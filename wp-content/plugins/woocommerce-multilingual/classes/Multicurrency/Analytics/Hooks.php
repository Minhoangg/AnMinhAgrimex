<?php

namespace WCML\Multicurrency\Analytics;

use IWPML_Action;
use WCML\Rest\Functions;
use WCML\Utilities\Resources;
use woocommerce_wpml;
use wpdb;
use WPML\FP\Fns;
use WPML\FP\Obj;

class Hooks implements IWPML_Action {

	/** @var \woocommerce_wpml $woocommerce_wpml */
	private $woocommerce_wpml;

	/** @var \wpdb $wpdb */
	private $wpdb;

	public function __construct( woocommerce_wpml $woocommerce_wpml, wpdb $wpdb ) {
		$this->woocommerce_wpml = $woocommerce_wpml;
		$this->wpdb             = $wpdb;
	}

	public function add_hooks() {
		if ( Functions::isAnalyticsPage() ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueueAssets' ] );
		}

		wpml_collect(
			[
				'revenue',
				'orders',
				'orders_stats',
				'products',
				'products_stats',
				'categories',
				'coupons',
				'coupons_stats',
				'taxes',
				'taxes_stats',
				'variations',
				'variations_stats',
			]
		)->each(
			function ( $item ) {
				add_filter( "woocommerce_analytics_{$item}_query_args", [ $this, 'addCurrencyArg' ] );
			}
		);

		wpml_collect(
			[
				'products',
				'orders',
				'variations',
				'categories',
				'coupons',
				'taxes',
			]
		)->each(
			function ( $item ) {
				add_filter( "woocommerce_analytics_clauses_join_{$item}_subquery", [ $this, 'addJoin' ] );
				add_filter( "woocommerce_analytics_clauses_join_{$item}_stats_total", [ $this, 'addJoin' ] );
				add_filter( "woocommerce_analytics_clauses_join_{$item}_stats_interval", [ $this, 'addJoin' ] );
				add_filter( "woocommerce_analytics_clauses_where_{$item}_subquery", [ $this, 'addWhere' ] );
				add_filter( "woocommerce_analytics_clauses_where_{$item}_stats_total", [ $this, 'addWhere' ] );
				add_filter( "woocommerce_analytics_clauses_where_{$item}_stats_interval", [ $this, 'addWhere' ] );
				add_filter( "woocommerce_analytics_clauses_select_{$item}_subquery", [ $this, 'addSelect' ] );
				add_filter( "woocommerce_analytics_clauses_select_{$item}_stats_total", [ $this, 'addSelect' ] );
				add_filter( "woocommerce_analytics_clauses_select_{$item}_stats_interval", [ $this, 'addSelect' ] );
			}
		);
	}

	public function enqueueAssets() {
		$multiCurrency = $this->woocommerce_wpml->get_multi_currency();
		$currencies    = $multiCurrency->get_currency_codes();
		$enqueue       = Resources::enqueueApp( 'multicurrencyAnalytics' );

		$enqueue(
			[
				'name' => 'wcmlAnalytics',
				'data' => [
					'strings'         => [
						'currencyLabel' => __( 'Currency', 'woocommerce-multilingual' ),
					],
					'filterItems'     => $this->getCurrencyFilterItems( $currencies ),
					'currencyConfigs' => $this->getCurrencyConfigs( $currencies, $multiCurrency ),
				],
			]
		);
	}

	/**
	 * Labels for the currency dropdown (filter).
	 *
	 * @param array $currencies
	 *
	 * @return array
	 */
	private function getCurrencyFilterItems( $currencies ) {
		$currencyLabels = get_woocommerce_currencies();

		return wpml_collect( $currencies )
			->map(
				function ( $currency ) use ( $currencyLabels ) {
					return [
						'value' => $currency,
						'label' => $currencyLabels[$currency],
					];
				}
			)->toArray();
	}

	/**
	 * Currency settings for displaying prices.
	 *
	 * @param array                $currencies
	 * @param \WCML_Multi_Currency $multiCurrency
	 *
	 * @return array
	 */
	private function getCurrencyConfigs( $currencies, $multiCurrency ) {
		return wpml_collect( $currencies )
			->mapWithKeys(
				function ( $currency ) use ( $multiCurrency ) {
					$get = Obj::prop( Fns::__, $multiCurrency->get_currency_details_by_code( $currency ) );

					return [
						$currency => [
							'code'              => $currency,
							'symbol'            => html_entity_decode( get_woocommerce_currency_symbol( $currency ) ),
							'symbolPosition'    => $get( 'position' ),
							'thousandSeparator' => $get( 'thousand_sep' ),
							'decimalSeparator'  => $get( 'decimal_sep' ),
							'precision'         => $get( 'num_decimals' ),
						],
					];
				}
			)->toArray();
	}

	/**
	 * @param array $args
	 *
	 * @return array
	 */
	public function addCurrencyArg( $args ) {
		return Obj::assoc( 'currency', $this->getCurrency(), $args );
	}

	/**
	 * @param array $clauses
	 *
	 * @return array
	 */
	public function addJoin( $clauses ) {
		$clauses[] = "JOIN {$this->wpdb->postmeta} wcml_currency_postmeta ON {$this->wpdb->prefix}wc_order_stats.order_id = wcml_currency_postmeta.post_id";

		return $clauses;
	}

	/**
	 * @param array $clauses
	 *
	 * @return array
	 */
	public function addWhere( $clauses ) {
		$clauses[] = $this->wpdb->prepare( "AND wcml_currency_postmeta.meta_key = '_order_currency' AND wcml_currency_postmeta.meta_value = %s", $this->getCurrency() );

		return $clauses;
	}

	/**
	 * @param array $clauses
	 *
	 * @return array
	 */
	public function addSelect( $clauses ) {
		$clauses[] = ', wcml_currency_postmeta.meta_value AS currency';

		return $clauses;
	}

	private function getCurrency() {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		return isset( $_GET['currency'] )
			? sanitize_text_field( wp_unslash( $_GET['currency'] ) )
			: wcml_get_woocommerce_currency_option();
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

}

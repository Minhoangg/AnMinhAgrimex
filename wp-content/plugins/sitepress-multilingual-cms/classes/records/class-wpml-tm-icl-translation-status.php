<?php

use WPML\FP\Lst;
use WPML\FP\Maybe;
use WPML\FP\Just;
use WPML\FP\Nothing;
use WPML\FP\Obj;
use function WPML\Container\make;
use WPML\Element\API\TranslationsRepository;

class WPML_TM_ICL_Translation_Status {
	/** @var wpdb $wpdb */
	public $wpdb;

	private $tm_records;

	private $table          = 'icl_translation_status';
	private $translation_id = 0;
	private $rid            = 0;

	private $status_result;

	/**
	 * WPML_TM_ICL_Translation_Status constructor.
	 *
	 * @param wpdb            $wpdb
	 * @param WPML_TM_Records $tm_records
	 * @param int             $id
	 * @param string          $type
	 */
	public function __construct( wpdb $wpdb, WPML_TM_Records $tm_records, $id, $type = 'translation_id' ) {
		$this->wpdb       = $wpdb;
		$this->tm_records = $tm_records;
		if ( $id > 0 && Lst::includes( $type, [ 'translation_id', 'rid' ] ) ) {
			$this->{$type} = $id;
		} else {
			throw new InvalidArgumentException( 'Unknown column: ' . $type . ' or invalid id: ' . $id );
		}
	}

	/**
	 * @param array $args in the same format used by \wpdb::update()
	 *
	 * @return $this
	 */
	public function update( $args ) {
		$this->wpdb->update(
			$this->wpdb->prefix . $this->table,
			$args,
			$this->get_args()
		);

		$this->status_result = null;
		return $this;
	}

	/**
	 * Wrapper for \wpdb::delete()
	 */
	public function delete() {
		$this->wpdb->delete(
			$this->wpdb->prefix . $this->table,
			$this->get_args()
		);
	}

	/**
	 * @return int
	 */
	public function rid() {

		return (int) $this->wpdb->get_var(
			"SELECT rid
		     FROM {$this->wpdb->prefix}{$this->table} "
			. $this->get_where()
		);
	}

	/**
	 * @return int
	 */
	public function status() {

		if ( $this->status_result === null ) {
			$status = $this->tm_records->get_preloaded_translation_status( $this->translation_id, $this->rid );
			if ( $status ) {
				$this->status_result = (int) $status->status;
			} else {
				if ( $this->translation_id ) {
					$job = TranslationsRepository::getByTranslationId( $this->translation_id );
					if ( $job ) {
						$this->status_result = Obj::prop( 'status', $job );

						return $this->status_result;
					}
				}

				$this->status_result = (int) $this->wpdb->get_var(
					"SELECT status
					 FROM {$this->wpdb->prefix}{$this->table} "
					. $this->get_where()
				);
			}
		}
		return (int) $this->status_result;
	}

	/**
	 * @return Just|Nothing
	 */
	public function previous() {

		return Maybe::fromNullable( $this->wpdb->get_var(
			"SELECT _prevstate
		     FROM {$this->wpdb->prefix}{$this->table} "
			. $this->get_where()
		) )->map( 'unserialize' );
	}

	/**
	 * @return string
	 */
	public function md5() {

		return $this->wpdb->get_var(
			"SELECT md5
		     FROM {$this->wpdb->prefix}{$this->table} "
			. $this->get_where()
		);
	}

	/**
	 * @return int
	 */
	public function translation_id() {

		return (int) $this->wpdb->get_var(
			"SELECT translation_id
		     FROM {$this->wpdb->prefix}{$this->table} "
			. $this->get_where()
		);
	}

	public function trid() {

		return $this->tm_records->icl_translations_by_translation_id( $this->translation_id() )->trid();
	}

	public function element_id() {

		return $this->tm_records->icl_translations_by_translation_id( $this->translation_id() )->element_id();
	}

	/**
	 * @return int
	 */
	public function translator_id() {

		return (int) $this->wpdb->get_var(
			"SELECT translator_id
		     FROM {$this->wpdb->prefix}{$this->table} "
			. $this->get_where()
		);
	}

	/**
	 * @return string|int
	 */
	public function service() {

		return (int) $this->wpdb->get_var(
			"SELECT translation_service
		     FROM {$this->wpdb->prefix}{$this->table} "
			. $this->get_where()
		);
	}

	private function get_where() {
		return ' WHERE ' .
			   ( $this->translation_id
				   ? $this->wpdb->prepare( ' translation_id = %d ', $this->translation_id )
				   : $this->wpdb->prepare( ' rid = %d ', $this->rid ) );
	}

	private function get_args() {

		return $this->translation_id
			? array( 'translation_id' => $this->translation_id )
			: array( 'rid' => $this->rid );
	}

	/**
	 * @param $id
	 *
	 * @return \WPML_TM_ICL_Translation_Status
	 * @throws \WPML\Auryn\InjectionException
	 */
	public static function makeByRid( $id ) {
		return make( self::class, [ ':id' => $id, ':type' => 'rid' ] );
	}
}

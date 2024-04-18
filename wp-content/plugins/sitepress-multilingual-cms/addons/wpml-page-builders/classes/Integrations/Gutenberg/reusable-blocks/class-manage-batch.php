<?php

namespace WPML\PB\Gutenberg\ReusableBlocks;

use WPML_TM_Translation_Batch;
use WPML_TM_Translation_Batch_Element;
use function wpml_collect;

class ManageBatch extends Manage {

	public function addBlocks( WPML_TM_Translation_Batch $batch ) {
		$blocks = $this->getBlocksFromPostElements( wpml_collect( $batch->get_elements() ) );

		$this->getBlockElementsToAdd( $blocks )->each(
				function( $block ) use ( $batch ) {
					$new_element = new WPML_TM_Translation_Batch_Element(
						$block->block_id,
						'post',
						$block->source_lang,
						$block->target_langs
					);

					$batch->add_element( $new_element );
				}
			);

		return $batch;
	}
}

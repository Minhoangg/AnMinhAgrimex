<?php

namespace WPML\PB\Elementor\Hooks;

use IWPML_Frontend_Action;

class Frontend implements IWPML_Frontend_Action {

    public function add_hooks() {
        add_action( 'elementor_pro/search_form/after_input', [ $this, 'addLanguageFormField' ] );
    }

    public function addLanguageFormField() {
        do_action( 'wpml_add_language_form_field' );
    }


}
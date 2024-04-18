<?php

namespace WPML\Rest;

use WP_REST_Request;

interface ITarget {

	function get_routes();
	function get_allowed_capabilities( WP_REST_Request $request );
	function get_namespace();

}

<?php
/**
 * Security Standards
 */
add_filter('xmlrpc_enabled', '__return_false');

add_filter( 'the_generator', 'my_secure_generator', 10, 2 );
function my_secure_generator( $generator, $type ) {
    return '';
}

add_action('init', 'remove_version_info');
function remove_version_info() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'woo_version');
}

add_filter('rest_authentication_errors', 'il_disable_default_rest_api', 99);
function il_disable_default_rest_api() {
	return new WP_Error('il_rest_api_disabled', 'REST API disabled', array('status' => 403));
}

add_filter( 'style_loader_src', 'rw_style_script_version', 9999, 2 );
add_filter( 'script_loader_src', 'rw_style_script_version', 9999, 2 );
function rw_style_script_version( $src, $handle ) {
    if( ENVIRONMENT == 'master' ) {
        if ( strpos( $src, 'ver=' ) ) {
            $ver = substr( strstr( $src, 'ver=' ), 4 );
            $ver .= '7088130fb9';
            $src = remove_query_arg( 'ver', $src );
            $src = add_query_arg( 'ver', md5( $ver ), $src );
        }
    } else {
        $develop_handle = [ 'project-scripts', 'project-styles' ];
        if ( in_array( $handle, $develop_handle ) ) {
            $src = remove_query_arg( 'ver', $src );
            $src = add_query_arg( 'ver', date( 'YmdHis' ), $src );
        }
    }

    return $src;
}
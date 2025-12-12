<?php
/**
 * Plugin Name: All 404 Redirect to Home by Soumen
 * Description: Redirect all 404 (Not Found) pages to the homepage. Includes safety checks to avoid loops and supports customizable redirect status codes. Use responsibly — blanket redirects may impact SEO.
 * Version:     1.0.0
 * Author:      Soumen Maity
 * Author URI:  https://www.linkedin.com/in/professional-soumen/
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: ls-404-redirect
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class LS_404_Redirect_To_Home {

    public function __construct() {
        add_action( 'template_redirect', [ $this, 'redirect_404_to_home' ] );
    }

    /**
     * Redirect all 404 pages to the homepage.
     */
    public function redirect_404_to_home() {
        // Do not run in admin or during AJAX/REST calls.
        if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
            return;
        }

        if ( ! is_404() ) {
            return;
        }

        $home_url = home_url( '/' );

        // Prevent any crazy loop if home somehow resolves as 404.
        if ( trailingslashit( esc_url_raw( $home_url ) ) === trailingslashit( esc_url_raw( home_url( add_query_arg( [] ) ) ) ) ) {
            // Continue with normal 404 behavior.
            return;
        }

        /**
         * Filter the status code for the 404 → home redirect.
         * Default: 301 (permanent)
         *
         * You can change to 302 via:
         * add_filter( 'ls_404_redirect_status_code', function() { return 302; } );
         */
        $status_code = apply_filters( 'ls_404_redirect_status_code', 301 );

        wp_safe_redirect( $home_url, $status_code );
        exit;
    }
}

new LS_404_Redirect_To_Home();

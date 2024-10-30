<?php
/**
 * Plugin Name: Langle Addons for Elementor
 * Description: <a href="https://langleaddons.com/">Langle Addons for Elementor</a> is one the best, light-weight, modern eye catchy Elementor addons comes with 17 free Elementor widget and many more coming soon.
 * Version: 1.0.0
 * Author: autocircle
 * Elementor tested up to: 3.7.8
 * Requires at least: 4.0
 * Requires PHP: 5.6
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: langle-addons
 * Domain Path: /languages/
 * 
 * @package Langle_Addons
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2023 Langle Software Solutions <https://langle.com.bd>
*/

defined('ABSPATH') || die();

if ( defined( 'LANGLE_ADDONS_DEV' ) && true == LANGLE_ADDONS_DEV ) {
	define('LANGLE_ADDONS_VERSION', time() );
} else {
    define( 'LANGLE_ADDONS_VERSION', '1.0.0' );
}

define( 'LANGLE_ADDONS__FILE__', __FILE__ );
define( 'LANGLE_ADDONS_DIR_PATH', plugin_dir_path( LANGLE_ADDONS__FILE__ ) );
define( 'LANGLE_ADDONS_DIR_URL', plugin_dir_url( LANGLE_ADDONS__FILE__ ) );

define( 'LANGLE_ADDONS_ASSETS', trailingslashit( LANGLE_ADDONS_DIR_URL . 'assets' ) );
define( 'LANGLE_ADDONS_MINIMUM_PHP_VERSION', '5.6' );
define( 'LANGLE_ADDONS_MINIMUM_ELEMENTOR_VERSION', '3.7.8' );

/**
 * Initialize the plugin
 */
function langle_addons_init() {
    require( LANGLE_ADDONS_DIR_PATH . 'inc/functions.php' );

    // Check for required PHP version
    if ( version_compare( PHP_VERSION, LANGLE_ADDONS_MINIMUM_PHP_VERSION, '<' ) ) {
        add_action( 'admin_notices', 'langle_addons_required_php_version_missing_notice' );
        return;
    }

    // Check if Elementor installed and activated
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'langle_addons_elementor_missing_notice' );
        return;
    }

    // Check for required Elementor version
    if ( ! version_compare( ELEMENTOR_VERSION, LANGLE_ADDONS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
        add_action( 'admin_notices', 'langle_addons_required_elementor_version_missing_notice' );
        return;
    }

    require LANGLE_ADDONS_DIR_PATH . 'base.php';
    \Langle_Addons\Elementor\Base::instance();
}

add_action( 'plugins_loaded', 'langle_addons_init' );

/**
 * Admin notice for required php version
 *
 * @return void
 */
function langle_addons_required_php_version_missing_notice() {
    $notice = langle_addons_kses_intermediate(sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
        __( '"%1$s" requires "%2$s" version %3$s or greater.', 'langle-addons' ),
        '<strong>' . __( 'Langle Addons', 'langle-addons' ) . '</strong>',
        '<strong>' . __( 'PHP', 'langle-addons' ) . '</strong>',
        LANGLE_ADDONS_MINIMUM_PHP_VERSION
    ));

    printf('<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice);
}

/**
 * Admin notice for elementor if missing
 *
 * @return void
 */
function langle_addons_elementor_missing_notice() {

    if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
        $notice_title = __( 'Activate Elementor', 'langle-addons' );
        $notice_url = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
    } else {
        $notice_title = __( 'Install Elementor', 'langle-addons' );
        $notice_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
    }

    $notice = langle_addons_kses_intermediate(sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
        __('%1$s requires %2$s to be installed and activated to function properly. %3$s', 'langle-addons' ),
        '<strong>' . __( 'Langle Addons', 'langle-addons' ) . '</strong>',
        '<strong>' . __( 'Elementor', 'langle-addons' ) . '</strong>',
        '<a href="' . esc_url( $notice_url ) . '">' . esc_html( $notice_title ) . '</a>'
    ));

    printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}

/**
 * Admin notice for required elementor version
 *
 * @return void
 */
function langle_addons_required_elementor_version_missing_notice() {

    $notice_title = __( 'Update Elementor', 'langle-addons' );
    $notice_url = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=elementor/elementor.php' ), 'upgrade-plugin_elementor/elementor.php' );

    $notice = langle_addons_kses_intermediate(sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
        __('"%1$s" requires "%2$s" version %4$s or greater. %3$s', 'langle-addons' ),
        '<strong>' . __( 'Langle Addons', 'langle-addons' ) . '</strong>',
        '<strong>' . __( 'Elementor', 'langle-addons' ) . '</strong>',
        '<a href="' . esc_url( $notice_url ) . '">' . esc_html( $notice_title ) . '</a>',
        LANGLE_ADDONS_MINIMUM_ELEMENTOR_VERSION
    ));

    printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}
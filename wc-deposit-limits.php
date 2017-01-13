<?php
/*
Plugin Name: WC Deposit Limits
Plugin URI:
Description: Allows deposits to be enabled for all products once the cart total (including full amount for all products)
is above a threshold
Version: 1.0.0
Author: Bryan Headrick
Author URI: https://catmanstudios.com
 License: GNU General Public License v3.0
 License URI: http://www.gnu.org/licenses/gpl-3.0.html

*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCDepositLimits {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'WC Deposit Limits';
	const slug = 'wc-deposit-limits';
	const minimum = 4500;

	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
//		register_activation_hook( __FILE__, array( $this, 'install_wc_deposit_limits' ) );

		//Hook up to the init action
		add_action( 'init', array( $this, 'init_wc_deposit_limits' ) );
	}

	/**
	 * Runs when the plugin is activated
	 */
	function install_wc_deposit_limits() {
		// do not generate any output here
	}

	/**
	 * Runs when the plugin is initialized
	 */
	function init_wc_deposit_limits() {

		/*
		 * TODO: Define custom functionality for your plugin here
		 *
		 * For more information:
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */

		add_filter( 'pre_option_wc_deposits_default_enabled', array( $this, 'settings_filter' ) );
	}

	function settings_filter($enabled){
        global $post;


	    if(is_product()){

            $subtotal = WC()->cart->get_cart_subtotal;

            if($subtotal >= self::minimum){
                return 'optional';
            }
            $items = WC()->cart->cart_contents;
                $subtotal = 0;
            foreach($items as $item){
                if($item['is_deposit']){
                    $subtotal += $item['full_amount'];
                }else{
                    $subtotal += $item['line_total'];
                }
            }
            if($subtotal >= self::minimum){
                return 'optional';
            }
        }

        return $enabled;

    }



	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			$this->load_file( self::slug . '-admin-script', '/js/admin.js', true );
			$this->load_file( self::slug . '-admin-style', '/css/admin.css' );
		} else {
			$this->load_file( self::slug . '-script', '/js/script.js', true );
			$this->load_file( self::slug . '-style', '/css/style.css' );
		} // end if/else
	} // end register_scripts_and_styles

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {

				wp_enqueue_script($name, $url, array('jquery'), false, true ); //depends on jquery
			} else {

				wp_enqueue_style( $name, $url );
			} // end if
		} // end if

	} // end load_file

} // end class
new WCDepositLimits();

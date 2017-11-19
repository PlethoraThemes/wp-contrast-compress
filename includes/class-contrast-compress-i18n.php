<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       plethorathemes.com
 * @since      1.0.0
 *
 * @package    Contrast_Compress
 * @subpackage Contrast_Compress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Contrast_Compress
 * @subpackage Contrast_Compress/includes
 * @author     PlethoraThemes <plethorathemes@gmail.com>
 */
class Contrast_Compress_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'contrast-compress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

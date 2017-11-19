<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       plethorathemes.com
 * @since      1.0.0
 *
 * @package    Contrast_Compress
 * @subpackage Contrast_Compress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Contrast_Compress
 * @subpackage Contrast_Compress/admin
 * @author     PlethoraThemes <plethorathemes@gmail.com>
 */
class Contrast_Compress_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name       = $plugin_name;
		$this->version           = $version;

		$this->contrastImageSlug = "contrast-compress";
		$this->JPEGCompression   = 75;
		$this->contrastRatio     = 50;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contrast_Compress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contrast_Compress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/contrast-compress-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contrast_Compress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contrast_Compress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/contrast-compress-admin.js', array( 'jquery' ), $this->version, false );

	}

	// CONTRAST COMPRESS
	function addContrastImageSize(){

		add_image_size( $this->contrastImageSlug, get_option('large_size_w'), get_option('large_size_h') );

	}

	function addSizeNames( $sizes ) { 

	    return array_merge( $sizes, array( $this->contrastImageSlug => __( 'Images with reduced contrast' ) ) );

	}

	function reduceImageContrast($meta) {

		$path   = wp_upload_dir();
		$subdir = trailingslashit(dirname($meta['file']));
		$file = trailingslashit($path['basedir']).$subdir.$meta['sizes'][$this->contrastImageSlug]['file'];
		// REPLACE DEFAULT 'LARGE' SIZE:
		// $file = trailingslashit($path['basedir']).$subdir.$meta['sizes']['large']['file'];
	    list($orig_w, $orig_h, $orig_type) = @getimagesize($file);	

	    $image = wp_load_image($file);	

	    if ( ! is_file($file) ){ return $meta; }

	    imagefilter( $image, IMG_FILTER_CONTRAST, $this->contrastRatio );

	    switch ( $orig_type ) {

	        case IMAGETYPE_GIF:
	            imagegif( $image, $file );
	            break;

	        case IMAGETYPE_PNG:
	            imagepng( $image, $file );
	            break;

	        case IMAGETYPE_JPEG:
	            imagejpeg( $image, $file, $this->JPEGCompression );
	            break;

	    }
	    return $meta;

	}

}

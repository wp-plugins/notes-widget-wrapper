<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Notes_Widget_Wrapper
 * @subpackage Notes_Widget_Wrapper/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Notes_Widget_Wrapper
 * @subpackage Notes_Widget_Wrapper/admin
 * @author     Your Name <email@example.com>
 */
class Notes_Widget_Wrapper_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $Notes_Widget_Wrapper    The ID of this plugin.
	 */
	private $Notes_Widget_Wrapper;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $Notes_Widget_Wrapper       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Notes_Widget_Wrapper, $version ) {

		$this->Notes_Widget_Wrapper = $Notes_Widget_Wrapper;
		$this->version = $version;

	}

	/**
	 * 
	 *
	 * @since    0.0.1
	 */
	public function notes_widget_wrapper_form($t,$return,$instance){

		$instance = wp_parse_args( 
			(array) $instance, 
			array( 
				'thumb_tack_colour' => 'red', 
				'background_colour' => 'yellow', 
				'text_colour' 			=> 'red',
				'font_size' 				=> 'normal',
				'iframe_height' 		=> '200',
				'wrapper_css' 			=> ''
			) 
		);

    if ( !isset($instance['use_notes_widget_style']) ) {
      $instance['use_notes_widget_style'] = null;
    }
    
    include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/view-notes-widget-wrapper-admin.php' );

    $retrun = null;
    
    return array($t,$return,$instance);

	}


	public function notes_widget_wrapper_form_update($instance, $new_instance, $old_instance){
    
    $instance['use_notes_widget_style'] 	= isset($new_instance['use_notes_widget_style']);
    $instance['thumb_tack_colour'] 				= sanitize_html_class($new_instance['thumb_tack_colour']);
    $instance['background_colour'] 				= sanitize_html_class($new_instance['background_colour']);
    $instance['text_colour'] 							= sanitize_html_class($new_instance['text_colour']);
    $instance['font_size'] 								= sanitize_html_class($new_instance['font_size']);
    $instance['iframe_height'] 						= filter_var($new_instance['iframe_height'], FILTER_SANITIZE_NUMBER_INT);
    $instance['wrapper_css'] 							= esc_html($new_instance['wrapper_css']);

    return $instance;
	}


	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Notes_Widget_Wrapper_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Notes_Widget_Wrapper_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Notes_Widget_Wrapper, plugin_dir_url( __FILE__ ) . 'css/notes-widget-wrapper-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Notes_Widget_Wrapper_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Notes_Widget_Wrapper_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Notes_Widget_Wrapper, plugin_dir_url( __FILE__ ) . 'js/notes-widget-wrapper-admin.js', array( 'jquery' ), $this->version, false );

	}

}

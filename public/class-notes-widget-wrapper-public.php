<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Notes_Widget_Wrapper
 * @subpackage Notes_Widget_Wrapper/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Notes_Widget_Wrapper
 * @subpackage Notes_Widget_Wrapper/public
 * @author     Your Name <email@example.com>
 */
class Notes_Widget_Wrapper_Public {

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
	 * @param      string    $Notes_Widget_Wrapper       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Notes_Widget_Wrapper, $version ) {

		$this->Notes_Widget_Wrapper = $Notes_Widget_Wrapper;
		$this->version = $version;

	}


	public function notes_widget_wrapper_update_callback($params){
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if (!empty($widget_opt[$widget_num]['use_notes_widget_style'])) {
    	$thumb_tack_colour 	= isset($widget_opt[$widget_num]['thumb_tack_colour']) ? sanitize_html_class($widget_opt[$widget_num]['thumb_tack_colour']) : 'red';
    	$background_colour 	= isset($widget_opt[$widget_num]['background_colour']) ? sanitize_html_class($widget_opt[$widget_num]['background_colour']) : 'yellow';
    	$text_colour 				= isset($widget_opt[$widget_num]['text_colour']) ? sanitize_html_class($widget_opt[$widget_num]['text_colour']) : 'red';
    	$font_size					= isset($widget_opt[$widget_num]['font_size']) ? sanitize_html_class($widget_opt[$widget_num]['font_size']) : 'normal';
    	$iframe_height			= isset($widget_opt[$widget_num]['iframe_height']) ? filter_var($widget_opt[$widget_num]['iframe_height'], FILTER_SANITIZE_NUMBER_INT) : '200';
    	$wrapper_css				= isset($widget_opt[$widget_num]['wrapper_css']) ? esc_html($widget_opt[$widget_num]['wrapper_css']) : '';
			
			$wrapper_remove_chars = array("{", "}", "<");
    	$wrapper_css = str_replace($wrapper_remove_chars, "", $wrapper_css);
    	
    	$widget_class_string 	= 'notes-widget-wrapper' . ' thumb-tack-colour-' . $thumb_tack_colour . ' background-colour-' . $background_colour . ' text-colour-' . $text_colour . ' font-size-' . $font_size;
    	$widget_id_string 		= 'notes-widget-wrapper-' . $widget_num;
    	
    	ob_start();

    	?>
				<style>
					#notes-widget-wrapper-<?php echo $widget_num; ?>.notes-widget-wrapper iframe {
						height:<?php echo $iframe_height; ?>px;
					}
					#notes-widget-wrapper-<?php echo $widget_num; ?>.notes-widget-wrapper {
						<?php echo $wrapper_css; ?>
					}
				</style>
    	<?php

    	$css_style = ob_get_clean();

    	$params[0]['before_widget'] =  $params[0]['before_widget'] . '<div id="'. $widget_id_string .'" class="' . $widget_class_string . '" ><div class="notes-widget-wrapper-pushpin"></div>';
    	$params[0]['after_widget'] 	=  '</div>' . $params[0]['after_widget'] . $css_style;
    }
    
    return $params;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->Notes_Widget_Wrapper, plugin_dir_url( __FILE__ ) . 'css/notes-widget-wrapper-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->Notes_Widget_Wrapper, plugin_dir_url( __FILE__ ) . 'js/notes-widget-wrapper-public.js', array( 'jquery' ), $this->version, false );

	}

}

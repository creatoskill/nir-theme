<?php
class ImageExtractorCS
{
    /**
   * A reference to an instance of this class.
   */
    private static $instance;

  /**
   * Returns an instance of this class.
   */
  public static function get_instance() {

  	if ( null == self::$instance ) {
  		self::$instance = new ImageExtractorCS();
  	}

  	return self::$instance;

  }
  /**
  *load Action Hooks  
  */
  function __construct()
  {
    //Enqueue/load Scripts
  	add_action('wp_enqueue_scripts', array($this, 'cs_enqueue_script'));

  }


  

  /**
  *load Action Hooks Function   
  */
  function cs_enqueue_script() {   
    /*
    *Registering Scripts and Styles then load these.
    */      
    // wp_register_style('cs_ua_css', plugin_dir_url( __FILE__ ) . 'assets/cs-style.css');


    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, false);
    wp_enqueue_script('jquery'); 



    // wp_register_script( 'cs_ae_script', plugin_dir_url( __FILE__ ) . 'assets/cs-script.js' );
   



    //localizing ajaxURL
    wp_localize_script( 'cs_ae_script', 'ajaxURL', admin_url('admin-ajax.php'));


    wp_enqueue_script('cs_ae_script');
    wp_enqueue_style('cs_ua_css'); 
    
}






}//end of class

//run an action to make the class live.
add_action( 'plugins_loaded', array( 'ImageExtractorCS', 'get_instance' ) );

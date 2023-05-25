<?php
/**
 * NirTheme functions and definitions
 *
 * @package NirTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// NirTheme's includes directory.
$NirTheme_inc_dir = 'inc';

// Array of files to include.
$NirTheme_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/NirTheme/NirTheme/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                    
);

//run an action to make the class live.

// require_once get_theme_file_path( $NirTheme_inc_dir .'/conditional-menu.php' );
// add_action( 'init', array ( 'nir_Conditional_Menus', 'init' ) );

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$NirTheme_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$NirTheme_includes[] = '/jetpack.php';
}
// Include files.
foreach ( $NirTheme_includes as $file ) {
	require_once get_theme_file_path( $NirTheme_inc_dir . $file );
    
}
function nir_custom_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
	background-image: url(<?php echo get_template_directory_uri()."/site-logo.jpg"?>);
	height: 100px;
    width: auto;
    background-size: contain;
    background-repeat: no-repeat;
    padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'nir_custom_login_logo' );
function nir_custom_login_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'nir_custom_login_url' );
function nir_login_logo_url_redirect() {
    return 'https://passwordprotectwp.com/';
}
add_filter( 'login_headertitle', 'nir_login_logo_url_redirect' );
add_filter( 'login_display_language_dropdown', '__return_false' );

function redirect_login_page() {
    $login_url  = home_url( '/login' );
    $url = basename($_SERVER['REQUEST_URI']); // get requested URL
    isset( $_REQUEST['redirect_to'] ) ? ( $url   = "wp-login.php" ): 0; // if users ssend request to wp-admin
    if( $url  == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET')  {
        wp_redirect( $login_url );
        exit;
    }
}
add_action('init','redirect_login_page');

function error_handler() {
    $login_page  = home_url( '/login' );
    global $errors;
    $err_codes = $errors->get_error_codes(); // get WordPress built-in error codes
    $_SESSION["err_codes"] =  $err_codes;
    wp_redirect( $login_page ); // keep users on the same page
    exit;
}
add_filter( 'login_errors', 'error_handler');

add_action( "login_enqueue_scripts", "admin_load_styles");
function admin_load_styles(){
	wp_enqueue_style( 'nirbhai-admin-css', get_template_directory_uri()."/css/custom-login-styles.css", array(), time() );
	
}

function admin_default_page() {
    $home_url = home_url();
    return $home_url;
  }
  
add_filter('login_redirect', 'admin_default_page');
add_filter('logout_redirect', 'admin_default_page');

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */


// user registration login form
function nir_registration_form() {
        
	// only show the registration form to non-logged-in members
	if(!is_user_logged_in()) {
        
        // check if registration is enabled
		$registration_enabled = get_option('users_can_register');
        
		// if enabled
		if($registration_enabled) {
            $output = nir_registration_fields();
		} else {
            $output = __('User registration is not enabled');
		}
        
		return '<div class="main-box-registration-nir">'.$output."</div>";
	}
}
add_shortcode('register_form', 'nir_registration_form');

// registration form fields
function nir_registration_fields() {
	
	ob_start(); ?>	
		<h3 class="nir_header"><?php _e('Register New Account'); ?></h3>
		
		<?php 
		// show any error messages after form submission
		nir_register_messages(); ?>
		<div class="register-form-nir">
            <form id="nir_registration_form" class="nir_form" action="" method="POST">
                <fieldset>
				<p>
					<label for="nir_user_Login"><?php _e('Username'); ?></label>
					<input name="nir_user_login" id="nir_user_login" class="nir_user_login" type="text"/>
				</p>
				<p>
					<label for="nir_user_email"><?php _e('Email'); ?></label>
					<input name="nir_user_email" id="nir_user_email" class="nir_user_email" type="email"/>
				</p>
				<p>
                    <label for="nir_user_first"><?php _e('First Name'); ?></label>
					<input name="nir_user_first" id="nir_user_first" type="text" class="nir_user_first" />
				</p>
				<p>
                    <label for="nir_user_last"><?php _e('Last Name'); ?></label>
					<input name="nir_user_last" id="nir_user_last" type="text" class="nir_user_last"/>
				</p>
				<p>
					<label for="password"><?php _e('Password'); ?></label>
					<input name="nir_user_pass" id="password" class="password" type="password"/>
				</p>
				<p>
					<label for="password_again"><?php _e('Password Again'); ?></label>
					<input name="nir_user_pass_confirm" id="password_again" class="password_again" type="password"/>
				</p>
				<p>
					<input type="hidden" name="nir_csrf" value="<?php echo wp_create_nonce('nir-csrf'); ?>"/>
					<input type="submit" class="submit-btn-register" value="<?php _e('Register Your Account'); ?>"/>
				</p>
			</fieldset>
		</form>
        </div>
	<?php
	return ob_get_clean();
}

// register a new user
function nir_add_new_user() {
    if (isset( $_POST["nir_user_login"] ) && wp_verify_nonce($_POST['nir_csrf'], 'nir-csrf')) {
        $user_login		= $_POST["nir_user_login"];	
        $user_email		= $_POST["nir_user_email"];
        $user_first 	    = $_POST["nir_user_first"];
      $user_last	 	= $_POST["nir_user_last"];
      $user_pass		= $_POST["nir_user_pass"];
      $pass_confirm 	= $_POST["nir_user_pass_confirm"];
      
      // this is required for username checks
      require_once(ABSPATH . WPINC . '/registration.php');
      
      if(username_exists($user_login)) {
          // Username already registered
          nir_errors()->add('username_unavailable', __('Username already taken'));
      }
      if(!validate_username($user_login)) {
          // invalid username
          nir_errors()->add('username_invalid', __('Invalid username'));
      }
      if($user_login == '') {
          // empty username
          nir_errors()->add('username_empty', __('Please enter a username'));
      }
      if(!is_email($user_email)) {
          //invalid email
          nir_errors()->add('email_invalid', __('Invalid email'));
      }
      if(email_exists($user_email)) {
          //Email address already registered
          nir_errors()->add('email_used', __('Email already registered'));
      }
      if($user_pass == '') {
          // passwords do not match
          nir_errors()->add('password_empty', __('Please enter a password'));
      }
      if($user_pass != $pass_confirm) {
          // passwords do not match
          nir_errors()->add('password_mismatch', __('Passwords do not match'));
      }
      
      $errors = nir_errors()->get_error_messages();
      
      // if no errors then cretate user
      if(empty($errors)) {
          
          $new_user_id = wp_insert_user(array(
                  'user_login'		=> $user_login,
                  'user_pass'	 		=> $user_pass,
                  'user_email'		=> $user_email,
                  'first_name'		=> $user_first,
                  'last_name'			=> $user_last,
                  'user_registered'	=> date('Y-m-d H:i:s'),
                  'role'				=> 'subscriber'
              )
          );
          if($new_user_id) {
              // send an email to the admin
              wp_new_user_notification($new_user_id);
              
              // log the new user in
              wp_setcookie($user_login, $user_pass, true);
              wp_set_current_user($new_user_id, $user_login);	
              do_action('wp_login', $user_login);
              
              // send the newly created user to the home page after logging them in
              wp_redirect(home_url()); exit;
          }
          
      }
  
  }
}
add_action('init', 'nir_add_new_user');

// used for tracking error messages
function nir_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function nir_register_messages() {
	if($codes = nir_errors()->get_error_codes()) {
		echo '<div class="nir_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = nir_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
        ob_start();
        wp_loginout();
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        if(!is_user_logged_in( )){

            $items .= '<li id="menu-item-cs" itemscope="itemscope" class="menu-item menu-item-type-custom menu-item-object-custom nav-item">'. $loginoutlink .'</li>';
            $items .= '<li id="menu-item-cs" itemscope="itemscope" class="menu-item menu-item-type-custom menu-item-object-custom nav-item">'.'<a href="'.get_home_url().'/register">Register</a>'.'</li>';

        }else{

            $items .= '<li id="menu-item-cs" itemscope="itemscope" class="menu-item menu-item-type-custom menu-item-object-custom nav-item">'. $loginoutlink .'</li>';

        }
    return $items;
}
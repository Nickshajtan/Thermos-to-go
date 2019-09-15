<?php
/**
 * File for functions and definitions of the theme
 *
 * Contain loading of styles and scripts
 *
 */
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
//Style css
add_action('wp_enqueue_scripts', 'load_sec_css');
function load_sec_css() {
    $url = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css';
    $response = wp_remote_get('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    $code = wp_remote_retrieve_response_code( $response );
    if ( !is_wp_error( $response ) ){
        if( isset( $url ) && !empty( $url) && ( $code == '200') ){
            wp_register_style( 'b4', $url, array(), ' ' );
            wp_enqueue_style( 'b4' );
        }
    }
    else{
        wp_register_style( 'b4', get_template_directory_uri() . '/styles/bootstrap.min.css', array(), ' ' );
        wp_enqueue_style( 'b4' );
    }
    wp_register_style( 'mine',  get_template_directory_uri() . '/styles/mine.css', array(), ' ' );
    wp_enqueue_style( 'mine');
    wp_register_style( 'styles', get_stylesheet_uri(), array(), ' ' );
    wp_enqueue_style( 'styles' );
    if( is_home() || is_front_page() || is_product() ){
        wp_register_style( 'slick',  get_template_directory_uri() . '/styles/slick.css', array(), ' ' );
        wp_enqueue_style( 'slick');
        wp_register_style( 'slick-theme',  get_template_directory_uri() . '/styles/slick-theme.css', array(), ' ' );
        wp_enqueue_style( 'slick-theme');   
    }
    if( is_product() ){
        wp_register_style( 'fancybox',  get_template_directory_uri() . '/styles/jquery.fancybox.min.css', array(), ' ' );
        wp_enqueue_style( 'fancybox');
    }
    wp_register_style( 'progressive',  get_template_directory_uri() . '/styles/progressive-image.min.css', array(), ' ' );
    wp_enqueue_style( 'progressive');
}
//JQUERY
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
    $url = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js';
    $response = wp_remote_get('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    $code = wp_remote_retrieve_response_code( $response );
    if ( !is_wp_error( $response ) ){
        if( isset( $url ) && !empty( $url) && ( $code == '200') ){
        	wp_deregister_script( 'jquery-core' );
	        wp_register_script( 'jquery-core', $url ,array(), null, true);
	        wp_enqueue_script( 'jquery' );
        }
    }
    else{
            wp_deregister_script( 'jquery-core' );
	        wp_register_script( 'jquery-core', get_theme_file_uri( 'js/jquery-3.3.1.min.js' ) ,array(), null, true);
	        wp_enqueue_script( 'jquery' );
    }
}
//Load js
add_action( 'wp_enqueue_scripts', 'load_js' );
function load_js() {
     wp_register_script('custom', get_theme_file_uri( 'js/scripts.js' ), array( 'jquery' ), null, true );
     wp_enqueue_script('custom');
     $wnm_custom = array( 'template_url' => get_bloginfo('template_url'), 'admin_url' => get_bloginfo('admin_url'), 'url' => get_bloginfo('url') );
     wp_localize_script( 'custom', 'wnm_custom', $wnm_custom );
    if( is_home() || is_front_page() || is_product() ){
         wp_register_script('slick', get_theme_file_uri( 'js/slick.js' ), array( 'jquery' ), null, true );
         wp_enqueue_script('slick');
    }
    if( is_product() ){
         wp_register_script('fancybox', get_theme_file_uri( 'js/jquery.fancybox.min.js' ), array( 'jquery' ), null, true );
         wp_enqueue_script('fancybox');
    }
     wp_register_script('progressive', get_theme_file_uri( 'js/progressive-image.min.js' ), array( 'jquery' ), null, true );
     wp_enqueue_script('progressive');
    if( is_home() || is_paged() || is_front_page() || is_shop() || is_page('78') ){
                wp_register_script( 'mihdan-infinite-scroll', get_theme_file_uri( 'js/jquery-ias.min.js' ), array( 'jquery' ), null, true );
                wp_enqueue_script('mihdan-infinite-scroll');
                 //$wnm_custom = array( 'ajax_text_button' => get_field('text_for_ajax_button_more','options'), 'ajax_end_load' => get_field('text_fo_end_of_ajax_load','options') );
                 //wp_localize_script( 'mihdan-infinite-scroll', 'wnm_custom', $wnm_custom );
    }
}
/**
 * Disable the confirmation notices when an administrator
 * changes their email address.
 *
 * @see http://codex.wordpress.com/Function_Reference/update_option_new_admin_email
 */
function wpdocs_update_option_new_admin_email( $old_value, $value ) {

    update_option( 'admin_email', $value );
}
add_action( 'add_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
add_action( 'update_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
//No slash
add_filter('user_trailingslashit', 'no_page_slash', 70, 2);
function no_page_slash( $string, $type ){
   global $wp_rewrite;

	if( ( $type == 'page' || $type == 'product' || $type == 'post' ) && $wp_rewrite->using_permalinks() && $wp_rewrite->use_trailing_slashes )
		$string = untrailingslashit($string);

   return $string;
}
//Remove admin pages
function remove_menus(){
    remove_menu_page( 'edit.php' ); 
    remove_menu_page( 'users.php' );
    remove_menu_page( 'edit-comments.php' );   
}
add_action( 'admin_menu', 'remove_menus' );
//Options page for main information
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Main Settings',
		'menu_title'	=> 'Основная информация',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
//Setup
add_theme_support( 'post-thumbnails', array( 'post' ) );
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'blog-thumb', 70, 90, array( 'left', 'center' ) ); 
    add_image_size( 'modal', 800, 600, array( 'left', 'center' ) ); 
    add_image_size( 'middle', 150, 150, array( 'left', 'top' ) );
    add_image_size( 'position', 540, 300, array( 'left', 'top' ) );
    add_image_size( 'sold-full', 580, 420, array( 'left', 'top' ) );
    add_image_size( 'map', 540, 625, array( 'left', 'top' ) );
    add_image_size( 'min', 400, 450, array( 'left', 'top' ) );
    add_image_size( 'lazy-load', 32, 32, array( 'left', 'top' ) );
}
if ( ! function_exists( 'theme_setup' ) ) :
function theme_setup(){
    //Add support theme html 5    
    add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption') ); 
    //Add custom logo
    add_theme_support( 'custom-logo', array(
		'height'      => 52,
		'width'       => 166,
		'flex-height' => false,
	) );
}
endif;
add_action( 'after_setup_theme', 'theme_setup' );
remove_filter('the_content', 'wpautop');
add_theme_support( 'post-thumbnails' );
//No robots
function meta_robots () {
if (is_feed() or is_single() or is_category() or is_author() or is_archive() or is_month() or is_date() or is_day() or is_year() or is_tag() or is_tax() or is_attachment() or is_paged() or is_search() or is_404())
{
echo "".'<meta name="robots" content="noindex,nofollow" />'."\n";
} }
add_action('wp_head', 'meta_robots');
//Is mobile
function is_mobile(){
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if(
		// добавить '|android|ipad|playbook|silk' в первую регулярку для определения еще и tablet
		@preg_match(
			'/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i|android|ipad|playbook|silk',
			$useragent
		)
		||
		@preg_match(
			'/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
			substr($useragent,0,4)
		)
	)
		return true;
	return false; 
}
//Pagination
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}
//title
add_theme_support('title-tag');
//Enable webp + mp4 +webp
add_filter( 'upload_mimes', 'upload_allow_types' );
function upload_allow_types( $mimes ) {
    $mimes['mp4']  = 'video/mp4'; 
   // $mimes['mp4']  = 'application/mp4'; 
    $mimes['webm']  = 'video/webm'; 
    $mimes['webp']  = 'image/webp';
    return $mimes;
}
//Register sidebars
add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_sidebar( array(
		'name'          => 'Хедер',
		'id'            => "header",
		'description'   => 'Виджет для корзины',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => "",
		'before_title'  => '',
		'after_title'   => "",
	) );
}
//Email form
add_action( 'wp_ajax_ajax_order', 'ajax_mail_function' ); // wp_ajax_{ЗНАЧЕНИЕ ПАРАМЕТРА ACTION!!}
add_action( 'wp_ajax_nopriv_ajax_order', 'ajax_mail_function' );  // wp_ajax_nopriv_{ЗНАЧЕНИЕ ACTION!!}
function ajax_mail_function(){
    //Variables
        $headers = "Content-type: text/html; charset=utf-8\r\n";
        $sitename = get_bloginfo('name');
        $admin_email = get_field('contact_mail','options');
        $subject = "Новое сообщение с сайта ". $sitename;
        $user_name = htmlspecialchars(trim($_POST['name']));
        $user_phone = htmlspecialchars(trim($_POST['phone']));
        $spam_first = (trim($_POST['spamFirst']));
        $spam_second = (trim($_POST['spamSecond']));
if( (isset( $spam_first ) && !empty( $spam_first )) || (isset( $spam_second ) && !empty( $spam_second) )){
    exit;
}    
    //    $id = trim($_POST['page']);
        $message = '<html>
<head>
     <meta charset="UTF-8">
     <title>Форма обратной связи</title>
</head>
<body>
    <body style="width:94%; height:auto;">
    <table style="width:100%; max-width:600px;height:auto;vertical-align: middle;border-color:#000;border:0px;border-style:solid;border-spacing:unset;padding:0;" summary="форма заявки" rules="none" frame="border" cellpadding="0" cellspacing="0">
        <caption align="justify" style="height: 45px;">
            <h2 style="margin: 5px;font-size: 1.5rem;">Сообщение</h2>
        </caption>
        <thead align="justify" style="background-color:#ddd;border-color:#000;border:1px;border-style:solid;">
            <tr style="height: 30px;">
                <td align="center" style="width:100%;" colspan="4">
                    <h3 style="margin:5px;font-size: 1.1rem;">' . $subject . '</h3>
                </td>
            </tr>
        </thead>
        <tbody style="font-size: 1rem;">';
if(isset($user_name)&&!empty($user_name)) {       
  $message .= '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                <td style="border-right: 1px solid #ccc;padding-left:25px;">Имя отправителя:</td>
                <td style="border-left: 1px solid #ccc;padding-left:25px;">'. $user_name .'</td>
            </tr>';
}
if(isset($user_phone)&&!empty($user_phone)) {     
   $message .=   '<tr style="height:30px;width:auto;border-bottom: 1px solid black;">
                <td style="border-right: 1px solid #ccc;padding-left:25px;">
                    Номер телефона:
                </td>
                <td style="border-left: 1px solid #ccc;padding-left:25px;">
                    '. $user_phone .'
                </td>
            </tr>';
}
    $message .= '<tr style="height:90px;width:auto;">
               <td colspan="4" align="center">
                        <a href="'. get_bloginfo("url") . '/wp-admin" style="background-color:#1eb4e9;border:none; width: 70%;padding: 16px 15px;-webkit-border-radius: 49px;border-radius: 49px;margin:16px 0;color:#fff;font-size: 1rem;text-decoration:none;font-weight:600;">АДМИНИСТРИРОВАТЬ</a>
               </td>
            </tr>';
        mail($admin_email,$subject,$message,$headers);
}


if( is_plugin_active('woocommerce/woocommerce.php') ){
    /* Woocommerce */
    add_action( 'after_setup_theme', 'woocommerce_support' );
    function woocommerce_support() {
    add_theme_support( 'woocommerce' );
    }
    add_action( 'init', 'custom_fix_thumbnail' );

    function custom_fix_thumbnail() {
      add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

        function custom_woocommerce_placeholder_img_src( $src ) {
        $upload_dir = wp_upload_dir();
        $uploads = untrailingslashit( $upload_dir['baseurl'] );
        $src = $uploads . '/2019/04/term-min.png';

        return $src;
        }
    }

    add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
        function woocommerce_header_add_to_cart_fragment( $fragments ) {
            global $woocommerce;
            ob_start(); ?>
                     <a href="<?php echo $woocommerce->cart->get_cart_url() ?>" class="basket-btn basket-btn_fixed-xs cart-contents">
                        <span class="basket-btn__label sr-only"><?php echo __('Корзина'); ?></span>
                        <span class="basket-btn__counter cart-contents"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
                     </a>
            <?php
            $fragments['.cart-contents'] = ob_get_clean();
            return $fragments;
        }

    add_filter('gettext', 'translate_text');
    add_filter('ngettext', 'translate_text');
    function translate_text($translated) {
    $translated = str_ireplace('Подытог', 'Итого', $translated);
    $translated = str_ireplace('Таблица размеров', 'Характеристики', $translated);
    $translated = str_ireplace('Хит продаж', 'Хит', $translated);
    $translated = str_ireplace('О бренде', 'О производителе', $translated);
    $translated = str_ireplace('Новый', 'Новинка', $translated);
    $translated = str_ireplace('(необязательно)', '', $translated);
    return $translated;
    }
    function add_to_cart_redirect_to_checkout() {
        wp_safe_redirect( get_permalink( get_option( 'woocommerce_checkout_page_id') ) );
            die();
    }
    add_action('woocommerce_add_to_cart','add_to_cart_redirect_to_checkout', 100 );

    add_filter('woocommerce_checkout_fields','remove_checkout_fields');
    function remove_checkout_fields($fields){
        unset($fields['billing']['billing_country']);
    }

    add_filter( 'woocommerce_checkout_fields' , 'custom_checkout_fields' );

    function custom_checkout_fields( $fields ) {
     $fields['billing']['billing_apartment'] = array(
            'type'          => 'radio',
            'class'         => array('form-row-wide'),
            'label'         =>  'Транспортная компания:',
            'options' => array(
                                'Укрпочта' => 'Укрпочта',
                                'Новая почта' => 'Новая почта'
                                ),
            );
     return $fields;
    }
    add_action( 'woocommerce_checkout_update_order_meta', 'billing_apartment_update_order_meta' );

    function shipping_apartment_update_order_meta( $order_id ) {
        if ( ! empty( $_POST['billing_apartment'] ) ) {
            update_post_meta( $order_id, 'billing_apartment', sanitize_text_field( $_POST['billing_apartment'] ) );
        }
        else{
            update_post_meta( $order_id, 'billing_apartment', 'Новая почта' );
        }
    }
    add_action( 'woocommerce_admin_order_data_after_billing_address', 'custom_field_display_admin_order_meta', 10, 1 );

    function custom_field_display_admin_order_meta($order){
        echo '<p><strong>'.__('Транспортная компания').':</strong> ' . get_post_meta( $order->id, '_billing_apartment', true ) . '</p>';
    }
    // Выводим значения полей в шаблоне письма с заказом
    add_filter('woocommerce_email_order_meta_keys', 'email_checkout_field_order_meta_keys');
    function email_checkout_field_order_meta_keys( $keys ) {
        $keys['Транспортная компания:'] = 'billing_apartment';
    return $keys;
    }
    add_filter('woocommerce_get_image_size_single','add_single_size',1,10);
    function add_single_size($size){

        $size['width'] = 500;
        $size['height'] = 1024;
        $size['crop']   = 0;
        return $size;
    }
}
//Testing
add_filter( 'admin_footer_text', 'wp_usage' );
function wp_usage(){
	echo sprintf(
		__( 'SQL: %d за %s сек. %s MB', 'km' ),
		get_num_queries(),
		timer_stop( 0, 3 ),
		round( memory_get_peak_usage()/1024/1024, 2 )
	);
}
//Disable auto renewals
if( is_admin() ){
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-themes.php', 'wp_update_themes' );
	remove_action( 'load-update.php', 'wp_update_plugins' );
	remove_action( 'load-update.php', 'wp_update_themes' );
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'wp_update_plugins', 'wp_update_plugins' );
	remove_action( 'wp_update_themes', 'wp_update_themes' );
	add_filter( 'pre_site_transient_browser_'. md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_true' );
}
/** Endings for timer **/
function get_num_ending($number, $ending_arr) 
{ 
    $text['day'] = __('День').' "%s"';
    
    $number = $number % 100; 
    if ($number >= 11 && $number <= 19) { 
        $ending = $ending_arr[2]; 
    } else { 
        $i = $number % 10; 
        switch ($i) { 
            case (1): $ending = $ending_arr[0]; 
                break; 
            case (2): 
            case (3): 
            case (4): $ending = $ending_arr[1]; 
                break; 
            default: $ending = $ending_arr[2]; 
        } 
    } 
    return $ending; 
}
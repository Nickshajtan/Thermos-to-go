<?php if (substr_count($_SERVER[‘HTTP_ACCEPT_ENCODING’], ‘gzip’)) ob_start(«ob_gzhandler»); else ob_start(); ?>
<?php ini_set('zlib.output_compression', 'On'); ini_set('zlib.output_compression_level', '1'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,user-scalable=0">
    <meta name="keywords" content="">
    <title><?php echo wp_get_document_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
    <div class="main__wrapper">
        <header id="nav" class="<?php if( !is_home() && !is_front_page() ) : ?>blue__bg<?php endif; ?>">
           <p class="logo d-block d-md-none">Термос <span>to GO</span></p>
           <span class="burger d-flex justify-content-center align-items-start d-md-none">
               <span class="line d-block"></span>
           </span>
            <div class="container">
                <div class="row">
                    <?php $href = get_home_url(); ?>
                    <ul>
                        <li class="d-none d-md-block">
                            <?php $logo_img = '';
                                    if( $custom_logo_id = get_theme_mod('custom_logo') ){
                                        $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                                            'class'    => 'custom-logo',
                                            'itemprop' => 'logo',
                                        ) );
                                    }
                            ?>
                            <?php if( !empty( $logo_img ) ){ echo $logo_img; }
                                  else{ echo '<p class="logo">Термос <br><span>to GO</span></p>'; }
                            ?>
                        </li>
                        <li>
                            <a href="<?php echo ( is_home() || is_front_page() ) ? '#about' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('О нас'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo ( is_home() || is_front_page() ) ? '#action' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('Акции'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo ( is_home() || is_front_page() ) ? '#products' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('Каталог'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo ( is_home() || is_front_page() ) ? '#review' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('Отзывы'); ?></a>
                        </li>
                        <li>
                            <div class="social d-flex flex-row">
                                <a href="<?php the_field('inst__link','options'); ?>" class="inst" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/inst-min.png" alt="Instagram icon"></a>
                                <a href="<?php the_field('fb__link','options'); ?>" class="fb" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/fb-min.png" alt="Facebook icon"></a>
                            </div>
                            <?php $cycle = get_field('contact__phones', 'options'); ?>
                            <?php if( !empty($cycle) ) : ?>
                                <?php foreach( $cycle  as $cycl ) : ?>
                                    <a href="tel:<?php echo $cycl['one__phone_tel']; ?>" class="phone"><?php echo $cycl['one__phone']; ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <?php if( is_plugin_active('woocommerce/woocommerce.php') ) : ?>
            <?php global $woocommerce; ?>
            <?php $cart = WC()->cart->get_cart_contents_count();  
                  if( !is_cart() && ( $cart != 0 ) ) : ?>
            <div id="cart" class="s-header__basket-wr woocommerce d-flex justify-content-center align-items-center">
                <a href="<?php echo $woocommerce->cart->get_cart_url() ?>" class="basket-btn basket-btn_fixed-xs cart-contents">
                        <span class="basket-btn__label sr-only"><?php echo __('Корзина'); ?></span>
                        <span class="basket-btn__counter cart-contents"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
                </a>
            </div>
            <div class="widget_cart">
                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
   
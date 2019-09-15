        <?php $href = get_home_url(); ?>
        <footer class="bgimg progressive replace">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-3 d-flex flex-column justify-content-center flex-column align-items-center text-center">
                         <?php $logo_img = '';
                                    if( $custom_logo_id = get_theme_mod('custom_logo') ){
                                        $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                                            'class'    => 'custom-logo',
                                            'itemprop' => 'logo',
                                        ) );
                                    }
                            ?>
                            <?php if( !empty( $logo_img ) ){ echo $logo_img; }
                                  else{ echo '<p class="logo"><a href="' . home_url() . '" class="logo__url">Термос <br><span>to GO</span></a></p>'; }
                            ?>
                                  
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 d-flex flex-column justify-content-center flex-column align-items-center">
                        <a href="<?php echo ( is_home() || is_front_page() ) ? '#about' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('О нас'); ?></a>
                        <a href="<?php echo ( is_home() || is_front_page() ) ? '#action' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('Акции'); ?></a>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 d-none d-md-flex justify-content-center flex-column align-items-center">
                        <a href="#nav" class="menu"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-min.png" alt=""></a>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 d-flex flex-column justify-content-center flex-column align-items-center">
                        <a href="<?php echo ( is_home() || is_front_page() ) ? '#products' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('Каталог'); ?></a>
                        <a href="<?php echo ( is_home() || is_front_page() ) ? '#review' : $href; ?>" <?php if( is_home() || is_front_page() ) : ?>class="menu"<?php endif; ?>><?php echo __('Отзывы'); ?></a>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3  d-flex flex-column justify-content-center flex-column align-items-center">
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
                    </div>
                </div>
                <div class="row">
                  <center class="col-12 copyright">Created by HCC &copy;copyright <?php $date = date('Y'); if( $date > 2019 ) { echo '2019 - '; } ?><?php echo date('Y');?></center>
                </div>
            </div>
        </footer>
        <?php if( is_home() || is_front_page() ) : ?>
            <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.slick').slick({
                            infinite: true,
                            dots: false,
                            slidesToShow: 5,
                            slidesToScroll: 1,
                            prevArrow:"<button type='button' class='slick-prev pull-left'><img src='<?php echo get_template_directory_uri() ?>/img/arrow-min.png'></button>",
                            nextArrow:"<button type='button' class='slick-next pull-right'><img src='<?php echo get_template_directory_uri() ?>/img/arrow-min.png'></button>",
                            responsive: [
                                {
                                  breakpoint: 1024,
                                  settings: {
                                      slidesToShow: 3,
                                  }
                                },
                                {
                                  breakpoint: 850,
                                  settings: {
                                      slidesToShow: 2,
                                  }
                                },
                                {
                                  breakpoint: 768,
                                  settings: {
                                      slidesToShow: 1,
                                  }
                                }
                            ]
                });
                $('.reviews').slick({
                            infinite: true,
                            dots: false,
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            prevArrow:"<button type='button' class='slick-prev pull-left'><img src='<?php echo get_template_directory_uri() ?>/img/arrow-min.png'></button>",
                            nextArrow:"<button type='button' class='slick-next pull-right'><img src='<?php echo get_template_directory_uri() ?>/img/arrow-min.png'></button>",
                            responsive: [
                                {
                                  breakpoint: 1024,
                                  settings: {
                                      slidesToShow: 3,
                                  }
                                },
                                {
                                  breakpoint: 850,
                                  settings: {
                                      slidesToShow: 2,
                                  }
                                },
                                {
                                  breakpoint: 768,
                                  settings: {
                                      slidesToShow: 1,
                                  }
                                }
                            ]
                });
                <?php $pageID = get_option('page_on_front'); 
                      $timer = get_field('timer', $pageID);
                      if( isset($timer) && !empty( $timer) ) : ?>
                        <?php $time = date('j', strtotime(get_field('timer', $pageID)) ) - date('j'); 
                              if( $time > 0 ) : ?>
                                var deadline = '<?php the_field('timer', $pageID); ?>';                 
                                initializeClock("clockdiv", deadline);
                        <?php else : ?>
                            $('.time-message').addClass('d-none');
                            $('section#timer p.desc').addClass('d-none');
                            $('#deadline-messadge').removeClass('hidden');
                        <?php endif; ?>
                      <?php endif; ?>
            });
            </script>
        <?php endif; ?>
        <?php if( is_product() ) : ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.similar__slide').slick({
                            infinite: true,
                            dots: false,
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            prevArrow:"<button type='button' class='slick-prev pull-left'><img src='<?php echo get_template_directory_uri() ?>/img/arrow-min.png'></button>",
                            nextArrow:"<button type='button' class='slick-next pull-right'><img src='<?php echo get_template_directory_uri() ?>/img/arrow-min.png'></button>",
                            responsive: [
                                {
                                  breakpoint: 1024,
                                  settings: {
                                      slidesToShow: 3,
                                      arrows: false,
                                  }
                                },
                                {
                                  breakpoint: 850,
                                  settings: {
                                      slidesToShow: 2,
                                      arrows: false,
                                  }
                                },
                                {
                                  breakpoint: 768,
                                  settings: {
                                      slidesToShow: 1,
                                      arrows: false,
                                  }
                                }
                            ]
                });
                $('.fancybox').fancybox({protect: true});
            });
        </script>  
        <?php endif; ?>
        <?php if( is_paged() || is_home() || is_front_page() || is_shop() || is_page('78') ) : ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
               $('.paginations .prev').attr('rel', 'prev'); 
               $('.paginations .next').attr('rel', 'next'); 
            });
        </script>
        <script type="text/javascript">
          //  $.noConflict();
            jQuery(document).ready(function($){
                var ias = jQuery.ias( {
                  container: ".product__wrapper",
                  item: ".one__product",
                  pagination: ".pagination",
                  next: ".next.page-numbers",
                } );

                ias.extension( new IASTriggerExtension( { offset: 2 } ) );
                ias.extension( new IASSpinnerExtension() );
                ias.extension( new IASNoneLeftExtension() );  
            });
        </script>
        <?php endif; ?> 
        <div class="overlay"></div>
        <div id="loader" style="display:none;"></div>
        <div class="modal text-center justify-content-center align-items-center">
                 <div class="value text-center d-flex justify-content-center align-items-center"></div>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>

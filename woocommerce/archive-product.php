<?php get_header(); ?>
<section id="main">
    <?php if( !is_mobile() && is_plugin_active('revslider/revslider.php') ) : ?>
        <?php putRevSlider("main") ?>
    <?php endif; ?>
    <?php if( is_mobile ) : ?> 
    <div class="main-mobile d-flex d-xl-none bgimg progressive replace justify-content-center flex-column align-items-center">
        <h1 class="main__header">Возьмите с собой<br><mark>термос <span>to GO</span></mark></h1>
        <a href="#products" class="box-button d-flex align-items-center justify-content-center menu"><?php echo __('Купить сейчас'); ?></a>
    </div>
    <?php endif; ?>
</section>
        <?php if( is_plugin_active('woocommerce/woocommerce.php') ) : ?>
          <?php
           $paged = (get_query_var('page_val') ? get_query_var('page_val') : 1);
           if ( get_query_var('paged') ) {
                $paged = get_query_var('paged');
            } elseif ( get_query_var('page') ) { // на статической главной странице используется 'page' вместо 'paged' 
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }
            $custom_args = array(
               'posts_per_page' => get_option('posts_per_page'),
               'post_type' => 'product',
               'paged' => $paged,
            );
            $featured_query = new WP_Query( $custom_args );
            $temp_query = $wp_query;
            $wp_query   = NULL;
            $wp_query   = $featured_query; 
            if ( $featured_query->have_posts() ) :  ?>
         <section id="products">
             <div class="container">
                <div class="row">
                    <h2 class="col-12 text-center"><?php echo __('Наши товары'); ?></h2>
                </div>
                 <div class="row product__wrapper">
                    <?php while( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                     <div class="col-12 col-md-6 col-lg-4 one__product">
                            <?php $img = get_the_post_thumbnail_url(); ?>
                         <a href="<?php the_permalink(); ?>" class="progressive replace row d-flex flex-column align-items-center " data-href="<?php echo $img; ?>">
                             <?php the_post_thumbnail('lazy-load', array('class' => "preview",)); ?>
                             <img src="<?php the_field('img__hover'); ?>" alt="" width="400" height="450" class="hidden">
                             <span class="see box-button"><?php echo __('Быстрый просмотр'); ?></span>
                             <span class="col-12 product-title text-center d-block"><?php the_title(); ?></span>
                             <span class="w-100 d-flex">
                                     <span class="product-main-sale col-6 text-right d-flex justify-content-end align-items-center"><?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?> <?php echo __('грн'); ?></span>
                                     <span class="product-action-sale col-6 text-left d-flex justify-content-start align-items-center"><?php echo get_post_meta( get_the_ID(), '_price', true); ?> <?php echo __('грн'); ?></span>
                             </span>
                         </a>
                     </div>
                     <?php endwhile; ?>
                     <?php wp_reset_postdata(); ?>    
                 </div>
                 <div class="row">
                       <div class="col-12 paginations d-flex justify-content-center"> 
                               <?php   
                                    $big = 999999999;  
                                    $args = array(
                                        'base' => '%_%',
                                        'format' => '?page=%#%',
                                        'show_all'     => false, 
                                        'end_size'     => 1,     
                                        'mid_size'     => 1,    
                                        'prev_next'    => true,  
                                        'prev_text'    => __(''),
                                        'next_text'    => __(''),
                                        'add_args'     => false, 
                                        'add_fragment' => '',     
                                        'screen_reader_text' => __( '' ),
                                    );
                                ?>
                                <center><?php the_posts_pagination($args); ?></center>
                       </div>
                      <?php
                            $wp_query = NULL;
                            $wp_query = $temp_query;
                      ?>
                 </div>
             </div>
         </section>
           <?php endif; ?>
        <?php endif; ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="d-none col-lg-3 justify-content-center align-items-center d-lg-flex">
                                                   <a href="<?php echo get_template_directory_uri(); ?>/img/left-min.png" class="progressive replace">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/min.png" alt="" class="preview">
                                                    </a>
                    </div>
                    <form action="" method="post" class="col-12 col-lg-6 submit">
                        <div class="row">
                            <h3 class="col-12 text-center"><?php echo __('Получите бесплатную консультацию специалиста'); ?></h3>
                            <div class="paddings col-12">
                                <div class="row">
                                    <div class="col-lg-3 d-none d-lg-block"></div>
                                    <p class="text-center col-12 col-lg-6"><?php echo __('Поможем выбрать термос и ответим на все вопросы'); ?></p>
                                    <div class="col-lg-3 d-none d-lg-block"></div>
                                    <?php echo '<style>textarea[name="comment"],textarea[name="message"]{display:none}</style>'; ?>
                                    <textarea name="comment"></textarea>
                                    <textarea name="message"></textarea>
                                    <div class="col-lg-3 d-none d-lg-block"></div>
                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="name" class="sr-only"><?php echo __('Ваше имя'); ?></label>
                                                <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="<?php echo __('Ваше имя'); ?>">
                                            </div>
                                            <div class="form-group col-12">
                                                        <label for="tel" class="sr-only"><?php echo __('Телефон'); ?></label>
                                                        <input type="tel" class="form-control" id="tel" aria-describedby="tel" placeholder="<?php echo __('Телефон'); ?>">
                                            </div>
                                            <div class="form-group col-12">
                                                <input type="submit" value="<?php echo __('Получить консультацию'); ?>" class="w-100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-none d-lg-block"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="d-none col-lg-3 justify-content-center align-items-center d-lg-flex">
                                                    <a href="<?php echo get_template_directory_uri(); ?>/img/right-min.png" class="progressive replace">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/min.png" alt="" class="preview">
                                                    </a>
                    </div>
                </div>
            </div>
        </section>
<?php get_footer(); ?>
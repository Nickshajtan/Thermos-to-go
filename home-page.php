<?php
/**
 * Template Name: Main page
 *
 */
get_header(); ?>
<section id="main">
    <?php if( !is_mobile() && !wp_is_mobile() && is_plugin_active('revslider/revslider.php') ) : ?>
        <?php putRevSlider("main") ?>
    <?php endif; ?>
    <?php if( is_mobile() || wp_is_mobile()) : ?> 
    <div class="main-mobile d-flex d-xl-none bgimg progressive replace justify-content-center flex-column align-items-center">
        <h1 class="main__header">Возьмите с собой<br><mark>термос <span>to GO</span></mark></h1>
        <a href="#products" class="box-button d-flex align-items-center justify-content-center menu"><?php echo __('Купить сейчас'); ?></a>
    </div>
    <?php endif; ?>
</section>
<?php $cycle = get_field('section__two__cycle');
        if( isset($cycle)  && !empty($cycle) ) : ?>
            <section id="about">
                <div class="container">
                    <div class="row">
                        <h2 class="col-12 text-center"><?php the_field('section__two__header'); ?></h2>
                        <div class="col-12">
                            <div class="row wy__we">
                                <?php foreach($cycle as $cycl): ?>
                                    <div class="col-12 col-md-6 col-lg-3 d-flex flex-column justify-content-center align-items-center">
                                        <?php   
                                                    $img = $cycl['cycle_icon'];
                                                    $size = 'blog-thumb';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                        ?>
                                        <?php   
                                                    $img_small = $cycl['cycle_icon'];
                                                    $size = 'lazy-load';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                        ?>
                                        <?php if( !empty($img) ) : ?>
                                                <a href="<?php echo $img['url']; ?>" class="progressive replace justify-content-center align-items-center d-flex w-50">
                                                    <img src="<?php echo $img_small['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="preview d-block ml-auto mr-auto w-100">
                                                </a>
                                        <?php endif; ?>
                                        <p class="header text-center">
                                            <?php echo $cycl['cycle_title']; ?>
                                        </p>
                                        <p class="text text-center">
                                            <?php echo $cycl['cycle_text']; ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
<?php $cycle = get_field('section_threee__cycle');
        if( isset($cycle)  && !empty($cycle) ) : ?>
            <section>
                <div class="gallery">
                    <?php foreach( $cycle  as $cycl ) : ?>
                                        <?php   
                                                    $img = $cycl['cycle_image'];
                                                    $size = 'sold-full';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                        ?>
                                        <?php   
                                                    $img_small = $cycl['cycle_image'];
                                                    $size = 'lazy-load';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                        ?>
                       <?php if( !empty($img) ) : ?>
                           <div class="foto__wrap">
                                <a href="<?php echo $img['url']; ?>" class="d-flex justify-content-center align-items-center flex-column progressive replace">
                                   <img src="<?php echo $img_small['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="preview">
                                   <p class="header text-center d-flex justify-content-center flex-column align-items-center"><?php echo $cycl['cycle_header']; ?>
                                       <span class="hidden text-center justify-content-center flex-column align-items-center">
                                           <?php echo $cycl['cycle_text']; ?>
                                       </span>
                                   </p>
                                </a>
                            </div>
                       <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
        <?php $timer = get_field('timer');
        if( isset($timer) && !empty( $timer) ) : ?>
        <section id="timer" class="bgimg progressive replace">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-block"></div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <h2 class="col-12 text-center"><?php the_field('timer__header'); ?></h2>
                            <p class="col-12 text-center desc"><?php echo __('до конца акции осталось:'); ?></p>
                            <div class="col-12 timer-wrapper">
                                <div id="clockdiv" class="row">
                                    <div class="col-4 time-message">
                                        <span class="days text-center"></span>
                                        <?php if (function_exists('get_num_ending')) : ?>
                                            <?php $number = date('j', strtotime(get_field('timer')) ) - date('j') - 1; ?>
                                            <div class="smalltext text-center days-text"><?php echo get_num_ending( $number, array(__('день'), __('дня'), __('дней'))); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4 time-message">
                                        <span class="hours text-center"></span>
                                        <?php if (function_exists('get_num_ending')) : ?>
                                            <?php $number = 23 - date('H'); /* H - 24 hours, h -12 hours */?>
                                            <div class="smalltext text-center hours-text"><?php echo get_num_ending( $number, array(__('час'), __('часа'), __('часов'))); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4 time-message">
                                        <span class="minutes text-center"></span>
                                        <?php if (function_exists('get_num_ending')) : ?>
                                            <?php $number = 59 - date('i'); ?>
                                            <div class="smalltext text-center minute-text"><?php echo get_num_ending( $number, array(__('минута'), __('минуты'), __('минут'))); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div id="deadline-messadge" class="col-12 text-center hidden" style="font-size: 2rem;">
                                      <?php echo __('Время истекло!'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <a href="#products" class="box-button menu"><?php echo __('Купить сейчас'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block"></div>
                </div>
            </div>
        </section>
        <?php endif;?>
<?php $design = get_field('section__four__image');
        if( isset($design)  && !empty($design) ) : ?>    
            <section>
                <div class="container">
                    <div class="row">
                        <h2 class="col-12 text-center"><?php the_field('section__four__header'); ?></h2>
                        <div class="col-12">
                                        <?php   
                                                    $img = get_field('section__four__image');
                                                    $size = 'sold-full';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                        ?>
                                        <?php   
                                                    $img_small = get_field('section__four__image');
                                                    $size = 'lazy-load';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                        ?>
                                    <?php if( !empty($img) ) : ?>
                                                <a href="<?php echo $img['url']; ?>" class="progressive replace">
                                                    <img src="<?php echo $img_small['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="preview">
                                                </a>
                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?> 
        <?php if( is_plugin_active('woocommerce/woocommerce.php') ) : ?>
              <?php $temp_query = $wp_query;
                global $post;
                $tmp_post = $post;
              ?>
              <?php if( is_mobile() ){
                        $posts_per_page = '3';
                    }
                    else{
                        $posts_per_page = '6';
                    }
                    if ( get_query_var('paged') ) {
                        $paged = get_query_var('paged');
                    } elseif ( get_query_var('page') ) { // на статической главной странице используется 'page' вместо 'paged' 
                        $paged = get_query_var('page');
                    } else {
                        $paged = 1;
                    }
                    $custom_args = array(
                        'posts_per_page' => $posts_per_page,  
                        'paged' => $paged,
                        'post_type' => 'product',
                    );
                    $wp_query = new WP_Query($custom_args); ?> 
              <?php if ($wp_query->have_posts()) : ?>
                  <section id="products">
                     <div class="container">
                         <div class="row">
                            <h2 class="col-12 text-center"><?php echo __('Наши товары'); ?></h2>
                         </div>
                         <div class="row product__wrapper">
                             <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
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
                                <center><?php the_posts_pagination(); ?></center>
                             </div>
                         </div>
                     </div>
                  </section>
              <?php endif; ?>
              <?php $post = $tmp_post; 
                    $wp_query = $temp_query;
              ?>
        <?php endif; ?>
        <?php $cycle   = get_field('section__five__cycle');
              $reviews = get_field('section__six__cycle');
              $actions = get_field('section__seven__cycle');
        if( (isset($cycle)  && !empty($cycle)) || (isset($reviews)  && !empty($reviews)) || (isset($actions)  && !empty($actions)) ) : ?>  
            <section class="<?php if( !is_mobile() ) : ?> bgimg progressive replace<?php endif; ?> bg__water">
                <div class="container">
                    <div class="row">
                       <?php if( isset($cycle)  && !empty($cycle) ) : ?>
                            <h2 class="col-12 text-center"><?php the_field('section__five__header'); ?></h2>
                            <div class="col-12">
                                <div class="row wy__we">
                                    <?php foreach( $cycle  as $cycl ) : ?>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <?php   
                                                    $img = $cycl['cycle_icon'];
                                                    $size = 'blog-thumb';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                            ?>
                                            <?php   
                                                        $img_small = $cycl['cycle_icon'];
                                                        $size = 'lazy-load';
                                                        $thumb = $img['sizes'][ $size ];
                                                        $width = $img['sizes'][ $size . '-width' ];
                                                        $height = $img['sizes'][ $size . '-height' ];
                                            ?>
                                            <?php if( !empty($img) ) : ?>
                                                    <a href="<?php echo $img['url']; ?>" class="progressive replace">
                                                        <img src="<?php echo $img_small['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="preview">
                                                    </a>
                                            <?php endif; ?>
                                            <p class="header text-center">
                                                <?php echo $cycl['cycle_header']; ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($reviews)  && !empty($reviews) ) : ?>
                            <h2 id="review" class="col-12 text-center slick-header"><?php echo __('Отзывы'); ?></h2>
                            <div class="col-12 reviews">
                                <?php foreach( $reviews  as $cycl ) : ?>
                                          <?php   
                                                    $img = $cycl['cycle_icon'];
                                                    $size = 'blog-thumb';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                            ?>
                                            <?php   
                                                        $img_small = $cycl['cycle_icon'];
                                                        $size = 'lazy-load';
                                                        $thumb = $img['sizes'][ $size ];
                                                        $width = $img['sizes'][ $size . '-width' ];
                                                        $height = $img['sizes'][ $size . '-height' ];
                                            ?>
                                            <?php if( !empty($img) ) : ?>
                                                    <a href="<?php echo $img['url']; ?>" class="progressive replace review-wrapper">
                                                        <img src="<?php echo $img_small['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="preview">
                                                        <span class="white__block">
                                                            <p class="header text-center">
                                                                <?php echo $cycl['cycle_name']; ?>
                                                            </p>
                                                            <span class="one__rewiew__text"><?php echo $cycl['cycle_text']; ?></span>
                                                        </span>
                                                        <?php if( !wp_is_mobile() ) : ?>
                                                            <span class="help text-white w-100 text-center"><?php echo __('Наведите курсор на фото'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if( wp_is_mobile() ) : ?>
                                                            <span class="help text-white w-100 text-center"><?php echo __('Кликните по фото'); ?></span>
                                                        <?php endif; ?>
                                                    </a>
                                            <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($actions)  && !empty($actions) ) : ?>
                            <h2 id="action" class="col-12 text-center slick-header action"><?php the_field('section__seven__header'); ?></h2>
                            <div class="d-none col-lg-2"></div>
                            <p class="col-12 col-lg-12 desc text-center">
                                <?php the_field('section__seven__text'); ?>
                            </p>
                            <div class="d-none col-lg-2"></div>
                            <div class="col-12 actions slick">
                                <?php foreach( $actions  as $cycl ) : ?>    
                                           <?php   
                                                    $img = $cycl['cycle_box'];
                                                    $size = 'blog-thumb';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                            ?>
                                            <?php   
                                                        $img_small = $cycl['cycle_box'];
                                                        $size = 'lazy-load';
                                                        $thumb = $img['sizes'][ $size ];
                                                        $width = $img['sizes'][ $size . '-width' ];
                                                        $height = $img['sizes'][ $size . '-height' ];
                                            ?>    
                                    <div class="box">
                                          <?php if( !empty($img) ) : ?>
                                                    <a href="<?php the_field('section__seven__link'); ?>" target="_blank" class="progressive replace" data-href="<?php echo $img['url']; ?>">
                                                        <img src="<?php echo $img_small['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="preview">
                                                    </a>
                                            <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <a href="<?php the_field('section__seven__link'); ?>" class="box-button action__link" target="_blank"><?php echo __('Выбрать сумку'); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
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
                                                <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="<?php echo __('Ваше имя'); ?>" required>
                                            </div>
                                            <div class="form-group col-12">
                                                        <label for="tel" class="sr-only"><?php echo __('Телефон'); ?></label>
                                                        <input type="tel" class="form-control" id="tel" aria-describedby="tel" placeholder="<?php echo __('Телефон'); ?>" required>
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

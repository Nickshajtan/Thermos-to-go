<?php get_header(); ?>
<section id="single__product">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 d-flex im__wrap">
                <div class="row">
                    <?php global $product; $product = wc_get_product(); 
                      $attachment_ids = $product->get_gallery_attachment_ids(); ?>
                      <div class="col-12 col-lg-3 ">
                         <div class="row">
                              <?php foreach( $attachment_ids as $attachment_id ) : ?>
                                  <div class="gallery__wrap col-6 col-lg-12"><?php echo wp_get_attachment_image( $attachment_id, 'medium' ); ?><span class="hidden d-none"><?php echo wp_get_attachment_image_url($attachment_id,'large'); ?></span></div>
                              <?php endforeach; ?>
                         </div> 
                      </div>
                       <div class="col-12 col-lg-9 d-none d-lg-block text-right main-product-image">
                           <a href="<?php the_post_thumbnail_url(); ?>" class="fancybox"><?php the_post_thumbnail(array(500,1024)); ?></a>
                       </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 d-flex text__wrap">
                <div class="row">
                    <h2 class="text-center col-12"><?php the_title(); ?></h2>
                    <div class="product-main-sale col-12 text-center"><?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?> <?php echo __('грн'); ?></div>
                    <div class="product-action-sale col-12 text-center"><?php echo get_post_meta( get_the_ID(), '_price', true); ?> <?php echo __('грн'); ?></div>
                    <?php 
                        global $product;
                        $product = wc_get_product(); 
                        global $post;
                        $attributes = $product->get_attributes();
                        if( $attributes ){
                            foreach ( $attributes as $attribute ) {
                                $terms = wp_get_post_terms( $product->id, $attribute[ 'name' ], 'all' );
                                $taxonomy = $terms[ 0 ]->taxonomy;
                                $taxonomy_object = get_taxonomy( $taxonomy );
                                $attribute_label = $taxonomy_object->labels->name;
                                $new_attribute_label = str_replace('Товар', '', $attribute_label);
                                echo get_the_term_list( $post->ID, $attribute[ 'name' ] , '<div class="attributes col-12 text-left">' . $new_attribute_label . ': ' , ', ', '</div>' );
                            }   
                        }
                    ?>
                    <div class="content col-12 text-left"><?php the_content(); ?></div>
                    <div class="content col-12 text-left"><?php the_excerpt(); ?></div>
                    
                    <form class="cart d-flex justify-content-center align-items-center col-12 flex-column" method="post" enctype='multipart/form-data'>
                       <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                       <?php if ( ! $product->is_sold_individually() )
                         woocommerce_quantity_input( array(
                          'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
                          'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
                         ) );
                       ?>
                       <span class="w-50 d-block ml-auto mr-auto quantity">
                           <span class="col-12 quantity-wrapper">
                              <span class="row">
                                   <span class="col-2 plus d-flex justify-content-center align-items-center">+</span>
                                   <span class="col-8 value d-flex justify-content-center align-items-center"></span>
                                   <span class="col-2 minus d-flex justify-content-center align-items-center">-</span>
                              </span>
                           </span>
                       </span>
                       <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
                       <?php global $woocommerce; ?>
                       <?php $cart = WC()->cart->get_cart_contents_count();  
                              if( $cart != 0 ) : ?>
                                  <?php $cart = 'cart'; ?>
                              <?php endif; ?>
                       <button type="submit" class="single_add_to_cart_button button alt box-button w-50 d-block ml-auto mr-auto <?php echo $cart; ?>" style="cursor:pointer;"><?php echo __('Купить сейчас'); ?></button>
                      <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                     </form>
                    <script>
                        jQuery(document).ready(function($) {
                            $('.gallery__wrap').each(function(){
                                var href = $(this).find('span.hidden').text(); 
                                $(this).find('img').wrap("<a href='" + href + "' rel='group' data-fancybox='group' class='fancybox gallery__modal'></a>"); 
                            });
                            $('.gallery__modal').fancybox({protect: true,cyclic:true});
                            var ipt = $('.quantity input[name=quantity]');
                            ipt.addClass('d-none');
                            var div = $('.quantity-wrapper .value');
                            var val = ipt.val();
                            div.text(val);
                            $('.quantity-wrapper .plus').on('click', function(){
                                var max = ipt.attr('size');
                                var count = div.text();
                                if( count <= max ){
                                    count++;
                                    div.text(count);
                                    ipt.val(count);
                                }
                                else{
                                    alert('Вы выбрали весь доступный товар!');
                                }
                            });
                            $('.quantity-wrapper .minus').on('click', function(){
                                var max = 0;
                                var count = div.text();
                                if( count > max ){
                                    count--;
                                    div.text(count);
                                    ipt.val(count);
                                }
                            });
                            /*var size = ipt.attr('size');
                            if( size > 0 ){
                                $('.single_add_to_cart_button').on('click', function(){

                                        var href = window.location.href;
                                        window.location.href = href +'/checkout';
                                });
                            }*/
                        });
                    </script>
 <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>
              <?php 
                    $args = array(
                        'posts_per_page' => 6,  
                        'post_type' => 'product',
                    );
                    $featured_query = new WP_Query( $args );
                ?>
<?php if ($featured_query ->have_posts()) : ?>
<section id="all">
    <div class="container">
        <div class="row">
            <h2 class="text-left col-12"><?php echo __('Похожие товары'); ?></h2>
            <div class="similar col-12">
               <div class="row similar__slide">
                   <?php while ($featured_query->have_posts()) :
                           $featured_query->the_post();
                           $product = get_product( $featured_query->post->ID );  ?>
                     <div class="col-12 one__product ">
                            <?php $img = get_the_post_thumbnail_url(); ?>
                         <a href="<?php the_permalink(); ?>" class="progressive replace row d-flex flex-column align-items-center" data-href="<?php echo $img; ?>">
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
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<style>@media screen and (min-width: 900px){.text__wrap{padding-left: 50px;}}</style>
<?php get_footer(); ?>
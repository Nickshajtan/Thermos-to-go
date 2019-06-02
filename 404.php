<?php get_header(); ?>
<section style="min-height:65vh;padding-top:120px;">
    <div class="container">
        <div class="row">
            <h2 class="col-12 header text-center"><?php echo __('Такой страницы не существует'); ?></h2>
            <div class="col-12 text-center"><?php the_field('text_404', 'options'); ?></div>
            <div class="col-12 text-center"><?php the_field('image_404', 'options'); ?></div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
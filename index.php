<?php get_header(); ?>
   <?php if(have_posts()){ while(have_posts()){ the_post();
        //Content
    }}?>
<?php get_footer(); ?>
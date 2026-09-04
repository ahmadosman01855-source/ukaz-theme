<?php
get_header(); ?>
<div class="max-w-6xl mx-auto px-4 py-12">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    endif;
    ?>
</div>
<?php get_footer(); ?>

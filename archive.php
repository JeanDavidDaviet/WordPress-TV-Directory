<?php get_header(); ?>
<main>

    <?php the_archive_title( '<h1>', '</h1>' ); ?>

    <?php get_template_part( 'components/listing' ); ?>

</main>
<?php get_footer(); ?>
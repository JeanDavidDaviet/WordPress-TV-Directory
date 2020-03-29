<div class="container">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <!-- post -->

        <article>

            <?php the_post_thumbnail(); ?>

            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php the_date(); ?>

            <?php the_excerpt(); ?>

        </article>

    <?php endwhile; ?>
    <!-- post navigation -->
        <?php html5wp_pagination(); ?>

    <?php else: ?>
    <!-- no posts found -->

    <?php endif; ?>

</div>
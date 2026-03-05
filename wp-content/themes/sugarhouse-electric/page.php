<?php
/**
 * Default Page Template
 */
get_header();
?>

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php if (!is_front_page()) : ?>
        <div class="page-header">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
        <?php endif; ?>

        <section class="page-content" style="padding: 60px 0;">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </section>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

<?php
/**
 * Projects Archive Template
 */
get_header();
?>

<main>
    <div class="page-header">
        <div class="container">
            <h1>Our Projects</h1>
            <p>Browse our portfolio of completed electrical projects</p>
        </div>
    </div>

    <section class="projects">
        <div class="container">
            <div class="projects-grid">
                <?php if (have_posts()) : while (have_posts()) : the_post();
                    $location = get_post_meta(get_the_ID(), '_project_location', true);
                    $type = get_post_meta(get_the_ID(), '_project_type', true);
                ?>
                    <div class="project-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>">
                                <div style="width: 100%; height: 250px; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                    <span style="color: #718096;">Project Image</span>
                                </div>
                            </a>
                        <?php endif; ?>
                        <div class="project-card-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p>
                                <?php if ($location) : ?><strong><?php echo esc_html($location); ?></strong> | <?php endif; ?>
                                <?php echo $type ? esc_html($type) : 'Electrical Project'; ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
            ));
            ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Start Your Project Today</h2>
            <p>Contact us for a free consultation and estimate.</p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Get a Quote</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<?php
/**
 * Single Project Template
 */
get_header();
?>

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post();
        $location = get_post_meta(get_the_ID(), '_project_location', true);
        $type = get_post_meta(get_the_ID(), '_project_type', true);
    ?>

        <div class="page-header">
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <p>
                    <?php if ($location) : ?><?php echo esc_html($location); ?> | <?php endif; ?>
                    <?php echo $type ? esc_html($type) : 'Electrical Project'; ?>
                </p>
            </div>
        </div>

        <section class="project-single" style="padding: 60px 0;">
            <div class="container">
                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom: 40px;">
                        <?php the_post_thumbnail('full', array('style' => 'width: 100%; border-radius: 10px;')); ?>
                    </div>
                <?php endif; ?>

                <div style="max-width: 800px;">
                    <?php the_content(); ?>
                </div>

                <div style="margin-top: 40px; padding: 30px; background: var(--light-bg); border-radius: 10px;">
                    <h3 style="margin-bottom: 15px; color: var(--primary-color);">Need Similar Work Done?</h3>
                    <p style="margin-bottom: 20px;">Contact us to discuss your project requirements.</p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Get a Quote</a>
                    <?php if ($phone = sugarhouse_get_contact('phone')) : ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="btn btn-secondary" style="margin-left: 10px; border-color: var(--primary-color); color: var(--primary-color);">
                        Call <?php echo esc_html($phone); ?>
                    </a>
                    <?php else : ?>
                    <a href="mailto:<?php echo esc_attr(sugarhouse_get_contact('email')); ?>" class="btn btn-secondary" style="margin-left: 10px; border-color: var(--primary-color); color: var(--primary-color);">
                        Email Us
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- More Projects -->
        <section class="projects">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: 40px; color: var(--primary-color);">More Projects</h2>
                <div class="projects-grid">
                    <?php
                    $more_projects = get_posts(array(
                        'post_type'      => 'project',
                        'posts_per_page' => 3,
                        'exclude'        => array(get_the_ID()),
                        'orderby'        => 'rand',
                    ));

                    foreach ($more_projects as $project) :
                        $proj_location = get_post_meta($project->ID, '_project_location', true);
                        $proj_type = get_post_meta($project->ID, '_project_type', true);
                    ?>
                        <div class="project-card">
                            <?php if (has_post_thumbnail($project->ID)) : ?>
                                <a href="<?php echo get_permalink($project->ID); ?>">
                                    <?php echo get_the_post_thumbnail($project->ID, 'large'); ?>
                                </a>
                            <?php else : ?>
                                <div style="width: 100%; height: 250px; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                    <span style="color: #718096;">Project Image</span>
                                </div>
                            <?php endif; ?>
                            <div class="project-card-content">
                                <h3><a href="<?php echo get_permalink($project->ID); ?>"><?php echo esc_html($project->post_title); ?></a></h3>
                                <p>
                                    <?php if ($proj_location) : ?><strong><?php echo esc_html($proj_location); ?></strong> | <?php endif; ?>
                                    <?php echo $proj_type ? esc_html($proj_type) : 'Electrical Project'; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

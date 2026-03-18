<?php
/**
 * Single Service Template
 */
get_header();
?>

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="page-header">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <section class="service-single" style="padding: 60px 0;">
            <div class="container">
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
                    <div class="service-content">
                        <?php if (has_post_thumbnail()) : ?>
                            <div style="margin-bottom: 30px;">
                                <?php the_post_thumbnail('large', array('style' => 'width: 100%; border-radius: 10px;')); ?>
                            </div>
                        <?php endif; ?>

                        <?php the_content(); ?>
                    </div>

                    <aside class="service-sidebar">
                        <div style="background: var(--light-bg); padding: 30px; border-radius: 10px; margin-bottom: 30px;">
                            <h3 style="margin-bottom: 20px; color: var(--primary-color);">Request a Quote</h3>
                            <p style="margin-bottom: 20px;">Ready to get started? Contact us for a free estimate.</p>
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary" style="display: block; text-align: center;">Get a Quote</a>
                        </div>

                        <div style="background: var(--light-bg); padding: 30px; border-radius: 10px;">
                            <?php if ($phone = sugarhouse_get_contact('phone')) : ?>
                            <h3 style="margin-bottom: 20px; color: var(--primary-color);">Call Us Now</h3>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" style="font-size: 24px; font-weight: 700; color: var(--secondary-color);">
                                <?php echo esc_html($phone); ?>
                            </a>
                            <p style="margin-top: 10px; color: #718096;">Available 24/7 for emergencies</p>
                            <?php else : ?>
                            <h3 style="margin-bottom: 20px; color: var(--primary-color);">Email Us</h3>
                            <a href="mailto:<?php echo esc_attr(sugarhouse_get_contact('email')); ?>" style="font-size: 20px; font-weight: 700; color: var(--secondary-color);">
                                <?php echo esc_html(sugarhouse_get_contact('email')); ?>
                            </a>
                            <p style="margin-top: 10px; color: #718096;">We'll respond within 24 hours</p>
                            <?php endif; ?>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- Other Services -->
        <section class="services" style="padding-bottom: 80px;">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: 40px; color: var(--primary-color);">Other Services</h2>
                <div class="services-grid">
                    <?php
                    $other_services = get_posts(array(
                        'post_type'      => 'service',
                        'posts_per_page' => 3,
                        'exclude'        => array(get_the_ID()),
                        'orderby'        => 'rand',
                    ));

                    foreach ($other_services as $service) :
                        $icon = get_post_meta($service->ID, '_service_icon', true);
                    ?>
                        <div class="service-card">
                            <div class="icon"><?php echo $icon ? esc_html($icon) : '⚡'; ?></div>
                            <h3><?php echo esc_html($service->post_title); ?></h3>
                            <p><?php echo esc_html(wp_trim_words($service->post_content, 15)); ?></p>
                            <a href="<?php echo get_permalink($service->ID); ?>" class="learn-more">Learn More &rarr;</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

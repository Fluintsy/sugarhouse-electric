<?php
/**
 * Services Archive Template
 */
get_header();
?>

<main>
    <div class="page-header">
        <div class="container">
            <h1>Our Services</h1>
            <p>Professional electrical services for residential and commercial properties</p>
        </div>
    </div>

    <section class="services">
        <div class="container">
            <div class="services-grid">
                <?php if (have_posts()) : while (have_posts()) : the_post();
                    $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                ?>
                    <div class="service-card">
                        <div class="icon"><?php echo $icon ? esc_html($icon) : '⚡'; ?></div>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="learn-more">Learn More &rarr;</a>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Need Electrical Help?</h2>
            <p>Contact us today for a free estimate on your electrical project.</p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Get a Quote</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

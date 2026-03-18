<?php
/**
 * Front Page Template
 */
get_header();
?>

<main>
    <!-- Hero Section -->
    <section class="hero" style="background: linear-gradient(rgba(26, 54, 93, 0.8), rgba(26, 54, 93, 0.85)), url('<?php echo esc_url(SUGARHOUSE_URI . '/assets/images/hero-bg.webp'); ?>') center/cover no-repeat;">
        <div class="container">
            <div class="hero-badge">Serving Utah Since 2009</div>
            <h1>Your Trusted Local Electrician</h1>
            <p>Full-service electrical contractor for residential, commercial, and industrial clients throughout Salt Lake, Provo, and Ogden. Licensed, bonded, and insured.</p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Get a Free Estimate</a>
                <?php if ($phone = sugarhouse_get_contact('phone')) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="btn btn-secondary">
                    <span class="btn-icon">📞</span> <?php echo esc_html($phone); ?>
                </a>
                <?php else : ?>
                <a href="mailto:<?php echo esc_attr(sugarhouse_get_contact('email')); ?>" class="btn btn-secondary">
                    <span class="btn-icon">📧</span> Email Us
                </a>
                <?php endif; ?>
            </div>
            <div class="hero-trust">
                <span>✓ Licensed & Insured</span>
                <span>✓ Free Estimates</span>
                <span>✓ 24/7 Emergency Service</span>
            </div>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="intro">
        <div class="container">
            <div class="intro-grid">
                <div class="intro-content">
                    <h2>A Full-Service Electrical Contractor</h2>
                    <p>SugarHouse Electric has built our business on the foundations of integrity, quality, and a desire to provide superior, reliable services to our clients. We have a solid reputation of excellence, which we work hard to maintain.</p>
                    <p>Our business philosophy is focused on achieving customer satisfaction by exceeding customer expectations. <strong>Our goal is to do the job right, the first time.</strong></p>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-outline">Learn More About Us</a>
                </div>
                <div class="intro-features">
                    <div class="feature-item">
                        <div class="feature-icon">⚡</div>
                        <div class="feature-text">
                            <h4>Expert Electricians</h4>
                            <p>Highly trained and qualified professionals</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🛡️</div>
                        <div class="feature-text">
                            <h4>Quality Guaranteed</h4>
                            <p>Work we stand behind, every time</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">💰</div>
                        <div class="feature-text">
                            <h4>Fair Pricing</h4>
                            <p>Competitive rates, no hidden fees</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🕐</div>
                        <div class="feature-text">
                            <h4>On-Time Service</h4>
                            <p>We respect your time and schedule</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p>From simple repairs to complete electrical installations, we handle projects of any size with expertise and care.</p>
            </div>

            <div class="services-grid">
                <?php
                $services = get_posts(array(
                    'post_type'      => 'service',
                    'posts_per_page' => 6,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ));

                if ($services) :
                    foreach ($services as $service) :
                        $icon = get_post_meta($service->ID, '_service_icon', true);
                ?>
                    <div class="service-card">
                        <div class="icon"><?php echo $icon ? esc_html($icon) : '⚡'; ?></div>
                        <h3><?php echo esc_html($service->post_title); ?></h3>
                        <p><?php echo esc_html($service->post_excerpt ? $service->post_excerpt : wp_trim_words($service->post_content, 20)); ?></p>
                        <a href="<?php echo get_permalink($service->ID); ?>" class="learn-more">Learn More →</a>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <div class="services-cta">
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn-outline">View All Services</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-us">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Sugar House Electric?</h2>
                <p>We're not just electricians — we're your neighbors, committed to keeping Utah homes and businesses safe.</p>
            </div>

            <div class="why-us-grid">
                <div class="why-us-item">
                    <div class="number">15+</div>
                    <h3>Years of Experience</h3>
                    <p>Serving the Salt Lake City community with expertise you can trust.</p>
                </div>
                <div class="why-us-item">
                    <div class="number">1000+</div>
                    <h3>Projects Completed</h3>
                    <p>Residential and commercial projects delivered with excellence.</p>
                </div>
                <div class="why-us-item">
                    <div class="number">24/7</div>
                    <h3>Emergency Service</h3>
                    <p>Electrical emergencies don't wait — neither do we.</p>
                </div>
                <div class="why-us-item">
                    <div class="number">100%</div>
                    <h3>Satisfaction</h3>
                    <p>We're not happy until you're happy with the work.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Areas -->
    <section class="service-areas">
        <div class="container">
            <div class="areas-content">
                <h2>Proudly Serving the Wasatch Front</h2>
                <p>We provide electrical services throughout the Salt Lake, Provo, and Ogden metro areas including:</p>
                <div class="areas-list">
                    <span>Salt Lake City</span>
                    <span>Sugar House</span>
                    <span>Murray</span>
                    <span>Sandy</span>
                    <span>West Valley City</span>
                    <span>Provo</span>
                    <span>Ogden</span>
                    <span>Park City</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Projects -->
    <section class="projects">
        <div class="container">
            <div class="section-title">
                <h2>Recent Projects</h2>
                <p>Take a look at some of our recent work across the Salt Lake City area.</p>
            </div>

            <div class="projects-grid">
                <?php
                $projects = get_posts(array(
                    'post_type'      => 'project',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));

                if ($projects) :
                    foreach ($projects as $project) :
                        $location = get_post_meta($project->ID, '_project_location', true);
                        $type = get_post_meta($project->ID, '_project_type', true);
                ?>
                    <div class="project-card">
                        <?php if (has_post_thumbnail($project->ID)) : ?>
                            <a href="<?php echo get_permalink($project->ID); ?>">
                                <?php echo get_the_post_thumbnail($project->ID, 'large'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo get_permalink($project->ID); ?>" class="project-placeholder">
                                <span class="project-placeholder-icon">🔧</span>
                            </a>
                        <?php endif; ?>
                        <div class="project-card-content">
                            <span class="project-type"><?php echo $type ? esc_html($type) : 'Electrical'; ?></span>
                            <h3><a href="<?php echo get_permalink($project->ID); ?>"><?php echo esc_html($project->post_title); ?></a></h3>
                            <?php if ($location) : ?>
                                <p class="project-location">📍 <?php echo esc_html($location); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <div class="projects-cta">
                <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="btn btn-outline">View All Projects</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>What Our Clients Say</h2>
                <p>Don't just take our word for it — hear from contractors and homeowners we've worked with.</p>
            </div>

            <div class="testimonials-grid">
                <?php
                $testimonials = get_posts(array(
                    'post_type'      => 'testimonial',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));

                if ($testimonials) :
                    foreach ($testimonials as $testimonial) :
                        $author = get_post_meta($testimonial->ID, '_testimonial_author', true);
                        $company = get_post_meta($testimonial->ID, '_testimonial_location', true);
                ?>
                    <div class="testimonial-card">
                        <div class="testimonial-stars">★★★★★</div>
                        <blockquote>"<?php echo esc_html(wp_trim_words($testimonial->post_content, 40)); ?>"</blockquote>
                        <cite>
                            <strong><?php echo $author ? esc_html($author) : ''; ?></strong>
                            <?php if ($company) : ?><span><?php echo esc_html($company); ?></span><?php endif; ?>
                        </cite>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Contact us today for a free consultation and estimate on your electrical project.</p>
            <div class="cta-buttons">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Request a Free Quote</a>
                <?php if ($phone = sugarhouse_get_contact('phone')) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="btn btn-secondary">
                    Call <?php echo esc_html($phone); ?>
                </a>
                <?php else : ?>
                <a href="mailto:<?php echo esc_attr(sugarhouse_get_contact('email')); ?>" class="btn btn-secondary">
                    Email Us
                </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

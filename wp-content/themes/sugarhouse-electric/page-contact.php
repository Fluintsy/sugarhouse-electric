<?php
/**
 * Template Name: Contact Page
 */
get_header();
?>

<main>
    <div class="page-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Get in touch for a free estimate or to schedule a service call</p>
        </div>
    </div>

    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-form-wrapper">
                    <h2>Send Us a Message</h2>
                    <?php
                    $cf7_shortcode = function_exists('sugarhouse_get_cf7_shortcode') ? sugarhouse_get_cf7_shortcode() : false;

                    if ($cf7_shortcode && shortcode_exists('contact-form-7')) :
                        echo do_shortcode($cf7_shortcode);
                    else :
                    ?>
                        <form class="contact-form" method="post">
                            <input type="text" name="name" placeholder="Your Name *" required>
                            <input type="email" name="email" placeholder="Your Email *" required>
                            <input type="tel" name="phone" placeholder="Your Phone">
                            <select name="service">
                                <option value="">Select a Service</option>
                                <option value="residential">Residential Electrical</option>
                                <option value="commercial">Commercial Electrical</option>
                                <option value="emergency">Emergency Service</option>
                                <option value="panel">Panel Upgrade</option>
                                <option value="lighting">Lighting Installation</option>
                                <option value="other">Other</option>
                            </select>
                            <textarea name="message" placeholder="Tell us about your project *" required></textarea>
                            <button type="submit">Send Message</button>
                        </form>
                        <p style="margin-top: 15px; color: #718096; font-size: 14px;">
                            <em>Contact Form 7 plugin is not active. Please activate it to enable full form functionality.</em>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="contact-info-wrapper">
                    <h2>Contact Information</h2>

                    <div class="contact-info-item">
                        <div class="icon">📞</div>
                        <div>
                            <h4>Phone</h4>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', sugarhouse_get_contact('phone'))); ?>">
                                <?php echo esc_html(sugarhouse_get_contact('phone')); ?>
                            </a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="icon">📧</div>
                        <div>
                            <h4>Email</h4>
                            <a href="mailto:<?php echo esc_attr(sugarhouse_get_contact('email')); ?>">
                                <?php echo esc_html(sugarhouse_get_contact('email')); ?>
                            </a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="icon">📍</div>
                        <div>
                            <h4>Service Area</h4>
                            <p><?php echo esc_html(sugarhouse_get_contact('address')); ?></p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="icon">🕐</div>
                        <div>
                            <h4>Business Hours</h4>
                            <p><?php echo esc_html(sugarhouse_get_contact('hours')); ?></p>
                            <p><strong>Emergency Service: 24/7</strong></p>
                        </div>
                    </div>

                    <?php if ($license = sugarhouse_get_contact('license')) : ?>
                    <div class="contact-info-item">
                        <div class="icon">📋</div>
                        <div>
                            <h4>License</h4>
                            <p>#<?php echo esc_html($license); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

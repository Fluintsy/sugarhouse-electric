<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Sugar House Electric</h4>
                <p>Professional electrical services for residential and commercial properties in the Salt Lake City area. Licensed, insured, and committed to quality work.</p>
            </div>

            <div class="footer-col">
                <h4>Our Services</h4>
                <ul>
                    <?php
                    $services = get_posts(array(
                        'post_type'      => 'service',
                        'posts_per_page' => 5,
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                    ));

                    if ($services) :
                        foreach ($services as $service) :
                    ?>
                        <li><a href="<?php echo get_permalink($service->ID); ?>"><?php echo esc_html($service->post_title); ?></a></li>
                    <?php
                        endforeach;
                    else :
                    ?>
                        <li><a href="#">Residential Electrical</a></li>
                        <li><a href="#">Commercial Electrical</a></li>
                        <li><a href="#">Emergency Services</a></li>
                        <li><a href="#">Panel Upgrades</a></li>
                        <li><a href="#">Lighting Installation</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a></li>
                    <li><a href="<?php echo esc_url(home_url('/projects/')); ?>">Our Projects</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul>
                    <li>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', sugarhouse_get_contact('phone'))); ?>">
                            <?php echo esc_html(sugarhouse_get_contact('phone')); ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo esc_attr(sugarhouse_get_contact('email')); ?>">
                            <?php echo esc_html(sugarhouse_get_contact('email')); ?>
                        </a>
                    </li>
                    <li><?php echo esc_html(sugarhouse_get_contact('address')); ?></li>
                    <li><?php echo esc_html(sugarhouse_get_contact('hours')); ?></li>
                    <?php if ($license = sugarhouse_get_contact('license')) : ?>
                        <li>License #<?php echo esc_html($license); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Sugar House Electric. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

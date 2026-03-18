<?php
/**
 * Sugar House Electric Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SUGARHOUSE_VERSION', '1.0.1');
define('SUGARHOUSE_DIR', get_template_directory());
define('SUGARHOUSE_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function sugarhouse_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'sugarhouse-electric'),
        'footer'  => __('Footer Menu', 'sugarhouse-electric'),
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'sugarhouse_setup');

/**
 * Enqueue Scripts and Styles
 */
function sugarhouse_scripts() {
    wp_enqueue_style('sugarhouse-style', get_stylesheet_uri(), array(), SUGARHOUSE_VERSION);
    wp_enqueue_style('sugarhouse-main', SUGARHOUSE_URI . '/assets/css/main.css', array(), SUGARHOUSE_VERSION);

    wp_enqueue_script('sugarhouse-main', SUGARHOUSE_URI . '/assets/js/main.js', array(), SUGARHOUSE_VERSION, true);
}
add_action('wp_enqueue_scripts', 'sugarhouse_scripts');

/**
 * Register Custom Post Types
 */
function sugarhouse_register_post_types() {
    // Services CPT
    register_post_type('service', array(
        'labels' => array(
            'name'               => __('Services', 'sugarhouse-electric'),
            'singular_name'      => __('Service', 'sugarhouse-electric'),
            'add_new'            => __('Add New Service', 'sugarhouse-electric'),
            'add_new_item'       => __('Add New Service', 'sugarhouse-electric'),
            'edit_item'          => __('Edit Service', 'sugarhouse-electric'),
            'view_item'          => __('View Service', 'sugarhouse-electric'),
            'all_items'          => __('All Services', 'sugarhouse-electric'),
            'search_items'       => __('Search Services', 'sugarhouse-electric'),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'services'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-hammer',
        'show_in_rest'       => true,
    ));

    // Projects CPT
    register_post_type('project', array(
        'labels' => array(
            'name'               => __('Projects', 'sugarhouse-electric'),
            'singular_name'      => __('Project', 'sugarhouse-electric'),
            'add_new'            => __('Add New Project', 'sugarhouse-electric'),
            'add_new_item'       => __('Add New Project', 'sugarhouse-electric'),
            'edit_item'          => __('Edit Project', 'sugarhouse-electric'),
            'view_item'          => __('View Project', 'sugarhouse-electric'),
            'all_items'          => __('All Projects', 'sugarhouse-electric'),
            'search_items'       => __('Search Projects', 'sugarhouse-electric'),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'projects'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-portfolio',
        'show_in_rest'       => true,
    ));

    // Testimonials CPT
    register_post_type('testimonial', array(
        'labels' => array(
            'name'               => __('Testimonials', 'sugarhouse-electric'),
            'singular_name'      => __('Testimonial', 'sugarhouse-electric'),
            'add_new'            => __('Add New Testimonial', 'sugarhouse-electric'),
            'add_new_item'       => __('Add New Testimonial', 'sugarhouse-electric'),
            'edit_item'          => __('Edit Testimonial', 'sugarhouse-electric'),
            'view_item'          => __('View Testimonial', 'sugarhouse-electric'),
            'all_items'          => __('All Testimonials', 'sugarhouse-electric'),
        ),
        'public'             => true,
        'has_archive'        => false,
        'supports'           => array('title', 'editor'),
        'menu_icon'          => 'dashicons-format-quote',
        'show_in_rest'       => true,
    ));
}
add_action('init', 'sugarhouse_register_post_types');

/**
 * Register Project Categories Taxonomy
 */
function sugarhouse_register_taxonomies() {
    register_taxonomy('project_category', 'project', array(
        'labels' => array(
            'name'              => __('Project Categories', 'sugarhouse-electric'),
            'singular_name'     => __('Project Category', 'sugarhouse-electric'),
            'search_items'      => __('Search Categories', 'sugarhouse-electric'),
            'all_items'         => __('All Categories', 'sugarhouse-electric'),
            'edit_item'         => __('Edit Category', 'sugarhouse-electric'),
            'add_new_item'      => __('Add New Category', 'sugarhouse-electric'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'rewrite'           => array('slug' => 'project-category'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'sugarhouse_register_taxonomies');

/**
 * Add custom meta boxes for services
 */
function sugarhouse_add_meta_boxes() {
    add_meta_box(
        'service_icon',
        __('Service Icon', 'sugarhouse-electric'),
        'sugarhouse_service_icon_callback',
        'service',
        'side'
    );

    add_meta_box(
        'testimonial_author',
        __('Testimonial Details', 'sugarhouse-electric'),
        'sugarhouse_testimonial_details_callback',
        'testimonial',
        'normal'
    );

    add_meta_box(
        'project_details',
        __('Project Details', 'sugarhouse-electric'),
        'sugarhouse_project_details_callback',
        'project',
        'normal'
    );
}
add_action('add_meta_boxes', 'sugarhouse_add_meta_boxes');

function sugarhouse_service_icon_callback($post) {
    wp_nonce_field('sugarhouse_service_icon', 'sugarhouse_service_icon_nonce');
    $icon = get_post_meta($post->ID, '_service_icon', true);
    ?>
    <p>
        <label for="service_icon"><?php _e('Icon (emoji or dashicon class):', 'sugarhouse-electric'); ?></label>
        <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat" placeholder="e.g., ⚡ or dashicons-lightbulb">
    </p>
    <?php
}

function sugarhouse_testimonial_details_callback($post) {
    wp_nonce_field('sugarhouse_testimonial', 'sugarhouse_testimonial_nonce');
    $author = get_post_meta($post->ID, '_testimonial_author', true);
    $location = get_post_meta($post->ID, '_testimonial_location', true);
    ?>
    <p>
        <label for="testimonial_author"><?php _e('Author Name:', 'sugarhouse-electric'); ?></label>
        <input type="text" id="testimonial_author" name="testimonial_author" value="<?php echo esc_attr($author); ?>" class="widefat">
    </p>
    <p>
        <label for="testimonial_location"><?php _e('Location:', 'sugarhouse-electric'); ?></label>
        <input type="text" id="testimonial_location" name="testimonial_location" value="<?php echo esc_attr($location); ?>" class="widefat" placeholder="e.g., Salt Lake City, UT">
    </p>
    <?php
}

function sugarhouse_project_details_callback($post) {
    wp_nonce_field('sugarhouse_project', 'sugarhouse_project_nonce');
    $location = get_post_meta($post->ID, '_project_location', true);
    $type = get_post_meta($post->ID, '_project_type', true);
    ?>
    <p>
        <label for="project_location"><?php _e('Project Location:', 'sugarhouse-electric'); ?></label>
        <input type="text" id="project_location" name="project_location" value="<?php echo esc_attr($location); ?>" class="widefat">
    </p>
    <p>
        <label for="project_type"><?php _e('Project Type:', 'sugarhouse-electric'); ?></label>
        <input type="text" id="project_type" name="project_type" value="<?php echo esc_attr($type); ?>" class="widefat" placeholder="e.g., Residential, Commercial">
    </p>
    <?php
}

/**
 * Save meta box data
 */
function sugarhouse_save_meta_boxes($post_id) {
    // Service icon
    if (isset($_POST['sugarhouse_service_icon_nonce']) && wp_verify_nonce($_POST['sugarhouse_service_icon_nonce'], 'sugarhouse_service_icon')) {
        if (isset($_POST['service_icon'])) {
            update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
        }
    }

    // Testimonial details
    if (isset($_POST['sugarhouse_testimonial_nonce']) && wp_verify_nonce($_POST['sugarhouse_testimonial_nonce'], 'sugarhouse_testimonial')) {
        if (isset($_POST['testimonial_author'])) {
            update_post_meta($post_id, '_testimonial_author', sanitize_text_field($_POST['testimonial_author']));
        }
        if (isset($_POST['testimonial_location'])) {
            update_post_meta($post_id, '_testimonial_location', sanitize_text_field($_POST['testimonial_location']));
        }
    }

    // Project details
    if (isset($_POST['sugarhouse_project_nonce']) && wp_verify_nonce($_POST['sugarhouse_project_nonce'], 'sugarhouse_project')) {
        if (isset($_POST['project_location'])) {
            update_post_meta($post_id, '_project_location', sanitize_text_field($_POST['project_location']));
        }
        if (isset($_POST['project_type'])) {
            update_post_meta($post_id, '_project_type', sanitize_text_field($_POST['project_type']));
        }
    }
}
add_action('save_post', 'sugarhouse_save_meta_boxes');

/**
 * Theme Customizer Settings
 */
function sugarhouse_customize_register($wp_customize) {
    // Contact Info Section
    $wp_customize->add_section('sugarhouse_contact', array(
        'title'    => __('Contact Information', 'sugarhouse-electric'),
        'priority' => 30,
    ));

    // Phone Number
    $wp_customize->add_setting('sugarhouse_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sugarhouse_phone', array(
        'label'   => __('Phone Number', 'sugarhouse-electric'),
        'section' => 'sugarhouse_contact',
        'type'    => 'text',
    ));

    // Email
    $wp_customize->add_setting('sugarhouse_email', array(
        'default'           => 'apex@fluintsy.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('sugarhouse_email', array(
        'label'   => __('Email Address', 'sugarhouse-electric'),
        'section' => 'sugarhouse_contact',
        'type'    => 'email',
    ));

    // Address
    $wp_customize->add_setting('sugarhouse_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sugarhouse_address', array(
        'label'   => __('Address', 'sugarhouse-electric'),
        'section' => 'sugarhouse_contact',
        'type'    => 'text',
    ));

    // Business Hours
    $wp_customize->add_setting('sugarhouse_hours', array(
        'default'           => 'Mon-Fri: 7AM - 6PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sugarhouse_hours', array(
        'label'   => __('Business Hours', 'sugarhouse-electric'),
        'section' => 'sugarhouse_contact',
        'type'    => 'text',
    ));

    // License Number
    $wp_customize->add_setting('sugarhouse_license', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sugarhouse_license', array(
        'label'   => __('License Number', 'sugarhouse-electric'),
        'section' => 'sugarhouse_contact',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'sugarhouse_customize_register');

/**
 * Helper function to get contact info
 */
function sugarhouse_get_contact($field) {
    $defaults = array(
        'phone'   => '',
        'email'   => 'apex@fluintsy.com',
        'address' => '',
        'hours'   => 'Mon-Fri: 7AM - 6PM',
        'license' => '',
    );

    return get_theme_mod('sugarhouse_' . $field, $defaults[$field]);
}

/**
 * Flush rewrite rules on theme activation
 */
function sugarhouse_rewrite_flush() {
    sugarhouse_register_post_types();
    sugarhouse_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'sugarhouse_rewrite_flush');

/**
 * Add LocalBusiness Schema Markup
 */
function sugarhouse_schema_markup() {
    // Only output on front-end
    if (is_admin()) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Electrician',
        'name' => 'Sugar House Electric',
        'description' => 'Full-service electrical contractor providing services for commercial, industrial and residential clients throughout the Salt Lake, Provo and Ogden metro areas in Utah.',
        'url' => home_url('/'),
        'email' => sugarhouse_get_contact('email'),
        'openingHoursSpecification' => array(
            array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
                'opens' => '07:00',
                'closes' => '18:00'
            )
        ),
        'areaServed' => array(
            array('@type' => 'City', 'name' => 'Salt Lake City, UT'),
            array('@type' => 'City', 'name' => 'Provo, UT'),
            array('@type' => 'City', 'name' => 'Ogden, UT'),
            array('@type' => 'City', 'name' => 'Murray, UT'),
            array('@type' => 'City', 'name' => 'Sandy, UT'),
            array('@type' => 'City', 'name' => 'West Valley City, UT'),
            array('@type' => 'City', 'name' => 'Park City, UT')
        ),
        'priceRange' => '$$',
        'image' => SUGARHOUSE_URI . '/assets/images/fluintsy-logo.svg',
        'sameAs' => array()
    );

    // Add services offered
    $services = get_posts(array(
        'post_type' => 'service',
        'posts_per_page' => -1,
    ));

    if ($services) {
        $schema['hasOfferCatalog'] = array(
            '@type' => 'OfferCatalog',
            'name' => 'Electrical Services',
            'itemListElement' => array()
        );

        foreach ($services as $service) {
            $schema['hasOfferCatalog']['itemListElement'][] = array(
                '@type' => 'Offer',
                'itemOffered' => array(
                    '@type' => 'Service',
                    'name' => $service->post_title,
                    'description' => $service->post_excerpt ? $service->post_excerpt : wp_trim_words($service->post_content, 30, ''),
                    'url' => get_permalink($service->ID)
                )
            );
        }
    }

    // Add aggregate rating from testimonials
    $testimonials = get_posts(array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
    ));

    if ($testimonials && count($testimonials) > 0) {
        $schema['aggregateRating'] = array(
            '@type' => 'AggregateRating',
            'ratingValue' => '5',
            'reviewCount' => count($testimonials),
            'bestRating' => '5',
            'worstRating' => '1'
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'sugarhouse_schema_markup');

/**
 * Add Service schema to individual service pages
 */
function sugarhouse_service_schema() {
    if (!is_singular('service')) {
        return;
    }

    global $post;

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => get_the_title(),
        'description' => $post->post_excerpt ? $post->post_excerpt : wp_trim_words($post->post_content, 50, ''),
        'url' => get_permalink(),
        'provider' => array(
            '@type' => 'Electrician',
            'name' => 'Sugar House Electric',
            'url' => home_url('/')
        ),
        'areaServed' => array(
            '@type' => 'State',
            'name' => 'Utah'
        ),
        'serviceType' => 'Electrical Services'
    );

    if (has_post_thumbnail()) {
        $schema['image'] = get_the_post_thumbnail_url($post->ID, 'large');
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'sugarhouse_service_schema');

/**
 * Contact Form 7 Integration
 *
 * Creates a default CF7 contact form on theme setup if none exists.
 * The form matches the static fallback fields: Name, Email, Phone, Service Type, Message.
 */
function sugarhouse_create_cf7_form() {
    // Only run if CF7 is active
    if (!class_exists('WPCF7_ContactForm')) {
        return;
    }

    // Check if we already created one
    if (get_option('sugarhouse_cf7_form_id')) {
        return;
    }

    $form_template = '<div class="contact-form">
<label>Your Name *
    [text* your-name placeholder "Your Name"]</label>

<label>Your Email *
    [email* your-email placeholder "Your Email"]</label>

<label>Your Phone
    [tel your-phone placeholder "Your Phone"]</label>

<label>Select a Service
    [select service include_blank "Select a Service" "Residential Electrical" "Commercial Electrical" "Emergency Service" "Panel Upgrade" "Lighting Installation" "Other"]</label>

<label>Tell us about your project *
    [textarea* your-message placeholder "Tell us about your project"]</label>

[submit class:contact-form-submit "Send Message"]
</div>';

    $mail_template = 'From: [your-name] <[your-email]>
Subject: New Contact Form Submission - [service]

Name: [your-name]
Email: [your-email]
Phone: [your-phone]
Service: [service]

Message:
[your-message]

---
This email was sent from the contact form at Sugar House Electric.';

    $mail_recipient = 'apex@fluintsy.com';

    $form = WPCF7_ContactForm::get_template();
    $form->set_title('Contact Form - Sugar House Electric');

    $properties = $form->get_properties();
    $properties['form'] = $form_template;
    $properties['mail']['subject'] = 'New Contact Form Submission - [service]';
    $properties['mail']['sender'] = 'wordpress@' . wp_parse_url(home_url(), PHP_URL_HOST);
    $properties['mail']['recipient'] = $mail_recipient;
    $properties['mail']['body'] = $mail_template;
    $properties['mail']['additional_headers'] = 'Reply-To: [your-email]';
    $properties['messages'] = array_merge($properties['messages'], array(
        'mail_sent_ok' => 'Thank you! Your message has been sent. We\'ll get back to you within 24 hours.',
        'mail_sent_ng' => 'Oops, there was an error sending your message. Please try again or call us directly.',
        'validation_error' => 'Please fill in the required fields below.',
        'spam' => 'There was a problem submitting your form. Please try again.',
        'accept_terms' => 'Please accept the terms and conditions.',
        'invalid_required' => 'This field is required.',
        'invalid_email' => 'Please enter a valid email address.',
        'invalid_tel' => 'Please enter a valid phone number.',
    ));
    $form->set_properties($properties);
    $form->save();

    update_option('sugarhouse_cf7_form_id', $form->id());
}
add_action('after_setup_theme', 'sugarhouse_create_cf7_form');
add_action('activated_plugin', function ($plugin) {
    if (strpos($plugin, 'contact-form-7') !== false) {
        sugarhouse_create_cf7_form();
    }
});

/**
 * Get the CF7 contact form shortcode for the theme
 */
function sugarhouse_get_cf7_shortcode() {
    $form_id = get_option('sugarhouse_cf7_form_id');

    // If no saved form, try to find any CF7 form
    if (!$form_id && class_exists('WPCF7_ContactForm')) {
        $forms = WPCF7_ContactForm::find();
        if (!empty($forms)) {
            $form_id = $forms[0]->id();
            update_option('sugarhouse_cf7_form_id', $form_id);
        }
    }

    if ($form_id) {
        return '[contact-form-7 id="' . intval($form_id) . '" title="Contact Form - Sugar House Electric"]';
    }

    return false;
}

/**
 * Style CF7 forms to match the theme
 */
function sugarhouse_cf7_styles() {
    if (!class_exists('WPCF7_ContactForm')) {
        return;
    }

    wp_enqueue_style('sugarhouse-cf7', false);
    wp_add_inline_style('sugarhouse-cf7', '
        /* CF7 form styles to match theme */
        .wpcf7 .contact-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--text-color);
        }

        .wpcf7 .contact-form input[type="text"],
        .wpcf7 .contact-form input[type="email"],
        .wpcf7 .contact-form input[type="tel"],
        .wpcf7 .contact-form select,
        .wpcf7 .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 16px;
            font-family: inherit;
        }

        .wpcf7 .contact-form textarea {
            min-height: 150px;
            resize: vertical;
        }

        .wpcf7 .contact-form input:focus,
        .wpcf7 .contact-form select:focus,
        .wpcf7 .contact-form textarea:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.1);
        }

        .wpcf7 .contact-form-submit {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 15px 40px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .wpcf7 .contact-form-submit:hover {
            background: var(--accent-color);
        }

        /* CF7 validation and response messages */
        .wpcf7-not-valid-tip {
            color: #e53e3e;
            font-size: 13px;
            margin-top: -15px;
            margin-bottom: 15px;
            display: block;
        }

        .wpcf7-not-valid {
            border-color: #e53e3e !important;
        }

        .wpcf7-response-output {
            margin: 20px 0 0 !important;
            padding: 15px 20px !important;
            border-radius: 5px !important;
            font-size: 15px;
        }

        .wpcf7-mail-sent-ok,
        .wpcf7 form.sent .wpcf7-response-output {
            border-color: #38a169 !important;
            background: #f0fff4;
            color: #22543d;
        }

        .wpcf7-mail-sent-ng,
        .wpcf7 form.failed .wpcf7-response-output,
        .wpcf7 form.aborted .wpcf7-response-output {
            border-color: #e53e3e !important;
            background: #fff5f5;
            color: #742a2a;
        }

        .wpcf7 form.invalid .wpcf7-response-output,
        .wpcf7-validation-errors {
            border-color: #dd6b20 !important;
            background: #fffaf0;
            color: #7b341e;
        }

        .wpcf7 form.spam .wpcf7-response-output {
            border-color: #e53e3e !important;
            background: #fff5f5;
            color: #742a2a;
        }

        /* Spinner */
        .wpcf7-spinner {
            margin: 0 10px;
        }
    ');
}
add_action('wp_enqueue_scripts', 'sugarhouse_cf7_styles');

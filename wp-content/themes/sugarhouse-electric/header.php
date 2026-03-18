<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-left">
                <span><?php echo esc_html(sugarhouse_get_contact('hours')); ?></span>
                <?php if ($license = sugarhouse_get_contact('license')) : ?>
                    <span> | License #<?php echo esc_html($license); ?></span>
                <?php endif; ?>
            </div>
            <div class="header-top-right">
                <?php if ($phone = sugarhouse_get_contact('phone')) : ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>">
                        <?php echo esc_html($phone); ?>
                    </a>
                    <span> | </span>
                <?php endif; ?>
                <a href="mailto:<?php echo esc_attr(sugarhouse_get_contact('email')); ?>">
                    <?php echo esc_html(sugarhouse_get_contact('email')); ?>
                </a>
            </div>
        </div>
    </div>

    <div class="header-main">
        <div class="container">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <img src="<?php echo esc_url(SUGARHOUSE_URI . '/assets/images/fluintsy-logo.svg'); ?>" alt="Fluintsy - Sugar House Electric" style="height: 60px; width: auto;">
                </a>
            <?php endif; ?>

            <button class="menu-toggle" aria-label="Toggle navigation">
                &#9776;
            </button>

            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'fallback_cb'    => 'sugarhouse_fallback_menu',
                ));
                ?>
            </nav>
        </div>
    </div>
</header>

<?php
function sugarhouse_fallback_menu() {
    ?>
    <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
        <li><a href="<?php echo esc_url(home_url('/projects/')); ?>">Projects</a></li>
        <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
        <?php if ($phone = sugarhouse_get_contact('phone')) : ?>
            <li><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="nav-cta">Call Now</a></li>
        <?php else : ?>
            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-cta">Get a Quote</a></li>
        <?php endif; ?>
    </ul>
    <?php
}
?>

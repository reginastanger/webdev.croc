<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php _e('Zum Inhalt springen', 'regi'); ?></a>
<div id="navbar" class="container">
    <input type="checkbox" id="nav-trigger">
    <div id="brand">
        <?php if (function_exists('the_custom_logo')) {
            the_custom_logo();
        } ?>

    </div>
    <label for="nav-trigger" id="burger-button">
        <span class="burger-icon" aria-hidden="true"></span>
        <span class="screen-reader-text"><?php _e('Navigation öffnen/schliessen', 'regi'); ?></span>
    </label>
    <nav id="main-nav">
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'nav-menu',
            'depth' => 2,
            'fallback_cb' => false
        )); ?>
    </nav>
</div>
<?php
$headerTitle = get_field('header_title');

if (is_home()){
    $headerTitle = __('Blog', 'regi');
}

if (is_archive()){
    $headerTitle = single_cat_title('', false);
}



if (is_page_template('homepage.php')) :

    $imgBg = get_field('headerimage'); ?>
    <header id="page-header"<?php echo headerBgImage($imgBg); ?>>
        <h1 class="page-title animate fade-in"><?php the_title(); ?></h1>
    </header>

<?php else : ?>
<header id="page-header">
    <?php
    $imgDesktop = get_field('headerimage_desktop');
    $imgMobile = get_field('headerimage_mobile');

    echo headerImage($imgMobile, $imgDesktop);

        if (!empty($headerTitle)) : ?>
        <span class="page-title animate fade-in"><?php echo $headerTitle; ?></span>
    <?php endif; ?>

</header>

    <?php endif; ?>




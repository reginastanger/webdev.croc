<?php
/*
 * In der functions.php werden über Actions, Filter & Hooks sämtliche WordPress Funktionen de-/aktiviert bzw. angepasst
 * https://developer.wordpress.org/themes/basics/theme-functions/
 * https://kinsta.com/de/blog/wordpress-hooks/
 *
 * Offizielle Doku zu WordPress Themes: https://developer.wordpress.org/themes/
 * Offizielle Doku zum Gutenberg Editor: https://developer.wordpress.org/block-editor/
 *
 * Auch eigene PHP-Funktionen, die man in den Teplates verwenden möchte, können in die functions.php geschrieben werden
 */


/* ---- Theme Setups ----
* Dieser Hook wird bei jedem Laden der Seite aufgerufen, nachdem das Theme initialisiert wurde. Es wird im Allgemeinen verwendet, um grundlegende Setup-, Registrierungs- und Initiierungsaktionen für ein Theme auszuführen.
* https://developer.wordpress.org/reference/hooks/after_setup_theme/
*/
add_action('after_setup_theme', function () {

    // Title Tag in <head> : <title>...</title>
    add_theme_support('title-tag');

    /* Pfad zur Sprachdatei
    * load_textdomain() gibt den Namen der Übersetzungsdatei (beliebiger Name) und den Pfad an, wo diese zu finden ist.
    * https://developer.wordpress.org/reference/functions/load_textdomain/
    * get_template_directory() liefert den absoluten Server-Pfad zum Theme-Verzeichnis (ZB: "/var/www/html/wp-content/themes/webdev-theme") https://developer.wordpress.org/reference/functions/get_template_directory/
    *
    * Sämtliche Texte die wir in unserer functions.php oder in Templates schreiben und im Frontend oder Backend angezeigt werden, sollten über die Textdomain übersetzbar sein!
    * die Ausgabe im PHP wird in der Funktion als echo "_e('Zu übersetzender Text','TEXTDOMAIN' )" oder return "__('Zu übersetzender Text','TEXTDOMAIN' )" eingebunden
    * https://developer.wordpress.org/reference/functions/_e/
    */
  //  load_textdomain('regi', get_template_directory() . '/languages');

    /*
     * add_theme_support() registriert die Themenunterstützung für bestimmte WordPress-Funktionen
     * https://developer.wordpress.org/reference/functions/add_theme_support/
     */

    // Aktivierung von Beitragsbildern
    add_theme_support('post-thumbnails');

    // Eigene Bildgrößen im Theme definieren bzw. registrieren (https://developer.wordpress.org/reference/functions/add_image_size/)
    add_image_size('post-image', 700, 525, array('center', 'top'));

    // WordPress HTML5-Markup
    add_theme_support('html5', array(
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
        'comment-list',
        'comment-form'
    ));

    /*
    * register_nav_menus() registriert Navigations Menüs (ohne diese Funktion gibt es im Admin-Menü: "Design > Menüs" nicht zur Aswahl
    * im array werden die "Positionen im Theme" definiert
    * https://developer.wordpress.org/reference/functions/register_nav_menus/
    */
    register_nav_menus(array(
        'primary' => __('Haupt Navigation', 'regi'),
        'footer' => __('Footer Navigation', 'regi'),
    ));


    /* -- Customizer -- */

    // Custom Logo über Customizer zu ändern
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 100,
        'flex-height' => false,
        'flex-width' => true
    ));


    /* -- Gutenberg Editor --
    * https://developer.wordpress.org/block-editor/developers/themes/theme-support/
    * Offizielle Doku zum Gutenberg Editor: https://developer.wordpress.org/block-editor/
    */

    // Theme für Gutenberg optimiert - Lade default Block styles
    add_theme_support('wp-block-styles');

    // aktiviere wide & fullwidth Layouts
    add_theme_support('align-wide');

    // Custom CSS für Gutenberg (Backend)
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');

    // Responsive Embeds (ZB. YouTube Videos, Iframes) erlauben
    add_theme_support('responsive-embeds');

    // eigene Farbauswahl-Palette deaktivieren
    add_theme_support('disable-custom-colors');

    // eignen Farbverlauf im Editor deaktivieren
    add_theme_support('disable-custom-gradients');


    //Farbpalette im Editor hinzufügen
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Font-Color', 'regi'),
            'slug' => 'color-1',
            'color' => '#383838'
        ),
        array(
            'name' => __('Background Color', 'regi'),
            'slug' => 'color-2',
            'color' => '#fff'
        ),
        array(
            'name' => __('Primary Color', 'regi'),
            'slug' => 'color-3',
            'color' => '#8f9b6c'
        ),
        array(
            'name' => __('Secondary Color', 'regi'),
            'slug' => 'color-4',
            'color' => '#47556f'
        ),
    ));

    //eigene Schriftgröße im Editor deaktivieren
    add_theme_support('disable-custom-font-sizes');

    //Schriftgrößenauswahl im Editor
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Normal', 'regi'),
            'slug' => 'normal',
            'size' => 17
        ),
        array(
            'name' => __('Groß', 'regi'),
            'slug' => 'large',
            'size' => 24
        ),
    ));

    // Block Vorlagen deaktivieren
    remove_theme_support('core-block-patterns');
});

// ermölgicht upload von SVG und Zip Dateien in Wordpress

add_filter('upload_mimes', function($mimes = array()) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['zip'] = 'application/zip';
    return $mimes;
});


/* -- Erlaubte Gutenberg Blöcke --
* https://rudrastyh.com/gutenberg/remove-default-blocks.html
*/
add_filter('allowed_block_types', function ($allowed_blocks) {

    return array(
        'acf/regi-about',
        'acf/regi-slide',
        'acf/wifi-teaser',
        'acf/wifi-posts',
        'core/paragraph',
        'core/heading',
        'core/image',
        'core/gallery',
        'core/button',
        'core/buttons',
        'core/list',
        'core/text-columns',
        'core/media-text',
        'core/shortcode',
        'core/youtube',
        'core/spacer',
        'core/video',
        'core/quote',
        'core/file',
        'core/columns',

    );

});


/* ---- CSS & JS in <head> bzw. vor dem </body> einfügen [ wp_head() , wp_footer() ] ----
* https://developer.wordpress.org/reference/functions/wp_enqueue_script/
* der "Hanle" muss eindeutig sein
* Liste aller Scripten, die WordPress bereits inkludiert hat: https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-and-js-libraries-included-and-registered-by-wordpress
*/
add_action('wp_enqueue_scripts', function () {

    // Google Font (Roboto) css einbinden
    //wp_enqueue_style('google-font','https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');

    // CSS (style.css) im Head einfügen


    wp_enqueue_style('dev-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/css/lightbox.min.css');
    wp_enqueue_style('abou', get_template_directory_uri()  . '/css/about.css');


    // OWL Carousel styles nur registrieren nicht ausgeben
    wp_register_style('owl-theme-style', get_template_directory_uri() . '/assets/owl.theme.default.min.css');
    wp_register_style('owl-style', get_template_directory_uri() . '/assets/owl.carousel.min.css');

    // JS im Footer einfügen
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dev-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);

    // OWL Carousel script nur registrieren nicht ausgeben
    wp_register_script('owl-script', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.0', true);
});


/* --- Widgets ---
* "widgets_init" wird aufgerufen, nachdem alle Standard-WordPress-Widgets registriert wurden
* https://developer.wordpress.org/reference/hooks/widgets_init/
*/
add_action('widgets_init', function () {

    /* register_sidebar()
    * registriert Widgets (ohne diese Funktion gibt es im Admin-Menü: "Design > Widgets" nicht zur Aswahl
    * Die "id" muss eindeutig sein. Mit dieser werden die Widgetbereiche im Template über die WordPress Funktion auggerufen "dynamic_sidebar()" aufgerufen
    * https://developer.wordpress.org/reference/functions/register_sidebar/
    */
    register_sidebar(array(
        'name' => __('Sidebar für Beitrags-Detailseiten', 'regi'), // Titel: Anzeigename unter "Design -> Widgets"
        'id' => 'sidebar_posts', // ID zum ansprchen des Widget-Bereich in den Templates
        'description' => __('Diese Widgets werden nur auf den Beitrags-Detailseiten angezeigt (single.php)', 'regu'), // Beschreibung: Anzeige unter "Design -> Widgets"
        'before_widget' => '<div class="widget %2$s">', // HTML-Markup vor dem Widget. "%2$s" ist ein Platzhalter für die Widget-Klassen ("%1$s" wäre der Platzhalter für die Widget-ID falls notwendig)
        'after_widget' => '</div>', // HTML-Markup nach dem Widget.
        'before_title' => '<h4 class="widget-title"><span>', // HTML-Markup vor dem Titel (Text).
        'after_title' => '</span></h4>' // HTML-Markup nach dem Titel (Text).
    ));

    /* Mit "unregister_widget()" können einzelne Widgets deaktiviert werden (also nicht sicchtbar bzw. nutzbar)
    * gilt natürlich auch für die Widget-Blöcke im Gutenberg
    * https://developer.wordpress.org/reference/functions/unregister_widget/
    */
    unregister_widget('WP_Widget_Media_Audio');
    unregister_widget('WP_Widget_Media_Video');

});


/* --- Custom Post Types ---
* Mit Custom Post Types können eigenen Beitrags- und/oder Seitentypen angelegt werden - eigener Menüpunkt im Admin-Menü
* Der Funktionsaufruf register_post_type() wird in einem "init" Hook ( "add_action('init', 'FUNKTIONSNAME',0)" ) in WordPress eingebunden.
* https://developer.wordpress.org/reference/hooks/init/
*/

/* Register Custom Post Type für Referenzen
* Hilfreiches Tool zur generierung des Code: https://generatewp.com/post-type/
* WordPress Doku: https://developer.wordpress.org/reference/functions/register_post_type/
*/
function post_type_references()
{

    $labels = array(
        'name' => _x('Referenzen', 'Post Type General Name', 'regi'),
        'singular_name' => _x('Referenz', 'Post Type Singular Name', 'regi'),
        'menu_name' => __('Referenzen', 'regi'),
        'name_admin_bar' => __('Referenzen', 'regi'),
        'archives' => __('Referenzen Archiv', 'regi'),
        'attributes' => __('Referenz Attribute', 'regi'),
        'parent_item_colon' => __('Parent Item:', 'regi'),
        'all_items' => __('Alle Referenzen', 'regi'),
        'add_new_item' => __('neue Referenz hinzufügen', 'regi'),
        'add_new' => __('Add New', 'regi'),
        'new_item' => __('New Item', 'regi'),
        'edit_item' => __('Edit Item', 'regi'),
        'update_item' => __('Update Item', 'regi'),
        'view_item' => __('View Item', 'regi'),
        'view_items' => __('View Items', 'regi'),
        'search_items' => __('Search Item', 'regi'),
        'not_found' => __('Not found', 'regi'),
        'not_found_in_trash' => __('Not found in Trash', 'regi'),
        'featured_image' => __('Featured Image', 'regi'),
        'set_featured_image' => __('Set featured image', 'regi'),
        'remove_featured_image' => __('Remove featured image', 'regi'),
        'use_featured_image' => __('Use as featured image', 'regi'),
        'insert_into_item' => __('Insert into item', 'regi'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'regi'),
        'items_list' => __('Items list', 'regi'),
        'items_list_navigation' => __('Items list navigation', 'regi'),
        'filter_items_list' => __('Filter items list', 'regi'),
    );
    $args = array(
        'label' => __('Referenz', 'regi'),
        'labels' => $labels,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 10,
        'menu_icon' => 'dashicons-testimonial',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'page',
        'show_in_rest' => false,
    );
    register_post_type('references', $args);

}

add_action('init', 'post_type_references', 0);



/* --- Eignen Funktonen --- */

/* Header Image
 * in dieser Funktion "headerImage()" erwarten wir zwei Werte ($imgSM & $imgLG) - in unserem Fall die Attachment-Image-ID
 * Die Bedingung (if) wertet aus, ob beide Werte übergeben wurden
 * Werden beide Werte übergeben, dann werden über die Funktion "wp_get_attachment_image_src()" die Url des großen und des mittleren Bildes, der übergebenen Attachment-Image-IDs, in Variablen geschrieben
 * Ist das nicht der Fall (else),  dann werden über die Funktion "wp_get_attachment_image_src()" die Url des großen und des mittleren Bildes, der Attachment-Image-ID unserer Platzhalter-Bilder (ACF-Option-Page), in diesen Variable geschrieben
 * Als Rückgabewert (return) geben wir den Image-Tag mit Data-Sources zurück (<img data-src-sm="..." ... >)
 * Damit der korrekte "data-src" als "src" (je nach größe des Browserfenster) übergeben wird, haben wir hier zusätzlich eine jQuery-Funktion in der scripts.js geschrieben
 * */
function headerImage($imgSM, $imgLG)
{
    if ($imgSM && $imgLG) {
        $srcSM = wp_get_attachment_image_src($imgSM, 'medium_large');
        $srcLG = wp_get_attachment_image_src($imgLG, 'full');
    } else {
        $srcSM = wp_get_attachment_image_src(get_field('default_header_mobile', 'options'), 'medium_large');
        $srcLG = wp_get_attachment_image_src(get_field('default_header_desktop', 'options'), 'full');
    }

    return '<img class="header-image" src="" data-src-sm="' . $srcSM[0] . '" data-src-lg="' . $srcLG[0] . '" alt="Header Image">';
}

/* Header Background-Image
 * in dieser Funktion "headerBgImage()" erwarten wir einen Wert ($img) - in unserem Fall die Attachment-Image-ID
 * Die Bedingung (if) wertet aus, ob der Wert (in der Variable) "leer" ist
 * Wenn der Wert "leer" ist, dann werden über die Funktion "wp_get_attachment_image_src()" die Url des großen und des mittleren Bildes, der Attachment-Image-ID unseres Platzhalter-Bildes (ACF-Option-Page), in Variablen geschrieben
 * Ist das nicht der Fall (else), dann werden über die Funktion "wp_get_attachment_image_src()" die Url des großen und des mittleren Bildes, der übergebenen Attachment-Image-ID, in diese Variablen geschrieben
 * Als Rückgabewert (return) geben wir den Klassen-Namen und Data-Sources zurück (class="..." data-src-sm="..." ...)
 * Damit der korrekte "data-src" als "background-image: url()" (je nach größe des Browserfenster) übergeben wird, haben wir hier zusätzlich eine jQuery-Funktion in der scripts.js geschrieben
 * */
function headerBgImage($img)
{
    if (empty($img)) {
        $srcSM = wp_get_attachment_image_src(get_field('default_header_mobile', 'options'), 'medium_large');
        $srcLG = wp_get_attachment_image_src(get_field('default_header_desktop', 'options'), 'full');
    } else {
        $srcSM = wp_get_attachment_image_src($img, 'medium_large');
        $srcLG = wp_get_attachment_image_src($img, 'full');
    }

    return ' class="header-bg-image" data-src-sm="' . $srcSM[0] . '" data-src-lg="' . $srcLG[0] . '"';
}


/* --- Funktonen für das Plugin ACF-Pro --- */

/* Bedingung: Prüfe ob ACF Pro installiert und aktiviert ist
* die PHP Funktion "function_exists()" prüft ob es diese Funktion mit dem Funktionsnamen gibt - "acf_add_options_page()" wird über das Plugin ACF-Pro deklariert
* wenn (if) das Plugin ACF-Pro installiert ist, existiert diese Funktion und wir können ACF-Option-Pages und/oder ACF-Gutenberg-Blöcke erstellen
* sonst (else) geben wir im WordPress Adminbereich eine Fehlermeldung aus, dass diese Plugin benötigt wird
* https://www.php.net/manual/de/function.function-exists.php
*/
if (function_exists('acf_add_options_page')) {

    /* ACF Option Page erstellen
    * https://www.advancedcustomfields.com/resources/acf_add_options_page/
    */
    acf_add_options_page(array(
        'page_title' => 'Theme Einstellungen',
        'menu_title' => 'Theme Einstellungen',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_pages',
        'position' => 100,
        'redirect' => false,
        'post_id' => 'options',
        'icon_url' => 'dashicons-smiley', //https://developer.wordpress.org/resource/dashicons/#smiley
        'update_button' => __('Änderungen speichern', 'regi'),
        'updated_message' => __('Einstellungen wurden gespeichert', 'regi'),
    ));


    /* Hinzufügen von Gutenberg-Block-Kategorie
    * https://developer.wordpress.org/reference/hooks/block_categories/
    * https://wordpress.stackexchange.com/questions/315511/gutenberg-editor-add-a-custom-category-as-wrapper-for-custom-blocks
    */

    add_filter('block_categories', function ($categories, $post) {
        if ($post->post_type !== 'page') {
            return $categories;
        }

        /* "array_merge()" fügt zwei oder mehrere arrays zusammen: https://www.php.net/manual/de/function.array-merge.php  */
        return array_merge(
            array(
                array(
                    'slug' => 'regi-category',
                    'title' => __('Eigene', 'regi')
                ),
            ),
            $categories
        );
    }, 10, 2);


    /* -- ACF Gutenberg-Blöcke erstellen --
    * https://www.advancedcustomfields.com/resources/acf_register_block_type/
    */
    add_action('acf/init', 'my_acf_init');
    function my_acf_init()
    {

        // check function exists
        if (function_exists('acf_register_block')) {

            // register a block
            acf_register_block(array(
                'name' => 'wifi_teaser', // Interner Name
                'title' => __('Teaser','regi'), // Titel (Anzeigename)
                'description' => __('Teaser 3-Spalten','regi'), // Beschreibung (wird im Editor bei der Blockauswahl angezeigt)
                'render_template' => 'template-parts/block-teaser.php', // Pfad zum Template (HTML & PHP) des Gutenberg-Block
                'category' => 'regi-category', // in welcher Kategorie der Block erscheint - in diesem Fall in unserer eigenen Kategorie, die mit "add_action('block_categories'..)" angelegt wurde
                'icon' => 'post-status', // https://developer.wordpress.org/resource/dashicons/#smiley
                'keywords' => array('Teaser', 'Neuigkeiten'), // optional für die Suche im Editor
                'post_types' => array('posts', 'page'), // bei welchen Post-Types der Block angezeigt wird bzw. verwendet werden kann. In diesem Fall bei Seiten (page) und Beiträgen (post)
                'align' => false, // optional ( left, center, right, wide u. full)
                'mode' => false, // verhindert das Links im Editor nicht weiterleiten, sondern die Bearbeitung des ACF-Blocks erzwungen wird
            ));

            acf_register_block(array(
                'name' => 'regi-slide',
                'title' => __('Slide','regi'),
                'description' => __('Slide 3-Spalten','regi'),
                'render_template' => 'template-parts/block-slide.php',
                'category' => 'regi-category',
                'icon' => 'format-status',
                'keywords' => array('Slide', 'Neuigkeiten'),
                'post_types' => array('posts', 'page'),
                'align' => false,
                'mode' => false,
            ));

            acf_register_block(array(
                'name' => 'regi-about',
                'title' => __('About','regi'),
                'description' => __('About','regi'),
                'render_template' => 'template-parts/block-about.php',
                'category' => 'regi-category',
                'icon' => 'format-quote',
                'keywords' => array('About', 'Über mich'),
                'post_types' => array('posts', 'page'),
                'align' => false,
                'mode' => false,
            ));



            acf_register_block(array(
                'name' => 'wifi_posts',
                'title' => __('Beiträge','regi'),
                'description' => __('Aktuelle Beiträge 2-Spalten'),
                'render_template' => 'template-parts/block-posts.php',
                'category' => 'regi-category',
                'icon' => 'format-aside',
                'keywords' => array('Beiträge', 'Neuigkeiten'),
                'post_types' => array('posts', 'page'),
                'align' => false,
                'mode' => false,
            ));
        }
    }

    /* ACF-Felder als PHP über externes Dokument (nur einmal) einbinden
    * die PHP Funktion "require_once()" bindet eine Datei ein und überprüft ob diese nicht schon eingebunden ist. Somit wird sichergestellt, dass die Datei nur einmel eingebunden wird
    * https://www.php.net/manual/de/function.require-once.php
    */


} else {
    /* Backend-Fehlermeldung, wenn ACF-Pro nicht installiert ist
    * https://developer.wordpress.org/reference/hooks/admin_notices/
    * https://digwp.com/2016/05/wordpress-admin-notices/
    */
    add_action('admin_notices', function () {
        ?>
        <div class="error notice">
            <p><?php _e('<b>ACHTUNG: </b> Das Plugin "ACF Pro" muss installiert werden!', 'regi'); ?></p>
        </div>
        <?php
    });
}

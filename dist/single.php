<?php get_header(); // WordPress Funktion zum Einbinden der header.php ?>
<?php /* Zeige Sidebar nur an, wenn Widgets eingefügt wurden. Sonst volle Breite
* Setze die Variable für den Klassennamen auf 'no-sidebar'
* Bedingung "is_active_sidebar()": wenn (if) Widgets im Widgets-Bereich eingefügt wurden, dann überschreibe die Variable mit 'has-sidebar'
* https://developer.wordpress.org/reference/functions/is_active_sidebar/
* Hinweis: die Klassen sind in der style.css so gestyled, dass nur bei "has-sidebar" der <main> Tag nicht 100% Breite hat
 */
$classSidebar = 'no-sidebar';
if (is_active_sidebar('sidebar_posts')) {
    $classSidebar = 'has-sidebar';
}
?>
<div id="content" class="container">
    <main class="main-content <?php echo $classSidebar; ?> animate fade-in-up">
        <?php /* the_title() gibt das Titel-Feld des Gutenberg-Editors aus. In diesem Fall mit zwei Parametern "before" & "after" - also was vor und nach dem Titel (Text) stehen soll. Hier der <h1> Tag
         * https://developer.wordpress.org/reference/functions/the_title/
         */
        the_title('<h1>','</h1>'); // ?>
        <div class="post-meta">
            <?php /* "the_time()" gibt das Veröffentlichkeits-Datum & Zeit aus. Als Parameter übergeben wir das Format als PHP
            * https://developer.wordpress.org/reference/functions/the_time/
            * https://www.php.net/manual/de/function.date.php
            */ ?>
            <time class="meta" datetime="<?php the_time('Y-m-d'); ?>">
                <span class="icon-calendar" aria-hidden="true"></span>
                <?php the_time('d.m.Y'); ?>
            </time>
            <span class="meta categories">
                <span class="icon-category" aria-hidden="true"></span>
                <?php /* "the_category()" gibt alle Kategorien mit Link zum Kategorie-Archiv aus, in die der Beitrag kategorisiert wurde (Chsckbox). Als Parameter übergeben wir den Seperator (was zwischen den Kategorien angezeigt werden soll). In unserem Fall einen Beistrich und ein Leerzeichen (', ')
                * https://developer.wordpress.org/reference/functions/the_category/
                */
                the_category(', '); ?>
            </span>
        </div>
        <?php /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge
        * https://developer.wordpress.org/themes/basics/the-loop/
        */
        if( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                the_content(); // gibt den gesamten Inhalt des Editors aus
            }
        } ?>
        <div class="post-meta">
            <span class="meta categories">
                <span class="icon-category" aria-hidden="true"></span>
                <?php /* "the_category()" gibt alle Kategorien mit Link zum Kategorie-Archiv aus, in die der Beitrag kategorisiert wurde (Chsckbox). Als Parameter übergeben wir den Seperator (was zwischen den Kategorien angezeigt werden soll). In unserem Fall einen Beistrich und ein Leerzeichen (', ')
                * https://developer.wordpress.org/reference/functions/the_category/
                */
                the_category(', '); ?>
            </span>
            <?php /* "the_tags()" gibt alle Schlagwörter mit Link zum Schlagwort-Archiv aus, die im Beitrag getagged wurden. Als Parameter übergeben wir "before" (was vor der Schlagwort-Ausgabe stehen soll), den "Seperator" (was zwischen den Schlagwörtern angezeigt werden soll) und "after" (was nach der Schlagwortausgabe stehen soll)
            * https://developer.wordpress.org/reference/functions/the_tags/
            */
            the_tags('<span class="meta tags"><span class="icon-tag" aria-hidden="true"></span>', ', ', '</span>'); ?>
        </div>
        <nav class="post-pagination">
            <?php /*
            * Pagination der Beitrags-Detailseite
            * es wird der Link zum Nächsten und Vorherigen Beitrag angezeigt, wenn es einen gibt
            * https://developer.wordpress.org/reference/functions/paginate_links/
            */
            the_post_navigation(array(
                'prev_text' => __('Vorheriger Beitrag', 'regi'),
                'next_text' => __('Nächster Beitrag', 'regi')
            )); ?>
        </nav>
    </main>

    <?php /* Zeige Sidebar (<aside> Tag) nur an, wenn Widgets eingefügt wurden.
    * Bedingung "is_active_sidebar()": wenn (if) Widgets im Widgets-Bereich eingefügt wurden, dann gib die Sidebar (<aside>) aus
    * https://developer.wordpress.org/reference/functions/is_active_sidebar/
     */
    if (is_active_sidebar('sidebar_posts')) : ?>
        <aside class="sidebar">
            <?php /* die WordPress Funktion "dynamic_sidebar()" gibt die Widgets mit dem angepassten Markup (haben wir in der functions.php im Bereich "register_widget" definiert) aus
            * https://developer.wordpress.org/reference/functions/dynamic_sidebar/
            */
            dynamic_sidebar('sidebar_posts'); ?>
        </aside>
    <?php endif; ?>
</div>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php ?>

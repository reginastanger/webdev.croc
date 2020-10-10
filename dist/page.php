<?php get_header(); // WordPress Funktion zum Einbinden der header.php ?>
<main id="content">
    <section class="container animate fade-in-up">
        <?php /* the_title() gibt das Titel-Feld des Gutenberg-Editors aus. In diesem Fall mit zwei Parametern "before" & "after" - also was vor und nach dem Titel (Text) stehen soll. Hier der <h1> Tag
         * https://developer.wordpress.org/reference/functions/the_title/
         */
        the_title('<h1>','</h1>'); // ?>
        <?php /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge
        * https://developer.wordpress.org/themes/basics/the-loop/
        */
        if( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                the_content(); // gibt den gesamten Inhalt des Editors aus
            }
        }
        ?>
    </section>
</main>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php ?>
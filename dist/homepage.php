<?php /* Template Name: Homepage */ ?>
<?php
/* Nur durch den Kommentar "Template Name: BELIEBIGER NAME" zu Beginn (vor der Funktion "get_header()") weiß WordPress, registriert WordPress ein Seiten-Template
 * Bei der Namensvergabe darauf achten, dass es kein Name aus der Template-Struktur ist (https://developer.wordpress.org/themes/basics/template-hierarchy/)
 * https://developer.wordpress.org/themes/template-files-section/page-template-files/#creating-custom-page-templates-for-global-use
 */ ?>
<?php get_header(); // WordPress Funktion zum Einbinden der header.php ?>
    <main id="content">
        <section class="container animate fade-in-up">
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


        <?php /* Ausgabe der Referenzen (Custom Posts) als Slider (owl-carousel)
        * Mit der WordPress Funktion "query_posts()" können Inhalte aus anderen Seiten, Beiträgen, Custom-Posts, etc. abgefragt und ausgegeben werden.
        * https://developer.wordpress.org/reference/functions/query_posts/
        * Sämtliche Argumente (stehen im array() ) der WP_Query (WordPress Datenbankabfrage) können dabei verwendet werden
        * https://developer.wordpress.org/reference/classes/wp_query/
        * Hinweis: es gibt einige Argumente die Standard-Werte haben, solange man sie nicht überschreibt. ZB: 'post_status' => 'publish' oder 'order' => 'DESC' oder 'orderby' => 'post_date'
        */
        query_posts(array(
            'post_type' => 'references',    // zeige nur Inhalte vom Custom-Post-Type "references"
            'posts_per_page' => 6,          // zeige "6" Beiträge pro Seite (da keine Pagination konfiguriert ist, werden nur 6 angezeigt)
            'orderby' => 'rand'             // zeige die Beiträge in zufälliger Reihenfolge an ("rand" = Random)
        ));

        /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge
        * https://developer.wordpress.org/themes/basics/the-loop/
        */
        if (have_posts()) : ?>
            <section id="testimonials" class="container-small secondary-bg">
                <h2 class="section-title"><?php _e('Kunden', 'regi'); ?></h2>
                <div class="owl-carousel owl-theme">
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <div class="item testimonial-item">
                            <figure class="testimonial-image">
                                <?php /* die WordPress Funktion "wp_get_attachment_image()" gibt einen <img> Tag mit "src", "srcset", "class" & "alt" zurück
                                * als Parameter werden die "Attachment ID" (aus dem ACF-Image-Feld) und die "Bildgröße" übergeben
                                * https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
                                */
                                echo wp_get_attachment_image(get_field('image'), 'full') ?>
                            </figure>
                            <blockquote class="testimonial-content">
                                <?php the_field('text'); // Ausgabe des ACF-Text-Feld ?>
                                <?php the_title('<cite>', '</cite>'); // Ausgebe des Custom-Post-Title (Titel Feld im Editor) ?>
                            </blockquote>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
            <?php /* Für das OWL-Carousel wird eine Javascript und zwei Stylesheet Dateien benötigt. Diese wurde in der functions.php im Bereich "wp_enqueue_scripts" registriert (aber nicht ausgegeben)
            * mit wp_enqueue_style() & wp_enqueue_script() werden dises Dateien nun im <head> über die Funktion "wp_head()" bzw. for dem </body> über die Funktion "wp_footer()" eingebunden
            */
            wp_enqueue_style('owl-style');
            wp_enqueue_style('owl-theme-style');
            wp_enqueue_script('owl-script');
        endif;
        wp_reset_query(); // wird nach jeder "query_posts()" Abfrage benötigt um diese "Abzubrechen". Dies sollte nach query_posts () und vor einem anderen query_posts () verwendet werden. Dadurch werden Fehler vermieden, die auftreten, wenn das vorherige WP_Query-Objekt nicht ordnungsgemäß "zerstört" wird, bevor ein anderes eingerichtet wird.


        /* Ausgabe der letzten Beiträge
        * Mit der WordPress Funktion "query_posts()" können Inhalte aus anderen Seiten, Beiträgen, Custom-Posts, etc. abgefragt und ausgegeben werden.
        * https://developer.wordpress.org/reference/functions/query_posts/
        * Sämtliche Argumente (stehen im array() ) der WP_Query (WordPress Datenbankabfrage) können dabei verwendet werden
        * https://developer.wordpress.org/reference/classes/wp_query/
        * Hinweis: es gibt einige Argumente die Standard-Werte haben, solange man sie nicht überschreibt. ZB: 'post_status' => 'publish' oder 'order' => 'DESC' oder 'orderby' => 'post_date'
        * Da 'orderby' => 'post_date' Standard-Wert ist, werden automatisch die aktuellsten Beiträge angezeigt
        */
        query_posts(array(
            'post_type' => 'post',  // zeige nur Inhalte vom Post-Type "post" (Beiträge)
            'posts_per_page' => 2,  // zeige "2" Beiträge pro Seite (da keine Pagination konfiguriert ist, werden nur 2 angezeigt)
        ));

        /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge
        * https://developer.wordpress.org/themes/basics/the-loop/
        */


        if (have_posts()) : ?>
            <section id="blog" class="container-small">
                <h2 class="section-title">Blog</h2>
                <div class="columns">
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <div class="col-2">
                            <article class="blog-item animate fade-in-right">
                                <?php /* die WordPress Funktion "the_permalink()" gibt die Url zu einem Beitrag oder Seite aus. Wenn keine Parameter übergeben werden, dann die URL des aktuellen Beitrags in der Schleife
                                * https://developer.wordpress.org/reference/functions/the_permalink/
                                */ ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php /* Prüfe ob es ein Beitragsbild in diesem Beitrag gibt, sonst gib das Platzhalterbild (ACF-Option-Page) aus
                                    * "has_post_thumbnail()" - wenn es ein Beitragsbild gibt
                                    * https://developer.wordpress.org/reference/functions/has_post_thumbnail/
                                    */
                                    if (has_post_thumbnail()) {
                                        /* the_post_thumbnail() gibt das Beitragsbild in der Bildgröße, die wir als Parameter übergeben ('post-image' = eigene Bildgröße, definiert in der functions.php) als <img> Tag mit "src", "srcset", "class" & "alt" zurück
                                        * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
                                        */
                                        the_post_thumbnail('post-image');
                                    } else {
                                        /* die WordPress Funktion "wp_get_attachment_image()" gibt einen <img> Tag mit "src", "srcset", "class" & "alt" zurück
                                        * als Parameter werden die "Attachment ID" (aus dem ACF-Image-Feld der ACF-Option-Page) und die "Bildgröße" übergeben
                                        * https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
                                        */
                                        echo wp_get_attachment_image(get_field('placeholder_posts', 'options'), 'post-image');
                                    } ?>
                                </a>
                                <div class="blog-description">
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
                                    <h2 class="blog-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="actions animate fade-in-up">
                    <?php /* die WordPress Funktion "the_permalink()" gibt die Url zu einem Beitrag oder Seite aus. In unserem Fall übergeben wir die Page-ID der Blog-Seite (die unter Einstellungen -> Lesen als Beitragsseite konfiguriert ist), damit wird die Url der Blog-Seite übergeben
                    * https://developer.wordpress.org/reference/functions/the_permalink/
                    * Mit "get_option()" können WordPress Einstellungen abgefragt werden. Diese kann man sich im WordPress unter "DEINE-DOMAIN/wp-admin/options.php" anzeigen lassen. ACHTUNG: hier sollte nichts geändert werden - außer man weiß was man tut ;)
                    * https://developer.wordpress.org/reference/functions/get_option/
                    */ ?>


                    <a href="<?php echo get_permalink( get_option( 'page_for_posts' )); ?>" class="btn"><?php _e('Mehr Beiträge', 'regi'); ?></a>


                </div>
            </section>
        <?php endif;
        wp_reset_query(); // wird nach jeder "query_posts()" Abfrage benötigt um diese "Abzubrechen". Dies sollte nach query_posts () und vor einem anderen query_posts () verwendet werden. Dadurch werden Fehler vermieden, die auftreten, wenn das vorherige WP_Query-Objekt nicht ordnungsgemäß "zerstört" wird, bevor ein anderes eingerichtet wird.
        ?>
    </main>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php ?>
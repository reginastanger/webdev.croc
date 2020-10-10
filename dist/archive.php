<?php /*
  * Archive Template (Beitrags-Übersichtsseite für "Kategorien, Schlagwörter, Datum, Autoren")
  * https://developer.wordpress.org/themes/basics/template-hierarchy/
 */ ?>
<?php get_header(); // WordPress Funktion zum Einbinden der header.php ?>
    <main id="content">
        <section class="container-small">
            <h1><?php /*
            * Bedingung für Überschrift 1 - wenn es ein Kategorie-Archiv ist, wird der Kategorie-Titel angezeigt, sonst der Archiv-Titel (Archiv: TITEL)
            * https://developer.wordpress.org/reference/functions/is_category/
            * https://codex.wordpress.org/Conditional_Tags
            */
                if (is_category()) {
                    single_cat_title(); // Kategorie Titel (https://developer.wordpress.org/reference/functions/single_cat_title/)
                } else {
                    the_archive_title(); // Archiv Titel (* https://developer.wordpress.org/reference/functions/the_archive_title/)
                }
                ?></h1>
            <?php /*
            * Zeige die Archiv Beschreibung (Textfeld "Beschreibung" bei Kategorien, Schlagwörtern)
            * https://developer.wordpress.org/reference/functions/the_archive_description/
            */
            the_archive_description('<p>', '</p>'); ?>
            <?php /*
            * Da die Kategorie-Navigation in mehreren Templates (archive.php & index.php) verwendet wird, kann man diese Code-Teile in eigene Dateien schreiben und dort einbinden, wo sie gebraucht werden.
            * Natürlich kann der Inhalt aus der Datei "teplate-parts/nav-category.php" auch direkt statt dem "include (locate_template('template-parts/nav-category.php'))" eingefügt werden.
            * mit "include" kann man in PHP Inhalte aus externen Dateien laden
            * https://www.php.net/manual/de/function.include.php
            * "locate_template" ist eine WordPress Funktion, die es ermöglicht Coede-Teile einzubinden
            * https://developer.wordpress.org/reference/functions/locate_template/
            * eine weiter Möglichkeit Code-Teile in WordPress einzubinden wäre "get_template_part()" https://developer.wordpress.org/reference/functions/get_template_part/
            */
            include (locate_template('template-parts/nav-category.php')); ?>
            <?php /*
            * Bedingung: wenn es Beiträge in diesem Archiv (Kategorie, Schlagwort, etc.) gibt, zeige sie an, sonst zeige den Text "Es wurden keine Beiträge gefunden" an.
            */
            if (have_posts()) : ?>
                <?php /*
                * wie bei der Kategorie-Navigation, wird die Ausgabe der Beiträge in der Beitragsübersicht (Kategorie, Schlagwort - also in "Archiven") in mehreren Template benötigt (archive.php, index.php, Gutenberg-Block, ...),
                * daher wird diese while-Schleife in einer eigenen Datei erstellt und hier eingebunden.
                */
                include (locate_template('template-parts/post-loop.php')); ?>
            <?php else: ?>
                <h2><?php _e('Es wurden keine Beiträge gefunden', 'wifi'); ?></h2>
            <?php endif; ?>
            <nav class="pagination">
                <?php /*
                * Pagination in der Beitrags-Übersicht
                * es werden X-Beiträge auf der Beitrags-Übersicht angezeigt, wenn mehr Beiträge vorhanden sind wird die Pagination (Vorherige/Nächste Seite und die Seiten-Nummern) angezeigt
                * wieviele Beiträge pro Seite angezeigt werden, kann im WordPress unter "Einstellungen -> lesen" im Punkt "Blogseiten zwigen maximal X Beiträge", eingestellt werden
                * https://developer.wordpress.org/reference/functions/paginate_links/
                */
                echo paginate_links(array(
                    'prev_text' => '<span class="icon-arrow-left" aria-label="' . __('Vorherige Seite', 'regi') . '"></span>',
                    'next_text' => '<span class="icon-arrow-right" aria-label="' . __('Nächste Seite', 'regi') . '"></span>'
                )); ?>
            </nav>
        </section>
    </main>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php ?>
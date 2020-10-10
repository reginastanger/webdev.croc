<?php /*
 * ist eine Kopie der "archive.php"
 * Details (Kommentare, Links) in der "archive.php".
*/ ?>
<?php get_header(); ?>
    <main id="content">
        <section class="container-small">
            <h1><?php
                if (is_category()) {
                    single_cat_title();
                } else {
                    the_archive_title();
                }
                ?></h1>
            <?php the_archive_description('<p>', '</p>'); ?>
            <?php include (locate_template('template-parts/nav-category.php')); ?>
            <?php if (have_posts()) : ?>
                <?php include (locate_template('template-parts/post-loop.php')); ?>
            <?php else: ?>
                <h2><?php _e('Es wurden keine Beiträge gefunden', 'regi'); ?></h2>
            <?php endif; ?>
            <nav class="pagination">
                <?php echo paginate_links(array(
                    'prev_text' => '<span class="icon-arrow-left" aria-label="' . __('Vorherige Seite', 'regi') . '"></span>',
                    'next_text' => '<span class="icon-arrow-right" aria-label="' . __('Nächste Seite', 'regi') . '"></span>'
                )); ?>
            </nav>
        </section>
    </main>
<?php get_footer(); ?>
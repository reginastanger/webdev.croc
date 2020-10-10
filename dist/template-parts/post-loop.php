<div class="columns">
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <div class="col-2">
            <article class="blog-item animate fade-in-right">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('post-image');
                    } else {
                        echo wp_get_attachment_image(get_field('placeholder_posts', 'options'), 'post-image');
                    } ?>
                </a>
                <div class="blog-description">
                    <time class="meta" datetime="<?php the_time('Y-m-d'); ?>">
                        <span class="icon-calendar" aria-hidden="true"></span>
                        <?php the_time('d.m.Y'); ?>
                    </time>
                    <span class="meta categories">
                                        <span class="icon-category" aria-hidden="true"></span>
                                        <?php the_category(', '); ?>
                                    </span>
                    <h2 class="blog-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
            </article>
        </div>
    <?php endwhile; ?>
</div>
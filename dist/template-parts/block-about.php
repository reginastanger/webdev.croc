<?php
$id = 'block!-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$className = 'columns';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

 ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">



            <section id="about" class="container-small color-line">



                <div class="about-item">

                    <figure class="about-image">
                        <?php echo wp_get_attachment_image(get_field('about-image'), 'full'); ?>
                    </figure>


                    <p class="about-content">
                        <?php the_field('about-text'); ?>
                        <cite><?php the_field('about-autor'); ?></cite>
                    </p>

                    <span class="<?php the_field('icon-about'); ?>" aria-hidden="true"></span>


                </div>

            </section>

    </div>

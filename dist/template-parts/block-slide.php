<?php
$id = 'block!-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$className = 'columns slide-row';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$slide = get_field('slide');
if (!empty($slide)): ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <?php foreach ($slide as $item): ?>


            <div class="col-3">
                <article class="slide_regi">
                    <?php echo wp_get_attachment_image($item['slider-bild'], 'full'); ?>
                    <div class="regi-wrapper">
                        <h3 class="slide-title"><?php echo $item['title']; ?></h3>
                        <p class="slide-description"><?php echo $item['description']; ?></p>
                    </div>
                </article>

            </div>




        <?php endforeach; ?>
    </div>

<?php endif; ?>
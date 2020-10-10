<?php
$id = 'block!-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

$className = 'columns teaser-row';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}

$teaser = get_field( 'teaser' );
if ( ! empty( $teaser ) ): ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
		<?php foreach ($teaser as $item):?>
        <div class="col-3">
            <div class="teaser animate zoom-in">
                <span class="<?php echo $item['icon']; ?>" aria-hidden="true"></span>
                <h3 class="teaser-title"><?php echo $item['title']; ?></h3>
                <p class="teaser-description"><?php echo $item['description']; ?></p>
                <a href="<?php echo $item['link']; ?>" class="teaser-link">
                    <span class="icon-link" aria-hidden="true"></span>
                    <span class="screen-reader-text"><?php echo __('Zur Seite: ', 'regi') . $item['title'];?></span>
                </a>
            </div>
        </div>
		<?php endforeach; ?>
    </div>

<?php endif; ?>
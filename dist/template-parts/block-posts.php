<?php
$id = 'block!-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

$className = 'columns';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}

query_posts(array(
	'post_type' => 'post',
	'posts_per_page' => 2,
));

if (have_posts()) : ?>
    <?php include (locate_template('template-parts/post-loop.php')); ?>
<?php endif;
wp_reset_query();
?>
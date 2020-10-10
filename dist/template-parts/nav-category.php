<nav class="category-nav">
    <ul>
        <?php wp_list_categories(array(
            'title_li' => '',
            'hierarchical' => false,
            'show_option_all' => __('Alle','wifi')
        )); ?>
    </ul>
</nav>
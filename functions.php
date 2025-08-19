<?php
function hodcode_enqueue_styles() {
    wp_enqueue_style('hodcode-style', get_stylesheet_uri());
    wp_enqueue_script('tailwind', "https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4", [], null, true);
}
add_action('wp_enqueue_scripts', 'hodcode_enqueue_styles');

function my_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_post_type_support('product', 'thumbnail');
}
add_filter('get_custom_logo', function($html) {
    return str_replace('custom-logo', 'custom-logo h-10 w-auto', $html);
});
add_action('after_setup_theme', 'my_setup');

add_action('init', function () {
    register_post_type('product', [
        'public'       => true,
        'label'        => 'Products',
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest' => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'products'],
    ]);

    register_taxonomy('product_cat', ['product'], [
        'hierarchical' => true,
        'labels'       => [
            'name'          => 'Product Categories',
            'singular_name' => 'Product Category'
        ],
        'rewrite'      => ['slug' => 'product-category'],
        'show_in_rest' => true,
    ]);
});

add_action('after_setup_theme', function () {
    register_nav_menus([
        "header" => "Header Menu"
    ]);
});

hodcode_add_custom_field("price", "product", "Price (Final)");
hodcode_add_custom_field("old_price", "product", "Price (Before)");
hodcode_add_custom_field("features", "product", "Product Features (comma separated)");

function hodcode_add_custom_field($fieldName, $postType, $title) {
    add_action('add_meta_boxes', function () use ($fieldName, $postType, $title) {
        add_meta_box(
            $fieldName . '_box',
            $title,
            function ($post) use ($fieldName) {
                $value = get_post_meta($post->ID, $fieldName, true);
                wp_nonce_field($fieldName . '_nonce', $fieldName . '_nonce_field');
                echo '<input type="text" style="width:100%" name="' . esc_attr($fieldName) . '" value="' . esc_attr($value) . '">';
            },
            $postType,
            'normal',
            'default'
        );
    });

    add_action('save_post', function ($post_id) use ($fieldName) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST[$fieldName . '_nonce_field'])) return;
        if (!wp_verify_nonce($_POST[$fieldName . '_nonce_field'], $fieldName . '_nonce')) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST[$fieldName])) {
            $san = sanitize_text_field(wp_unslash($_POST[$fieldName]));
            update_post_meta($post_id, $fieldName, $san);
        } else {
            delete_post_meta($post_id, $fieldName);
        }
    });
}

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_home() || $query->is_post_type_archive('product') || $query->is_tax('product_cat')) {
            $query->set('post_type', 'product');
        }
    }
});

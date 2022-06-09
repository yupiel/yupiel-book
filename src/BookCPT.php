<?php

namespace Yupiel\Book;

class BookCPT
{
    public static function init()
    {
        add_action('init', [__CLASS__, 'create_yupielbook_cpt'], 0);
    }

    public static function create_yupielbook_cpt()
    {
        $labels = array(
            'name' => _x('Books', 'Post Type General Name', 'yupiel-book'),
            'singular_name' => _x('Book', 'Post Type Singular Name', 'yupiel-book'),
            'menu_name' => _x('Books', 'Admin Menu text', 'yupiel-book'),
            'name_admin_bar' => _x('Book', 'Add New on Toolbar', 'yupiel-book'),
            'archives' => __('Book Archives', 'yupiel-book'),
            'attributes' => __('Book Attributes', 'yupiel-book'),
            'parent_item_colon' => __('Parent Book:', 'yupiel-book'),
            'all_items' => __('All Books', 'yupiel-book'),
            'add_new_item' => __('Add New Book', 'yupiel-book'),
            'add_new' => __('Add New', 'yupiel-book'),
            'new_item' => __('New Book', 'yupiel-book'),
            'edit_item' => __('Edit Book', 'yupiel-book'),
            'update_item' => __('Update Book', 'yupiel-book'),
            'view_item' => __('View Book', 'yupiel-book'),
            'view_items' => __('View Books', 'yupiel-book'),
            'search_items' => __('Search Book', 'yupiel-book'),
            'not_found' => __('Not found', 'yupiel-book'),
            'not_found_in_trash' => __('Not found in Trash', 'yupiel-book'),
            'featured_image' => __('Featured Image', 'yupiel-book'),
            'set_featured_image' => __('Set featured image', 'yupiel-book'),
            'remove_featured_image' => __('Remove featured image', 'yupiel-book'),
            'use_featured_image' => __('Use as featured image', 'yupiel-book'),
            'insert_into_item' => __('Insert into Book', 'yupiel-book'),
            'uploaded_to_this_item' => __('Uploaded to this Book', 'yupiel-book'),
            'items_list' => __('Books list', 'yupiel-book'),
            'items_list_navigation' => __('Books list navigation', 'yupiel-book'),
            'filter_items_list' => __('Filter Books list', 'yupiel-book'),
        );
        $args = [
            'label' => __('Book', 'yupiel-book'),
            'description' => __('Book Custom Type', 'yupiel-book'),
            'labels' => $labels,
            'menu_icon' => 'dashicons-book',
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'author'],
            'taxonomies' => ['category', 'post_tag'],
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'exclude_from_search' => false,
            'show_in_rest' => true,
            'publicly_queryable' => true,
            'capability_type' => 'post',
            'rewrite' => ['slug' => 'yupiel-book']
        ];
        register_post_type('yupiel-book', $args);
    }
}

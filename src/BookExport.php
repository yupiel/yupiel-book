<?php

namespace Yupiel\Book;

class BookExport
{
    public static function init()
    {
        add_action('admin_post_generate_books_json_file', [__CLASS__, 'generate_books_json_file']);
        add_action('admin_notices', [__CLASS__, 'book_export_success_notification']);
    }

    public static function generate_books_json_file()
    {
        $filename = 'yupiel-books.json';

        try {
            $json = json_encode(self::getAllBooks(), JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            echo $e->getMessage();
            wp_safe_redirect(admin_url() . "options-general.php?page=yupiel-book&action=export&success=false");
            exit;
        }

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        echo $json;

        wp_safe_redirect(admin_url() . "options-general.php?page=yupiel-book&action=export&success=true");
        exit;
    }

    public static function getAllBooks()
    {
        global $wpdb;

        $books = $wpdb->get_results(
            "SELECT * FROM wp_posts
            WHERE post_type = 'yupiel-book'
            AND post_status != 'auto-draft'"
        );

        return $books;
    }

    public static function book_export_success_notification()
    {
        global $pagenow;



        if ($pagenow == 'options-general.php' && $_GET['page'] == 'yupiel-book' && isset($_GET['action']) && $_GET['action'] == 'export' && isset($_GET['success'])) {
            $success = $_GET['success'];
            if ($success == true) {
                echo '<div class="notice notice-success is-dismissible">
                <p>Successfully exported Books.</p>
            </div>';
            } else if ($success == false) {
                echo '<div class="notice notice-success is-dismissible">
                <p>Book Export failed. Try again.</p>
            </div>';
            }
        }
    }
}

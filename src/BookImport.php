<?php

namespace Yupiel\Book;

class BookImport
{
    public static function init()
    {
        add_action('admin_post_import_books_json_file', [__CLASS__, 'import_books_json_file']);
        add_action('admin_notices', [__CLASS__, 'book_import_success_notification']);
    }

    public static function import_books_json_file()
    {
        if ($_FILES['file']['name'] == '') {
            wp_safe_redirect(admin_url() . "options-general.php?page=yupiel-book&action=import&success=false");
            exit;
        }

        $importedBooks = json_decode(file_get_contents($_FILES['file']['tmp_name']));

        foreach ($importedBooks as $importedBook) {
            self::insertBook($importedBook);
        }

        wp_safe_redirect(admin_url() . "options-general.php?page=yupiel-book&action=import&success=true");
        exit;
    }

    public static function insertBook($importBook)
    {
        global $wpdb;

        $wpdb->insert(
            "wp_posts",
            (array) $importBook
        );
    }

    public static function book_import_success_notification()
    {
        global $pagenow;

        if ($pagenow == 'options-general.php' && $_GET['page'] == 'yupiel-book' && isset($_GET['action']) && $_GET['action'] == 'import' && isset($_GET['success'])) {
            $success = $_GET['success'];
            if ($success == true) {
                echo '<div class="notice notice-success is-dismissible">
                <p>Successfully imported Books.</p>
            </div>';
            } else if ($success == false) {
                echo '<div class="notice notice-success is-dismissible">
                <p>Book Import failed. Try again.</p>
            </div>';
            }
        }
    }
}

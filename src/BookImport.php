<?php

namespace Yupiel\Book;

class BookImport {
    public static function import_books_json_file()
    {
        if ($_FILES['file']['name'] == '') {
            header("Location: " . admin_url() . "options-general.php?page=yupiel-book");
            exit();
        }

        $importedBooks = json_decode(file_get_contents($_FILES['file']['tmp_name']));

        foreach ($importedBooks as $importedBook) {
            self::insertBook($importedBook);
        }

        header("Location: " . admin_url() . "options-general.php?page=yupiel-book");
        exit();
    }

    public static function insertBook($importBook)
    {
        global $wpdb;

        $wpdb->insert(
            "wp_posts",
            (array) $importBook
        );
    }
}
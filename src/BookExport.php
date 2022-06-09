<?php

namespace Yupiel\Book;

class BookExport {
    public static function generate_books_json_file()
    {
        $filename = 'yupiel-books.json';

        try {
            $json = json_encode(self::getAllBooks(), JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        echo $json;

        exit();
    }

    public static function getAllBooks()
    {
        global $wpdb;

        $books = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM wp_posts
                WHERE post_type = 'yupiel-book'
                AND post_status != 'auto-draft'"
            ),
            OBJECT
        );

        return $books;
    }
}
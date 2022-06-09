<?php

namespace Yupiel\Book;

use Yupiel\Book\BookExport;
use Yupiel\Book\BookImport;

class BookOptions
{
    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'yupielbook_register_options_page']);
        add_action('admin_post_generate_books_json_file', [new BookExport, 'generate_books_json_file']);
        add_action('admin_post_import_books_json_file', [new BookImport, 'import_books_json_file']);
    }

    public static function yupielbook_register_options_page()
    {
        add_options_page(
            'Book Options',
            'Book Options',
            'manage_options',
            'yupiel-book',
            [__CLASS__, 'yupielbook_options_page']
        );
    }

    public static function yupielbook_options_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
?>
        <div class="wrap">
            <h1>Yupiel Book Options</h1>
            <hr>
            <h3>Export</h3>
            <p>
                To generate and download every book (not including autosaves), click the Export button.
                You may then later import this file using the Import button.
            </p>
            <form action="<?php echo admin_url(); ?>admin-post.php?action=generate_books_json_file" method="POST">
                <input type="hidden" name="action" value="generate_books_json_file">
                <input type="submit" value="Export">
            </form>

            <hr>
            <h3>Import</h3>
            <p>
                To import previously downloaded books, click the Import button below and select the data file.
            </p>
            <form action="<?php echo admin_url(); ?>admin-post.php?action=import_books_json_file" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Upload File</td>
                        <td><input type="file" name="file"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" value="Import">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
<?php
    }
}

<?php

namespace Yupiel\Book;

use Yupiel\Book\BookCPT;
use Yupiel\Book\BookOptions;

defined('ABSPATH') || exit;

class Plugin
{
    public static function init()
    {
        if (is_admin()) {
            BookCPT::init();
            BookOptions::init();
        }
    }
}

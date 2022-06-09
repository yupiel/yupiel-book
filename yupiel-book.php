<?php

/*
Plugin Name: Yupiel Book
*/

use Yupiel\Book\Plugin;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once(__DIR__ . '/vendor/autoload.php');
}

Plugin::init();
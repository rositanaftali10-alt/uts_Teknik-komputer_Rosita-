<?php

function view($path, $data = []) {
    extract($data);
   $file = dirname(__DIR__, 2) . '/views/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "File view tidak ditemukan di: " . $file;
    }
}
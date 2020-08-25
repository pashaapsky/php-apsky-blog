<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

use function helpers\loadSettingsFromFile;
use function helpers\saveSettingsToFile;

if (!empty($_POST)) {
    if (isset($_POST['blog-count-on-page']) && !empty($_POST['blog-count-on-page'])) {
        $path = $_SERVER["DOCUMENT_ROOT"] . '/configs/admin-settings.json';

        $settings = loadSettingsFromFile($path);
        $settings['admin-settings']['blog-count-on-page'] = $_POST['blog-count-on-page'];

        saveSettingsToFile($path, $settings);
        echo 'Success';
    } else {
        echo 'No changes received';
    }
} else {
    echo 'No changes received';
}
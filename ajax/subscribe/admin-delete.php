<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\DataBase;
use Models\Subscribe;

if (!empty($_POST['subID']) && isset($_POST['subID'])) {
    new DataBase();

    $sub = Subscribe::find($_POST['subID']);
    $sub->delete();
    echo 'Success';
} else {
    echo 'Cant get subscribe information';
}


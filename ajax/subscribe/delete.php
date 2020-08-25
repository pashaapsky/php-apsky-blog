<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\DataBase;
use Models\Subscribe;
use Models\User;

if (!empty($_POST)) {
    new DataBase();

    $sub = new Subscribe();

    if (isset($_COOKIE['login']) && !empty($_COOKIE['login'])) {
        $subscriber = User::where('email', $_COOKIE['login'])->first();
    } else {
        echo 'No login user';
        return;
    }

    if (isset($_POST['profile']) && !empty($_POST['profile'])) {
        $profile = User::where('username', $_POST['profile'])->first();
    } else {
        echo 'Empty subscribed user';
        return;
    }

    $isSub = Subscribe::where('subscriber', $subscriber->id)->where('subscribe_to', $profile->id)->first();

    if ($isSub) {
        $isSub->delete();
        echo 'Success';
    } else {
        echo 'This subscribe is not actually or already deleted';
    }
}

<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\DataBase;
use Models\Subscribe;
use Models\User;

if (!empty($_POST)) {
    new DataBase();

    $sub = new Subscribe();

    if (isset($_POST['date-up-to']) && !empty($_POST['date-up-to'])) {
        $date = mb_substr($_POST['date-up-to'], 0, strrpos($_POST['date-up-to'], 'month'));
        $sub->date_up_to = $date;
    } else {
        echo 'Field date_up_to is required';
        return;
    }

    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        $sub->subscriber = $_POST['user_id'];
    } else {
        echo 'Empty subscriber user';
        return;
    }

    if (isset($_POST['subscribe_to']) && !empty($_POST['subscribe_to'])) {
        $subToID = User::where('username', $_POST['subscribe_to'])->first()->id;

        $activeSub = Subscribe::where('subscriber', $_POST['user_id'])->where('subscribe_to', $subToID)->first();
        if ($activeSub) {
            echo 'This subscribe is actually yet. Delete it or create another.';
            return;
        } else {
            $sub->subscribe_to = $subToID;
        }
    } else {
        echo 'Field subscribe to is required';
        return;
    }

    $sub->save();
    echo 'Success';
}

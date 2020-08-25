<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\AuthCategory;
use Models\AuthCategoryUsers;
use Models\DataBase;
use Models\User;

use function helpers\loadPhoto;

if (!empty($_POST)) {
    new DataBase();
    $changeGrants = false;
    $user = User::where('username', $_POST['lastUserName'])->first();

    if (isset($_POST['firstname']) && !empty($_POST['firstname'])) {
        $user->firstname = $_POST['firstname'];
    } else {
        echo 'User firstname is required';
        return;
    }

    if (isset($_POST['secondname']) && !empty($_POST['secondname'])) {
        $user->secondname = $_POST['secondname'];
    } else {
        echo 'User secondname is required';
        return;
    }

    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $allUsersNames = User::all('username');

        if ($allUsersNames->contains('username', $_POST['username']) && $user->username !== $_POST['username']) {
            echo 'This username has already use. Please choice another.';
            return;
        } else {
            $user->username = $_POST['username'];
        }
    } else {
        echo 'Username is required';
        return;
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $allUsersEmails = User::all('email');

        if ($allUsersEmails->contains('email', $_POST['email']) && $user->email !== $_POST['email']) {
            echo 'This email has already use. Please choice another.';
            return;
        } else {
            $user->email = $_POST['email'];
        }
    } else {
        echo 'User email is required';
        return;
    }

    if (isset($_POST['grants']) && !empty($_POST['grants'])) {
        $newCategoryID = AuthCategory::where('name', $_POST['grants'])->value('id');
        $userCategory = AuthCategoryUsers::where('user_id', $user->id)->first();

        $userCategory->category_id = $newCategoryID;
        $changeGrants = true;
    }

    if (isset($_POST['bio']) && !empty($_POST['bio'])) {
        $user->bio = $_POST['bio'];
    }

    $result = loadPhoto($_SERVER['DOCUMENT_ROOT'] . '/src/img/profile/', $user, 'defaultProfilePhoto.png');

    if ($result === 'Photo added') {
        $user->save();

        if ($changeGrants) {
            $userCategory->save();
        }

        echo 'Success';
    } else {
        echo $result;
    }
}
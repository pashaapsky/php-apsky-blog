<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

use Controllers\AuthController;
use Controllers\UserController;
use Models\DataBase;
use Models\User;

if (!empty($_POST)) {
    if ($_POST['password'] === $_POST['password-confirm']) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userName = $_POST['userName'];
        $password = password_hash($_POST['password'], 1);
        $email = $_POST['email'];

        new DataBase();

        $checkEmail = User::where('email', $email)->first();

        if (!$checkEmail) {
            $checkUserName = User::where('username', $userName)->first();
            if (!$checkUserName) {
                $user = UserController::create_user($userName, $firstName, $lastName, $email, $password);

                $createdUserId = $user->id;
                AuthController::createAuthCategoryUsersField($createdUserId);

                setcookie('login', $email, time() + (3600 * 24 * 30), '/');
                setcookie('grants', 'registered', time() + (3600 * 24 * 30), '/');
                $grants = 'registered';

                echo 'Registration completed';
            } else {
                echo 'This username is already use, please change';
            }
        } else {
            echo 'This email is already use, please change';
        }
    } else {
        echo 'Passwords must be the same';
    }
} else {
    echo 'Form Data is empty';
}
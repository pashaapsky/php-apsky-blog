<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

use Controllers\AuthController;
use Controllers\UserController;
use Models\DataBase;
use Models\User;

if (!empty($_POST)) {
    if ($_POST['password'] === $_POST['password-confirm']) {
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $userName = htmlspecialchars($_POST['userName']);
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
                session_name('session_id');
                session_start();
                setcookie('login', $email, time() + (3600 * 24 * 30), '/');
                setcookie('grants', 'registered', time() + (3600 * 24 * 30), '/');
                $grants = 'registered';
                $_SESSION['login']='yes';

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
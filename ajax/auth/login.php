<?php
use Controllers\AuthController;

require $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if(!empty($_POST["email"]) && !empty($_POST['password'])) {
    AuthController::goSignIn($_POST['email'], $_POST['password']);
} else {
    echo 'All fields are required';
}
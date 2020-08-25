<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';
use Controllers\UserController;
use Models\DataBase;

if (!empty($_POST)) {
    new DataBase();

    UserController::update($_POST['profile_username'], $_POST['userName'], $_POST['name'], $_POST['bio']);
}


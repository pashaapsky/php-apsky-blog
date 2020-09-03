<?php
session_name('session_id');
session_start();

use function helpers\checkModerationGrants;

if (!checkModerationGrants()) {
    header("Location: /admin/auth");
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/auth/logout.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <base href="../../">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../../src/css/styles.css">

    <!-- jquery  -->
    <title><?= $data['title'] ?></title>
</head>
<body>






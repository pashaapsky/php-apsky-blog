<?php

use Models\DataBase;
use Models\Pages;

require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

if (!empty($_POST)) {
    new DataBase();

    if (isset($_POST['page_id']) && !empty($_POST['page_id'])) {
        $page = Pages::find($_POST['page_id']);
    } else {
        echo 'Page ID is not find';
        return;
    }

    if (isset($_POST['text']) && !empty($_POST['text'])) {
        $page->text = htmlspecialchars($_POST['text']);
    } else {
        echo 'Page text is required';
        return;
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $allPagesNames = Pages::all('name');

        if ($allPagesNames->contains('name', $_POST['name']) && $page->name !== $_POST['name']) {
            echo 'This page name has already use. Please choice another.';
            return;
        } else {
            $page->name = htmlspecialchars($_POST['name']);
        }
    } else {
        echo 'Page name is required';
        return;
    }

    if (isset($_POST['src']) && !empty($_POST['src'])) {

        $pattern = "/^pages\/[a-z]*.php/";
        $test = $_POST['src'];

        if (!preg_match($pattern, $test)) {
            echo 'Page Src must look like {ex: pages/calls.php}';
            return;
        }

        $allPagesSrc = Pages::all('src');

        if ($allPagesSrc->contains('src', $_POST['src']) && $page->src !== $_POST['src']) {
            echo 'This src has already use. Please choice another.';
            return;
        } else {
            $oldName = $_SERVER['DOCUMENT_ROOT'] . '/view/' . $page->src;
            $newName = $_SERVER['DOCUMENT_ROOT'] . '/view/' . $_POST['src'];

            $result = rename($oldName, $newName);

            if ($result)
                $page->src = $_POST['src'];
            else {
                echo 'Error with rename page file template';
                return;
            }
        }

    } else {
        echo 'Page src is required';
        return;
    }

    $page->save();
    echo 'Success';
}
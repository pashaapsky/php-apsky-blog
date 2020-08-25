<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\Comment;
use Models\DataBase;

if (!empty($_POST)) {
    new DataBase();;

    $comment = Comment::find($_POST['comment_id']);
    $comment->delete();
    echo 'Success';
} else {
    echo 'No data send';
}


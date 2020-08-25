<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\Comment;
use Models\DataBase;

if (!empty($_POST)) {
    new DataBase();

    $comment = Comment::find($_POST['comment_id']);

    if (isset($_POST['content']) && !empty($_POST['content'])) {
        $comment->text = $_POST['content'];
        $comment->save();
        echo 'Success';
    } else {
        echo 'Comment content is required';
        return;
    }
}
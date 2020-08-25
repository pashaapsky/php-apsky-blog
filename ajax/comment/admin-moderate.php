<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\Comment;
use Models\DataBase;

if (!empty($_POST)) {
    new DataBase();

    if (isset($_POST['comment_id']) && !empty($_POST['comment_id'])) {
        $comment = Comment::find($_POST['comment_id']);
        $comment->approved ? $comment->approved = 0 : $comment->approved = 1;
        $comment->save();
        echo 'Success';
    } else {
        echo 'Error data send';
        return;
    }
}
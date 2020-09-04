<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Controllers\CommentController;
use Models\Comment;
use Models\DataBase;
use Models\User;
use function helpers\checkModerationGrants;

if(!empty($_POST)) {
    if (!is_finite($_POST['blog_id'])) {
        echo 'Blog_id is incorrect. Try to refresh page.';
        return;
    };

    new DataBase();
    $comment = new Comment();

    if (isset($_COOKIE['login']) && !empty($_COOKIE['login'])) {
        $user = User::where('email', $_COOKIE['login'])->first();
        $comment->user_id = $user->id;
    } else {
        echo 'User not found';
        return;
    }

    if (isset($_POST['comment-text']) && !empty($_POST['comment-text'])) {
        $comment->text = htmlspecialchars($_POST['comment-text']);
    } else {
        echo 'Comment text is required';
        return;
    }

    if (isset($_POST['blog_id']) && !empty($_POST['blog_id'])) {
        $comment->blog_id = $_POST['blog_id'];
    } else {
        echo 'Blog id is not found';
        return;
    }

    $comment->approved = checkModerationGrants() === true ? '1' : '0';
    $comment->save();
    echo 'Success';
}

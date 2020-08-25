<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Models\Comment;
use Models\DataBase;
use Models\User;

new DataBase();

$countItemsOnPage = 3;

if (!empty($_GET) && isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

if (empty($page) or $page < 0) {
    $page = 1;
}

$blogID = $currentBlog->id;

function getStartValue($page, $commentsCount, $countItemsOnPage) {
    $commentsCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($commentsCount) / $countItemsOnPage);

    if ($page > $totalPages) {
        $page = $totalPages;
    }

    $page = intval($page);

    return ($page - 1) * $countItemsOnPage;
}

if (isset($_COOKIE['grants']) && (($_COOKIE['grants'] !== 'registered'))) {
    $commentsCount = Comment::where('blog_id', $blogID)->count();
    $start = getStartValue($page, $commentsCount, $countItemsOnPage);

    $comments = Comment::where('blog_id', $blogID)->orderBy('created_at', 'desc')->limit($countItemsOnPage)->offset($start)->get();
} elseif (isset($_COOKIE['grants']) && ($_COOKIE['grants'] === 'registered')) {
    $user = User::where('email', $_COOKIE['login'])->first();

    $commentsCount = Comment::where('blog_id', $blogID)->where(function ($q) {
        $user = User::where('email', $_COOKIE['login'])->first();
        $q->where('approved', 1)->orWhere('user_id', $user->id);
    })->count();

    $start = getStartValue($page, $commentsCount, $countItemsOnPage);

    $comments = Comment::where('blog_id', $blogID)->where(function ($q) {
        $user = User::where('email', $_COOKIE['login'])->first();
        $q->where('approved', 1)->orWhere('user_id', $user->id);
    })->orderBy('created_at', 'desc')->limit($countItemsOnPage)->offset($start)->get();
} else {
    $commentsCount = Comment::where('blog_id', $blogID)->where('approved', '1')->count();
    $start = getStartValue($page, $commentsCount, $countItemsOnPage);

    $comments = Comment::where('blog_id', $blogID)->where('approved', '1')->orderBy('created_at', 'desc')->limit($countItemsOnPage)->offset($start)->get();
}

$commentsCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($commentsCount) / $countItemsOnPage);




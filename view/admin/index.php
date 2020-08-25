<?php

use Models\Blog;
use Models\User;
use function helpers\getAdminPageParseUrl;
use function helpers\getRandomSVGFill;

include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';
?>
<main role="main" class="bg-light">
    <div class="container">
        <section class="administration">
            <div class="administration__intro d-flex align-items-center p-2 my-3 text-white-50 rounded shadow-sm" style="background-color: #c5c0d0;">
                <img class="administration__logo mx-2" src="../../src/img/signup/administration-page-logo.svg" alt="" width="48" height="48">

                <div class="administration__header">
                    <h4 class="administration__heading mb-0 text-white">Administration</h4>
                    <span class="administration__page text-white"><?= getAdminPageParseUrl() ?></span>
                </div>
            </div>

            <section class="last-blogs my-3 pb-1 pt-3 px-3 bg-white rounded shadow-sm">
                <h6 class="last-blogs__header border-bottom border-gray pb-2 mb-0">Last blogs</h6>

                <?php foreach ($data['blogs'] as $blog) : ?>
                <div class="last-blogs__item media text-muted pt-3">
                    <svg class="d-none d-sm-block bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#<?= getRandomSVGFill() ?>"></rect>
                    </svg>

                    <p class="last-blogs__body media-body pb-1 mb-0 small text-justify border-bottom border-gray">
                        <a href="/profile/<?= User::where('id', $blog->user_id)->first()->username ?>" class="d-block">
                            <strong class="" style="color: deepskyblue">@<?= User::where('id', $blog->user_id)->first()->username ?></strong>
                        </a>
                        <?= $blog->text ?>
                    </p>
                </div>
                <?php endforeach; ?>

                <small class="last-blogs__actions d-block text-center text-sm-right my-1">
                    <a href="/admin/blogs" class="btn btn-sm btn-success">Edit blogs</a>
                </small>
            </section>

            <?php if (isset($_COOKIE['grants']) && $_COOKIE['grants'] === 'admin') : ?>
            <section class="last-users my-3 pb-1 pt-3 px-3 bg-white rounded shadow-sm">
                <h6 class="last-users__header border-bottom border-gray pb-2 mb-0">Last registered users</h6>

                <?php foreach ($data['users'] as $user) : ?>
                    <div class="last-users__item media text-muted pt-2">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#<?= getRandomSVGFill() ?>"></rect>
                        </svg>

                        <div class="last-users__body media-body pb-1 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="" style="color: deepskyblue"><?= $user->firstname ?></strong>

                                <a href="/profile/<?= $user->username ?>">Follow</a>
                            </div>

                            <span class="d-block">@<?= $user->username ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>

                <small class="last-users__actions d-block text-center text-sm-right my-1">
                    <a href="/admin/users" class="btn btn-sm btn-success">Edit users</a>
                </small>
            </section>
            <?php endif; ?>

            <section class="last-comments my-3 pb-1 pt-3 px-3 bg-white rounded shadow-sm">
                <h6 class="border-bottom border-gray pb-2 mb-0">Last comments</h6>

                <?php foreach ($data['comments'] as $comment) : ?>
                    <div class="last-comments__item media text-muted pt-3">
                        <svg class="d-none d-sm-block bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#<?= getRandomSVGFill() ?>"></rect>
                        </svg>

                        <p class="last-comments__body media-body pb-1 mb-0 small text-justify border-bottom border-gray">
                            <a href="/blog/<?= Blog::where('id', $comment->blog_id)->first()->id ?>" class="d-block">
                                <strong class="" style="color: deepskyblue">@<?= Blog::where('id', $comment->blog_id)->first()->name ?></strong>
                            </a>
                            <?= $comment->text ?>
                        </p>
                    </div>
                <?php endforeach; ?>

                <small class="last-comments__actions d-block text-center text-sm-right my-1">
                    <a href="/admin/comments" class="btn btn-sm btn-success">Edit comments</a>
                </small>
            </section>
        </section>
    </div>
</main>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-footer.php';
?>

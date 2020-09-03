<?php
use Models\User;
use function helpers\setActiveAdminNavigation;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/admin-header.php';

if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') {
    $user = User::where('email', $_COOKIE['login'])->first();
}
 ?>
<div class="wrapper d-flex flex-column bg-light" style="min-height: 100vh; overflow: hidden">
    <header class="header">
        <div class="navbar navbar-expand-lg navbar-dark bg-dark" id="">
            <div class="container">
                <a class="navbar-brand d-flex pl-2" href="/" >
                    <img src="../src/img/header/site-logo.png" width="50" height="30" class="d-inline-block align-top" alt="">

                    <div class="d-flex flex-column">
                        <span class="ml-3 text-bottom" style="font-size: 16px">dot
                            <strong style="font-size: 20px; line-height: 0.5">.BLOG</strong>
                        </span>

                        <span class="ml-3 text-danger d-block" style="font-size: 12px; line-height: 0.5">administration</span>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu-admin-header" aria-controls="nav-menu-admin-header" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" style="flex-grow: 0" id="nav-menu-admin-header">
                    <nav class="navbar-nav align-items-center">
                        <div class="navbar-nav align-items-center">
                            <?php if(isset($_COOKIE['grants']) && $_COOKIE['grants'] === 'admin') :?>
                                <a class="nav-link <?= setActiveAdminNavigation('main') ?>" href="/admin">Main</a>
                                <a class="nav-link <?= setActiveAdminNavigation('blogs') ?>" href="/admin/blogs">Blogs</a>
                                <a class="nav-link <?= setActiveAdminNavigation('users') ?>" href="/admin/users">Users</a>
                                <a class="nav-link <?= setActiveAdminNavigation('comments') ?>" href="/admin/comments">Comments</a>
                                <a class="nav-link <?= setActiveAdminNavigation('settings') ?>" href="/admin/settings">Settings</a>
                                <a class="nav-link <?= setActiveAdminNavigation('subscribes') ?>" href="/admin/subscribes">Subscribes</a>
                                <a class="nav-link <?= setActiveAdminNavigation('pages') ?>" href="/admin/pages">Pages</a>
                                <a class="nav-link <?= setActiveAdminNavigation('page-creator') ?>" href="/admin/page-creator">Page Creator</a>
                            <?php elseif (isset($_COOKIE['grants']) && $_COOKIE['grants'] === 'manager') : ?>
                                <a class="nav-link <?= setActiveAdminNavigation('main') ?>" href="/admin">Main</a>
                                <a class="nav-link <?= setActiveAdminNavigation('blogs') ?>" href="/admin/blogs">Blogs</a>
                                <a class="nav-link <?= setActiveAdminNavigation('comments') ?>" href="/admin/comments">Comments</a>
                                <a class="nav-link <?= setActiveAdminNavigation('page-creator') ?>" href="/admin/pages">Pages</a>
                            <?php endif; ?>
                        </div>

                        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') : ?>
                        <div class="dropdown <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?> d-flex <? else :?> d-none <? endif; ?> align-items-center justify-content-center nav-link text-light p-0">
                            <button class="btn btn-sm btn-dark dropdown-toggle text-danger" type="button" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $user->username ?>

                                <span class="sr-only">unread messages</span>
                            </button>

                            <img src="../../src/img/signup/admin-login-in.svg" width="30" height="24" class="d-lg-flex d-none" alt="">

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-menu">
                                <a class="dropdown-item" href="/profile/<?= $user->username ?>">Profile</a>
                                <a class="dropdown-item" id="js-nav-logout" href="/?logout=yes">Logout</a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
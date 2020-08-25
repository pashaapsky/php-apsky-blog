<?php

use Models\Pages;
use Models\User;
use function helpers\checkModerationGrants;
use function helpers\setActiveAdminNavigation;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/header.php';

if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') {
    $user = User::where('email', $_COOKIE['login'])->first();
}
$pages = Pages::all();
?>
<div class="wrapper d-flex flex-column bg-light" style="min-height: 100vh; overflow: hidden">
    <header class="header">
        <div class="navbar navbar-expand-lg navbar-dark bg-dark" id="">
            <div class="container">
                <a class="navbar-brand d-flex pl-2" href="/" >
                    <img src="/src/img/header/site-logo.png" width="50" height="30" class="d-inline-block align-top" alt="">

                    <span class="ml-3 text-bottom" style="font-size: 16px">
                        dot<strong style="font-size: 20px">.BLOG</strong>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu-header" aria-controls="nav-menu-header" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" style="flex-grow: 0" id="nav-menu-header">
                    <nav class="navbar-nav align-items-center">
                        <div class="navbar-nav align-items-center mr-lg-3">
                            <?php foreach ($pages as $page) :?>
                                <a class="nav-link <?= setActiveAdminNavigation($page->name) ?>" href="/<?= $page->name ?>"><?= mb_strtoupper($page->name) ?></a>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="btn btn-outline-light mb-2 mb-lg-0 mr-lg-2 <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?> d-none <? endif; ?>" style="width: 81px; height: 38px" id="js-signin-btn">Sign In</button>

                        <button type="button" class="btn btn-outline-info <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?> d-none <? endif; ?>" style="width: 81px; height: 38px" id="js-signup-btn">Sign Up</button>

                        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') : ?>
                        <div class="dropdown <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?> d-flex <? else :?> d-none <? endif; ?> align-items-center justify-content-center nav-link text-light p-0 ml-2">
                            <img src="/src/img/profile/<?= $user->photo ?>" width="50" height="40" class="d-lg-flex d-none text-white bg-transparent" alt="">

                            <button class="btn btn-sm btn-dark dropdown-toggle ml-1" type="button" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $user->username ?>
                                <span class="badge badge-light ">4</span>

                                <span class="sr-only">unread messages</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-menu">
                                <a class="dropdown-item" href="/profile/<?= $user->username ?>">Profile</a>
                                <?php if(checkModerationGrants()) : ?>
                                    <a class="dropdown-item" href="/admin">Administration</a>
                                <?php endif; ?>
                                <a class="dropdown-item" id="js-nav-logout" href="/?logout=yes">Logout</a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>



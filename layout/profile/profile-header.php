<?php
use Models\User;
use function helpers\checkModerationGrants;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/header.php';
if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') {
    $user = User::where('email', $_COOKIE['login'])->first();
}
?>
<div class="wrapper d-flex flex-column bg-light" style="min-height: 100vh; overflow: hidden">
    <header class="header">
        <div class="navbar navbar-expand-lg navbar-dark bg-dark" id="">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center justify-content-center pl-2" href="/" >
                    <img src="/src/img/header/site-logo.png" width="50" height="30" class="d-inline-block align-top" alt="">

                    <span class="ml-3 text-bottom" style="font-size: 16px">
                        dot<strong style="font-size: 20px">.BLOG</strong>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu" aria-controls="nav-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" style="flex-grow: 0" id="nav-menu">
                    <nav class="navbar-nav align-items-center">
                        <button type="button" class="btn btn-outline-light mr-2 <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?> d-none <? endif; ?>" style="width: 81px; height: 38px" id="js-signin-btn">Sign In</button>

                        <button type="button" class="btn btn-outline-info <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?> d-none <? endif; ?>" style="width: 81px; height: 38px" id="js-signup-btn">Sign Up</button>

                        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') : ?>
                        <div class="dropdown <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?> d-flex <? else :?> d-none <? endif; ?> align-items-center justify-content-center nav-link text-light p-0 ml-2">
                            <img src="/src/img/profile/<?= $user->photo ?>" width="50" height="38" class="d-lg-flex d-none text-white bg-transparent mr-1" alt="">

                            <button class="btn btn-sm btn-dark dropdown-toggle ml-1 " type="button" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $user->username ?>
                                <span class="badge badge-light ">4</span>

                                <span class="sr-only">unread messages</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="user-menu">
                                <a class="dropdown-item" href="/profile/<?= $user->username ?>">Profile</a>
                                <a class="dropdown-item" href="/profile/<?= $user->username ?>/edit">Edit Profile</a>
                                <?php if(checkModerationGrants()) : ?>
                                    <a class="dropdown-item" href="/admin">Administration</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="/profile/<?= $user->username ?>/subscribes">Subs</a>
                                <a class="dropdown-item" id="js-nav-logout" href="/?logout=yes">Logout</a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
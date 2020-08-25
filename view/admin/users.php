<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';

use Controllers\AuthController;
use Models\AuthCategoryUsers;
use Models\User;
use function helpers\getAdminPageParseUrl;
use function helpers\getRandomSVGFill;
use function helpers\setHrefForAdminPagination;
use function helpers\setSelectedFieldDefault;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/admin-pagination.php';

if ($limit === 'no') {
    $totalPages = 1;
    $page = 1;
    $users = User::orderBy('id', 'desc')->get();
    $usersCount = User::all()->count();
} else {
    $usersCount = User::all()->count();
    $usersCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($usersCount) / $countItemsOnPage);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/pagination.php';
    $users = User::limit($countItemsOnPage)->orderBy('id', 'desc')->offset($start)->get();
}
?>

<main role="main" class="bg-light">
    <div class="container">
        <section class="administration">
            <div class="administration__intro d-flex align-items-center p-2 my-3 text-white-50 rounded shadow-sm" style="background-color: #c5c0d0;">
                <img class="administration__logo mx-2" src="../../src/img/signup/administration-page-logo.svg" alt="" width="48" height="48">

                <div class="administration__header d-none d-sm-block">
                    <h4 class="administration__heading mb-0 text-white">Administration</h4>
                    <span class="administration__page text-white"><?= getAdminPageParseUrl() ?></span>
                </div>

                <label for="users-select-field" class="d-flex flex-column js-select-show-items ml-auto my-auto">To show
                    <select class="custom-select custom-select-sm" id="user-select-field">
                        <option <?= setSelectedFieldDefault('10') ?> value="10">10</option>
                        <option <?= setSelectedFieldDefault('20') ?> value="20">20</option>
                        <option <?= setSelectedFieldDefault('50') ?> value="50">50</option>
                        <option <?= setSelectedFieldDefault('200') ?> value="200">200</option>
                        <option <?= setSelectedFieldDefault('all') ?> value="all">all</option>
                    </select>
                </label>
            </div>

            <section class="admin-users my-3 p-3 bg-white rounded shadow-sm">
                <div class="admin-users__header d-flex flex-row justify-content-between align-item-center border-bottom border-gray mb-3">
                    <h6 class="admin-users__heading pb-2 mb-0">Users</h6>

                    <span class="text-dark" style="font-size: 0.8rem"><?= count($users) ?> of <?= $usersCount ?></span>
                </div>

                <?php foreach ($users as $user) : ?>
                    <div class="admin-users__item media text-muted border-bottom border-gray mb-2 pb-2" id="a-user-id@<?= $user->id ?>">
                        <svg class="d-none d-md-block bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#<?= getRandomSVGFill() ?>"></rect>
                        </svg>

                        <div class="admin-users__body media-body small text-justify">
                            <div class="media-header d-flex flex-column flex-md-row justify-content-between ">
                                <div class="d-flex flex-column align-items-center align-items-md-start pl-md-0 mb-1 mb-md-0 col-12 col-md-4">
                                    <span class=""><strong>Name</strong> : <?= $user->firstname ?></span>

                                    <span class=""><strong>Second Name</strong>: <?= $user->secondname ?></span>
                                </div>

                                <div class="d-flex flex-column align-items-center align-items-md-start pl-md-0 mb-1 mb-md-0 col-12 col-md-4">
                                    <span class=""><strong>User Login</strong> : <?= $user->username ?></span>

                                    <span class=""><strong>Email</strong> : <?= $user->email ?></span>
                                </div>

                                <div class="d-flex flex-column align-items-center align-items-md-start pl-md-0 mb-1 mb-md-0 col-12 col-md-3">
                                    <span class=""><strong>User Grants</strong></span>

                                    <span class=""><?= AuthController::getAuthCategoryByID(AuthCategoryUsers::where('user_id', $user->id)->first()->category_id) ?></span>
                                </div>

                                <div class="admin-users__options d-flex flex-row flex-md-column justify-content-center align-items-md-end media-actions col-12 col-md-1 pr-md-0">
                                    <a href="/profile/<?= mb_strtolower($user->username) ?>" class="d-block btn btn-outline-primary p-0 mb-sm-1" style="width: 30px; height: 15px; font-size: 10px">view</a>
                                    <a href="/admin/users/<?= mb_strtolower($user->username) ?>/edit" class="d-block btn btn-outline-warning p-0 mr-1 mx-1 mx-md-0 mb-sm-1" style="width: 30px; height: 15px; font-size: 10px">edit</a>
                                    <a href="/profile/<?= mb_strtolower($user->username) ?>/delete" class="btn btn-outline-danger p-0 m-0 js-admin-user-delete" style="width: 30px; height: 15px; font-size: 10px">delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <ul class="pagination justify-content-center <?php if (intval($totalPages) === 1) : ?> d-none <? endif; ?>">
                    <li class="page-item <?php if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] === "1")) : ?>disabled<? endif; ?>">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for($i = 1; $i<=$totalPages; $i++) :?>
                        <li class="page-item <?php if (isset($_GET['page']) && $_GET['page'] === "$i"): ?> active <?php endif; ?>">
                            <a class="page-link"
                               href="<?= setHrefForAdminPagination('/admin/users', 'show') . 'page=' . $i ?>"
                            ><?= $i ?></a>
                        </li>
                    <? endfor; ?>

                    <li class="page-item <? if (isset($_GET['page']) && $_GET['page'] === "$totalPages") : ?>disabled<? endif; ?>">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </section>
        </section>
    </div>
</main>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-footer.php';
?>


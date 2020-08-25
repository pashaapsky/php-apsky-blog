<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';

use Models\Subscribe;
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
    <div class="container p-0">
        <section class="administration" style="">
            <div class="administration__intro d-flex align-items-center p-2 my-3 text-white-50 rounded shadow-sm" style="background-color: #c5c0d0;">
                <img class="administration__logo mx-2" src="../../src/img/signup/administration-page-logo.svg" alt="" width="48" height="48">

                <div class="administration__header d-none d-sm-block">
                    <h4 class="administration__heading mb-0 text-white">Administration</h4>
                    <span class="administration__page text-white"><?= getAdminPageParseUrl() ?></span>
                </div>

                <label for="comments-select-field" class="d-flex flex-column js-select-show-items ml-auto my-auto">To show
                    <select class="custom-select custom-select-sm" id="comments-select-field">
                        <option <?= setSelectedFieldDefault('10') ?> value="10">10</option>
                        <option <?= setSelectedFieldDefault('20') ?> value="20">20</option>
                        <option <?= setSelectedFieldDefault('50') ?> value="50">50</option>
                        <option <?= setSelectedFieldDefault('200') ?> value="200">200</option>
                        <option <?= setSelectedFieldDefault('all') ?> value="all">all</option>
                    </select>
                </label>
            </div>

            <section class="admin-subscribes my-3 p-3 bg-white rounded shadow-sm ">
                <div class="admin-subscribes__header d-flex flex-row justify-content-between align-item-center border-bottom border-gray mb-3">
                    <h6 class="admin-subscribes__heading pb-2 mb-0">Users</h6>

                    <span class="text-dark" style="font-size: 0.8rem"><?= count($users) ?> of <?= $usersCount ?></span>
                </div>

                <div class="admin-subscribe__users user">
                    <?php foreach ($users as $user) : ?>
                        <div class="user__body d-flex flex-column text-muted border-bottom border-gray mb-2" id="a-sub-user-id@<?= $user->id ?>">
                            <div class="media-body d-flex small position-relative">
                                <div class="media-header d-flex flex-column flex-sm-row justify-content-start mb-2 position-relative" style="font-size: 0.7rem">
                                    <svg class="d-none d-md-block bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#<?= getRandomSVGFill() ?>"></rect>
                                    </svg>

                                    <div class="d-flex flex-column justify-content-start mb-1 mr-3" style="min-width: 200px">
                                        <span class=""><strong>Name</strong> : <?= $user->firstname ?></span>

                                        <span class=""><strong>Second Name</strong> : <?= $user->secondname ?></span>
                                    </div>

                                    <div class="d-flex flex-column justify-content-start mb-1">
                                        <span class=""><strong>User Login</strong> : <?= $user->username ?></span>

                                        <span class=""><strong>Email</strong> : <?= $user->email ?></span>
                                    </div>
                                </div>

                                <button type="button" class="btn border-0 bg-transparent position-absolute js-show-subscribe-btn" style="top: 0; right: 0">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4 4a.5.5 0 0 0-.374.832l4 4.5a.5.5 0 0 0 .748 0l4-4.5A.5.5 0 0 0 12 6H4z"></path>
                                    </svg>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="d-none bi bi-caret-up-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4 9a.5.5 0 0 1-.374-.832l4-4.5a.5.5 0 0 1 .748 0l4 4.5A.5.5 0 0 1 12 11H4z"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="subscribes d-none flex-column">
                                <h6 class="border-bottom pb-2" style="font-size: 0.8rem;">Subscribes</h6>

                                <?php
                                $subs = Subscribe::where('subscriber', $user->id)->get();
                                if ($subs->count()) :
                                    ?>
                                    <ul class="subscribes__items list-group mb-2 d-flex flex-row flex-wrap col-12 p-0">
                                        <?php
                                        foreach ($subs as $sub): ?>
                                            <li class="d-flex flex-column subscribes__item subscribe list-group-item col-12 col-sm-6 col-md-4 border rounded m-0" style="font-size: 0.7rem">
                                                <div class="subscribe__body">
                                                    <span class="subscribe__id d-block">
                                                        <strong>ID</strong> : <?= $sub->id ?>
                                                    </span>

                                                    <span class="subscribe__to d-block">
                                                        <strong>Subscribe to</strong> : <?= User::where('id', $sub->subscribe_to)->first()->username ?>
                                                    </span>

                                                    <span class="subscribe__created-at d-block">
                                                        <strong>Created at</strong>: <?= $sub->created_at ?>
                                                    </span>

                                                    <span class="subscribe__up-to d-block">
                                                        <strong>Lasts for months</strong>: <?= $sub->date_up_to ?>
                                                    </span>
                                                </div>

                                                <button type="button" class="btn btn-sm btn-danger p-0 mt-1 js-admin-delete-subscribe-btn" style="max-width: 50px; font-size: 0.5rem">Delete</button>
                                            </li>
                                        <?endforeach;
                                        ?>
                                    </ul>

                                <?php else : ?>
                                    <p class="small">Not available subscribes yet</p>
                                <?php endif ?>

                                <button type="button" class="btn btn-sm btn-info d-block ml-auto p-1 mb-2 js-admin-add-new-subscribe-btn" style="max-width: 90px; font-size: 0.7rem">Add subscribe</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

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

        <div class="modals d-none w-100 h-100 position-fixed bg-dark" style="top: 0; left: 0; opacity: 0.9">
            <form class="admin-new-subscribe-form new-subscribe d-flex flex-column m-auto p-3 border bg-white w-25" style="z-index: 1000" method="post" action="" novalidate>
                    <h4 class="text-dark">New subscribe</h4>

                    <div class="new-subscribe__inner form-label-group">
                        <label for="new-subscribe__to"><strong>Subscribe to</strong></label>
                        <select id="new-subscribe__to" name="subscribe_to" class="form-control" required="" autofocus="">
                            <?php
                            $users = User::all();
                            foreach ($users as $user) :?>
                                <option class=""><?= $user->username ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="new-subscribe__duration form-label-group">
                        <label for="new-subscribe__date-up-to"><strong>Date up to</strong></label>
                        <select id="new-subscribe__date-up-to" name="date-up-to" class="form-control" required="" autofocus="">
                            <option>1 month</option>
                            <option>2 month</option>
                            <option>5 month</option>
                            <option>12 month</option>
                        </select>
                    </div>

                    <div class="btn-group ml-auto" role="group" aria-label="admin-user-edit-buttons">
                        <button type="submit" class="btn btn-sm btn-outline-info" style="font-size: 0.8rem; min-width: 80px">Add</button>
                        <button type="button" class="btn btn-sm btn-outline-danger js-new-subscribe-cancel-btn" style="font-size: 0.8rem; min-width: 80px">cancel</button>
                    </div>
            </form>
        </div>
    </div>
</main>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-footer.php';
?>


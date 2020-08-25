<?php
use Models\Subscribe;
use Models\User;

use function helpers\setHrefForAdminPagination;
use function helpers\setSelectedFieldDefault;

include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/header.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/admin-pagination.php';

if ($limit === 'no') {
    $totalPages = 1;
    $page = 1;
    $userSubs = Subscribe::where('subscriber', $user->id)->orderBy('created_at', 'desc')->get();
    $subsCount = Subscribe::where('subscriber', $user->id)->orderBy('created_at', 'desc')->count();
} else {
    $subsCount = Subscribe::where('subscriber', $user->id)->orderBy('created_at', 'desc')->count();
    $subsCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($subsCount) / $countItemsOnPage);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/pagination.php';
    $userSubs = Subscribe::where('subscriber', $user->id)->limit($countItemsOnPage)->orderBy('created_at', 'desc')->offset($start)->get();
}
?>

<main role="main" class="bg-light">
    <div class="container p-0">
        <section class="profile-subs">
            <div class="profile-subs__header d-flex align-items-center p-2 my-3 rounded shadow-sm" style="background-color: ghostwhite">
                <img class="profile-subs__logo mx-2" src="/src/img/profile/subs/profile-subs-header.svg" alt="profile-subs-logo" width="48" height="48">
                <h3 class="profile-subs__heading text-dark h4">Active subscribes</h3>

                <label for="comments-select-field" class="d-flex flex-column js-select-show-items ml-auto my-auto text-dark">To show
                    <select class="custom-select custom-select-sm" id="comments-select-field">
                        <option <?= setSelectedFieldDefault('10') ?> value="10">10</option>
                        <option <?= setSelectedFieldDefault('20') ?> value="20">20</option>
                        <option <?= setSelectedFieldDefault('50') ?> value="50">50</option>
                        <option <?= setSelectedFieldDefault('200') ?> value="200">200</option>
                        <option <?= setSelectedFieldDefault('all') ?> value="all">all</option>
                    </select>
                </label>
            </div>

            <div class="profile-subs__inner subscribe rounded shadow-sm p-3" style="background-color: ghostwhite; min-height: 78vh">
                <div class="subscribe__heading d-flex justify-content-between align-items-center mb-2">
                    <p class="h4 mb-0">Subscribes</p>

                    <span class="text-dark" style="font-size: 0.8rem"><?= count($userSubs) ?> of <?= $subsCount ?></span>
                </div>

                <?php if($userSubs->count()) : ?>
                <ul class="subscribe__list list-group mb-2 d-flex flex-row flex-wrap col-12 p-0">
                    <?php foreach ($userSubs as $sub): ?>
                        <li class="d-flex flex-column subscribe__item list-group-item col-12 col-sm-6 col-md-4 border rounded m-0" style="font-size: 0.7rem">
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

                            <button type="button" class="btn btn-sm btn-danger p-0 mt-1 js-delete-profile-subscribe-btn" style="max-width: 50px; font-size: 0.5rem">Delete</button>
                        </li>
                    <?endforeach; ?>
                </ul>
                <?php else : ?>
                    <p class="small">Not available subscribes yet</p>
                <?php endif; ?>

                <ul class="pagination justify-content-center <?php if (intval($totalPages) === 1) : ?>d-none<? endif; ?>">
                    <li class="page-item <?php if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] === "1")) : ?>disabled<? endif; ?>">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for($i = 1; $i<=$totalPages; $i++) :?>
                        <li class="page-item <?php if (isset($_GET['page']) && $_GET['page'] === "$i"): ?> active <?php endif; ?>">
                            <a class="page-link"
                               href="<?= setHrefForAdminPagination('/profile/' . $user->username . '/subscribes', 'show') . 'page=' . $i ?>"
                            ><?= $i ?></a>
                        </li>
                    <? endfor; ?>

                    <li class="page-item <? if (isset($_GET['page']) && $_GET['page'] === "$totalPages") : ?>disabled<? endif; ?>">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/footer.php';
?>

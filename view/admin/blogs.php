<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';

use Models\Blog;
use Models\User;
use function helpers\getAdminPageParseUrl;
use function helpers\getRandomSVGFill;
use function helpers\setHrefForAdminPagination;
use function helpers\setSelectedFieldDefault;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/admin-pagination.php';

if ($limit === 'no') {
    $totalPages = 1;
    $page = 1;
    $blogs = Blog::orderBy('created_at', 'desc')->get();
    $blogsCount = Blog::all()->count();
} else {
    $blogsCount = Blog::all()->count();
    $blogsCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($blogsCount) / $countItemsOnPage);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/pagination.php';
    $blogs = Blog::limit($countItemsOnPage)->orderBy('created_at', 'desc')->offset($start)->get();
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

                <label for="blogs-select-field" class="administration__options d-flex flex-column js-select-show-items ml-auto my-auto">To show
                    <select class="custom-select custom-select-sm" id="blogs-select-field">
                        <option <?= setSelectedFieldDefault('10') ?> value="10">10</option>
                        <option <?= setSelectedFieldDefault('20') ?> value="20">20</option>
                        <option <?= setSelectedFieldDefault('50') ?> value="50">50</option>
                        <option <?= setSelectedFieldDefault('200') ?> value="200">200</option>
                        <option <?= setSelectedFieldDefault('all') ?> value="all">all</option>
                    </select>
                </label>
            </div>

            <section class="admin-blogs my-3 p-3 bg-white rounded shadow-sm">
                <div class="admin-blogs__header d-flex flex-row justify-content-between align-item-center border-bottom border-gray mb-3">
                    <h6 class="admin-blogs__heading pb-2 mb-0">Last blogs</h6>

                    <span class="text-dark" style="font-size: 0.8rem"><?= count($blogs) ?> of <?= $blogsCount ?></span>
                </div>

                <?php foreach ($blogs as $blog) : ?>
                    <div class="admin-blogs__item media text-muted border-bottom border-gray position-relative mb-2" id="a-blog-id@<?= $blog->id ?>">
                        <svg class="d-none d-sm-block bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#<?= getRandomSVGFill() ?>"></rect>
                        </svg>

                        <div class="admin-blogs__body media-body mb-3 small text-justify">
                            <div class="media-header d-flex justify-content-between">
                                <a href="/profile/<?= User::where('id', $blog->user_id)->first()->username ?>" class="d-block">
                                    <strong class="" style="color: deepskyblue">@<?= User::where('id', $blog->user_id)->first()->username ?></strong>
                                </a>

                                <span class=""><?= $blog->created_at ?></span>
                            </div>

                            <p class="mb-2"><?= $blog->text ?></p>
                        </div>

                        <div class="admin-blogs__actions d-flex media-actions justify-content-end align-items-center mb-1 position-absolute" style="bottom: 0; right: 0">
                            <a href="/blog/<?= $blog->id ?>" class="btn btn-outline-primary p-0 mr-1" style="width: 30px; height: 15px; font-size: 10px">view</a>
                            <a href="/blog/<?= $blog->id ?>/edit" class="btn btn-outline-warning p-0 mr-1" style="width: 30px; height: 15px; font-size: 10px">edit</a>
                            <a href="/blog/<?= $blog->id ?>/delete" class="btn btn-outline-danger p-0 m-0 js-admin-blog-delete" style="width: 30px; height: 15px; font-size: 10px">delete</a>
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
                               href="<?= setHrefForAdminPagination('/admin/blogs', 'show') . 'page=' . $i ?>"
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


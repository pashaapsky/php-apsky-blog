<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';

use Models\Blog;
use Models\Comment;
use Models\User;
use function helpers\getAdminPageParseUrl;
use function helpers\getRandomSVGFill;
use function helpers\setHrefForAdminPagination;
use function helpers\setSelectedFieldDefault;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/admin-pagination.php';

if ($limit === 'no') {
    $totalPages = 1;
    $page = 1;
    $comments = Comment::orderBy('created_at', 'desc')->orderBy('approved', 'asc')->get();
    $commentCount = Comment::all()->count();
} else {
    $commentCount = Comment::all()->count();
    $commentCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($commentCount) / $countItemsOnPage);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/pagination.php';
    $comments = Comment::limit($countItemsOnPage)->orderBy('created_at', 'desc')->orderBy('approved', 'asc')->offset($start)->get();
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

                <label for="admin-comments-select-field" class="d-flex flex-column js-select-show-items ml-auto my-auto">To show
                    <select class="custom-select custom-select-sm" id="admin-comments-select-field">
                        <option <?= setSelectedFieldDefault('10') ?> value="10">10</option>
                        <option <?= setSelectedFieldDefault('20') ?> value="20">20</option>
                        <option <?= setSelectedFieldDefault('50') ?> value="50">50</option>
                        <option <?= setSelectedFieldDefault('200') ?> value="200">200</option>
                        <option <?= setSelectedFieldDefault('all') ?> value="all">all</option>
                    </select>
                </label>
            </div>

            <section class="admin-comments d-flex flex-wrap my-3 p-3 bg-white rounded shadow-sm" >
                <div class="comments__heading d-flex flex-row col-12 justify-content-between align-item-center border-bottom border-muted mb-3">
                    <h6 class="pb-2 mb-0 text-dark">Comments</h6>

                    <span class="text-muted" style="font-size: 0.8rem"><?= count($comments) ?> of <?= $commentCount ?></span>
                </div>

                <?php foreach ($comments as $comment) : ?>
                    <div class="admin-comments__item media text-muted col-12 col-md-6 col-lg-4 px-1 my-1">
                        <div class="admin-comments__body media-body border rounded p-2 d-flex flex-column w-100 justify-content-between small" id="a-comment-id@<?= $comment->id ?>">
                            <div class="media-heading d-flex flex-row justify-content-between mb-3">
                                <div class="media-left-side d-flex align-items-center">
                                    <svg class="d-none d-sm-flex align-self-center bd-placeholder-img mx-1 rounded text-center" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#badaf7"></rect>
                                    </svg>

                                    <div class="media-info flex-column">
                                        <a href="/profile/<?= User::where('id', $comment->user_id)->first()->username ?>" class="d-flex mr-2" style="color: deepskyblue">
                                            User : <strong class="ml-1"> @<?= User::where('id', $comment->user_id)->first()->username ?></strong>
                                        </a>

                                        <a href="/blog/<?= Blog::where('id', $comment->blog_id)->first()->id ?>" class="d-flex" style="color: deepskyblue">
                                            Blog : <strong class="ml-1"> <?= Blog::where('id', $comment->blog_id)->first()->name ?></strong>
                                        </a>
                                    </div>
                                </div>

                                <div class="media-right-side d-flex flex-column">
                                    <span class="ml-auto <?= $comment->approved ? 'text-success' : 'text-danger' ?>"><?= $comment->created_at ?></span>

                                    <button type="button" class="btn bg-transparent p-0 js-comment-change-moderation-btn ml-auto <?= $comment->approved ? 'text-success' : 'text-danger' ?>" style="font-size: 0.8rem">
                                        <img src="../../src/img/comment/moderate-comment.svg" class="mr-1" alt="change-moderation-button"><strong><?= $comment->approved ? 'modetared' : 'not moderated' ?></strong>
                                    </button>
                                </div>
                            </div>

                            <p class="admin-comments__content mb-3 p-2 border small text-justify" style="border-radius: 15px; min-height: 100px"><?= $comment->text ?></p>

                            <form class="admin-comment-edit d-none flex-column pt-2 js-admin-comment-edit-form " method="post" action="" novalidate>
                                <div class="admin-comment-edit__textarea">
                                    <label for="admin-comment-textarea-<?= $comment->id ?>" class="px-1"><strong>Edit text</strong></label>
                                    <textarea id="admin-comment-textarea-<?= $comment->id ?>" name="content" rows="8" class="form-control mb-3 border text-muted text-justify" required="" style="border-radius: 15px; font-size: 0.7rem"><?= $comment->text ?></textarea>

                                    <div class="invalid-feedback">
                                        Comment text is required.
                                    </div>
                                </div>

                                <div class="btn-group col-12 p-0" role="group" aria-label="edit-comment-buttons">
                                    <button type="submit" class="btn btn-sm btn-outline-success border rounded text-dark col-6 js-admin-save-comment-btn" style="font-size: 0.7rem;">Save</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger border rounded text-dark col-6 js-admin-cancel-comment-btn" style="font-size: 0.7rem;">Cancel</button>
                                </div>
                            </form>

                            <div class="btn-group d-flex justify-content-between col-12 p-0">
                                <button type="button" class="btn btn-sm btn-outline-warning border rounded text-dark col-6 js-admin-edit-comment-btn" style="font-size: 0.7rem">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger border rounded text-dark col-6 js-admin-delete-comment-btn" style="font-size: 0.7rem">Delete</button>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

                <ul class="pagination w-100 justify-content-center my-2 <?php if (intval($totalPages) === 1) : ?> d-none <? endif; ?>">
                    <li class="page-item <?php if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] === "1")) : ?>disabled<? endif; ?>">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for($i = 1; $i<=$totalPages; $i++) :?>
                        <li class="page-item <?php if (isset($_GET['page']) && $_GET['page'] === "$i"): ?> active <?php endif; ?>">
                            <a class="page-link"
                               href="<?= setHrefForAdminPagination('/admin/comments', 'show') . 'page=' . $i ?>"
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



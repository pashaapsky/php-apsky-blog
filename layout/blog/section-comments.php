<?php
use Models\User;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/comments-pagination.php';
?>
<section class="comments position-relative">
    <h2 class="comments__heading text-muted" >Comments</h2>

    <ul class="comments__list list-group <?= $commentsCount !== 0 ? 'mb-3' : ''?>">
        <?php foreach ($comments as $comment) :?>
        <?php $user = User::find($comment->user_id); ?>
            <li class="comments__item list-group-item" id="<?= 'comment№' . $comment->id ?>">
                <article class="comments__intro d-flex flex-column">
                    <h3 class="comments__heading d-none">comment</h3>

                    <div class="comments__user-info d-flex justify-content-between border-bottom pb-1">
                        <div class="comments__user-data d-flex align-items-center">
                            <img src="/src/img/profile/<?= $user->photo ?>"
                                 alt=""
                                 width="40"
                                 height="40"
                                 class="comments__photo"
                            >
                            <div class="comments__user user d-flex flex-column ">
                                <p class="user__firstname mb-0 mx-1" style="font-size: 1.2rem; line-height: 1"><?= $user->firstname ?></p>

                                <p class="user__username text-muted font-weight-light mb-0 mx-1" style="font-size: 1rem; line-height: 1"><?= $user->username ?></p>
                            </div>
                        </div>

                        <div class="comments__attributes attributes d-flex flex-column align-items-end">
                            <time class="attributes__time d-flex align-items-top"><?= $comment->created_at ?></time>

                            <span class="attributes__moderate <?= $comment->approved === 0 ? 'text-danger' : 'd-none' ?>">not moderated yet</span>
                        </div>
                    </div>

                    <p class="comments__content text-justify mt-3"><?= $comment->id . ' ' . $comment->text ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

    <form class="form new-comment d-none" method="post" id="js-new-comment-form" novalidate>
        <h2 class="new-comment__heading font-weight-bold text-success m-0 h4">New Comment</h2>

        <div class="new-comment__inner mb-3">
            <label for="new-comment__textarea-label"></label>
            <textarea class="form-control" id="new-comment__textarea-label" rows="5" cols="33" placeholder="New comment text here" name="comment-text" required></textarea>

            <div class="invalid-feedback">
                Please enter a message in the textarea.
            </div>
        </div>

        <div class="new-comment__actions btn btn-group d-flex justify-content-end align-items-center p-0 mb-2 js-new-comment-action" aria-label="Basic example">
            <button type="submit" class="btn btn-sm btn-outline-success" id="js-new-comment-add" style="min-width: 60px">Add</button>
            <button type="button" class="btn btn-sm btn-outline-danger" id="js-new-comment-back" style="min-width: 60px">Back</button>
        </div>
    </form>

    <p class="comments__no <?= $commentsCount !== 0 ? 'd-none' : ''?>">No comments for this blog yet.</p>

    <ul class="pagination justify-content-center <?php if (intval($totalPages) === 1) : ?> d-none <? endif; ?>">
        <li class="page-item <?php if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] === "1")) : ?>disabled<? endif; ?>">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for($i = 1; $i<=$totalPages; $i++) :?>
            <li class="page-item <?php if (isset($_GET['page']) && $_GET['page'] === "$i"): ?> active <?php endif; ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <? endfor; ?>

        <li class="page-item <? if (isset($_GET['page']) && $_GET['page'] === "$totalPages") : ?>disabled<? endif; ?>">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>

    <button class="btn btn-outline-success ml-auto js-new-comment-btn" style="display: block" type="button" data-login="<?= (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') ? 'yes' : 'no' ?>">new comment</button>
</section>

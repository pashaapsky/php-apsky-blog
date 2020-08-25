<?php
use Controllers\BlogController;
use Models\Blog;
use function helpers\checkEditGrants;

$countItemsOnPage = 4;
$blogsCount = Blog::where('user_id', $data['profile']->id)->get()->count();

$blogsCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($blogsCount) / $countItemsOnPage);

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/pagination.php';

$blogs = Blog::where('user_id', $data['profile']->id)->limit($countItemsOnPage)->offset($start)->get();
?>
<div class="profile__blog col-12 blog p-0">
    <div class="profile__header d-flex justify-content-between col-12 col-md-6 col-lg-8 mb-2 p-0">
        <h4 class="profile__heading text-muted font-weight-light">Last updated posts</h4>

        <span class="d-flex align-items-center text-muted font-weight-light justify-content-center">Posts
            <span class="badge badge-pill badge-secondary ml-2"><?= $blogsCount ?></span>
        </span>
    </div>

    <?php if (count($blogs) !== 0) : ?>
        <div class="profile__blogs-list user-blog d-flex flex-row flex-wrap col-12 col-md-6 col-lg-8 p-0 pr-md-0">
            <?php foreach ($blogs as $blog) : ?>
            <div class="col-12 col-sm-6 col-md-12 col-lg-6 p-0 p-lg-1">
                <div class="user-blog__item" id="<?= "comment№" . $blog->id ?>">
                    <div class="card mb-4 shadow-sm">
                        <span class="user-blog__created-at d-block text-right pr-2 text-muted" style="font-size: 14px"><?= $blog->created_at ?></span>

                        <img class="user-blog__photo d-block" alt="Blog image" style="height: 225px; width: 100%;" src="/src/img/blogs/<?= $blog->photo ?>">

                        <div class="user-blog__body card-body">
                            <p class="user-blog__text card-text text-justify" style="font-size: 14px"><?=$blog->id . ' : ' . BlogController::getPreviewBlogText($blog) ?></p>

                            <div class="user-blog__actions d-flex justify-content-end align-items-center">
                                <a href="/profile/<?= $data['profile']->username ?>/blog/<?= $blog->id ?>" class="btn btn-sm btn-outline-primary" style="width: 60px">View</a>

                                <?php if (checkEditGrants($data['profile'])) :?>
                                    <a href="/profile/<?= $data['profile']->username ?>/blog/<?= $blog->id ?>/edit" class="btn btn-sm mx-1 btn-outline-warning" style="width: 60px">Edit</a>
                                <?php endif; ?>

                                <?php if (checkEditGrants($data['profile'])) :?>
                                    <a href="/profile/<?= $data['profile']->username ?>/blog/<?= $blog->id ?>/delete" class="btn btn-sm btn-outline-danger js-profile-blog-delete" style="width: 60px">Delete</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <span class="profile__blogs-list d-flex">Not available posts yet</span>
    <?php endif; ?>

    <ul class="pagination col-12 col-md-6 col-lg-8 p-0 pr-md-0 justify-content-center <?php if (intval($totalPages) === 1) : ?> d-none <? endif; ?>">
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
</div>
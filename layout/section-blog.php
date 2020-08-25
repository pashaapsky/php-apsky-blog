<?php
use Controllers\BlogController;
use Models\Blog;
use Models\User;

use function helpers\loadSettingsFromFile;

$countItemsOnPage = loadSettingsFromFile($_SERVER["DOCUMENT_ROOT"] . '/configs/admin-settings.json')['admin-settings']['blog-count-on-page'];
$blogsCount = Blog::all()->count();
$blogsCount === 0 ? $totalPages = 1 : $totalPages = ceil(intval($blogsCount) / $countItemsOnPage);

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination/pagination.php';
$blogs = Blog::limit($countItemsOnPage)->orderBy('created_at', 'desc')->offset($start)->get();
?>
<section class="blog pt-3 pb-1 bg-light" id="js-section-blog">
    <div class="container">
        <div class="blog__inner d-flex flex-column">
            <h2 class="blog__heading d-none">Blogs</h2>

            <div class="blog__list row">
                <?php foreach ($blogs as $blog) :?>
                    <?php $user = User::where('id', $blog->user_id)->first(); ?>
                    <div class="blog__item col-sm-6 col-lg-4" id="<?= "blog№" . $blog->id ?>">
                        <div class="blog__content card mb-4 shadow-sm">
                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') :?>
                            <div class="blog__info d-flex justify-content-between align-items-center px-1">
                                <a href="/profile/<?= $user->username ?>" class="blog__username text-info pl-2" style=""><?= $user->email; ?></a>

                                <div class="blog__created-at d-block text-right text-muted" style="font-size: 14px"><?= $blog->created_at ?></div>
                            </div>
                            <?php else : ?>
                            <div class="blog__created-at text-right text-muted px-2" style="font-size: 14px"><?= $blog->created_at ?></div>
                            <?php endif; ?>

                            <img class="blog__photo d-block" alt="Blog image" style="height: 225px; width: 100%;" src="/src/img/blogs/<?= $blog->photo ?>">

                            <div class="blog__intro p-3">
                                <div class="blog__name mb-2">
                                    <strong style="text-decoration: underline"><?= $blog->name ?></strong>
                                </div>

                                <p class="blog__text card-text text-justify" style="font-size: 14px; height: 110px; overflow: hidden"><?= $blog->id . ' : ' . BlogController::getPreviewBlogText($blog) ?></p>

                                <button type="button" class="btn btn-sm btn-outline-success js-view-blog-btn d-block ml-auto" style="width: 70px;">Read</button>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>

            <?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'yes') : ?>
            <button type="button" class="btn btn-outline-primary align-self-end js-blog-add" style="font-size: 0.8rem">Add new blog</button>
            <?php endif; ?>

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
        </div>
    </div>
</section>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';

use Models\Pages;
use function helpers\getAdminPageParseUrl;

$pages = Pages::all();
?>
    <main role="main" class="bg-light">
        <div class="container">
            <section class="administration">
                <div class="administration__intro d-flex align-items-center p-2 my-3 text-white-50 rounded shadow-sm" style="background-color: #c5c0d0;">
                    <img class="administration__logo mx-2" src="../../src/img/signup/administration-page-logo.svg" alt="" width="48" height="48">

                    <div class="administration__header">
                        <h4 class="administration__heading mb-0 text-white">Administration</h4>
                        <span class="administration__page text-white"><?= getAdminPageParseUrl() ?></span>
                    </div>
                </div>

                <section class="pages my-3 pb-1 pt-3 px-3 bg-white rounded shadow-sm" style="min-height: 76vh">
                    <h6 class="pages__header border-bottom border-gray pb-2 mb-0">Active pages</h6>

                    <?php if ($pages->count()) : ?>
                    <ul class="pages__list list-group">
                        <?php foreach ($pages as $page) : ?>
                            <li class="pages__item list-group-item d-flex flex-row align-items-center text-muted pt-3" id="page_id=@<?= $page->id ?>">
                                <img src="/src/img/pages/page.svg" alt="" class="d-flex mr-2" width="32" height="32">

                                <div class="page__attributes">
                                    <span class="pages__name"><strong><?= $page->name ?></strong></span>

                                    <a href="/profile/<?= $page->name ?>" class="pages__url d-block">
                                        <strong class="" style="color: deepskyblue">@<?= $page->src ?></strong>
                                    </a>
                                </div>

                                <div class="d-flex flex-column ml-auto">
                                    <a href="/admin/pages/<?= $page->id ?>/edit" class="btn btn-sm btn-primary border mb-2" style="font-size: 0.7rem">Edit</a>
                                    <a href="/admin/pages/<?= $page->id ?>/delete" class="btn btn-sm btn-outline-danger border text-dark js-delete-page-btn" style="font-size: 0.7rem">Delete</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else : ?>
                        <p>Not available static pages</p>
                    <?php endif; ?>
                </section>
            </section>
        </div>
    </main>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-footer.php';
?>
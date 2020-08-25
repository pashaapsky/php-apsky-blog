<?php

use Models\Pages;

include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';
$page = Pages::find($data['id']);
?>
    <main role="main" class="my-3 d-flex col-12 m-auto">
        <div class="container py-2 shadow-sm rounded">
            <section class="admin-page-edit">
                <div class="admin-page-edit__header d-flex align-items-center py-2 mx-3 mb-3 rounded">
                    <img class="admin-page-edit__logo mr-2" src="/src/img/pages/pages-logo.svg" alt="profile-subs-logo" width="48" height="48">
                    <h3 class="admin-page-edit__heading text-warning h4 mb-0">Page editor</h3>
                </div>

                <form class="admin-page-edit__form page d-flex flex-column p-3 " style="min-height: 70vh" id="js-page-edit-form"  method="post" action="/" novalidate>
                    <div class="page__header form-label-group">
                        <label for="page-header"><strong>Name of Page</strong></label>
                        <input type="text" id="page-header" name="name" class="form-control p-0 pl-2" style="width: 200px" value="<?= $page->name ?>" placeholder="" required="" autofocus="">

                        <div class="invalid-feedback">
                            Blog name is required.
                        </div>
                    </div>

                    <div class="page__name form-label-group">
                        <label for="page-name"><strong>Site`s Page Src</strong></label>
                        <input type="text" id="page-name" name="src" class="form-control p-0 pl-2" style="width: 200px" value="<?= $page->src ?>" placeholder="" required="" autofocus="">

                        <div class="invalid-feedback">
                            Site`s Page Name is required.
                        </div>
                    </div>

                    <div class="page__textarea form-label-group">
                        <label for="page-textarea"><strong>Main Content</strong></label>
                        <textarea id="page-textarea" name="text" rows="10" class="form-control text-justify" placeholder="" required=""><?= $page->text ?></textarea>

                        <div class="invalid-feedback">
                            Created date is required.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-info mt-auto align-self-end" style="font-size: 0.8rem; min-width: 100px">Save Page</button>
                </form>
            </section>
        </div>
    </main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-footer.php';
?>
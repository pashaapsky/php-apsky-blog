<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';
?>

<main role="main" class="my-3 d-flex col-12 m-auto">
    <div class="container py-2 shadow-sm rounded">
        <section class="page-creator">
            <div class="page-creator__header d-flex align-items-center py-2 mx-3 mb-3 rounded">
                <img class="page-creator__logo mr-2" src="/src/img/pages/pages-logo.svg" alt="profile-subs-logo" width="48" height="48">
                <h3 class="page-creator__heading text-warning h4 mb-0">Page creator</h3>
            </div>

            <form class="page-creator__form page d-flex flex-column p-3 " style="min-height: 70vh" id="js-page-creator-form"  method="post" action="/" novalidate>
                <div class="page__name form-label-group">
                    <label for="page-name"><strong>Name of page</strong></label>
                    <input type="text" id="page-name" name="name" class="form-control p-0 pl-2" style="width: 200px" value="" placeholder="Contacts" required="" autofocus="">

                    <div class="invalid-feedback">
                        Name of page is required.
                    </div>
                </div>

                <div class="page__header form-label-group">
                    <label for="page-src"><strong>Site`s Page Src</strong></label>
                    <input type="text" id="page-src" name="src" class="form-control p-0 pl-2" style="width: 200px" value="" placeholder="pages/contacts.php" required="" autofocus="">

                    <div class="invalid-feedback">
                        Site`s Page Src is required.
                    </div>
                </div>

                <div class="page__textarea form-label-group">
                    <label for="page-textarea"><strong>Main Content</strong></label>
                    <textarea id="page-textarea" name="text" rows="10" class="form-control text-justify" placeholder="Text here" required=""></textarea>

                    <div class="invalid-feedback">
                        Page text is required.
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
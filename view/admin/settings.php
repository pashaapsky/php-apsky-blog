<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-header.php';

use function helpers\getAdminPageParseUrl;
use function helpers\loadSettingsFromFile;

$settings = loadSettingsFromFile($_SERVER["DOCUMENT_ROOT"] . '/configs/admin-settings.json');
?>
<main role="main" class="bg-light">
    <div class="container px-sm-0 px-lg-3">
        <section class="administration">
            <div class="administration__intro d-flex align-items-center p-2 my-3 text-white-50 rounded shadow-sm" style="background-color: #c5c0d0;">
                <img class="administration__logo mx-2" src="../../src/img/signup/administration-page-logo.svg" alt="" width="48" height="48">

                <div class="administration__header">
                    <h4 class="administration__heading mb-0 text-white">Administration</h4>
                    <span class="administration__page text-white"><?= getAdminPageParseUrl() ?></span>
                </div>
            </div>

            <section class="admin-settings d-flex flex-column my-3 p-3 bg-white rounded shadow-sm" >
                <h6 class="pb-2 mb-2 text-dark border-bottom">Settings</h6>

                <form class="admin-settings-form settings position-relative" style="height: 68vh" method="post" novalidate>
                    <ul class="settings__list list-group">
                        <li class="settings__item option list-group-item d-flex justify-content-between align-item-center form-label-group px-2">
                            <span class="option__name d-flex align-items-center text-dark" style="font-weight: bold">* Blogs to show</span>

                            <div class="option__value d-flex flex-column align-items-center">
                                <label for="option-blogs-count" class="option__value" ></label>
                                <input type="number"
                                       class="option__input form-control align-self-end"
                                       name="blog-count-on-page"
                                       value="<?= $settings['admin-settings']['blog-count-on-page'] ?>"
                                       id="option-blogs-count"
                                       style="width: 70px"
                                       required=""
                                >

                                <div class="invalid-feedback">
                                    Blogs count is required.
                                </div>
                            </div>
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-sm btn-success position-absolute js-settings-save-btn w-25" style="width : 70px; bottom: 0; right: 0;">Save</button>
                </form>
            </section>
        </section>
    </div>
</main>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-footer.php';
?>



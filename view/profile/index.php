<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/profile/profile-header.php';
use function helpers\checkEditGrants;
use function helpers\isSubscribed;
?>
<main role="main">
    <div class="container p-md-0">
        <section class="profile d-flex flex-column flex-md-row py-3">
            <div class="profile__info col-12 col-sm-8 col-md-6 col-lg-4 align-self-sm-start p-0 pr-md-3">
                <form class="edit-profile-form" novalidate>
                    <div class="d-flex justify-content-center mb-3" style="border: 1px solid black; border-radius: 80%; overflow: hidden;"  href="#">
                        <img class="profile__photo w-60 h-auto" src="/src/img/profile/<?= $data['profile']->photo ?>" alt="">
                    </div>

                    <h1 class="profile__name mb-0" style="font-size: 1.7rem; line-height: 1"><?= $data['profile']->firstname ?></h1>

                    <h4 class="profile__username text-muted font-weight-light mb-3"><?= $data['profile']->username ?></h4>

                    <?php if (isSubscribed($data['profile'], $_COOKIE['login']) === 'NO') : ?>
                        <button type="button" class="d-block w-100 btn btn-sm btn-outline-success mb-1 js-profile-subscribe-btn">Subscribe</button>
                    <?php elseif (isSubscribed($data['profile'], $_COOKIE['login']) === 'YES') : ?>
                        <button type="button" class="d-block w-100 btn btn-sm btn-outline-success mb-1 js-profile-unsubscribe-btn">Unsubscribe</button>
                    <?php endif; ?>

                    <?php if (checkEditGrants($data['profile'])) : ?>
                        <button type="button" class="w-100 btn btn-sm btn-outline-secondary" id="edit-profile-btn">Edit Profile</button>
                    <?php endif; ?>

                    <div class="hidden-inputs d-none">
                        <div class="mb-1 mt-0">
                            <div class="input-group">
                                <textarea class="form-control" id="hidden-inputs-username" name="bio" rows="3" cols="15"><?= $data['profile']->bio ?></textarea>
                            </div>
                        </div>

                        <div class="mb-1">
                            <label for="hidden-inputs-name">Name</label>

                            <div class="input-group">
                                <input type="text" class="form-control" id="hidden-inputs-name" name="name" value="<?= $data['profile']->firstname ?>" required="">

                                <div class="invalid-feedback" style="width: 100%;">
                                    Your name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="hidden-inputs-username">Username</label>

                            <div class="input-group">
                                <input type="text" class="form-control" id="hidden-inputs-username" name="userName" value="<?= $data['profile']->username ?>" required="">

                                <div class="invalid-feedback" style="width: 100%;">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-sm btn-success btn-outline-success rounded mr-1" id="hidden-inputs-save-btn" style="width: 60px">Save</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded" id="hidden-inputs-cancel-btn" style="width: 60px;">Cancel</button>
                        </div>
                    </div>

                    <hr class="mt-3">

                    <div class="profile__bio bio description text-muted">About me
                        <p class="bio__text text-dark my-2"><?= $data['profile']->bio ?></p>
                    </div>
                </form>
            </div>

            <?php include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/profile/profile-blog.php' ?>
        </section>
    </div>
</main>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/footer.php';
?>

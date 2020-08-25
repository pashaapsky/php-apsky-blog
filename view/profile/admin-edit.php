<?php
use Controllers\AuthController;
use Models\AuthCategory;
use Models\AuthCategoryUsers;

include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/admin/admin-header.php';
$user = $data['user'];
 ?>
    <main role="main" class="my-3 d-flex col-12 bg-light m-auto">
        <div class="container py-2 shadow-sm rounded bg-white">
            <form class="admin-user-edit d-flex flex-column w-100 p-3 js-user-edit-form" method="post" action="/" novalidate>
                <div class="admin-user-edit__inner d-flex flex-row flex-wrap my-2 js-user-edit-inner" style="margin-bottom: 50px;">
                    <div class="admin-user-edit__info col-12 col-sm-7 p-0">
                        <div class="admin-user-edit__first-name form-label-group">
                            <label for="admin-user-edit-first-name"><strong>Firstname</strong></label>
                            <input type="text" id="admin-user-edit-first-name" name="firstname" class="form-control p-0 pl-2" value="<?= $user->firstname ?>" placeholder="" required="" autofocus="">

                            <div class="invalid-feedback">
                                User firstname is required.
                            </div>
                        </div>

                        <div class="admin-user-edit__second-name form-label-group">
                            <label for="admin-user-edit-second-name"><strong>Secondname</strong></label>
                            <input type="text" id="admin-user-edit-second-name" name="secondname" class="form-control p-0 pl-2" value="<?= $user->secondname ?>" placeholder="" required="" autofocus=""">

                            <div class="invalid-feedback">
                                User secondname is required.
                            </div>
                        </div>

                        <div class="admin-user-edit__username form-label-group">
                            <label for="admin-user-edit-username"><strong>Username</strong></label>
                            <input type="text" id="admin-user-edit-username" name="username" class="form-control p-0 pl-2" value="<?= $user->username ?>" placeholder="" required="" autofocus="">

                            <div class="invalid-feedback">
                                Username is required.
                            </div>
                        </div>

                        <div class="admin-user-edit__email form-label-group">
                            <label for="admin-user-edit-email"><strong>User email</strong></label>
                            <input type="email" id="admin-user-edit-email" name="email" class="form-control p-0 pl-2" value="<?= $user->email ?>" placeholder="" required="" autofocus="">

                            <div class="invalid-feedback">
                                Email is required.
                            </div>
                        </div>

                        <div class="admin-user-edit__grants form-label-group">
                            <label for="admin-user-edit-grants"><strong>User grants</strong></label>
                            <select type="email" id="admin-user-edit-grants" name="grants" class="form-control p-0 pl-2" required="" autofocus="">
                                <?php
                                    $userGrants = AuthController::getAuthCategoryByID(AuthCategoryUsers::where('user_id', $user->id)->first()->category_id);
                                    $enableCategories = AuthCategory::all();
                                    foreach ($enableCategories as $cat) :
                                ?>
                                    <option class="" <?= $userGrants === $cat->name ? 'selected' : '' ?> value="<?= $cat->name ?>"><?= $cat->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="admin-user-edit__photo photo col-12 p-0 p-sm-3 col-sm-5 d-flex flex-column justify-content-top align-items-sm-center align-items-left">
                        <div class="photo__item photo__item--active mb-2">
                            <img class="photo__img " alt="User`s photo" style="" src="/src/img/profile/<?= $user->photo ?>">
                        </div>

                        <div class="photo__item photo__item--add" >
                            <input type="file" name="photo" class="form-control is-valid js-user-edit-photo" id="admin-user-edit-photo" hidden="">
                            <label for="admin-user-edit-photo" class="btn btn-outline-info rounded m-0" style="font-size: 0.8rem; max-width: 100px">Edit Photo</label>
                        </div>
                    </div>
                </div>

                <div class="admin-user-edit__textarea form-label-group">
                    <label for="admin-user-edit-textarea"><strong>BIO</strong></label>
                    <textarea id="admin-user-edit-textarea" name="bio" rows="5" class="form-control text-justify"><?= $user->bio ?></textarea>
                </div>

                <div class="btn-group ml-auto" role="group" aria-label="admin-user-edit-buttons">
                    <button type="submit" class="btn btn-sm btn-outline-info" style="font-size: 0.8rem; min-width: 80px">edit</button>
                    <button type="button" class="btn btn-sm btn-outline-danger js-edit-cancel-btn" style="font-size: 0.8rem; min-width: 80px">cancel</button>
                </div>
            </form>
        </div>
    </main>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/admin/admin-footer.php'; ?>
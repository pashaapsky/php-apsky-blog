<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/header.php'; ?>
<main role="main">
    <section class="registration">
        <form class="form-signup position-relative" id="js-form-signup" novalidate>
            <h2 class="mb-1 font-weight-bold text-primary">Registration</h2>

            <div class="row">
                <div class="col-md-6 mb-1">
                    <label for="form-signup-firstname">First name</label>

                    <input type="text" class="form-control" id="form-signup-firstname" name="firstName" required="">

                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <label for="form-signup-lastname">Last name</label>

                    <input type="text" class="form-control" id="form-signup-lastname" name="lastName" required="">

                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>

            <div class="mb-1">
                <label for="form-signup-username">Username</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <img class="input-group-text p-1" style="background-color: transparent" src="../src/img/signup/registration-login.png" alt="" width="34" height="38">
                    </div>

                    <input type="text" class="form-control" id="form-signup-username" name="userName" placeholder="Username" required="">

                    <div class="invalid-feedback" style="width: 100%;">
                        Your username is required.
                    </div>
                </div>
            </div>

            <div class="mb-1">
                <label for="form-signup-password">Password</span></label>
                <input type="password" class="form-control" name="password" id="form-signup-password" required="">

                <div class="invalid-feedback">
                    Your password is required.
                </div>
            </div>

            <div class="mb-1">
                <label for="form-signup-password-confirm">Confirm Password</span></label>
                <input type="password" class="form-control" name="password-confirm" id="form-signup-password-confirm" required="">

                <div class="invalid-feedback">
                    Confirm-password is required.
                </div>
            </div>

            <div class="mb-3">
                <label for="form-signup-email">Email</span></label>
                <input type="email" class="form-control" id="form-signup-email" name="email" placeholder="you@example.com" required="">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="site-rules" required>
                    <label class="form-check-label" for="site-rules">
                        Agree to terms and conditions.
                    </label>

                    <a href="/rules" class="text-primary" target="_blank">Terms & Conditions</a>

                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>

            <button class="btn  btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

            <a href="/" class="position-absolute" style="top: 22px; right: 20px">
                <img src="../src/img/auth/back.png" alt="Back to Site" width="24" height="24">
            </a>
        </form>
    </section>
</main>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/footer.php'; ?>


<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/header.php';
?>
<main role="main">
    <section class="administration-auth">
        <form class="form-admin-signin position-relative" method="post" novalidate>
            <h2 class="administration-auth__header font-weight-bold pb-3 text-primary" style="font-size: 32px">Admin Login</h2>

            <div class="form-label-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="" autofocus="">

                <div class="invalid-feedback">
                    Valid email is required.
                </div>
            </div>

            <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">

                <div class="invalid-feedback">
                    Valid password is required.
                </div>
            </div>

            <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>

            <p class="text-muted text-center mt-2">©  apsky.blog 2020</p>

            <a href="/" class="position-absolute" style="top: 22px; right: 20px">
                <img src="../src/img/auth/back.png" alt="Back to Site" width="24" height="24">
            </a>
        </form>
    </section>
</main>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/footer.php'; ?>

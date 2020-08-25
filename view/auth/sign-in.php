<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/header.php'; ?>
<main role="main">
    <section class="auth">
        <form class="form-signin position-relative" method="post" novalidate>
            <h2 class="auth__heading font-weight-bold pb-3 text-primary" style="font-size: 32px">Login</h2>

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

            <a href="/auth/sign-up" class="text-primary text-center mb-2">Not registered yet?</a>
            
            <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>

            <a href="/" class="position-absolute" style="top: 22px; right: 20px">
                <img src="../src/img/auth/back.png" alt="Back to Site" width="24" height="24">
            </a>
        </form>
    </section>
</main>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/base/footer.php'; ?>


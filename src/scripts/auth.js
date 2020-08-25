$( document ).ready(function() {
    const signInBtn = $('#js-signin-btn');
    const signUpBtn = $('#js-signup-btn');

    const registrationFormElem = $('#js-form-signup');
    
    const authFormElem = $('.form-signin');
    const adminAuthForm = $('.form-admin-signin');

    signInBtn.on('click', function (event) {
        event.preventDefault();

        location.href = '/auth/sign-in';
    });

    signUpBtn.on('click', function (event) {
        event.preventDefault();

        location.href = '/auth/sign-up';
    });

    authFormElem.on('submit', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            const data = $(this).serialize();

            $.post('/ajax/auth/login.php', data, function (response) {
                if (response === 'Sign In Success') {
                    location.href = '/'
                } else {
                    alert(response);
                }
            });
        }

        this.classList.add('was-validated');
    });

    adminAuthForm.on('submit', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            const data = $(this).serialize();

            $.post('/ajax/auth/admin-login.php', data, function (response) {
                if (response === 'Sign In Success') {
                    location.href = '/admin'
                } else {
                    alert(response);
                }
            });
        }

        this.classList.add('was-validated');
    });

    registrationFormElem.on('submit', function (event) {
        event.preventDefault();

        if (registrationFormElem[0].checkValidity() === false) {
            event.stopPropagation();
        } else {
            const data = registrationFormElem.serialize();

            const passwordInput = $('#form-signup-password');
            const passwordConfirmInput = $('#form-signup-password-confirm');
            const userNameInput = $('#form-signup-username');
            const emailInput = $('#form-signup-email');

            function setDefaultField(...params) {
                params.forEach((item) => {
                    item.classList.remove('is-invalid');
                    item.classList.remove('border-danger');
                })
            }

            setDefaultField(passwordInput[0], passwordConfirmInput[0], userNameInput[0], emailInput[0]);

            $.post('/ajax/registration/registration.php', data, function (response) {
                switch (response) {
                    case 'Passwords must be the same' : {
                        passwordInput[0].classList.add('is-invalid');
                        passwordInput[0].classList.add('border-danger');
                        passwordConfirmInput[0].classList.add('is-invalid');
                        passwordConfirmInput[0].classList.add('border-danger');
                        alert(response);
                        break;
                    }
                    case 'This username is already use, please change' : {
                        userNameInput[0].classList.add('is-invalid');
                        userNameInput[0].classList.add('border-danger');
                        alert(response);
                        break;
                    }
                    case 'This email is already use, please change' : {
                        emailInput[0].classList.add('is-invalid');
                        emailInput[0].classList.add('border-danger');
                        alert(response);
                        break;
                    }
                    case 'Registration completed' : {
                        location.href = '/';
                        alert('Registration completed.');
                        break;
                    }
                    default : {
                        alert('ERROR: ' . response);
                    }
                }
            })
        }

        registrationFormElem[0].classList.add('was-validated');
    })
});
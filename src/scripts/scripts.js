$(document).ready(function () {
    const commentsSectionElem = $('.comments');
    const profileSectionElem = $('.profile');
    const blogSectionElem = $('.blog');
    const pagesSectionElem = $('.pages');
    const wrapperElem = $('.wrapper');
    const administrationElem = $('.administration');
    const adminCommentsSection = $('.admin-comments');
    const adminSubscribesSection = $('.admin-subscribes');
    const adminNewSubscribeForm = $('.admin-new-subscribe-form');
    const adminPageEditForm = $('#js-page-edit-form');
    const adminPageCreatorForm = $('#js-page-creator-form');

    const editProfileForm = $('.edit-profile-form');

    const privacyBackLink = $('#js-privacy-back-link');

    const blogAddForm = $('#blog-add-form');
    const blogEditForm = $('#blog-edit-form');

    const userEditForm = $('.js-user-edit-form');
    const adminBlogDeleteBtn = $('.js-admin-blog-delete');
    const adminUserDeleteBtn = $('.js-admin-user-delete');

    function pagination(elem) {
        let href = location.href;
        let pageVal = elem.textContent;

        if (!isFinite(pageVal)) {
            const pages = $(".page-item");

            pages.each((index, value) => {
                if (value.classList.contains('active')) {
                    pageVal = value.textContent;
                    return false;
                }

                pageVal = 1;
            });

            const arrow = elem.getAttribute('aria-label');

            if (arrow === 'Next') {
                pageVal++;
            } else if (arrow === 'Previous') {
                pageVal--;
            }
        }

        if (href.includes('?')) {
            if (href.includes('page=')) {
                href = href.substr(0, href.indexOf('page=') + 5) + pageVal
            } else {
                href += '&page=' + pageVal;
            }
        } else {
            href += '?page=' + pageVal;
        }

        location.href = href;
    }

    wrapperElem.on('click', '.page-link', function (event) {
        event.preventDefault();
        pagination(this);
    });

    commentsSectionElem.on('click', '.js-new-comment-btn', function (event) {
        event.preventDefault();

        const isLogin = this.getAttribute('data-login');

        if (isLogin === 'yes') {
            $('#js-new-comment-form').toggleClass('d-none');
            $(this).toggleClass('d-none');
        } else {
            alert("Only registered users can make comments. Sign In or create account.");
        }
    });

    commentsSectionElem.on('click', '#js-new-comment-back', function (event) {
        event.preventDefault();

        $('#js-new-comment-form').toggleClass('d-none');
        $('.js-new-comment-btn').toggleClass('d-none');
    });

    wrapperElem.on('submit', '#js-new-comment-form', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            let data = $(this).serialize();
            const href = location.href;

            if (href.lastIndexOf('?') > 0) {
                data += ('&blog_id=' + href.substr(href.lastIndexOf('/') + 1, href.lastIndexOf('?') - href.lastIndexOf('/') - 1));
            } else {
                data += ('&blog_id=' + href.substr(href.lastIndexOf('/') + 1));
            }

            $.post('/ajax/comment/add.php', data, function (response) {
                if (response === 'Success') {
                    location.reload();
                } else {
                    alert(response);
                }
            })
        }

        this.classList.add('was-validated');
    });

    wrapperElem.on('click', '.js-view-blog-btn', function (event) {
        event.preventDefault();

        const btn = event.target;
        let blogID = btn.closest('.blog__item').id;
        blogID = blogID.substr(blogID.lastIndexOf('№') + 1);

        location.href = `/blog/${blogID}`;
    });

    wrapperElem.on('change', '.js-select-show-items', function (event) {
        event.preventDefault();

        let href = location.href;

        if (href.indexOf('?') !== -1) {
            href = href.substr(0, href.indexOf('?')) + '?show=' + event.target.value;
        } else {
            href = href + '?show=' + event.target.value;
        }

        location.href = href;
    });

    wrapperElem.on('submit', '#blog-add-form', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            if (confirm('Apply these changes?')) {
                let data = new FormData(this);

                $.ajax({
                    url: '/ajax/blog/add.php',
                    data: data,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(response) {
                        console.log(response);
                        if (response === 'Success') {
                            alert('Changes success');
                            location.href = '/';
                        } else {
                            alert(response);
                        }
                    },
                    error: function(response) {
                        alert('Data was not send to server');
                    }
                });
            }
        }

        this.classList.add('was-validated');
    });

    wrapperElem.on('submit', '#blog-edit-form', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            if (confirm('Apply these changes?')) {
                let data = new FormData(this);
                const href = location.href;

                let blogID = href.substr(href.lastIndexOf('blog') + 5);
                blogID = blogID.substr(0, blogID.lastIndexOf('/'));

                data.append('blog_id', blogID);

                $.ajax({
                    url: '/ajax/blog/edit.php',
                    data: data,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(response) {
                        if (response === 'Success') {
                            alert('Changes success');
                            location.reload();
                        } else {
                            alert(response);
                        }
                    },
                    error: function(response) {
                        alert('Data was not send to server');
                    }
                });
            }
        }

        this.classList.add('was-validated');
    });

    wrapperElem.on('submit', '.admin-settings-form', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            if (confirm('Save these changes?')) {
                let data = $(this).serialize();

                $.post('/ajax/settings/save.php', data, function (response) {
                    if (response === 'Success') {
                        alert('Changes successfully applied');
                        location.reload();
                    } else {
                        alert(response);
                    }
                });
            }
        }

        this.classList.add('was-validated');
    });

    wrapperElem.on('submit', '.js-user-edit-form', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            if (confirm('Apply these changes?')) {
                let data = new FormData(this);
                const href = location.href;

                let username = '';

                if (href.includes('users')) {
                    username = href.substr(href.lastIndexOf('users') + 6);
                } else if  (href.includes('profile')) {
                    username = href.substr(href.lastIndexOf('profile') + 8);
                }

                username = username.substr(0, username.lastIndexOf('/'));

                data.append('lastUserName', username);

                $.ajax({
                    url: '/ajax/profile/full-edit.php',
                    data: data,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(response) {
                        if (response === 'Success') {
                            alert('Changes success');
                            history.go(-2); //cant get new username to location
                        } else {
                            alert(response);
                        }
                    },
                    error: function(response) {
                        alert('Data was not send to server');
                    }
                });
            }
        }

        this.classList.add('was-validated');
    });

    wrapperElem.on('click', '.js-edit-cancel-btn', function (event) {
        event.preventDefault();

        history.back();
    });

    privacyBackLink.on('click', function (event) {
        event.preventDefault();
        window.close();
    });

    profileSectionElem.on('click', '#edit-profile-btn', function (event) {
        event.preventDefault();

        $('.hidden-inputs').toggleClass('d-none');
        $(this).toggleClass('d-none');
    });

    profileSectionElem.on('click', '.js-profile-blog-delete', function (event) {
       if (!confirm('Delete this blog?')) {
           event.preventDefault();
       }
    });

    profileSectionElem.on('click', '.js-profile-subscribe-btn', function (event) {
        if (confirm('Subscribe this user?')) {
            let data = location.href;
            data = 'profile=' + data.substr(data.lastIndexOf('/') + 1);

            $.post('/ajax/subscribe/add.php', data, function (response) {
                if (response === 'Success') {
                    location.reload();
                } else {
                    alert(response);
                }
            });
        } else {
            event.preventDefault();
        }
    });

    profileSectionElem.on('click', '.js-profile-unsubscribe-btn', function (event) {
        if (confirm('Unsubscribe this user?')) {
            let data = location.href;
            data = 'profile=' + data.substr(data.lastIndexOf('/') + 1);

            $.post('/ajax/subscribe/delete.php', data, function (response) {
                if (response === 'Success') {
                    location.reload();
                } else {
                    alert(response);
                }
            });
        } else {
            event.preventDefault();
        }
    });

    profileSectionElem.on('click', '#hidden-inputs-cancel-btn', function (event) {
       event.preventDefault();

        $('.hidden-inputs').toggleClass('d-none');
        $('#edit-profile-btn').toggleClass('d-none');
    });

    wrapperElem.on('click', '.js-delete-profile-subscribe-btn', function (event) {
        event.preventDefault();
        let subID = $(this).parents('.subscribe__item').children('.subscribe__body').children('.subscribe__id').text();

        subID = 'subID=' + subID.substr(subID.lastIndexOf(':') + 2);

        if (confirm('Delete this subscribe?')) {
            $.post('/ajax/subscribe/admin-delete.php', subID, function (response) {
                if (response === 'Success') {
                    location.reload();
                } else {
                    alert(response);
                }
            });
        }
    });

    editProfileForm.on('submit', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            let data = $(this).serialize();
            const href = location.href;

            if (href.lastIndexOf('?') > 0) {
                data += ('&profile_username=' + href.substr(href.lastIndexOf('/') + 1, href.lastIndexOf('?') - href.lastIndexOf('/') - 1));
            } else {
                data += ('&profile_username=' + href.substr(href.lastIndexOf('/') + 1));
            }

            let newUserName = data.split('&')[2];
            newUserName = newUserName.substr(newUserName.indexOf('=') + 1);

            $.post('/ajax/profile/fast-edit.php', data, function (response) {
                if (response === 'Update success') {
                    let newLocation = location.href;
                    newLocation = newLocation.substr(0, newLocation.lastIndexOf('/')) + '/' + newUserName;
                    alert(response);
                    location.href = newLocation;
                } else if (response === 'Update failed') {
                    alert(response + '. Errors with database');
                } else {
                    alert(response);
                }
            })
        }

        this.classList.add('was-validated');
    });

    administrationElem.on('click', '.js-show-subscribe-btn', function (event) {
        event.preventDefault();

        $(this).children('.bi-caret-up-square-fill').toggleClass('d-none');
        $(this).children('.bi-caret-down-square-fill').toggleClass('d-none');
        $(this).parents('.user__body').children('.subscribes').toggleClass('d-none d-flex')
    });

    blogSectionElem.on('click', '.js-blog-add', function (event) {
        event.preventDefault();

        location.href = `/blog/add`;
    });

    blogAddForm.on('change', '#blog-add-photo', function (event) {
        const file = this.files[0];
        const reader = new FileReader();

        let imageElem = $(this).parents('.blog-add__inner')[0].querySelector('.photo__img');

        reader.onload = (evt) => {
            imageElem.src = evt.target.result;
        };

        reader.readAsDataURL(file);
    });

    blogEditForm.on('change', '#blog-edit-photo', function (event) {
        const file = this.files[0];
        const reader = new FileReader();

        let imageElem = $(this).parents('.blog-edit__inner')[0].querySelector('.photo__img');

        reader.onload = (evt) => {
            imageElem.src = evt.target.result;
        };

        reader.readAsDataURL(file);
    });

    adminCommentsSection.on('click', '.js-admin-edit-comment-btn', function (event) {
        event.preventDefault();

        const editCommentForm = $(this).parents('.media-body').children('.admin-comment-edit');
        const editBtnGroup = $(this).parents('.btn-group');
        const commentContent = $(this).parents('.media-body').children('.admin-comments__content');

        editBtnGroup.toggleClass('d-flex d-none');
        editCommentForm.toggleClass('d-flex d-none');
        commentContent.toggleClass('d-none');
    });

    adminCommentsSection.on('submit', '.js-admin-comment-edit-form', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            let data = $(this).serialize();

            let commentID = $(this).parents('.media-body')[0].id;
            commentID = '&comment_id=' + commentID.substr(commentID.lastIndexOf('@') + 1);

            data += commentID;
            $.post('/ajax/comment/admin-edit.php', data, function (response) {
                if (response === 'Success') {
                    location.reload();
                } else {
                    alert(response);
                }
            })
        }

        this.classList.add('was-validated');
    });

    adminCommentsSection.on('click', '.js-admin-delete-comment-btn', function (event) {
        event.preventDefault();

        let commentID = $(this).parents('.media-body')[0].id;
        commentID = 'comment_id=' + commentID.substr(commentID.lastIndexOf('@') + 1);

        if (confirm('Delete this comment?')) {
            $.post('/ajax/comment/admin-delete.php', commentID, function (response) {
                if (response === 'Success') {
                    location.reload();
                } else {
                    alert(response);
                }
            })
        }
    });

    adminCommentsSection.on('click', '.js-comment-change-moderation-btn', function (event) {
        event.preventDefault();

        let commentID = $(this).parents('.media-body')[0].id;
        commentID = 'comment_id=' + commentID.substr(commentID.lastIndexOf('@') + 1);

        $.post('/ajax/comment/admin-moderate.php', commentID, function (response) {
            if (response === 'Success') {
                location.reload();
            } else {
                alert(response);}
        })
    });

    adminCommentsSection.on('click', '.js-admin-cancel-comment-btn', function (event) {
        event.preventDefault();

        const editCommentForm = $(this).parents('.admin-comment-edit');
        const commentContent = $(this).parents('.media-body').children('.admin-comments__content');
        const editBtnGroup = $(this).parents('.media-body').children('.btn-group');

        editCommentForm[0].reset();
        editCommentForm.toggleClass('d-flex d-none');
        commentContent.toggleClass('d-none');
        editBtnGroup.toggleClass('d-flex d-none');
    });

    userEditForm.on('change', '.js-user-edit-photo', function (event) {
        const file = this.files[0];
        const reader = new FileReader();

        let imageElem = $(this).parents('.js-user-edit-inner')[0].querySelector('.photo__img');

        reader.onload = (evt) => {
            imageElem.src = evt.target.result;
        };

        reader.readAsDataURL(file);
    });

    adminBlogDeleteBtn.on('click', function (event) {
        event.preventDefault();

        if (confirm("Delete this blog?")) {
            location.href = this.href;
        }
    });

    adminUserDeleteBtn.on('click', function (event) {
        event.preventDefault();

        if (confirm("Delete this user?")) {
            location.href = location.href = this.href;
        }
    });

    adminSubscribesSection.on('click', '.js-admin-add-new-subscribe-btn', function (event) {
        event.preventDefault();

        let userID = $(this).parents('.user__body')[0].id;
        userID = '&user_id=' + userID.substr(userID.lastIndexOf('@') + 1);

        $('.modals').toggleClass('d-none d-flex');

        adminNewSubscribeForm.on('submit', function (event) {
            event.preventDefault();

            if (this.checkValidity() === false) {
                event.stopPropagation();
            } else {
                let data = $(this).serialize();

                data += userID;

                $.post('/ajax/subscribe/admin-add.php', data, function (response) {
                    if (response === 'Success') {
                        location.reload();
                    } else {
                        alert(response);
                    }
                })
            }

            this.classList.add('was-validated');
        })
    });

    adminSubscribesSection.on('click', '.js-admin-delete-subscribe-btn', function (event) {
        event.preventDefault();

        let subID = $(this).parents('.subscribe').children('.subscribe__body').children('.subscribe__id').text();
        subID = 'subID=' + subID.substr(subID.lastIndexOf(':') + 2);

        if (confirm('Delete this subscribe?')) {
            $.post('/ajax/subscribe/admin-delete.php', subID, function (response) {
                if (response === 'Success') {
                    location.reload();
                } else {
                    alert(response);
                }
            });
        }
    });

    adminPageEditForm.on('submit', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            if (confirm('Are you sure to save this page?')) {
                let data = $(this).serialize();
                const href = location.href;

                let pageID = href.substr(href.lastIndexOf('pages') + 6);
                pageID = pageID.substr(0, pageID.lastIndexOf('/'));
                pageID = '&page_id=' + pageID;

                data += pageID;

                $.post('/ajax/pages/edit.php', data, function (response) {
                    if (response === 'Success') {
                        location.href = '/admin/pages';
                    } else {
                        alert(response);
                    }
                })
            }
        }

        this.classList.add('was-validated');
    });

    pagesSectionElem.on('click', '.js-delete-page-btn', function (event) {
        if (!confirm('Are you sure to delete this page?')) {
            event.preventDefault();
        }
    });

    adminPageCreatorForm.on('submit', function (event) {
        event.preventDefault();

        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            if (confirm('Are you sure to save this page?')) {
                let data = $(this).serialize();

                $.post('/ajax/pages/add.php', data, function (response) {
                    if (response === 'Success') {
                        location.href = '/admin/pages';
                    } else {
                        alert(response);
                    }
                })
            }
        }

        this.classList.add('was-validated');
    })
});
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
?>
    <main role="main" class="my-3 d-flex col-12 bg-light m-auto">
        <div class="container py-2 shadow-sm rounded bg-white">
            <form class="blog-add d-flex flex-column w-100 p-3" id="blog-add-form" method="post" action="/" novalidate>
                <h2 class="blog-add__header">Create your blog</h2>

                <div class="blog-add__inner d-flex flex-column my-2" style="margin-bottom: 50px;">
                    <div class="blog-add__info col-12 col-sm-8 col-md-4 p-0">
                        <div class="blog-add__name form-label-group">
                            <label for="blog-add-name"><strong>Blog Name</strong></label>
                            <input type="text" id="blog-add-name" name="name" class="form-control p-0 pl-2" placeholder="" required="" autofocus="">

                            <div class="invalid-feedback">
                                Blog name is required.
                            </div>
                        </div>
                    </div>

                    <div class="blog-add__photo photo d-flex flex-column justify-content-start">
                        <div class="photo__item photo__item--active mb-2">
                            <img class="photo__img " alt="Blog`s photo" style="" src="/src/img/blogs/defaultBlog.png">
                        </div>

                        <div class="photo__item photo__item--add" >
                            <input type="file" name="photo" class="form-control is-valid" id="blog-add-photo" hidden="">
                            <label for="blog-add-photo" class="btn btn-outline-info rounded m-0" style="font-size: 0.8rem; max-width: 130px">New Photo</label>
                        </div>
                    </div>
                </div>

                <div class="blog-add__textarea form-label-group">
                    <label for="blog-add-textarea"><strong>Content</strong></label>
                    <textarea id="blog-add-textarea" name="content" rows="7" class="form-control text-justify" required=""></textarea>

                    <div class="invalid-feedback">
                        Blog text is required.
                    </div>
                </div>

                <div class="btn-group ml-auto" role="group" aria-label="edit-blog-buttons">
                    <button type="submit" class="btn btn-sm btn-outline-info" style="font-size: 0.8rem; min-width: 80px">add</button>
                    <button type="button" class="btn btn-sm btn-outline-danger js-add-cancel-btn" style="font-size: 0.8rem; min-width: 80px">cancel</button>
                </div>
            </form>
        </div>
    </main>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/footer.php'; ?>
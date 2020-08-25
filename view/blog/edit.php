<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
$currentBlog = $data['currentBlog'];
?>
<main role="main" class="my-3 d-flex col-12 bg-light m-auto">
    <div class="container py-2 shadow-sm rounded bg-white">
        <form class="blog-edit d-flex flex-column w-100 p-3" id="blog-edit-form" method="post" action="/" novalidate>
            <div class="blog-edit__inner d-flex flex-column my-2" style="margin-bottom: 50px;">
                <div class="blog-edit__info col-12 col-sm-8 col-md-4 p-0">
                    <div class="blog-edit__name form-label-group">
                        <label for="blog-edit-name"><strong>Blog Name</strong></label>
                        <input type="text" id="blog-edit-name" name="name" class="form-control p-0 pl-2" value="<?= $currentBlog->name ?>" placeholder="" required="" autofocus="">

                        <div class="invalid-feedback">
                            Blog name is required.
                        </div>
                    </div>

                    <div class="blog-edit__date form-label-group">
                        <label for="blog-edit-date"><strong>Created date</strong></label>
                        <input type="datetime-local" id="blog-edit-date" name="date" class="form-control p-0 pl-2" value="<?= $currentBlog->created_at->format('Y-m-d\TH:i') ?>" placeholder="" required="" autofocus=""">

                        <div class="invalid-feedback">
                            Created date is required.
                        </div>
                    </div>

                    <div class="blog-edit__updated-date form-label-group">
                        <label for="blog-edit-updated-date"><strong>Updated date</strong></label>
                        <input type="datetime-local" id="blog-edit-updated-date" class="form-control" value="<?= $currentBlog->updated_at->format('Y-m-d\TH:i') ?>" readonly>
                    </div>
                </div>

                <div class="blog-edit__photo photo d-flex flex-column justify-content-start">
                    <div class="photo__item photo__item--active mb-2">
                        <img class="photo__img " alt="Blog`s photo" style="" src="/src/img/blogs/<?= $currentBlog->photo ?>">
                    </div>

                    <div class="photo__item photo__item--add" >
                        <input type="file" name="photo" class="form-control is-valid" id="blog-edit-photo" hidden="">
                        <label for="blog-edit-photo" class="btn btn-outline-info rounded m-0" style="font-size: 0.8rem; max-width: 100px">Edit Photo</label>
                    </div>
                </div>
            </div>

            <div class="blog-edit__textarea form-label-group">
                <label for="blog-edit-textarea"><strong>Content</strong></label>
                <textarea id="blog-edit-textarea" name="content" rows="10" class="form-control text-justify" required=""><?= $currentBlog->text ?></textarea>

                <div class="invalid-feedback">
                    Created date is required.
                </div>
            </div>

            <div class="btn-group ml-auto" role="group" aria-label="edit-blog-buttons">
                <button type="submit" class="btn btn-sm btn-outline-info" style="font-size: 0.8rem; min-width: 80px">edit</button>
                <button type="button" class="btn btn-sm btn-outline-danger js-edit-cancel-btn" style="font-size: 0.8rem; min-width: 80px">cancel</button>
            </div>
        </form>
    </div>
</main>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/footer.php'; ?>
<?php $currentBlog = $data['currentBlog']; ?>

<main role="main" class="my-3">
    <div class="container">
        <section class="blog py-2">
            <h2 class="blog__heading text-center d-none" style="text-transform: uppercase">Blog Info</h2>

            <div class="blog__inner d-flex my-2 p-3 border" style="margin-bottom: 50px;">
                <div class="blog__info flex-fill">
                    <h5 class="blog__name d-block pb-2 border-bottom"><?= $currentBlog->name ?></h5>

                    <h5 class="blog__date d-block">Created date</h5>

                    <time class="blog__created-at text-muted"><?= $currentBlog->created_at ?></time>
                </div>

                <img class="blog__img d-block" alt="Blog`s photo" style="height: 225px; width: 40%; display: block; padding: 0 5%" src="/src/img/blogs/<?= $currentBlog->photo ?>">
            </div>

            <h3 class="blog__heading text-center" style="text-transform: uppercase">Content</h3>

            <p class="blog__textarea p-3 border text-justify" style="min-height: 200px"><?= $currentBlog->text ?></p>
        </section>

        <?php include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/blog/section-comments.php';?>
    </div>
</main>
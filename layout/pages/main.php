<?php $page = $data['page']; ?>
<main role="main">
    <section class="<?= $page->name ?> mt-3">
        <div class="container">
            <div class="<?= $page->name . '__inner' ?>">
                <h3 class="header"><?= mb_strtoupper($page->name) ?></h3>

                <div class="content text-justify">
                    <?= $page->text ?>
                </div>
            </div>
        </div>
    </section>
</main>

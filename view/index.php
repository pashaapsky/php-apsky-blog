<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/header.php';
?>
<main role="main">
    <section class="jumbotron text-center mb-0">
        <div class="container">
            <h1 class="">Welcome to my Blog Application</h1>

            <p class="text-muted mb-0">This site is a mini-application where everyone can try themselves as a blogger.</p>
            <p class="text-muted mb-0">Wish you good luck and have some fun.</p>
        </div>
    </section>

    <?php include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/section-blog.php'; ?>
</main>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/layout/footer.php';
?>
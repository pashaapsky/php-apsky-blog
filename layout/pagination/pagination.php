<?php
if (!empty($_GET) && isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

$page = intval($page);

if (empty($page) or $page < 0) {
    $page = 1;
}
if ($page > $totalPages) {
    $page = $totalPages;
}

$start = ($page - 1) * $countItemsOnPage;



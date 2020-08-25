<?php
$limit = 'yes';

if (isset($_GET['show']) && ($_GET['show'] === 'all')) {
    $limit = 'no';
} elseif (isset($_GET['show']) && is_finite($_GET['show'])) {
    $countItemsOnPage = intval($_GET['show']);
} else {
    $countItemsOnPage = 20;
}
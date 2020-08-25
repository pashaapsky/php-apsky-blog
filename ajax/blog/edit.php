<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Carbon\Carbon;
use Models\Blog;
use Models\DataBase;

use function helpers\loadPhoto;

if (!empty($_POST)) {
    new DataBase();
    $blog = Blog::find($_POST['blog_id']);

    if(isset($_POST['name']) && !empty($_POST['name'])) {
        $blog->name = $_POST['name'];
    } else {
        echo 'Blog Name is required';
        return;
    }

    if(isset($_POST['date']) && !empty($_POST['date'])) {
        $blog->created_at = $_POST['date'];
    } else {
        echo 'Created date is required';
        return;
    }

    if(isset($_POST['content']) && !empty($_POST['content'])) {
        $blog->text = $_POST['content'];
    } else {
        echo 'Blog Content is required';
        return;
    }

    $result = loadPhoto($_SERVER['DOCUMENT_ROOT'] . '/src/img/blogs/', $blog, 'defaultBlog.png');

    if ($result === 'Photo added') {
        $blog->updated_at = Carbon::now()->timestamp;
        $blog->save();
        echo 'Success';
    } else {
        echo $result;
    }
}
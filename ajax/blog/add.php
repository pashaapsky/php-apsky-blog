<?php
require $_SERVER["DOCUMENT_ROOT"] . '/bootstrap.php';

use Carbon\Carbon;
use Models\Blog;
use Models\DataBase;
use Models\Subscribe;
use Models\User;

use function helpers\loadPhoto;
use function helpers\writeNewBlogLog;

if (!empty($_POST)) {
    new DataBase();
    $blog = new Blog();

    $user = User::where('email', $_COOKIE['login'])->first();

    if(isset($_POST['name']) && !empty($_POST['name'])) {
        $blog->name = $_POST['name'];
    } else {
        echo 'Blog Name is required';
        return;
    }

    if(isset($_POST['content']) && !empty($_POST['content'])) {
        $blog->text = $_POST['content'];
    } else {
        echo 'Blog Content is required';
        return;
    }

    $blog->user_id = $user->id;
    $blog->updated_at = Carbon::now()->timestamp;
    $blog->save();

    $result = loadPhoto($_SERVER['DOCUMENT_ROOT'] . '/src/img/blogs/', $blog, 'defaultBlog.png');

    if ($result === 'Photo added') {
        $subscribes = Subscribe::where('subscriber', $user->id)->get();

        if ($subscribes->count()) {
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/src/logs/new-blog-log.txt';
            $readHref = $_SERVER['DOCUMENT_ROOT'] . '/blog/' . $blog->id;
            $unsubHref = $_SERVER['DOCUMENT_ROOT'] . '/profile/' . $user->username;

            foreach ($subscribes as $subscribe) {
                $subscriber = User::find($subscribe->subscribe_to);
                $result = writeNewBlogLog($filePath, $blog, $subscriber, $readHref, $unsubHref);
            }

            if ($result === 'Success') {
                $blog->save();
                echo 'Success';
            } else {
                echo $result;
            }
        } else {
            echo 'Success';
        }
    } else {
        echo $result;
    }
}
<?php
error_reporting(E_ALL);
require_once 'bootstrap.php';   //autoload classes

use App\Router;
use App\Application;
use App\View;
use App\Route;
use Controllers\AuthController;
use Controllers\BlogController;
use Controllers\CommentController;
use Controllers\PagesController;
use Controllers\SubscribeController;
use Controllers\UserController;
use Models\DataBase;
use Models\Pages;

$router = new Router();
new DataBase();
$pages = Pages::all();

$router->get(new Route('GET', '/', function()
{
    return new View('index', ['title' => 'Index Page']);
}));

$router->get(new Route('GET', '/admin', AuthController::class . '@adminIndex'));
$router->get(new Route('GET', '/admin/auth', AuthController::class . '@adminAuth'));
$router->get(new Route('GET', '/admin/blogs', BlogController::class . '@adminBlogs'));
$router->get(new Route('GET', '/admin/users', UserController::class . '@adminUsers'));
$router->get(new Route('GET', '/admin/users/*/edit', UserController::class . '@adminUserUpdate'));
$router->get(new Route('GET', '/admin/comments', CommentController::class . '@adminComments'));
$router->get(new Route('GET', '/admin/subscribes', SubscribeController::class . '@adminSubscribes'));
$router->get(new Route('GET', '/admin/pages', PagesController::class . '@index'));
$router->get(new Route('GET', '/admin/pages/*/edit', PagesController::class . '@update'));
$router->get(new Route('GET', '/admin/pages/*/delete', PagesController::class . '@delete'));
$router->get(new Route('GET', '/admin/settings', function () {
    return new View('admin/settings', ['title' => 'Admin Settings Page']);
}));

$router->get(new Route('GET', '/admin/page-creator', function () {
    return new View('admin/page-creator', ['title' => 'Admin Pages Creator']);
}));

$router->get(new Route('GET', '/auth/sign-in', AuthController::class . '@signIn'));
$router->get(new Route('GET', '/auth/sign-up', AuthController::class . '@signUp'));

foreach ($pages as $page) {
    $router->get(new Route('GET', '/' . $page->name , function() use ($page)
    {
        $fileName = substr($page->src, 0, -4);
        return new View($fileName, ['title' => $page->name, 'page' => $page]);
    }));
}

$router->get(new Route('GET', '/profile/*', UserController::class . '@index'));
$router->get(new Route('GET', '/profile/*/blog/*', BlogController::class . '@profileBlogIndex'));
$router->get(new Route('GET', '/profile/*/blog/*/edit', BlogController::class . '@profileBlogUpdate'));
$router->get(new Route('GET', '/profile/*/blog/*/delete', BlogController::class . '@profileBlogDelete'));
$router->get(new Route('GET', '/profile/*/edit', UserController::class . '@userUpdate'));
$router->get(new Route('GET', '/profile/*/delete', UserController::class . '@delete'));
$router->get(new Route('GET', '/profile/*/subscribes', SubscribeController::class . '@index'));

$router->get(new Route('GET', '/blog/add', BlogController::class . '@add'));
$router->get(new Route('GET', '/blog/*', BlogController::class . '@index'));
$router->get(new Route('GET', '/blog/*/edit', BlogController::class . '@update'));
$router->get(new Route('GET', '/blog/*/delete', BlogController::class . '@delete'));

$application = new Application($router);
$application->run();

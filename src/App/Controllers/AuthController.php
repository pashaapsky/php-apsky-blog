<?php
namespace Controllers;

use App\NotFoundException;
use App\View;
use Models\AuthCategoryUsers;
use Models\Blog;
use Models\Comment;
use Models\DataBase;
use Models\User;
use function helpers\isAdmin;

class AuthController
{
    public function signIn() {
        return new View('auth/sign-in', ['title' => 'SignIn']);
    }

    public function signUp() {
        return new View('auth/sign-up', ['title' => 'SignUp']);
    }

    public function adminIndex() {
        $blogs = Blog::orderBy('created_at', 'desc')->take(3)->get();
        $users = User::orderBy('id', 'desc')->take(3)->get();
        $comments = Comment::orderBy('id', 'desc')->take(3)->get();

        return new View('admin/index',
            [
                'title' => 'Admin Page',
                'blogs' => $blogs,
                'users' => $users,
                'comments' => $comments,
            ]);
    }

    public function adminAuth() {
        return new View('admin/auth', ['title' => 'Admin login']);
    }

    public static function adminSignIn($email, $password) {
        new DataBase();
        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            $isAdmin = AuthCategoryUsers::where('user_id', $user->id)->where('category_id', '1')->get()->first();
            $isModerator = AuthCategoryUsers::where('user_id', $user->id)->where('category_id', '2')->get()->first();

            if (!is_null($isAdmin)) {
                session_name('session_id');
                session_start();
                setcookie('login', $user->email, time() + (3600 * 24 * 30), '/');
                setcookie('grants', 'admin', time() + (3600 * 24 * 30), '/');
                $_SESSION['login']='yes';
                echo 'Sign In Success';
                return;
            }

            if (!is_null($isModerator)) {
                session_name('session_id');
                session_start();
                setcookie('login', $user->email, time() + (3600 * 24 * 30), '/');
                setcookie('grants', 'manager', time() + (3600 * 24 * 30), '/');
                $_SESSION['login']='yes';
                echo 'Sign In Success';
                return;
            }

            echo 'This user is not a moderator';
        } else {
            echo 'User not found or password is incorrect';
        }
    }

    public static function goSignIn($email, $password)
    {
        new DataBase();
        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            $userCategories = AuthCategoryUsers::where('user_id', $user->id)->get();

            $userCategoriesId = [];

            foreach ($userCategories as $category) {
                array_push($userCategoriesId, $category->category_id);
            }

            $grants = '';

            if (in_array('1', $userCategoriesId)) {
                session_name('session_id');
                session_start();
                setcookie('login', $user->email, time() + (3600 * 24 * 30), '/');
                setcookie('grants', 'admin', time() + (3600 * 24 * 30), '/');
                $grants = 'admin';
                $_SESSION['login']='yes';
            } elseif (in_array('2', $userCategoriesId)) {
                session_name('session_id');
                session_start();
                setcookie('login', $user->email, time() + (3600 * 24 * 30), '/');
                setcookie('grants', 'manager', time() + (3600 * 24 * 30), '/');
                $grants = 'manager';
                $_SESSION['login']='yes';
            } elseif (in_array('3', $userCategoriesId)) {
                session_name('session_id');
                session_start();
                setcookie('login', $user->email, time() + (3600 * 24 * 30), '/');
                setcookie('grants', 'registered', time() + (3600 * 24 * 30), '/');
                $grants = 'registered';
                $_SESSION['login']='yes';
            }

            echo $grants ? 'Sign In Success' : $grants;
        } else {
            echo 'User not found or password is incorrect';
        }
    }

    public static function createAuthCategoryUsersField($userId, $categoryId = 3) {
        $authCategory = new AuthCategoryUsers();

        $authCategory->category_id = $categoryId;
        $authCategory->user_id = $userId;

        $authCategory->save();
    }

    public static function getAuthCategoryByID($id) {
        switch ($id) {
            case 1 : return 'Admin';
            case 2 : return 'Moderator';
            case 3 : return 'Registered';
            default : return 'Unregistered';
        }
    }
}


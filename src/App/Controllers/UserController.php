<?php
namespace Controllers;

use App\NotFoundException;
use App\View;
use Models\User;
use function helpers\checkEditGrants;
use function helpers\isAdmin;

class UserController
{
    public static function create_user($username, $firstName, $secondName, $email, $password)
    {
        $user = User::create([
            'username'=>$username,
            'firstname'=>$firstName,
            'secondname'=>$secondName,
            'email'=>$email,
            'password'=>$password
        ]);

        return $user;
    }

    public function adminUsers() {
        if (isAdmin()) {
            return new View('admin/users',
                [
                    'title' => 'Admin Page Users',
                ]);
        } else {
            throw new NotFoundException();
        }
    }

    public function index($username)
    {
        $profile = User::where('username', $username)->first();

        if ($profile) {
            return new View('profile/index', [
                'title' => 'Profile ' . $profile->username ,
                'id' => $profile->id,
                'profile' => $profile,
            ]);
        } else {
            throw new NotFoundException();
        }
    }

    public function delete($username) {
        $currentUser = User::where('username', $username)->first();

        if ($currentUser) {
            $currentUser->delete();
            header('Location: /admin/users');
        } else {
            throw new NotFoundException();
        }
    }

    public static function update($profileUserName, $userName, $firstName , $bio='') {
        $user = User::where('username', $profileUserName)->get()->first();

        if (checkEditGrants($user)) {
            $user->username = $userName;
            $user->firstname = $firstName;
            $user->bio = $bio;

            $saved = $user->save();
            echo $saved ? 'Update success' : 'Update failed';
        } else {
            echo 'You have not permissions for edit this profile';
        }
    }

    public function userUpdate($userName) {
        $currentUser = User::where('username', $userName)->first();
        $loginUser = User::where('email', $_COOKIE['login'])->first();

        if ($currentUser->id === $loginUser->id) {
            return new View('profile/edit', [
                'title' => $currentUser->username,
                'user' => $currentUser,
            ]);
        } else {
            throw new NotFoundException();
        }
    }

    public function adminUserUpdate($userName) {
        $currentUser = User::where('username', $userName)->first();

        if (isAdmin() && $currentUser) {
            return new View('profile/admin-edit', [
                'title' => $currentUser->username,
                'user' => $currentUser,
            ]);
        } else {
            throw new NotFoundException();
        }
    }
}

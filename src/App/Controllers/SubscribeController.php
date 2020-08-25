<?php
namespace Controllers;

use App\NotFoundException;
use App\View;
use Models\User;
use function helpers\isAdmin;

class SubscribeController
{
    public function adminSubscribes() {
        if (isAdmin()) {
            return new View('admin/subscribes',
                [
                    'title' => 'Admin Page Subscribes'
                ]
            );
        } else {
            throw new NotFoundException();
        }
    }

    public function index($username) {
        $profile = User::where('username', $username)->first();

        return new View('profile/profile-subs', ['title' => $username . ' subscribes', 'profile' => $profile]);
    }
}


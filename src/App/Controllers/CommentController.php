<?php
namespace Controllers;

use App\NotFoundException;
use App\View;
use function helpers\isModerator;

class CommentController
{
    public function adminComments() {
        if (isModerator()) {
            return new View('admin/comments',
                [
                    'title' => 'Admin Page Comments',
                ]);
        } else {
            throw new NotFoundException();
        }
    }
}

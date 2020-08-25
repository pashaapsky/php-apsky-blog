<?php
namespace Controllers;

use App\NotFoundException;
use App\View;
use Models\Pages;
use Models\User;

class PagesController
{
    public function index()
    {
        return new View('admin/pages', [
            'title' => 'Admin Active Pages'
        ]);
    }

    public function update($id)
    {
        return new View('pages/edit', [
            'title' => 'Admin Active Pages',
            'id' => $id
        ]);
    }

    public function delete($id) {
        $page = Pages::find($id);

        if ($page) {
            $page->delete();
            header('Location: /admin/pages');
        } else {
            throw new NotFoundException();
        }
    }
}

<?php
namespace Controllers;

use App\NotFoundException;
use App\View;
use Models\Blog;
use Models\User;
use function helpers\isModerator;


class BlogController
{
    public static function getPreviewBlogText($blog)
    {
        $previewText = substr($blog->text, 0, 150) . '...';

        return $previewText;
    }

    public function adminBlogs() {

        if (isModerator()) {
            return new View('admin/blogs',
                [
                    'title' => 'Admin Page Blogs',
                ]);
        } else {
            throw new NotFoundException();
        }
    }


    public function index($id)
    {
        $currentBlog = Blog::find($id);

        if ($currentBlog) {
            return new View('blog/index', ['title' => 'Blog', 'id' => $id, 'currentBlog' => $currentBlog]);
        } else {
            throw new NotFoundException();
        }
    }

    public function add(){
        return new View('blog/add', ['title' => 'Add new blog page']);
    }

    public function update($id)
    {
        $currentBlog = Blog::find($id);

        if ($currentBlog) {
            return new View('blog/edit', ['title' => 'Blog', 'id' => $id, 'currentBlog' => $currentBlog]);
        } else {
            throw new NotFoundException();
        }
    }

    public function delete($id)
    {
        $currentBlog = Blog::find($id);

        if ($currentBlog) {
            $currentBlog->delete();
            header("Location: /admin/blogs");
        } else {
            throw new NotFoundException();
        }
    }

    public function profileBlogIndex($userName, $id) {
        $currentUser = User::where('username', $userName)->first();
        $currentBlog = Blog::find($id);

        if ($currentBlog && $currentUser) {
            return new View('blog/index', ['title' => 'Blog', 'id' => $id, 'currentBlog' => $currentBlog]);
        } else {
            throw new NotFoundException();
        }
    }

    public function profileBlogUpdate($userName, $id)
    {
        $currentUser = User::where('username', $userName)->first();
        $currentBlog = Blog::find($id);

        if ($currentBlog) {
            return new View('blog/edit', ['title' => 'Blog', 'id' => $id, 'currentBlog' => $currentBlog]);
        } else {
            throw new NotFoundException();
        }
    }

    public function profileBlogDelete($userName, $id)
    {
        $currentUser = User::where('username', $userName)->first();
        $currentBlog = Blog::find($id);

        if ($currentBlog && $currentUser) {
            $currentBlog->delete();
            Header("Location: /profile/" . $userName);
        } else {
            throw new NotFoundException();
        }
    }

}

<?php

namespace It20Academy\App\Controllers;

use It20Academy\App\Core\View;
use It20Academy\App\Models\Post;
use It20Academy\App\Models\Status;
use It20Academy\App\Models\Category;
use It20Academy\App\Models\Author;

class PostsController
{
    public function index()
    {
        $posts = Post::all();
        //$posts = Post::published();
        $statuses = Status::all();
        //$categories = Category::all();
        //$authors = Author::all();

        //echo View::render('posts-index', compact('posts', 'statuses', 'categories', 'authors'));// ['posts' =>[]]
        echo View::render('posts-index', compact('posts', 'statuses'));// ['posts' =>[]]

    }
}
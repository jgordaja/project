<?php

namespace It20Academy\App\Controllers;

use It20Academy\App\Core\View;
use It20Academy\App\Models\TablePosts;

class PostsController
{
    public function index()
    {
        $posts = TablePosts::all();

        echo View::render('posts-index', compact('posts'));// ['posts' =>[]]

    }

}
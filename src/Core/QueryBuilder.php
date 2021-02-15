<?php

namespace It20Academy\App\Core;

class QueryBuilder
{

    public function __construct()
    {
        //$dbh = (new Connection())->getHandler();
    }

    public function select(string $field): string
    {
        //$dbh = (new Connection())->getHandler();

//        $statement  = $dbh->query('select * from posts');
//        $initialPosts = $statement->fetchAll();

//        return array_map(function ($initialPost) {
//
//            $post = new self;
//
//            $post->setTitle($initialPost['title']);
//            $post->setId($initialPost['id']);
//            $post->setContent($initialPost['content']);
//            $post->setAuthorId($initialPost['author_id']);
//            $post->setStatusId($initialPost['status_id']);
//            $post->setCategoryId($initialPost['category_id']);
//            $post->setImg($initialPost['img']);
//
//            return $post;
//
//        }, $initialPosts);
//        //return $dbh->query("select ? from ");
    }
}
<?php

namespace It20Academy\App\Models;

class Post
{
    private $id;
    private $title;
    private $content;
    private $author;
    private $status;
    private $category;
    private $img;

    public static function all(): array
    {
        //$db = [];
        $db = require_once '../storage/db.php';
        //dump($db);
        $posts = isset($db['posts']) ? $db['posts'] : [];

        return array_map(function ($initialPost) {
            $post = new self;

            $post->setTitle($initialPost['title']);
            $post->setId($initialPost['id']);
            $post->setContent($initialPost['content']);
            $post->setAuthor($initialPost['author']);
            $post->setStatus($initialPost['status']);
            $post->setCategory($initialPost['category']);
            $post->setImg($initialPost['img']);

            return $post;

        }, $posts);
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setImg($img): void
    {
        $this->img = $img;
    }

    public function getImg()
    {
        return $this->img;
    }
}
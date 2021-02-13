<?php

namespace It20Academy\App\Models;

use It20Academy\App\Core\Db;

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
        $dbh = (new Db())->getHandler();

        $statement  = $dbh->query('select * from posts');
        $initialPosts = $statement->fetchAll();

        //$db = [];
        //$db = require_once '../storage/db.php';
        //dump($db);
        //$posts = isset($db['posts']) ? $db['posts'] : [];

        return array_map(function ($initialPost) {

            $post = new self;

            $post->setTitle($initialPost['title']);
            $post->setId($initialPost['id']);
            $post->setContent($initialPost['content']);
            $post->setAuthor($initialPost['author_id']);
            $post->setStatus($initialPost['status_id']);
            $post->setCategory($initialPost['category_id']);
            $post->setImg($initialPost['img']);

            return $post;

        }, $initialPosts);
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

    public function shortContent(int $maxSymbol): string
    {
        if (mb_strlen($this->getContent()) > $maxSymbol) {
            return mb_substr($this->getContent(), 0, $maxSymbol-1) . '…';
        } else {
            return $this->getContent();
        }
    }
}
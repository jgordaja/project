<?php

namespace It20Academy\App\Models;

use It20Academy\App\Core\Connection;
use It20Academy\App\Core\QueryBuilder;

class Post
{
    //protected $table = 'posts';
    private $id;
    private $title;
    private $content;
    private $authorId;
    private $statusId;
    private $categoryId;
    private $img;

    public static function all(): array
    {
//        $queryBuilder = new QueryBuilder();
//        $queryBuilder->select('*', 'posts');

        $dbh = (new Connection())->getHandler();

        $statement  = $dbh->query('select * from posts');
        //$statement  = $dbh->query('select * from $table');
        $initialPosts = $statement->fetchAll();
        //dump($initialPosts);

        return array_map(function ($initialPost) {

            $post = new self;

            $post->setTitle($initialPost['title']);
            $post->setId($initialPost['id']);
            $post->setContent($initialPost['content']);
            $post->setAuthorId($initialPost['author_id']);
            $post->setStatusId($initialPost['status_id']);
            $post->setCategoryId($initialPost['category_id']);
            $post->setImg($initialPost['img']);

            return $post;

        }, $initialPosts);

    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getAuthorID()
    {
        return $this->authorId;
    }

    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }


    public function setImg(string $img): void
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
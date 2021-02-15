<?php

namespace It20Academy\App\Models;

use It20Academy\App\Core\Db;

class Post
{
    private $id;
    private $title;
    private $content;
    private $author_id;
    private $author;
    private $status;
    private $status_id;
    private $category_id;
    private $category;
    private $img;

    public static function all(): array
    {
        $dbh = (new Db())->getHandler();

        $statement  = $dbh->query('select * from posts');
        $initialPosts = $statement->fetchAll();

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

/*    public static function all(): array
    {
        $dbh = (new Db())->getHandler();

        $allPosts  = $dbh->query("select posts.id, posts.title, posts.content, authors.name as author,  
                                           posts.status_id, categories.name as category, posts.img 
                                           from authors 
                                           join posts 
                                           on authors.id=posts.author_id
                                           join categories
                                           on posts.category_id=categories.id");

        $initialAllPosts = $allPosts->fetchAll();
        dump($initialAllPosts);

        $p = array_map(function ($initialAllPost) {

            $post = new self;

            $post->setId($initialAllPost['id']);
            $post->setTitle($initialAllPost['title']);
            $post->setContent($initialAllPost['content']);
            $post->setAuthor($initialAllPost['author']);
            dump($post->getAuthor());
            $post->setStatus($initialAllPost['status_id']);
            $post->setCategory($initialAllPost['category']);
            $post->setImg($initialAllPost['img']);

            return $post;

        }, $initialAllPosts);

        dump('p= ',$p);
        return $p;

    }*/

    public static function published(): array
    {
        $statuses = Status::all();
        //$posts = Post::all();
        $dbh = (new Db())->getHandler();

        $allPosts  = $dbh->query("select posts.id, posts.title, posts.content, authors.name as author,  
                                           posts.status_id, categories.name as category, posts.img 
                                           from authors 
                                           join posts 
                                           on authors.id=posts.author_id
                                           join categories
                                           on posts.category_id=categories.id");

        $initialAllPosts = $allPosts->fetchAll();
        dump($initialAllPosts);

        $posts = array_map(function ($initialAllPost) {

            $post = new self;

            $post->setId($initialAllPost['id']);
            $post->setTitle($initialAllPost['title']);
            $post->setContent($initialAllPost['content']);
            $post->setAuthor($initialAllPost['author']);
            $post->setStatus($initialAllPost['status_id']);
            $post->setCategory($initialAllPost['category']);
            $post->setImg($initialAllPost['img']);

            return $post;

        }, $initialAllPosts);

        dump($posts);
        dump($statuses);

        $publishedPosts = [];

        foreach ($posts as $post) {
            foreach ($statuses as $status) {
                if ( ($post->getStatus() ===  $status->getId()) && ($status->getName() === 'published')) {
                    $publishedPosts[] = $post;
                }
            }
        }

        //dump($publishedPosts);

        return  $publishedPosts;

/*        $dbh = (new Db())->getHandler();

        $statement  = $dbh->query("select posts.id, posts.title, posts.content, posts.author_id,
                                            statuses.name as status, posts.category_id, posts.img
                                            from posts join statuses on posts.status_id=statuses.id
                                            where statuses.name='published'");
        $initialPosts = $statement->fetchAll();
        dump($initialPosts);

        return array_map(function ($initialPost) {

            $post = new self;

            $post->setTitle($initialPost['title']);
            $post->setId($initialPost['id']);
            $post->setContent($initialPost['content']);
            $post->setAuthor($initialPost['author_id']);
            $post->setStatus($initialPost['status']);
            $post->setCategory($initialPost['category_id']);
            $post->setImg($initialPost['img']);

            return $post;

        }, $initialPosts);*/
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setAuthor($author): void
    {
        $this->author_id = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setStatus($status): void
    {
        $this->status_id = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCategory($category): void
    {
        $this->category_id = $category;
    }

    public function getCategory()
    {
        return $this->category;
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
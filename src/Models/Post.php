<?php

namespace It20Academy\App\Models;

use It20Academy\App\Core\Connection;

class Post
{
    protected $table = 'posts';
    private $id;
    private $title;
    private $content;
    private $authorId;
    private $authorName;
    private $statusId;
    private $statusName;
    private $categoryId;
    private $categoryName;
    private $img;

    public static function all(): array
    {
        $dbh = (new Connection())->getHandler();

        $allPosts  = $dbh->query("select posts.id, posts.title, posts.content, posts.author_id, authors.name as author,  
                                           posts.status_id, statuses.name as status, posts.category_id, categories.name as category, posts.img 
                                           from authors 
                                           join posts 
                                           on authors.id=posts.author_id
                                           join categories
                                           on posts.category_id=categories.id
                                           join statuses
                                           on statuses.id=posts.status_id");

        $initialAllPosts = $allPosts->fetchAll();

        return array_map(function ($initialAllPost) {

            $post = new self;

            $post->setId($initialAllPost['id']);
            $post->setTitle($initialAllPost['title']);
            $post->setContent($initialAllPost['content']);
            $post->setAuthorId($initialAllPost['author_id']);
            $post->setAuthorName($initialAllPost['author']);
            $post->setStatusID($initialAllPost['status_id']);
            $post->setStatusName($initialAllPost['status']);
            $post->setCategoryId($initialAllPost['category_id']);
            $post->setCategoryName($initialAllPost['category']);
            $post->setImg($initialAllPost['img']);

            return $post;

        }, $initialAllPosts);
    }


    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getTable(): string
    {
        return $this->table;
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

    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }

    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function setStatusName(string $statusName): void
    {
        $this->statusName = $statusName;
    }

    public function getStatusName()
    {
        return $this->statusName;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function passGetImage()
    {

        return "{$this->getImg()}";

    }

    //- контент обрезать до 200 символов и в конце добавить "..."
    public function shortContent(int $maxSymbol): string
    {
        if (mb_strlen($this->getContent()) > $maxSymbol) {
            return mb_substr($this->getContent(), 0, $maxSymbol-1) . '…';
        } else {
            return $this->getContent();
        }
    }

    //- в атрибут alt картинки вставить строку - имя файла , т.е прогнать ссылку картинки через функцию, которая
    //на выходе сделает - picture.png или name.jpg
    public function altImg(): string
    {
        //ltrim (,'/') - удалить первый слеш
        //strrchr - найти последнее вхождение '/'
        return ltrim(strrchr($this->getImg(),'/'),'/');
    }

    //- сделать отображение автора в сокращенном варианте (Фамилия И.)
    function getShortAuthorName(): string
    {
        $arr = explode(' ', $this->getAuthorName());
        $shortName = $arr[0].' '.mb_strtoupper(mb_substr($arr[1], 0,1)).'.';

        return $shortName;
    }

    private function rusToTranslit($string)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        );

        return strtr($string, $converter);
    }

    //- написать функцию slug(). которая принимает строку и переводит ее в нижний регистр, если есть
    //русские слова то должна сделать транслит, вместо пробелов "-". На выходе должно получаться "privet-mir"
    public function slug(string $input): string
    {
        $output = mb_strtolower(trim($input)); // в нижний регистр
        $output = $this->rusToTranslit($output); // переводим в транслит
        $output = preg_replace('~[^-a-z0-9_]+~u', '-', $output);

        return $output.'.html';
    }

}
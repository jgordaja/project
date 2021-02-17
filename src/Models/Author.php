<?php

namespace It20Academy\App\Models;

use It20Academy\App\Core\Connection;

class Author
{
    private $id;
    private $name;

    public static function all(): array
    {
        $dbh = (new Connection())->getHandler();
        $statement  = $dbh->query('select * from authors');
        $initialAuthors = $statement->fetchAll();

        return array_map(function ($initialAuthor) {

            $author = new self;

            $author->setId($initialAuthor['id']);
            $author->setName($initialAuthor['name']);

            return $author;

        }, $initialAuthors);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

}
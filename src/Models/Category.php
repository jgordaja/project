<?php

namespace It20Academy\App\Models;

use It20Academy\App\Core\Db;

class Category
{
    private $id;
    private $name;

    public static function all(): array
    {
        $dbh = (new Db())->getHandler();
        $statement  = $dbh->query('select * from categories');
        $initialCategories = $statement->fetchAll();

        return array_map(function ($initialCategory) {

            $category = new self;

            $category->setId($initialCategory['id']);
            $category->setName($initialCategory['name']);

            return $category;

        }, $initialCategories);
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
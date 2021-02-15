<?php

namespace It20Academy\App\Models;

use It20Academy\App\Core\Db;

class Status
{
    private $id;
    private $name;

    public static function all(): array
    {
        $dbh = (new Db())->getHandler();
        $statement  = $dbh->query('select * from statuses');
        $initialStatuses = $statement->fetchAll();

        return array_map(function ($initialStatus) {

            $status = new self;

            $status->setId($initialStatus['id']);
            $status->setName($initialStatus['name']);

            return $status;

        }, $initialStatuses);
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
<?php

namespace It20Academy\App\Core;

use PDO;

class Db
{
    private PDO $handler;

    public function __construct()
    {
        $config = new Config();
        $dbConfig = $config->get('db');

//        $host = '127.0.0.1';
//        $db   = 'test';
//        $user = 'root';
//        $pass = 'root';
//        $charset = 'utf8';

        //$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false, //отключение режима эмуляции. чтобы данные не переводились в строки
        ];

        //$pdo = new PDO($dsn, $user, $pass, $opt);
        $this->handler = new PDO($dsn, $dbConfig['user'], $dbConfig['password'], $opt);
    }

    public function getHandler(): PDO
    {
        return $this->handler;
    }
}
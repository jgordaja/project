<?php

namespace It20Academy\App\Controllers;

use It20Academy\App\Core\Config;
use It20Academy\App\Core\Connection;
use It20Academy\App\Core\View;
use It20Academy\App\Models\Author;
use It20Academy\App\Models\Category;
use It20Academy\App\Models\Status;
use It20Academy\App\Models\TablePosts;
use It20Academy\App\Models\Post;

class PostsController
{
    public function index()
    {
        $posts = TablePosts::all();

        echo View::render('posts-index', compact('posts'));// ['posts' =>[]]

    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $statuses = Status::all();
        $posts = Post::all();

        echo View::render('posts-create', compact('authors', 'categories','statuses','posts'));
    }

    public function store()
    {
        $config = new Config();
        $uploadsConfig = $config->get('uploads');

        //Определяем место сохранения загруженного файла и его имя

        //$destination = __DIR__ . './../../storage/uploads';//было
        $destination = __DIR__ . "{$uploadsConfig['path']}";

//__DIR__ //"C:\OpenServer\domains\project\src\Controllers"
dump($destination); //"C:\OpenServer\domains\project\src\Controllers./../../storage/uploads"
dump($_FILES);
//array:1 [▼
//  "img" => array:5 [▼
//    "name" => "front-z-400.jpg"
//    "type" => "image/jpeg"
//    "tmp_name" => "C:\OpenServer\userdata\php_upload\php438A.tmp"
//    "error" => 0
//    "size" => 18636
//  ]
//]

        $fileTempName = $_FILES['img']['tmp_name'];//

        if (is_uploaded_file($fileTempName)) {
            //Проверяем тип файла и меняем его имя в соответствии

            $name = ltrim(strrchr($fileTempName, '\\'),'\\'). "_{$_FILES['img']['name']}";
            $newFilename = $destination .'/user';

            switch ($_FILES['img']['type']) {

                case 'image/jpeg':
                case 'image/png':
                    $newFilename .= "-{$name}";
                    break;

                default:
                    echo 'Файл неподдерживаемого типа';
                    exit;
            }

            //Перемещаем файл из временной папки в указанную
            if (move_uploaded_file($fileTempName, $newFilename)) {
                echo 'Файл сохранен под именем '. $newFilename;
                //Файл сохранен под именем
                // C:\OpenServer\domains\project\src\Controllers./../../storage/uploads/user-phpA2F4.tmp_front-z-400.jpg

            } else {
                echo 'Не удалось осуществить сохранение файла';
            }
        } else {
            echo 'Файл не был загружен на сервер';
        }

        $_POST["img"] = $newFilename;

dump($_POST);
//array:6 [▼
//  "title" => "tythjkn"
//  "content" => "rtygujk"
//  "author_id" => "1"
//  "status_id" => "1"
//  "category_id" => "2"
//  "img" => "C:\OpenServer\domains\project\src\Controllers./../../storage/uploads/user-php4132.tmp_front-z-400.jpg"
//]

        $dbh = (new Connection())->getHandler();

        $values = array();

        function pdoSet($allowed, &$values, $source = array()) {
            $set = '';
            $values = array();
            if (!$source) $source = &$_POST;
            foreach ($allowed as $field) {
                if (isset($source[$field])) {
                    $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
                    $values[$field] = $source[$field];
                }
            }
            return substr($set, 0, -2);
        }
dump($values);

        $allowed = array("title","content","author_id", "status_id", "category_id", "img"); // allowed fields

        $sql = "insert into posts set ".pdoSet($allowed,$values);
        $stm = $dbh->prepare($sql);
        $stm->execute($values);

        $this->index();

    }


}
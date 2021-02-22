<?php

namespace It20Academy\App\Controllers;

use It20Academy\App\Core\Config;
use It20Academy\App\Core\Connection;
use It20Academy\App\Core\View;
use It20Academy\App\Models\Author;
use It20Academy\App\Models\Category;
use It20Academy\App\Models\Post;
use It20Academy\App\Models\Status;

class PostsController
{
    public function index()
    {
        $posts = Post::all();

        echo View::render('posts-index', compact('posts'));// ['posts' =>[]]

    }

    public function create()
    {

        $posts = Post::all();
        $authors = Author::all();
        $statuses = Status::all();
        $categories = Category::all();

        echo View::render('posts-create', compact('posts', 'categories', 'authors', 'statuses'));
    }

    public function store()
    {
        $config = new Config();
        $uploadsConfig = $config->get('uploads');

        //Определяем место сохранения загруженного файла и его имя
        $destination = "{$uploadsConfig['path']}";//'/uploads'

        $fileTempName = $_FILES['img']['tmp_name'];//
        $newFilename = "";

        if (is_uploaded_file($fileTempName)) {
            //Проверяем тип файла и меняем его имя в соответствии

            $name = "{$_FILES['img']['name']}";
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
            if (move_uploaded_file($fileTempName, "../public/$newFilename")) {
                echo 'Файл сохранен под именем '. $newFilename;
                //Файл сохранен под именем

            } else {
                echo "Не удалось осуществить сохранение файла";
                echo $newFilename; // /uploads/user-2.jpg
            }
        } else {
            echo 'Файл не был загружен на сервер';

        }

        $_POST["img"] = $newFilename;

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

        $allowed = array("title","content","author_id", "status_id", "category_id", "img"); // allowed fields

        $sql = "insert into posts set ".pdoSet($allowed,$values);
        $stm = $dbh->prepare($sql);
        $stm->execute($values);

        $this->index();

    }


}
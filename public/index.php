<?php

//phpinfo();
//dump($_SERVER);

require_once  '../vendor/autoload.php';

use \It20Academy\App\Core\App;

$app = new App();
$app->run();

/***
 *      ФАЙЛЫ
 *
***/

//Создайте файл 'test.txt' и запишите в него фразу 'Привет, мир!'.

/*$filename = '../storage/test.txt';

if (! file_exists($filename)) {
    echo 'Error!';
} else {
    $file = fopen($filename, 'a+');
    fwrite($file, 'Привет, мир!' . PHP_EOL);
    fclose($file);
}*/

//Считайте данные из файла 'test.txt' и выведите их на экран.

/*$file = fopen('../storage/test.txt', 'r');
$text = '';
while (!feof($file)) {
    $text .= fread($file, 1);
}
fclose($file);
echo $text;*/

//Переименуйте файл 'test.txt' в 'mir.txt'.

//rename('../storage/test.txt', '../storage/mir.txt');

//Определите размер файла 'world.txt'. Выведите его на экран. Выведите его в байтах, мегабайтах, гигабайтах.

/*$filename = '../storage/world.txt';

$sizeB = filesize($filename);
$sizeMb = round ($sizeB/1024, 2);
$sizeGb = round($sizeMb/1024,6);

echo $sizeB , " B <br>";
echo $sizeMb , " MB <br>";
echo $sizeGb , " GB <br>";*/

//пример:

//если размер меньше 1 МБ, показать размер в КБ
//если он находится между 1 МБ - 1 ГБ, покажите его в МБ
//если больше - в ГБ

/*function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}*/

//Удалите файл 'world.txt'.

/*$fdel = '../storage/mir2.txt';

if (file_exists($fdel)) {
    unlink($fdel);
} else {
    echo 'Нет такого файла!';
}*/

//Проверьте существование файлов 'world.txt' и 'mir.txt'.

/*$f1 = '../storage/world.txt';
$f2 = '../storage/mir.txt';

if (file_exists($f1)) {
    echo 'Файл world.txt есть!';
} else {
    echo 'Нет такого файла!';
}
if (file_exists($f2)) {
    echo 'Файл mir.txt есть!';
} else {
    echo 'Нет такого файла!';
}*/

/*************************************************************************************************/

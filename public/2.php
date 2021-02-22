<?php
//Первое задание - cookie
//if (isset($_COOKIE['name'])) {
//    var_dump($_COOKIE);
//} else {
//    echo 'Exit';
//}

//Второе задание - сессии

session_start();
$_SESSION['userName']= $_POST['userName'];

if(isset($_SESSION['userName'])) {
    echo "<br>  Hello, {$_SESSION['userName']}";
} else {
    echo "<br>  Error!!!";
}

//Пример на экзамен
//define ('FOO', 10);
//$arr = [10=>FOO, 'FOO'=>20];
//var_dump('!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', $arr[$arr[FOO]] * $arr['FOO']);//200
?>

<br>
<a href="3.php">Выход</a>
<?php
//Первое задание - cookie
//http://project/1.php
//setcookie('name', 'my', time () + 20); //создание
//session_start();
?>
<?php
//Второе задание - сессии
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="2.php" enctype="multipart/form-data">
        <label>Введите имя</label>
        <input type="text" name="userName">
        <button>Submit</button>
    </form>
</body>
</html>
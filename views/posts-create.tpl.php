<?php

/**
 * @var array $data
 */
$posts = $data['posts'];
$authors = $data['authors'];
$categories = $data['categories'];
$statuses = $data['statuses'];
//dump($post);

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Добавление новости</title>
<!--    <link rel="stylesheet" href="css/main.css">-->
    <style>
        .center {
            box-sizing: border-box;
            display: block;
            width: 170px;
            margin: 10px auto;
        }
    </style>
</head>
<body>
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Follow on Twitter</a></li>
                        <li><a href="#" class="text-white">Like on Facebook</a></li>
                        <li><a href="#" class="text-white">Email me</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <strong>Album</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Добавление новой новости</h1>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <form method="POST" action="/posts" enctype="multipart/form-data" id="new-post-form">
<!--            <form method="POST" action="/posts/store" enctype="multipart/form-data" id="new-post-form" onsubmit="return validateForm()">-->
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Заголовок статьи</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="content" class="col-sm-2 col-form-label">Контент</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="content" name="content" style="height: 300px;"></textarea>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Автор</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio-author-name" id="radio-author-name1" value="author-name1">
<!--                            <input class="form-check-input" type="radio" name="radio-author-name1" id="radio-author-name1" value="author-name1" checked>-->
                            <label class="form-check-label" for="radio-author-name1">
                                Выбрать из существующих в базе
                            </label>
                            <select class="form-control" id="author-name1" name="author_id">
                                <?php foreach ($authors as $author): ?>
                                    <option><?php echo $author->getId(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input class="form-check-input" type="radio" name="radio-author-name" id="radio-author-name2" value="author-name2">
                            <label class="form-check-label" for="radio-author-name2">
                                Добавить автора
                            </label>
                            <input type="text" class="form-control" id="author-name2" name="author-name2" disabled>
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Статус новости</label>
                        <select id="status" name="status_id" class="form-select">
                            <?php foreach ($statuses as $status): ?>
                                <option><?php echo $status->getId(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Категория новости</label>
                        <select id="category" class="form-select" name="category_id">
                            <?php foreach ($categories as $category): ?>
                                <option><?php echo $category->getId(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Загрузить картинку</label>
<!--                    <input class="form-control" multiple type="file" id="formFile" name="file_name[]">-->
                    <input class="form-control" type="file" id="formFile" name="img">
                </div>
                <button type="submit" class="btn btn-primary center">Добавить</button>
            </form>

        </div>
    </div>
</main>
<footer class="text-muted py-5">
    <div class="container">
        <p class="float-end mb-1">
            <a href="#">Back to top</a>
        </p>
        <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.0/getting-started/introduction/">getting started guide</a>.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        function validateForm() {

            return true;

        }

    });
</script>
</body>
</html>
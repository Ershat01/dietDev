<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<?php require_once('../vendor/connect.php');
require_once('function.php');?>

<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset="utf-8">
    <title>Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/catalogStyle.css">

</head>
<body>

<header class="header">
    <div class="container">

        <a href="/" title="Курсы">
            <img class="logo" src="../assets/images/logo.svg" alt="Logo">
        </a>
             <div class="header-right">
                  <form name="search-form" method="post" action="search.php">
                      <input type="search" name="query" placeholder="Поиск" class="search-input">
                      <button type="submit">Найти </button>
                  </form>
                  <form class="search-form">
                      <input type="text" name="search" value="" placeholder="Search" class="search-input">
                      <button><i class="fa fa-search search-i"></i></button>
                  </form>

            <button class="backTo" id="btn_go">На главную</button>
            <script>
                document.getElementById('btn_go').addEventListener('click', function () {
                    window.location.href = 'https://health.kz/profile.php';
                });
            </script>

        </div>
    </div>
</header>
<div class="menu">
    <div class="container menu__container">
        <div class="catalog">
            <div class="catalog__wrapper">
                <div class="catalog__header"><span>Категории</span><i class="fa fa-bars catalog__header-icon"></i></div>
                <ul class="catalog__list">
                    <li class="catalog__item">
                        <a href="/" class="catalog__link">
                            <img src="logos/heartLogo.png" alt="Сердце" class="catalog__link-img">
                            Сердце
                        </a>
                        <div class="catalog__subcatalog">
                            <a href="/" class="catalog__subcatalog-link">Курс №1</a>
                            <a href="/" class="catalog__subcatalog-link">Курс №2</a>
                        </div>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="logos/diabetLogo.png" alt="Сахар" class="catalog__link-img">Сахар</a>
                        <div class="catalog__subcatalog">
                            <a href="/" class="catalog__subcatalog-link">Курс №1</a>
                            <a href="/" class="catalog__subcatalog-link">Курс №2</a>
                        </div>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="logos/pressure.png" alt="Давление" class="catalog__link-img">Давление</a>
                        <div class="catalog__subcatalog">
                            <a href="/" class="catalog__subcatalog-link">Курс №1</a>
                            <a href="/" class="catalog__subcatalog-link">Курс №2 </a>
                        </div>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="logos/ozhirenie.png" alt="Ожирение" class="catalog__link-img">Ожирение</a>
                        <div class="catalog__subcatalog">
                            <a href="/" class="catalog__subcatalog-link">Курс №1</a>
                            <a href="/" class="catalog__subcatalog-link">Курс №2 </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>

<?php $courses = get_courses();?>
<?php foreach ($courses as $course): ?>

<div class="container products__container">
    <ul class="products products_row">
        <li class="product">
            <div class="product__inner">
                <div >
                    <img src = <?=$course['img'] ?> alt="   " class="image">
                </div>
                <p class="product__av">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <span><a class="titleLink" href="coursePage.php?post_id=<?=$course['id']?>">  <?=mb_substr($course['title'],0,45) .'...' ?></a></span>
                </p>

                <div class="product__info">

                    <p><?=mb_substr($course['content'],0,40) .'...' ?></p>
                </div>

                <form class="product__buy-form">
                    <input type="hidden">
                    <a class="product__submit" href="coursePage.php?post_id=<?=$course['id']?>">  Подробнее</a>

                </form>
            </div>
        </li>


    </ul>
</div>

<?php endforeach;?>

</body>
</html>

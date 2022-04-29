<?php
session_start();
if ($_SESSION['user']) {
    header('Location: profile.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/profileStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<!--header start-->
<header class="header">
    <div class="wrapper">

        <div class="header_wrapper">

            <div class="header_logo">
                <a href="/" class="header_logo-link">
                    <img class="header_logo-pic" src="assets/images/logo.svg" alt="logo"></img>

                </a>
            </div>

            <nav class="header_nav">
                <ul class="header_list">
                    <li class="header_item">
                        <a class="btn btn-outline-info btn-lg btn-block"  href="index.php" role="button"> Авторизация</a>
                        <a class="btn btn-outline-info btn-lg btn-block"  href="register.php" role="button"> Регистрация</a>

                    </li>
                </ul>
            </nav>

        </div>

    </div>
</header>

<!--header end-->

<!--main start-->
<main class="main">
    <section class="intro">
        <div class="wrapper">

            <h1 class="intro_title">

                <?= $_SESSION['user']['full_name'] ?>
            </h1>
            <p class="intro_subtitle">
                <?= $_SESSION['user']['email'] ?>
            </p>

            <form class="input-form">
                <fieldset class="input-form_wrap">
                    <p class="input-form_info">

                        <input type="text" class ="input-form_field" placeholder="Хотите пройти курс лечения?">
                        <a class="btn btn-outline-info btn-lg btn-block"  href="catalog/courses.php" role="button"> Перейти</a>

                    </p>

                </fieldset>

            </form>

        </div>
    </section>
    <!--main end-->




</main>
</body>
</html>
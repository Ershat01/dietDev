<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
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
                        <a class="btn btn-outline-info btn-lg btn-block"  href="vendor/logout.php" role="button"> Выход</a>

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
            <img src="<?= $_SESSION['user']['avatar'] ?>" class="photo-form" width="215"   height="152"alt="avatar">
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


            <section class="benefits">
                <div class="benefits_wrap">

                    <div class="benefits_cards">
                        <div class="benefits_card">
                            <div class="benefits_card-pic">
                                <img src="assets/images/idd.svg" alt="Вычисление дневной дозы инсулина" class="benefits-_card-thumb">
                            </div>
                            <h3 class="benefits_card-title">
                                Вычисление суточной дозы инсулина
                            </h3>
                            <p class="benefits_card-desc">
                                Для людей, страдающих от сахарного диабета
                            </p>
                            <a href="calculators/iddCalculator.php" class="benefits_card-more">
                                Вычислить
                            </a>
                        </div>
                        <div class="benefits_card">
                            <div class="benefits_card-pic">
                                <img src="assets/images/bmi.svg" alt="Калькулятор ИМТ" class="benefits-_card-thumb">
                            </div>
                            <h3 class="benefits_card-title">
                                Калькулятор ИМТ

                            </h3>
                            <p class="benefits_card-desc">
                                Калькулятор индекса массы тела
                            </p>
                            <a href="calculators/bmi.php" class="benefits_card-more">
                                Вычислить
                            </a>
                        </div>
                        <div class="benefits_card">
                            <div class="benefits_card-pic">
                                <img src="assets/images/course.svg" alt="Открыть список курсов" class="benefits-_card-thumb">
                            </div>
                            <h3 class="benefits_card-title">
                                Пройти курс лечения
                            </h3>
                            <p class="benefits_card-desc">
                                Пройдите нужный курс лечения
                            </p>
                            <a href="catalog/courses.php" class="benefits_card-more">
                                Пройти
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!--main end-->




</main>
</body>
</html>
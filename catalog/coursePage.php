<?php
require_once('../vendor/connect.php');
require_once('function.php');
?>

<?php
$post_id = $_GET['post_id'];
if(!is_numeric($post_id)) die('Что-то пошло не так...');
?>

<?php //получение массива данных
$course = get_course_by_id($post_id);
?>
<link rel="stylesheet" href="../assets/css/pageStyle.css">
<header class="header">
    <div class="container">

        <a href="/" title="Курсы">
            <img class="logo" src="../assets/images/logo.svg" alt="Logo">
        </a>
        <div class="header-right">

           <div> <a class="product__submit" href="courses.php">  Курсы лечения</a></div>
            <div><button class="backTo" id="btn_go">На главную</button>
            <script>
                document.getElementById('btn_go').addEventListener('click', function () {
                    window.location.href = 'https://health.kz/profile.php';
                });
            </script>
            </div>

        </div>
    </div>
</header>

<div class="menu">
    <div class="container menu__container">
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="page-header">
                <h1><?= $course['title']?></h1>
            </div>
            <hr>
            <div class="course-content">
                <img class="courseImg" align="left" ; src="<?=$course['img']?>" >
                <?= $course['content']?>
            </div>
        </div>
    </div>
</div>

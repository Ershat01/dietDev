<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<style type="text/css">

    .content {

        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: Montserrat, sans-serif;
        flex-direction: column;

    }

    form {
        display: flex;
        flex-direction: column;
        width: 400px;


    }

    input {
        margin: 10px 0;
        padding: 10px;
        border: unset;
        border-bottom: 2px solid #e3e3e3;
        outline: none;
    }

    input:hover {
        color: #4b1bcb
    }
    a{
        text-decoration: none;
        color: #a724ff;
    }
    a:hover{
        transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        color: rgb(50, 15, 164);
    }

</style>
<?php


function bmi_calculate($mass, $height, $unit) {
    $bmi = 0;
    if ($unit == "Metric") {
        //BMI = weight ÷/ ( height * height  )
        $bmi = ($mass / ($height * $height));
    }
    return round($bmi,2);
}

function idd($bmi,$height,$diabetDuration){
    $dailyDose = 0;
    $perfbmi = 0 ;
    if($bmi >=18.5 && $bmi<=24.9){
        $perfbmi = ($height*$height*18.5);
        if($diabetDuration <5){
            $dailyDose = $perfbmi *0.5;
        }
        if($diabetDuration >=5 && $diabetDuration<10){
            $dailyDose = $perfbmi *0.7;
        }
        if($diabetDuration>=10){
            $dailyDose=$perfbmi*0.9;
        }
    }
    if($bmi<=18.4 || $bmi>=25){
        if($diabetDuration <5){
            $dailyDose = $bmi *0.5;
        }
        if($diabetDuration >=5 && $diabetDuration<10){
            $dailyDose = $bmi *0.7;
        }
        if($diabetDuration>=10){
            $dailyDose=$bmi*0.9;
        }
    }
    return round($dailyDose,1);

}
function basalDose_calculate($dailyDose){
    $basalDose = $dailyDose*0.4;
    return round($basalDose,1);
}
if (isset($_POST["bmi_calculate_m"])) {
    $mass = $_POST["weight"];
    $height = $_POST["height"];
    $diabetDuration = $_POST["dur"];
    $bmi = bmi_calculate($mass, $height, "Metric");
    $dailyDose = idd($bmi,$height,$diabetDuration);
    $basalDose = basalDose_calculate($dailyDose);
}
$firsttext = "Ваша суточная доза инсулина : $dailyDose";
$secondtext = "Доза базального инсулина: $basalDose";
?>
<div class="content">
    Вычисление дозы инсулина в день
    <form method="post">
        <p> Ваш вес: <input type="text"  name="weight"  /> кг</p>
        <p> Ваш рост: <input type="text"  name="height"  /> м</p>
        <p> Длительность сахарного диабета : <input type="text"  name="dur"   /> год/лет</p>
        <input type="submit" name="bmi_calculate_m" value="Вычислить дозу инсулина" />
        <input  type="button" id="btn_go" value="Назад">
    </form>
    <script>
        document.getElementById('btn_go').addEventListener('click', function () {
            window.location.href = 'https://health.kz/profile.php';
        });
    </script>


    <?php if (!empty($_POST['bmi_calculate_m'])): ?>
    <div class="calculator_table">
        <p><?= $firsttext ?></p>
        <p><?=$secondtext?></p>

    </div>

    <p><a href="http://<?= $_SERVER['HTTP_HOST']; ?><?= $_SERVER['REQUEST_URI'] ?>">Посчитать
            заново</a></p>
    <?php endif; ?>
</div>

<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<?php

/* Feel free to modify the CSS and the texts below. - no problem at all. Just don't touch the PHP code or the specual codes which are surrounded with %% unless you know what you are doing. */
session_start();

$firsttext = "Ваш индекс массы тела %%BMI%%. Это означает что вас вес в  %%BMIMSG%% диапазоне.";

$normaltext = "Кажется, вы поддерживаете свой вес в норме. Так держать!";

$lowertext = "Ваш ИМТ ниже рекомендованного диапазона <strong>18.5</strong> to <strong>24.9</strong>. <br> Чтобы быть в пределах правильного диапазона для вашего роста, вы должны иметь вес между <strong>%%LOWERLIMIT%% фунтов</strong> / <strong>%%LOWERLIMITKG%% кг</strong> и <strong>%%UPPERLIMIT%% фунтов</strong> / <strong>%%UPPERLIMITKG%% кг</strong>";

$uppertext = "Ваш ИМТ выше рекомендованного диапазона <strong>18.5</strong> to <strong>24.9</strong>. <br>Чтобы быть в пределах правильного диапазона для вашего роста, вы должны иметь вес между  <strong>%%LOWERLIMIT%% фунтов</strong> / <strong>%%LOWERLIMITKG%% кг</strong> и <strong>%%UPPERLIMIT%% фунтов</strong> / <strong>%%UPPERLIMITKG%% кг</strong>";
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
if (!empty($_POST['calculator_ok'])) {
    // set vars in session
    foreach ($_POST as $key => $var) {
        $_SESSION['bmi_calc_' . $key] = $var;
    }

    if ($_POST['system'] == 'english') {
        $height = $_POST['height_ft_en'] * 12 + $_POST['height_in_en'];
        $bmi = ($_POST['weight_en'] * 703) / ($height * $height);
    } else {
        $height = $_POST['height_met'] / 100;
        $bmi = $_POST['weight_met'] / round(($height * $height), 2);
    }

    $bmi = number_format($bmi, 1, ".", "");

    // prepare message for the user
    if ($bmi <= 18.5) {
        $bmimsg = "низком";
    }

    if ($bmi > 18.5 and $bmi <= 24.9) {
        $bmimsg = "нормальном";
    }

    if ($bmi >= 25 and $bmi <= 29.9) {
        $bmimsg = "высоком";
    }

    if ($bmi >= 30) {
        $bmimsg = "критически высоком (ожирение)";
    }

    // what is the weight range?
    if ($bmimsg != 'нормальном') {
        if ($_POST['system'] == 'english') {
            $lowerlimit = number_format((18.5 * ($height * $height)) / 703);
            $lowerlimitkg = number_format($lowerlimit * 0.453, 1, ".", "");

            $upperlimit = number_format((24.9 * ($height * $height)) / 703);
            $upperlimitkg = number_format($upperlimit * 0.453, 1, ".", "");
        } else {
            $lowerlimit = number_format(18.5 * ($height * $height) * 2.204);
            $lowerlimitkg = number_format(18.5 * ($height * $height), 1, ".", "");

            $upperlimit = number_format(24.9 * ($height * $height) * 2.204);
            $upperlimitkg = number_format(24.9 * ($height * $height), 1, ".", "");
        }
    }

    //prepare texts
    $firsttext = str_replace("%%BMI%%", $bmi, $firsttext);
    $firsttext = str_replace("%%BMIMSG%%", $bmimsg, $firsttext);
    $lowertext = str_replace("%%LOWERLIMIT%%", $lowerlimit, $lowertext);
    $lowertext = str_replace("%%LOWERLIMITKG%%", $lowerlimitkg, $lowertext);
    $lowertext = str_replace("%%UPPERLIMIT%%", $upperlimit, $lowertext);
    $lowertext = str_replace("%%UPPERLIMITKG%%", $upperlimitkg, $lowertext);
    $uppertext = str_replace("%%LOWERLIMIT%%", $lowerlimit, $uppertext);
    $uppertext = str_replace("%%LOWERLIMITKG%%", $lowerlimitkg, $uppertext);
    $uppertext = str_replace("%%UPPERLIMIT%%", $upperlimit, $uppertext);
    $uppertext = str_replace("%%UPPERLIMITKG%%", $upperlimitkg, $uppertext);
}
?>

<div class="content">
    <title> Индекс массы тела</title>
    <h2> Индекс массы тела</h2>

    <form method="post">
        <div class="calculator_div">
            <div><input type="radio" value="english"
                        name="system" <?php if ($_SESSION['bmi_calc_system'] == "" or $_SESSION['bmi_calc_system'] == 'english') echo "checked='true'"; ?>
                        onclick="changeSystem('english');"> Английская( фунты, футы)
                &nbsp;
                <input type="radio" value="metric"
                       name="system" <?php if ($_SESSION['bmi_calc_system'] != '' and $_SESSION['bmi_calc_system'] == 'metric') echo "checked='true'"; ?>
                       onclick="changeSystem('metric');"> Метрическая
            </div>
            <div><label>Ваш вес:</label>
                <span id="englishWeight"
                      style="display:<?php echo ($_SESSION['bmi_calc_system'] == '' or $_SESSION['bmi_calc_system'] == 'english') ? 'block' : 'none' ?>;"><input
                            type="text" name="weight_en" size="6"
                            value="<?php echo !empty($_SESSION['bmi_calc_weight_en']) ? $_SESSION['bmi_calc_weight_en'] : "" ?>"> фунтов</span>
                <span id="metricWeight"
                      style="display:<?php echo (($_SESSION['bmi_calc_system'] == "" or $_SESSION['bmi_calc_system'] == 'english')) ? 'none' : 'block' ?>;"><input
                            type="text" name="weight_met" size="6"
                            value="<?php echo !empty($_SESSION['bmi_calc_weight_met']) ? $_SESSION['bmi_calc_weight_met'] : "" ?>"> кг</span>
            </div>
            <div><label>Ваш рост:</label>
                <span id="englishHeight"
                      style="display:<?php echo (($_SESSION['bmi_calc_system'] == '' or $_SESSION['bmi_calc_system'] == 'english')) ? 'block' : 'none' ?>;"><input
                            type="text" size="6" name="height_ft_en"
                            value="<?php echo !empty($_SESSION['bmi_calc_height_ft_en']) ? $_SESSION['bmi_calc_height_ft_en'] : "" ?>"> футов
            &nbsp; <input type="text" size="6" name="height_in_en"
                          value="<?php echo ($_SESSION['bmi_calc_height_in_en'] != '') ? $_SESSION['bmi_calc_height_in_en'] : "" ?>"> дюймов</span>
                <span id="metricHeight"
                      style="display:<?php echo ($_SESSION['bmi_calc_system'] == '' or $_SESSION['bmi_calc_system'] == 'english') ? 'none' : 'block' ?>;">
            <input type="text" name="height_met" size="6"
                   value="<?php echo ($_SESSION['bmi_calc_height_met'] != '') ? $_SESSION['bmi_calc_height_met'] : "" ?>"> см
            </span>
            </div>

                <input type="hidden" name="calculator_ok" value="ok">
                <input type="submit" value="Подтвердить">
                <input style="margin-left: 100px" type="button" id="btn_go" value="Назад">



            <script>
                document.getElementById('btn_go').addEventListener('click', function () {
                    window.location.href = 'https://health.kz/profile.php';
                });
            </script>

        </div>

</form>


<?php if (!empty($_POST['calculator_ok'])): ?>
    <div class="calculator_table">
        <p><?= $firsttext ?></p>
        <?php
        switch ($bmimsg) {
            case 'нормальном':

                break;

            case 'низком':
                echo $lowertext;
                break;

            default:
                echo $uppertext;
                break;
        }
        ?>

        <p align="center"><a href="http://<?= $_SERVER['HTTP_HOST']; ?><?= $_SERVER['REQUEST_URI'] ?>">Посчитать
                заново</a></p>
    </div>
</div>
<?php endif; ?>


<script type="text/javascript">
    function changeSystem(s) {
        if (s == 'english') {
            document.getElementById('englishWeight').style.display = 'block';
            document.getElementById('englishHeight').style.display = 'block';
            document.getElementById('metricWeight').style.display = 'none';
            document.getElementById('metricHeight').style.display = 'none';
        } else {
            document.getElementById('englishWeight').style.display = 'none';
            document.getElementById('englishHeight').style.display = 'none';
            document.getElementById('metricWeight').style.display = 'block';
            document.getElementById('metricHeight').style.display = 'block';
        }
    }
</script>
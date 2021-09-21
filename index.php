<?php
include "checker.php";

$start = microtime(true);
$res = false;
$x = null;
$y = null;
$r = null;
$end = null;

function startCheck()
{
    global $res;
    global $x;
    global $y;
    global $r;
    global $start;
    global $end;

    if (isset($_POST["x-change"]) && isset($_POST["y-change"]) && isset($_POST["r-change"])) {
        $x = $_POST["x-change"];
        $y = $_POST["y-change"];
        $r = $_POST["r-change"];

        if ($y > -3 && $y < 5) {
            $res = check($x, $y, $r);
            $end = round((microtime(true) - $start) * 1000000);

            return true;
        }
    }

    return false;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>LAB 1</title>
    <style>
        body {
            width: 100%;
            min-width: 740px;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 18px;
            line-height: 24px;
            color: #000000;
        }

        .container-main {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 10px;
        }

        .main-header {
            width: 100%;
            padding-top: 35px;
            padding-bottom: 30px;
            font-family: Arial, sans-serif;
            color: black;
            font-size: 18px;
        }

        .main-header::after {
            display: table;
            clear: both;
            content: "";
        }

        .logo {
            float: left;
        }

        .university-title {
            color: #1a46b3;
            float: right;
        }

        .lab-title {
            padding-top: 170px;
            text-align: center;
        }

        .lab-title ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .lab-title li {
            color: #1a46b3;
            font-size: 22px;
            line-height: 32px;
            font-weight: 600;
        }

        .container-program {
            width: 100%;
            max-width: 900px;
            border: 2px solid #2f9aff;
            border-radius: 15px;
            padding: 10px;
        }

        .program-parts {
            color: #536e7b;
        }

        .program-img {
            float: left;
            padding-left: 5%;
        }

        .area {
            width: 300px;
            height: 300px;
        }

        .x-interval,
        .y-interval,
        .r-interval,
        .buttons {
            float: right;
            padding-right: 5%;
            width: 350px;
            font-size: 18px;
            line-height: 10px;
        }

        .buttons,
        .cancel {
            padding-top: 20px;
        }

        .check {
            float: right;
            margin-right: 10px;
        }

        .clear {
            float: right;
        }

        .y-interval input[type="text"],
        .r-interval select {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 100%;
            padding: 5px 5px;
            font-weight: 400;
            font-size: 18px;
            font-family: Arial, sans-serif;
            outline: none;
            border: 2px solid #c4c4c4;
            border-radius: 6px;
            color: #536e7b;
        }

        .y-interval input[type="text"]:hover,
        .r-interval select:hover {
            border: 2px solid #212e35;
        }

        .y-interval input[type="text"]:focus,
        .r-interval select:focus {
            border: 2px solid #3647ac;
            color: #3647ac;
        }

        .btn {
            display: inline-block;
            padding: 10px;
            font-size: 16px;
            line-height: 24px;
            vertical-align: top;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            color: #ffffff;
            cursor: pointer;
            outline: none;
            border: 0px solid #ffffff;
            border-radius: 6px;
            width: 170px;
        }

        .btn {
            background: #2f9aff;
        }

        .btn:hover {
            background: #1a46b3;
        }

        .btn:active {
            background: #1a46b3;
            color: #2fb9ff;
        }

        .program-parts::after {
            display: table;
            clear: both;
            content: "";
        }

        .container-result {
            width: 100%;
            padding-top: 30px;
            text-align: center;
            max-width: 850px;
            color: #536e7b;
        }

        .result-title,
        .last-results-title {
            font-size: 24px;
            line-height: 24px;
            padding-bottom: 10px;
        }

        .last-results-title {
            padding-top: 35px;
        }

        #result-table,
        #last-results-table {
            border-collapse: collapse;
            margin: auto;
        }

        .result-key,
        .result-value,
        .last-results-key {
            margin-right: 18px;
            font-size: 18px;
            line-height: 24px;
        }

        td,
        th {
            padding: 3px;
            border: 0.8px solid #2f9aff;
        }

        td div,
        th div {
            min-height: 24px;
            width: 100%;
            text-align: center;
            vertical-align: center;
        }

        .main-footer {
            padding-bottom: 35px;
        }

    </style>
</head>
<body>
<header class="main-header">
    <div class="container-main">
        <div class="logo">
            <img src="img/logo.jpg" width="150" height="150" alt="ИТМО ВТ">
        </div>
        <div class="university-title">
            <h1>Университет ИТМО</h1>
        </div>
        <div class="lab-title">
            <ul>
                <li>Карапетян Эрик Акопович P3215</li>
                <li>Вариант 15010</li>
                <li id="clock">00:00:00</li>
            </ul>
        </div>
    </div>
</header>

<section class="program">
    <div class="container-main container-program">
        <div class="program-parts">
            <div class="program-img">
                <img class="area" src="img/areas.png" alt="Визуализация">
            </div>
            <form id="main-form" action="index.php" onsubmit="return validate()" method="post">
                <div class="x-interval">
                    <p id="x-title">Выберите координату X:</p>
                    <label><input type="radio" id="-5" name="x-change" value="-5">-5</label>
                    <label><input type="radio" id="-4" name="x-change" value="-4">-4</label>
                    <label><input type="radio" id="-3" name="x-change" value="-3">-3</label>
                    <label><input type="radio" id="-2" name="x-change" value="-2">-2</label>
                    <label><input type="radio" id="-1" name="x-change" value="-1">-1</label>
                    <label><input type="radio" id="0" name="x-change" value="0">0</label>
                    <label><input type="radio" id="1" name="x-change" value="1">1</label>
                    <label><input type="radio" id="2" name="x-change" value="2">2</label>
                    <label><input type="radio" id="3" name="x-change" value="3">3</label>
                </div>
                <div class="y-interval">
                    <p id="y-title">Введите координату Y:</p>
                    <input type="text" id="y-change" name="y-change" placeholder="Число в диапазоне (-3 ... 5)"
                           oninput="onInputYCheck()">
                </div>
                <div class="r-interval">
                    <p id="r-title">Выберите параметр R:</p>
                    <select name="r-change">
                        <option>1</option>
                        <option>1.5</option>
                        <option>2</option>
                        <option>2.5</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="buttons">
                    <div class="clear">
                        <input type="button" id="btn-clear" class="btn btn-clear" value="Очистить">
                    </div>
                    <div class="check">
                        <input type="submit" class="btn btn-check" value="Проверить точку">
                    </div>
                </div>
            </form>
        </div>

        <?php
        if (startCheck()) {
            echo <<<HTML
<div class="container-main container-result">
    <div class="current-result">
        <div class="result-title">Результат:</div>
        <table id="result-table">
            <tr>
                <th>
                    <div class="result-key"><span>Координата X:</span></div>
                </th>
                <th>
                    <div class="result-key">Координата Y:</div>
                </th>
                <th>
                    <div class="result-key">Параметр R:</div>
                </th>
                <th>
                    <div class="result-key">Попала:</div>
                </th>
                <th>
                    <div class="result-key">Время выполнения скрипта:</div>
                </th>
            </tr>
            <tr>
                <td>
                    <div class="result-value">
HTML;
            echo $x;
            echo <<<HTML
                    </div>
                </td>
                <td>
                    <div class="result-value">
HTML;
            echo $y;
            echo <<<HTML
                    </div>
                </td>
                <td>
                    <div class="result-value">
HTML;
            echo $r;
            echo <<<HTML
                    </div>
                </td>
                <td>
                    <div class="result-value">
HTML;
            if ($res) {
                echo "Да";
            } else {
                echo "Нет";
            }
            echo <<<HTML
                    </div>
                </td>
                <td>
                    <div class="result-value">
HTML;
            echo $end . " мкс";
            echo <<<HTML
                    </div>
                </td>
            </tr>
        </table>
    </div>
HTML;
            if (isset($_POST["savedRequests"]) && !(isset($_POST["clear"]))) {
                echo <<<HTML
<div class="last-results">
        <div class="last-results-title">Прошлые результаты:</div>
        <table id="last-results-table">
            <tr>
                <th>
                    <div class="last-results-key"><span>Координата X:</span></div>
                </th>
                <th>
                    <div class="last-results-key">Координата Y:</div>
                </th>
                <th>
                    <div class="last-results-key">Параметр R:</div>
                </th>
                <th>
                    <div class="last-results-key">Попала:</div>
                </th>
                <th>
                    <div class="last-results-key">Время выполнения скрипта:</div>
                </th>
            </tr>
HTML;
                $savedRequests = $_POST["savedRequests"];
                $savedRequests = explode(";", $savedRequests);
                for ($i = 0; $i < count($savedRequests); $i++) {
                    $parameters = explode(",", $savedRequests[$i]);
                    echo "<tr class='request'>";
                    for ($j = 0; $j < count($parameters); $j++) {
                        echo "<td class='parameter'>$parameters[$j]</td>";
                    }
                    echo "</tr>";
                }
                echo <<<HTML
        </table>
    </div>
</div>
HTML;
            }
        }
        ?>
    </div>
</section>

<footer class="main-footer">
    <div class="container-main">

    </div>
</footer>

<script src="js/script.js"></script>
</body>
</html>
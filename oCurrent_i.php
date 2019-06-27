<?php require_once 'connection.php'; ?>
<?php session_start(); ?>
<?php mysqli_query($link, "set names 'utf8'"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Текущие доходы</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <form method="post">


        <section class="home">

            <div id="fon3">
                <h3 align="center">Отчет по текущим доходам. </h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="otch.php" class="button7">Назад</a>

                </p>
                <?php

                if (isset($_POST["searchbatton"])) {
                    if (isset($_POST["date_from"]) and isset($_POST["date_to"])) {

                        $startDate = htmlentities(mysqli_real_escape_string($link, $_POST['date_from']));
                        $endDate = htmlentities(mysqli_real_escape_string($link, $_POST['date_to']));


                        $sql = mysqli_query($link, "SELECT c.id_income, f.full_name, c.date_i, s.s_name, c.sum_i 
                   FROM current_i c 
                   LEFT JOIN family f ON c.id_family = f.id_family
                   LEFT JOIN sources_i s ON c.id_sources = s.id_sources 
                   WHERE c.date_i between STR_TO_DATE('$startDate','%Y-%m-%d') AND STR_TO_DATE('$endDate','%Y-%m-%d')");

                        $numrows = mysqli_num_rows($sql);


                        if ($numrows != 0) {
                            if ($sql) {
                                echo '<table class="bordered" align = "center" cellspacing="0">';
                                echo '<thead>';
                                echo "<tr><th>Код дохода</th><th>ФИО</th><th>Дата</th><th>Источник дохода</th><th>Сумма</th></tr>";
                                echo '</thead>';
                                while ($data = mysqli_fetch_array($sql)) {
                                    echo "
                                        <tr>
                                        <td>{$data['id_income']}</td>
                                        <td>{$data['full_name']}</td>
                                        <td>{$data['date_i']}</td>
                                        <td>{$data['s_name']}</td>
                                        <td>{$data['sum_i']}</td>
                                        </tr>";
                                }
                                echo "</table>";
                            }
                        } else {
                            echo '<p align = "center">Совпадение не найдено!</p>';
                        }
                    } else {
                        echo '<p align = "center">Введите обе даты!</p>';
                    }
                }
                ?>
                <div align="center">
                    <form action="" method="post">

                        <p>Дата от:</p>
                        <p><input type="date" name="date_from" value=""></p>
                        <p>Дата до:</p>
                        <p><input type="date" name="date_to" value=""></p>

                        <p colspan="2"><input class="button8" type="submit" name="searchbatton" value="Искать"></p>
                    </form>
    </form>
    </div>

    </div>

    </section>
    </form>
</body>

</html>
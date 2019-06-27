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
                <h3 align="center">Поиск по текущим доходам. </h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="current_i.php" class="button7">Назад к таблице</a>

                </p>
                <div align="center">
                    <form action="" method="post">
                        <table align="center" class="frm_block">
                            <tr>
                                <td>
                                    <p>ФИО:</p>
                                    <p><?php
                                        $sql = "SELECT id_family, full_name FROM `family`";
                                        $result = mysqli_query($link, $sql);
                                        echo '<select name="id_family">';
                                        while ($result1 = mysqli_fetch_array($result)) {
                                            echo ' <option value="' . $result1['id_family'] . '">' . $result1['full_name'] . '</option>'; // в значение записывмем ид а выводиться его имя
                                        }
                                        echo '</select>';
                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <p>Дата:</p>
                                    <p><input type="date" name="date_i" value=""></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Источник дохода:</p>
                                    <p><?php
                                        $sql = "SELECT id_sources, s_name FROM `sources_i`";
                                        $result = mysqli_query($link, $sql);

                                        echo '<select name="id_sources">';
                                        while ($result1 = mysqli_fetch_array($result)) {
                                            echo ' <option value="' . $result1['id_sources'] . '">' . $result1['s_name'] . '</option>'; // в значение записывмем ид а выводиться его имя
                                        }
                                        echo '</select>';
                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <p>Сумма:</p>
                                    <p><input type="text" name="sum_i" value=""></p>
                                </td>
                            </tr>
                        </table>

                        <p colspan="2"><input class="button8" type="submit" name="searchbatton" value="Искать"></p>
                    </form>
                </div>
                <?php

                if (isset($_POST["searchbatton"])) {
                    if (isset($_POST["id_family"]) or isset($_POST["date_i"]) or isset($_POST["id_sources"]) or isset($_POST["sum_i"])) {
                        $id_family = htmlentities(mysqli_real_escape_string($link, $_POST['id_family']));
                        $date_i = htmlentities(mysqli_real_escape_string($link, $_POST['date_i']));
                        $id_sources = htmlentities(mysqli_real_escape_string($link, $_POST['id_sources']));
                        $sum_i = htmlentities(mysqli_real_escape_string($link, $_POST['sum_i']));

                        $sql = mysqli_query(
                            $link,
                            "SELECT c.id_income, f.full_name, c.date_i, s.s_name, c.sum_i 
                        FROM current_i c 
                        LEFT JOIN family f ON c.id_family = f.id_family
                        LEFT JOIN sources_i s ON c.id_sources = s.id_sources 
                        WHERE  c.id_family = $id_family and c.date_i like '%" . $date_i . "%' 
                        and c.id_sources like '%" . $id_sources . "%' and c.sum_i like '%" . $sum_i . "%'"
                        );

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
                        echo '<p align = "center">Совпадение не найдено!</p>';
                    }
                }
                ?>

            </div>
        </section>
    </form>
</body>

</html>
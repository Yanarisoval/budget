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

            <div id="fon2">
                <h3 align="center">Добавление новой записи в текущие доходы. </h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="current_i.php" class="button7">Назад к таблице</a>

                </p>

                <?php
                if (isset($_POST["id_family"])) {
                    if ((strlen($_POST['sum_i']) >= 2 && strlen($_POST['sum_i']) <= 30)) {
                        if ((preg_match("/^[0-9.]+$/iu", $_POST['sum_i']))) {
                            $id_family = htmlentities(mysqli_real_escape_string($link, $_POST['id_family']));
                            $date_i = htmlentities(mysqli_real_escape_string($link, $_POST['date_i']));
                            $id_sources = htmlentities(mysqli_real_escape_string($link, $_POST['id_sources']));
                            $sum_i = htmlentities(mysqli_real_escape_string($link, $_POST['sum_i']));
                            $sql = mysqli_query($link, "INSERT INTO `current_i` (`id_family`, `date_i`, `id_sources`, `sum_i`) VALUES ('$id_family', '$date_i', '$id_sources', '$sum_i')");
                            //Если вставка прошла успешно
                            if ($sql) {
                                echo '<p align = "center">Успешно!</p>';
                            } else {
                                echo '<p align = "center">Произошла ошибка: ' . mysqli_error($link) . '</p>';
                            }
                        } else {
                            echo '<p align = "center">Поля заполнены некоррекно!</p>';
                        }
                    } else {
                        echo '<p align = "center">Поля заполнены некоррекно!</p>';
                    }
                }
                ?>
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
                        <p colspan="2"><input class="button8" type="submit" value="Добавить"></p>
                    </form>
                </div>

            </div>

        </section>
    </form>
</body>

</html>
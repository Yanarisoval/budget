<?php require_once 'connection.php'; ?>
<?php session_start(); ?>
<?php mysqli_query($link, "set names 'utf8'"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Текущие расходы</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="post">


        <section class="home">

            <div id="fon2">
                <h3 align="center">Изменить данные. </h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="current_e.php" class="button7">Назад к таблице</a>

                </p>
                <?php
                // если запрос POST 
                if (isset($_POST['id_family'])) {
                    $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit']));
                    $id_family = htmlentities(mysqli_real_escape_string($link, $_POST['id_family']));
                    $date_c = htmlentities(mysqli_real_escape_string($link, $_POST['date_c']));
                    $id_expenditure = htmlentities(mysqli_real_escape_string($link, $_POST['id_expenditure']));
                    $sum_c = htmlentities(mysqli_real_escape_string($link, $_POST['sum_c']));

                    $query = "UPDATE current_e SET id_family = '$id_family', `date_c`='$date_c',
                             id_expenditure = '$id_expenditure', sum_c = '$sum_c' WHERE id_costs={$_GET['edit']} ";
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

                    if ($result) {
                        echo "<script>alert('Данные обновлены')</script>";
                        // тут желательно редирект сделать на таблицу
                        echo '<script>location.replace("current_e.php");</script>';
                        //так вот редирект
                    }
                }

                // если запрос GET
                if (isset($_GET['edit'])) {
                    $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit']));
                    // создание строки запроса
                    $query = "SELECT * FROM `current_e` WHERE id_costs = $id";
                    // выполняем запрос
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                    //если в запросе более нуля строк
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_row($result); // получаем первую строку


                        $id_family = $row[1];
                        $date_c = $row[2];
                        $id_expenditure = $row[3];
                        $sum_c = $row[4];

                        echo "<div align = 'center'>
                        <form method='POST'>
                        <input type='hidden' name='id_costs' value='$id'>

                        <p><label >ФИО:<br></label></p><p>";
                        $sql = "SELECT id_family, full_name FROM `family`";
                        $result = mysqli_query($link, $sql);
                        echo '<select name="id_family">';
                        while ($result1 = mysqli_fetch_array($result)) {
                            echo ' <option value="' . $result1['id_family'] . '">' . $result1['full_name'] . '</option>'; // в значение записывмем ид а выводиться его имя
                        }
                        echo " <option selected value={$id_family}>{$id_family}</option>";
                        echo '</select>';

                        echo "</p><p><label >Дата:<br></label></p><p>                    
                        <input  name='date_c' type='date' value='$date_c'>";

                        echo "<p><label >Статья расхода:<br></label></p><p>";
                        $sql = "SELECT id_expenditure, e_name FROM `expenditure`";
                        $result = mysqli_query($link, $sql);
                        echo '<select name="id_expenditure">';
                        while ($result1 = mysqli_fetch_array($result)) {
                            echo ' <option value="' . $result1['id_expenditure'] . '">' . $result1['e_name'] . '</option>'; // в значение записывмем ид а выводиться его имя
                        }
                        echo " <option selected value={$id_expenditure}>{$id_expenditure}</option>";
                        echo '</select>';

                        echo "<p><label >Сумма:<br></label></p>
                        <input  name='sum_c' type='text' value='$sum_c'>
                        <p><input class='button8' type='submit' value='Сохранить'></p></div>";
                        mysqli_free_result($result);
                    }
                }
                // закрываем подключение
                mysqli_close($link);
                ?>

        </section>
    </form>
</body>

</html>
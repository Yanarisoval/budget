<?php require_once 'connection.php'; ?>
<?php session_start(); ?>
<?php mysqli_query($link, "set names 'utf8'"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Члены семьи</title>

    <link rel="stylesheet" href="css/style.css">


</head>

<body>
    <form method="post">

        <section class="home">

            <div id="fon2">
                <h3 align="center">Изменить данные. </h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="family.php" class="button7">Назад к таблице</a>

                </p>
                <?php
                // если запрос POST 
                if (isset($_POST['id_family'])) {

                    $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit']));
                    $full_name = htmlentities(mysqli_real_escape_string($link, $_POST['full_name']));
                    $date_b = htmlentities(mysqli_real_escape_string($link, $_POST['date_b']));

                    $query = "UPDATE family SET full_name = '$full_name', date_b = '$date_b' WHERE id_family={$_GET['edit']} ";
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

                    if ($result) {
                        echo "<script>alert('Данные обновлены')</script>";
                        // тут желательно редирект сделать на таблицу
                        echo '<script>location.replace("family.php");</script>';
                        //так вот редирект
                    }
                }

                // если запрос GET
                if (isset($_GET['edit'])) {
                    $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit']));
                    // создание строки запроса
                    $query = "SELECT * FROM `family` WHERE id_family = $id";
                    // выполняем запрос
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                    //если в запросе более нуля строк
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_row($result); // получаем первую строку

                        $id_family = $row[0];
                        $full_name = $row[1];
                        $date_b = $row[2];

                        echo "<div align = 'center'>
                        <form method='POST'>
                        <input type='hidden' name='id_family' value='$id'>";
                        echo "<p><label>ФИО:<br></label></p><input  name='full_name' type='text' value='$full_name'>";

                        echo "<p><label>День рождения:<br></label></p>                     
                        <input  name='date_b' type='date' value='$date_b'>
                        <p> <input class='button8' type='submit' value='Сохранить'></p></div>";

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
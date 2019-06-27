<?php require_once 'connection.php'; ?>
<?php session_start(); ?>
<?php mysqli_query($link, "set names 'utf8'"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Статьи расходов</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="post">

        <section class="home">

            <div id="fon2">
                <h3 align="center">Изменить данные. </h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="expenditure.php" class="button7">Назад к таблице</a>

                </p>
                <?php
                // если запрос POST 
                if (isset($_POST['id_expenditure'])) {

                    $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit']));
                    $e_name = htmlentities(mysqli_real_escape_string($link, $_POST['e_name']));


                    $query = "UPDATE expenditure SET e_name = '$e_name' WHERE id_expenditure={$_GET['edit']} ";
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

                    if ($result) {
                        echo "<script>alert('Данные обновлены')</script>";
                        // тут желательно редирект сделать на таблицу
                        echo '<script>location.replace("expenditure.php");</script>';
                        //так вот редирект
                    }
                }

                // если запрос GET
                if (isset($_GET['edit'])) {
                    $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit']));
                    // создание строки запроса
                    $query = "SELECT * FROM `expenditure` WHERE id_expenditure = $id";
                    // выполняем запрос
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                    //если в запросе более нуля строк
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_row($result); // получаем первую строку

                        $id_expenditure = $row[0];
                        $e_name = $row[1];



                        echo "<div align = 'center'>
                        <form method='POST'>
                        <input type='hidden' name='id_expenditure' value='$id'>";

                        echo "</p><p><label >Название статьи расхода:<br></label></p>                     
                        <input  name='e_name' type='text' value='$e_name'>
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
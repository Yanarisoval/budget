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

            <div id="fon4">
                <h3 align="center">Члены семьи</h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>

                </p>
                <?php
                if (isset($_POST["full_name"])) {

                    $full_name = htmlentities(mysqli_real_escape_string($link, $_POST['full_name']));
                    $date_b = htmlentities(mysqli_real_escape_string($link, $_POST['date_b']));
                    $sql = mysqli_query($link, "INSERT INTO `family` (`full_name`, `date_b`) VALUES ('$full_name', '$date_b')");
                    //Если вставка прошла успешно
                    if ($sql) {
                        echo '<p align = "center">Успешно!</p>';
                    } else {
                        echo '<p align = "center">Произошла ошибка: ' . mysqli_error($link) . '</p>';
                    }
                }
                ?>
                <div align="center">
                    <form action="" method="post">
                        <p>ФИО:
                            <input type="text" name="full_name" value="">
                            Дата рождения:<input type="date" name="date_b" value="">
                            <input class="button8" type="submit" value="Добавить">
                        </p>
                    </form>
                </div>
                <?php
                mysqli_query($link, "set names 'utf8'");

                echo '<table class="bordered" align = "center" cellspacing="0">';
                echo '<thead>';
                echo "<tr><th>Код члена семьи</th><th>ФИО</th><th>Дата рождения</th></tr>";
                echo '</thead>';
                $sql = mysqli_query($link, "SELECT * FROM family ;");

                while ($data = mysqli_fetch_array($sql)) {
                    echo "
		        <tbody>
		        <tr>
		        <td>{$data['id_family']}</td>
                <td>{$data['full_name']}</td>
                <td>{$data['date_b']}</td>
                <td>
                <a href='editFamily.php?edit={$data['id_family']}'>Редактировать</a></td>
                </tr>
		        </tbody>";
                }
                echo "</table>";
                ?>

            </div>

        </section>
    </form>
</body>

</html>
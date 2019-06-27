<?php require_once 'connection.php'; ?>
<?php session_start(); ?>
<?php mysqli_query($link, "set names 'utf8'"); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Источники доходов</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <form method="post">

        <section class="home">

            <div id="fon4">
                <h3 align="center">Источники доходов</h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                </p>
                <?php
                if (isset($_POST["s_name"])) {
                    if ((preg_match("/^[a-zA-Zа-яА-Я_ -]+$/iu", $_POST['s_name']))) {
                        $s_name = htmlentities(mysqli_real_escape_string($link, $_POST['s_name']));

                        $sql = mysqli_query($link, "INSERT INTO `sources_i` (`s_name`) VALUES ('$s_name')");
                        //Если вставка прошла успешно
                        if ($sql) {
                            echo '<p align = "center">Успешно!</p>';
                        } else {
                            echo '<p align = "center">Произошла ошибка: ' . mysqli_error($link) . '</p>';
                        }
                    }
                }
                ?>
                <div align="center">
                    <form action="" method="post">
                        <p>Название:
                            <input type="text" name="s_name" value=""><input class="button8" type="submit" value="Добавить">
                        </p>
                    </form>
                </div>
                <?php
                mysqli_query($link, "set names 'utf8'");

                echo '<table class="bordered" align = "center" cellspacing="0">';
                echo '<thead>';
                echo "<tr><th>Код источника</th><th>Название источника дохода</th></tr>";
                echo '</thead>';
                $sql = mysqli_query($link, "SELECT * FROM sources_i ;");

                while ($data = mysqli_fetch_array($sql)) {
                    echo "
		        <tbody>
		        <tr>
		        <td>{$data['id_sources']}</td>
                <td>{$data['s_name']}</td>
                
                <td>
                <a href='editSources_i.php?edit={$data['id_sources']}'>Редактировать</a></td>
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
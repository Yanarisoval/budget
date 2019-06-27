<?php require_once 'connection.php'; ?>
<?php session_start(); ?>

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

            <div id="fon4">
                <h3 align="center">Текущие доходы</h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="addCurrent_i.php" class="button7">Добавить запись</a>
                    <a href="searchCurrent_i.php" class="button7">Поиск</a>

                </p>

                <?php
                mysqli_query($link, "set names 'utf8'");

                if (isset($_GET['del'])) {
                    $sql = mysqli_query($link, "DELETE FROM current_i WHERE id_income = {$_GET['del']}");
                    if ($sql) {
                        echo "<script>alert('Данные удалены')</script>";
                        echo '<script>location.replace("current_i.php");</script>';
                    } else {
                        echo "<p align = 'center'>Ошибка:" . mysqli_error($link) . "</p>";
                    }
                }

                echo '<table class="bordered" align = "center" cellspacing="0">';
                echo '<thead>';
                echo "<tr><th>Код дохода</th><th>ФИО</th><th>Дата</th><th>Источник дохода</th><th>Сумма</th></tr>";
                echo '</thead>';
                $sql = mysqli_query($link, "SELECT c.id_income, f.full_name, c.date_i, s.s_name, c.sum_i 
                FROM current_i c 
                LEFT JOIN family f ON c.id_family = f.id_family
                LEFT JOIN sources_i s ON c.id_sources = s.id_sources;");

                while ($data = mysqli_fetch_array($sql)) {
                    echo "
		        <tbody>
		        <tr>
		        <td>{$data['id_income']}</td>
                <td>{$data['full_name']}</td>
                <td>{$data['date_i']}</td>
                <td>{$data['s_name']}</td>
                <td>{$data['sum_i']}</td>
                <td><a href='?del={$data['id_income']}'> Удалить</a>
                <a href='editCurrent_i.php?edit={$data['id_income']}'>Редактировать</a></td>
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
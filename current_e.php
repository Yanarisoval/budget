<?php require_once 'connection.php'; ?>
<?php session_start(); ?>

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

            <div id="fon4">
                <h3 align="center">Текущие расходы</h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="addCurrent_e.php" class="button7">Добавить запись</a>
                    <a href="searchCurrent_e.php" class="button7">Поиск</a>

                </p>

                <?php
                mysqli_query($link, "set names 'utf8'");

                if (isset($_GET['del'])) {
                    $sql = mysqli_query($link, "DELETE FROM current_e WHERE id_costs = {$_GET['del']}");
                    if ($sql) {
                        echo "<script>alert('Данные удалены')</script>";
                        echo '<script>location.replace("current_e.php");</script>';
                    } else {
                        echo "<p align = 'center'>Ошибка:" . mysqli_error($link) . "</p>";
                    }
                }

                echo '<table class="bordered" align = "center" cellspacing="0">';
                echo '<thead>';
                echo "<tr><th>Код расхода</th><th>ФИО</th><th>Дата</th><th>Статья расхода</th><th>Сумма</th></tr>";
                echo '</thead>';
                $sql = mysqli_query($link, "SELECT c.id_costs, f.full_name, c.date_c, e.e_name, c.sum_c 
                FROM current_e c 
                LEFT JOIN family f ON c.id_family = f.id_family 
                LEFT JOIN expenditure e ON c.id_expenditure = e.id_expenditure");


                while ($data = mysqli_fetch_array($sql)) {
                    echo "
		        <tbody>
		        <tr>
		        <td>{$data['id_costs']}</td>
                <td>{$data['full_name']}</td>
                <td>{$data['date_c']}</td>
                <td>{$data['e_name']}</td>
                <td>{$data['sum_c']}</td>
                <td><a href='?del={$data['id_costs']}'> Удалить</a>
                <a href='editCurrent_e.php?edit={$data['id_costs']}'>Редактировать</a></td>
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
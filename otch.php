<?php require_once 'connection.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Отчет</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <form method="post">

        <section class="home">

            <div id="fon">
                <h3 align="center">Управление семейным бюджетом. Отчет за период.</h3>

                <p align="center">
                    <a href="intropage.php" class="button7">Главная страница</a>
                    <a href="oCurrent_i.php" class="button7">Текущие доходы</a>
                    <a href="oCurrent_e.php" class="button7">Текущие расходы</a>

                </p>
               
            </div>

        </section>
</form>
</body>

</html>
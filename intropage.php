<?php require_once 'connection.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="post">

        <section class="home">

            <div id="fon">
                <h3 align="center">Управление семейным бюджетом.</h3>

                <p align="center">
                    <a href="current_i.php" class="button7">Текущие доходы</a>
                    <a href="current_e.php" class="button7">Текущие расходы</a>
                    <a href="otch.php" class="button7">Отчет за период</a>
                </p>
                <br />
                <p align="center">
                    <a href="sources_i.php" class="button7">Источники дохода</a>
                    <a href="expenditure.php" class="button7">Статьи расхода</a>
                    <a href="family.php" class="button7">Члены семьи</a>

                </p>
            </div>

        </section>
    </form>
</body>

</html>
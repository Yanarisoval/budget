<?php  require_once 'connection.php'; ?> 
<?php session_start(); ?>
<?php  mysqli_query($link, "set names 'utf8'"); ?> 

<!DOCTYPE html>
<html >
	<head>
	<meta charset="UTF-8">
	<title>Текущие доходы</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body><form method="post">
	

	<section class="home">
        
		<div id="fon2">
            <h3 align = "center">Изменить данные. </h3>
            
            <p align = "center">
                <a href="intropage.php" class="button7">Главная страница</a>
                <a href="current_i.php" class="button7">Назад к таблице</a>

            </p>
            <?php   
                // если запрос POST 
                if(isset($_POST['id_family']))
                {   
                            $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit'])); 
                            $id_family = htmlentities(mysqli_real_escape_string($link, $_POST['id_family']));
                            $date_i = htmlentities(mysqli_real_escape_string($link, $_POST['date_i']));
                            $id_sources = htmlentities(mysqli_real_escape_string($link, $_POST['id_sources']));
                            $sum_i = htmlentities(mysqli_real_escape_string($link, $_POST['sum_i']));
                    
    	                    $query ="UPDATE current_i SET id_family = '$id_family', `date_i`='$date_i',
                             id_sources = '$id_sources', sum_i = '$sum_i' WHERE id_income={$_GET['edit']} ";
                            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 
                            if($result)
                            {
                                echo "<script>alert('Данные обновлены')</script>";
	                            // тут желательно редирект сделать на таблицу
	                            echo '<script>location.replace("current_i.php");</script>';
                                //так вот редирект
                            }
                        
                }
 
                // если запрос GET
                if(isset($_GET['edit']))
                {   
                    $id = htmlentities(mysqli_real_escape_string($link, $_GET['edit']));    
                    // создание строки запроса
                    $query = "SELECT * FROM `current_i` WHERE id_income = $id";
                    // выполняем запрос
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
                    //если в запросе более нуля строк
                    if($result && mysqli_num_rows($result)>0) 
                    {
                        $row = mysqli_fetch_row($result); // получаем первую строку

                        
                        $id_family = $row[1];
                        $date_i = $row[2];
                        $id_sources = $row[3];
                        $sum_i = $row[4];
		 
                        echo "<div align = 'center'>
                        <form method='POST'>
                        <input type='hidden' name='id_income' value='$id'>

                        <p><label >ФИО:<br></label></p><p>";
                        $sql = "SELECT id_family, full_name FROM `family`"; 
                        $result = mysqli_query($link, $sql); 
                        echo '<select name="id_family">'; 
                        while ($result1 = mysqli_fetch_array($result)) 
                        { 
                            echo ' <option value="'.$result1['id_family'].'">'.$result1['full_name'].'</option>'; // в значение записывмем ид а выводиться его имя
                        } 
                        echo " <option selected value={$id_family}>{$id_family}</option>";
                        echo '</select>'; 
                            
                        echo "</p><p><label >Дата:<br></label></p><p>                    
                        <input  name='date_i' type='date' value='$date_i'>";

                        echo"<p><label >Источник дохода:<br></label></p><p>";
                        $sql = "SELECT id_sources, s_name FROM `sources_i`"; 
                        $result = mysqli_query($link, $sql); 
                        echo '<select name="id_sources">'; 
                        while ($result1 = mysqli_fetch_array($result)) 
                        { 
                            echo ' <option value="'.$result1['id_sources'].'">'.$result1['s_name'].'</option>'; // в значение записывмем ид а выводиться его имя
                        } 
                        echo " <option selected value={$id_sources}>{$id_sources}</option>";
                        echo '</select>';

                        echo"<p><label >Сумма:<br></label></p>
                        <input  name='sum_i' type='text' value='$sum_i'>

                        <p> <input class='button8' type='submit' value='Сохранить'></p></div>";
         
                        mysqli_free_result($result);
                    }
                }
                // закрываем подключение
                mysqli_close($link);
            ?>
      
	</section>
	</form></body>
</html>
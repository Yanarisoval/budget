<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "budget";
?>

<?php
    $link = mysqli_connect($db_host, $db_user, $db_password, $db_name)
     or die (mysqli_error($link));
?>
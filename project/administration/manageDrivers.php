<?php
    require_once("../authCheck.php");
    
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
    
    if(authCheck()){
        $query = mysqli_query($conn, "SELECT * FROM drivers");
        include 'html/manageDrivers.html';
        echo "<br><a href='/project/logout.php'>Çıkış Yap</a>";
    }
    else{
        header("Location: adminLogin.html");
    }
?>
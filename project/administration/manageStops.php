<?php
    require_once('../authCheck.php');
    
    session_start();
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');

    if(authCheck()){
        $query = mysqli_query($conn, "SELECT * FROM stops");
        include_once "html/manageStops.html";
        echo "<br><a href='/project/logout.php'>Çıkış Yap</a>";

    }
    else{
        header("Location: adminLogin.html");
    }
?>
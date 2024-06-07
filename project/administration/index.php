<?php
    require_once("../authCheck.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
    $username = $_SESSION['username'];
    
    if(authCheck()){
        include 'html/admin.html';
    }
    else{
        header("Location: adminLogin.html");
    }
?>
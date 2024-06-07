<?php
    require_once('../authCheck.php');
    
    session_start();
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');

    if(authCheck()){
        $q = mysqli_query($conn, "SELECT * FROM busses");
        $query = mysqli_query($conn, "SELECT * FROM stops");
        include_once "html/manageBusses.html";

    }
    else{
        header("Location: adminLogin.html");
    }
?>
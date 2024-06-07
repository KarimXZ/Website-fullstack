<?php
    require_once("../../authCheck.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();

    if(authCheck()){
        $id = $_POST['id'];
        $q = mysqli_query($conn, "DELETE FROM busses WHERE id=$id");
        header("Location: ../manageBusses.php");
    }
    else{
        header("Location: ../adminLogin.html");
    }
?>
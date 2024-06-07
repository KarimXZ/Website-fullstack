<?php
    require_once('../../authCheck.php');
    
    session_start();
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');

    if(authCheck()){
        $id = $_POST['id'];

        $q = mysqli_query($conn, "DELETE FROM stops WHERE id=$id");
        header("Location: ../manageStops.php");
    }
    else{
        header("Location: ../adminLogin.html");
    }
?>
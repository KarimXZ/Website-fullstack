<?php
    require_once("../../authCheck.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();

    if(authCheck()){
        $id = $_POST['id'];
        $q = mysqli_query($conn, "DELETE FROM drivers WHERE id=$id");
        header("Location: ../manageDrivers.php");
    }
    else{
        header("Location: ../adminLogin.html");
    }
?>
<?php
    require_once("../../authCheck.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();

    if(authCheck()){
        $id = $_POST['id'];
        $stopName = $_POST['stopName'];
        
        $q = mysqli_query($conn, "UPDATE `stops` SET `stopName`='$stopName' WHERE id=$id");
        header("Location: ../manageStops.php");
    }
    
    else{
        header("Location: ../adminLogin.html");
    }
?>
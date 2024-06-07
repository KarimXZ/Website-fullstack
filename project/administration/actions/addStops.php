<?php
    //oturum doğrulama fonksiyonunun -authCheck()- olduğu dosya
    require_once("../../authCheck.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
    
    if(authCheck()){

        $stopName = $_POST['stopName'];
        
        if(is_null($stopName)){
            ;
        }
        else{
            $q = mysqli_query($conn, "INSERT INTO `stops`(`stopName`) VALUES ('$stopName')");
        }
        header("Location: ../manageStops.php");
    }
    else{
        header("Location: ../adminLogin.html");
    }
?>
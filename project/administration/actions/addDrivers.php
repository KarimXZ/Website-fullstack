<?php
    //oturum doğrulama fonksiyonunun -authCheck()- olduğu dosya
    require_once("../../authCheck.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
        
    if(authCheck()){
        
        $tckn = (int) $_POST['tckn'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $salary = $_POST['salary'];
        
        if(is_null($tckn) and is_null($name) and is_null($surname)){
            ;
        }
        else{
            $q = mysqli_query($conn, "INSERT INTO `drivers`(`tckn`, `name`, `surname`, `salary`) VALUES ('$tckn','$name','$surname', '$salary')");
            header("Location: ../manageDrivers.php");
        }
    }
    else{
        header("Location: adminLogin.html");
    }
?>
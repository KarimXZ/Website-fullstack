<?php
    require_once("../../authCheck.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
        
    if(authCheck()){

        $busName = $_POST['busName'];
        $line = json_encode($_POST['line']);
        $price = (int) $_POST['price'];
        
        if(is_null($busName) and is_null($line) and is_null($price)){
            ;
        }
        else{
            $q = mysqli_query($conn, "INSERT INTO `busses`(`busName`, `line`, `price`) VALUES ('$busName','$line',$price)");
            header("Location: ../manageBusses.php");
        }
    }
    else{
        header("Location: ../adminLogin.html");
    }
?>
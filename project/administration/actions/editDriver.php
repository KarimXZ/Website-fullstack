<?php
    require_once("../../authCheck.php");
    
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();

    if(authCheck()){
        $id = $_POST['id'];
        $tckn = $_POST['tckn'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $salary = $_POST['salary'];

        $q = mysqli_query($conn, "UPDATE `drivers` SET `tckn`= '$tckn', `name` = '$name', `surname` = '$surname', `salary` = '$salary' WHERE id=$id");
        header('Location: ../manageDrivers.php');
    }
    else{
        header("Location: ../adminLogin.html");
    }
?>

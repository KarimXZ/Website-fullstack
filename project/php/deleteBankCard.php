<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
    $mail = $_SESSION['mail'];

    require_once('authCheckUser.php');
    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }
 
    if(authCheckUser()){
        $id = $_POST['id'];

        $q = mysqli_query($conn, "DELETE FROM bankCards WHERE id=$id");
        header("Location: ../user/index.php");
    }
    else{
        header("Location: ../../login.html");
    }
?>
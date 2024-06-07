<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    
    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }

    session_start();
    require_once('../php/authCheckUser.php');

    $username = $_SESSION['username'];
    $mail = $_SESSION['mail'];

    if(authCheckUser()){
        $queryCard = mysqli_query($conn, "SELECT * FROM bankCards WHERE ownerId = (SELECT id FROM users WHERE mail='$mail')");
        $queryBusCard = mysqli_query($conn, "SELECT * FROM busCards WHERE ownerId = (SELECT id FROM users WHERE mail='$mail')");
        include_once "html/loadMoney.html";
    }
    else{
        header("Location: ../login.html");
    }
?>
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
        include_once "html/addBankCard.html";
    }
    else{
        header("Location: login.html");
    }
?>
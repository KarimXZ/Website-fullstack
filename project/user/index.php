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
        $queryTransactions = mysqli_query($conn, "SELECT COALESCE(bankCardId,'') AS bankCardId, COALESCE(busCardId,'') AS busCardId, COALESCE(busId, '') AS busId, COALESCE(time,'') AS time, COALESCE(transactionValue, '') AS transactionValue FROM transactions WHERE userId = (SELECT id FROM  users WHERE mail='$mail')");
        
        
        include_once "html/index.html"; //gözükecek html sayfası
    }
    else{
        header('Location: ../login.html');
    }
?>
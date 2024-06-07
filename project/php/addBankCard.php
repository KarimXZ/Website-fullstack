<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
    $mail = $_SESSION['mail'];

    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }
 
    $mail = $_SESSION['mail'];

    require_once('../php/authCheckUser.php');

    $cardNumber = stripslashes(mysqli_real_escape_string($conn, $_POST['cardNumber']));
    $expiration = stripslashes(mysqli_real_escape_string($conn, $_POST['expiration']));
    $cvv = stripslashes(mysqli_real_escape_string($conn, $_POST['cvv']));

    if(authCheckUser()){
        $q = mysqli_query($conn, "INSERT INTO bankCards (`cardNumber`, `expiration`, `cvv`, `ownerId`) VALUES ('$cardNumber ','$expiration','$cvv', (SELECT id FROM users WHERE mail = '$mail'))");
        header('Location: ../user/index.php');
    }
    else{
        header("Location: /project/login.html");
    }
?>
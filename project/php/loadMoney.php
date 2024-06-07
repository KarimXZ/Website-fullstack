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
        $bankCardId = stripslashes(mysqli_real_escape_string($conn, $_POST['bankCardId'])); //Bunu şu anlık kullanmayacağız çünkü gerçek bir ödeme sistemimiz yok
        $busCardId = stripslashes(mysqli_real_escape_string($conn, $_POST['busCardId']));
        $payment = (int) stripslashes(mysqli_real_escape_string($conn, $_POST['payment']));

        $q = mysqli_query($conn, "UPDATE busCards SET money = money + $payment WHERE id=$busCardId");
        $tq = mysqli_query($conn," INSERT INTO transactions (`bankCardId`, `busCardId`, `transactionValue`, `userId`) VALUES ('$bankCardId', '$busCardId', '+$payment', (SELECT id FROM users WHERE mail = '$mail'))");

        header("Location: ../user/index.php");
    }
    else{
        header("Location: ../login.html");
    }
?>
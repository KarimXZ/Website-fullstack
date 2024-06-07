<?php
    require_once("authCheckUser.php");

    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();
    $mail = $_SESSION['mail'];

    if(authCheckUser()){  

        $idQuery = mysqli_query($conn, "SELECT id FROM bankCards WHERE ownerId = (SELECT id FROM users WHERE mail='$mail')");
        $row = mysqli_fetch_assoc($idQuery);
        
        $cardNumber = $_POST['cardNumber'];
        $id = $row['id'];
        $expiration = $_POST['expiration'];
        $cvv = $_POST['cvv'];

        $q = mysqli_query($conn, "UPDATE bankCards SET cardNumber = '$cardNumber', expiration = '$expiration', cvv = '$cvv' WHERE id=$id");

        header('Location: ../user/index.php');
    }
    else{
        header("Location: ../../login.html");
    }
?>
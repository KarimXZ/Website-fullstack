<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');

    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }


    $mail = stripslashes(mysqli_real_escape_string($conn, $_POST['mail']));
    $pass = hash('sha256', stripslashes(mysqli_real_escape_string($conn, $_POST['pass'])));

    $q = mysqli_query($conn, "SELECT password FROM users WHERE mail = '$mail'");
    $row = mysqli_fetch_assoc($q);
    $truepass = $row['password'];

    if($pass == $truepass){
        session_start();
        
        $nameQuery = mysqli_query($conn, "SELECT name FROM users WHERE mail = '$mail'");
        $row = mysqli_fetch_assoc($nameQuery);
        $username = $row['name'];
        $_SESSION['username'] = $username;
        $_SESSION['mail'] = $mail;
        $cookie = hash('sha256', stripslashes(mysqli_real_escape_string($conn, $_COOKIE['PHPSESSID'])));
        $cookieQuery = mysqli_query($conn, "UPDATE userCookies SET cookieValue = '$cookie' where userId = (SELECT id FROM users WHERE mail = '$mail')");
        header('Location: ../index.php');
        exit;
    }
    else{
        echo "<script>
                alert('Yanlış kullanıcı adı veya şifre');
                document.location = '../login.html';   
            </script>";
        exit;
    }
?>
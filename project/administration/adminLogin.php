<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    
    $username = stripslashes(mysqli_real_escape_string($conn, $_POST['username']));
    $pass = hash('sha256', stripslashes(mysqli_real_escape_string($conn, $_POST['password'])));

    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }
    
    $q = mysqli_query($conn, "SELECT password FROM admins WHERE username = '$username'");
    $row = mysqli_fetch_assoc($q);
    $truepass = $row['password'];
    
    if($pass == $truepass){
        session_start();
        $_SESSION['username'] = $username;
        $cookie = $_COOKIE['PHPSESSID'];
        $cookie = hash('sha256', stripslashes(mysqli_real_escape_string($conn, $cookie)));
        $cookieQuery = mysqli_query($conn, "UPDATE adminCookies SET cookieValue = '$cookie' WHERE userid = (SELECT id FROM admins WHERE username = '$username')");
        header('Location: index.php'); #istek atıldıktan sonra yönlenidirilecek yer 
        exit;
    }
    else{
        echo "<script>
                alert('Yanlış kullanıcı adı veya şifre');
                document.location = 'adminLogin.html';   
            </script>";
        exit;
    }
?>
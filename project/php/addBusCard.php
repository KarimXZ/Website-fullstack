<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    
    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }

    session_start();
    $mail = $_SESSION['mail'];
    require_once('../php/authCheckUser.php');

    $cardSerialNumber = stripslashes(mysqli_real_escape_string($conn, $_POST['cardSerialNumber'])); 

    if(authCheckUser()){
        $serialNumberControl = mysqli_query($conn, "SELECT * FROM busCards WHERE cardSerialNumber='$cardSerialNumber'");

        if(mysqli_num_rows($serialNumberControl) > 0){
            $row = mysqli_fetch_assoc($serialNumberControl);
            if(is_null($row['ownerId'])){
                $q = mysqli_query($conn, "UPDATE busCards SET ownerId = (SELECT id FROM users WHERE mail='$mail')");
                header("Location: ../user/index.php");
            }
            else{
                echo "<script>
                        alert('Belirtilen seri numarası zaten kullanılıyor.');
                        document.location = '../user/index.php';   
                    </script>";
            }
        }
        else{
            $q = mysqli_query($conn, "INSERT INTO `busCards`(`ownerId`, `cardSerialNumber`, `money`) VALUES ((SELECT id FROM users WHERE mail = '$mail'),'$cardSerialNumber', 0)");
            header("Location: ../user/index.php");
        }
    }
    else{
        header('Location: /project/login.html');
    }

?>
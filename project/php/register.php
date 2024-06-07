<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');

    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }

    $name = stripslashes(mysqli_real_escape_string($conn,$_POST['name']));
    $surname = stripslashes(mysqli_real_escape_string($conn,$_POST['surname']));
    $mail = stripslashes(mysqli_real_escape_string($conn,$_POST['mail']));
    $pass = hash('sha256',stripslashes(mysqli_real_escape_string($conn,$_POST['password'])));
    
    $mailCheck = mysqli_query($conn, "SELECT * FROM users WHERE mail='$mail'");

    if(mysqli_num_rows($mailCheck) > 0){ //Mailin özgün olması gerek
        echo "<script>
                alert('Gridiğiniz mail adresi zaten kullanımda');
                document.location = '../register.html';   
              </script>";
    } 
    else{
        //user oluştur
        $q = mysqli_query($conn, "INSERT INTO `users`(`name`, `surname`, `mail`, `password`) VALUES ('$name','$surname','$mail','$pass')");
        
        //userCookies içinde userların cookielerini oluşturup veritabanında depolamak için userCookies'e userid ile bir data oluşturulur
        $getUserId = mysqli_query($conn, "SELECT id FROM users WHERE mail = '$mail'");
        $row = mysqli_fetch_assoc($getUserId);
        $userId = $row['id']; //burada userId değişkenine yeni oluşan user'ın id'si eklendi
        //veritabanına userId gönderildi
        $cookieTableQuery = mysqli_query($conn, "INSERT INTO `userCookies`(`userId`) VALUES ('$userId')"); 
        echo "<p>Hesabınız başarıyla oluşturuldu. <a href='../login.html'>Buradan</a> giriş yapabilirsiniz</p>";
    }
?>
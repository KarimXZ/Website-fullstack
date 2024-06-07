<?php
    function authCheckUser(){
        $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
        
        if ($conn->connect_error) {
            die("Bağlantı başarısız: " . $conn->connect_error);
        }    

        session_start();
        $mail = $_SESSION['mail'];

        //User session control via db-stored cookie
        $cookieQuery = mysqli_query($conn, "SELECT cookieValue FROM userCookies WHERE userId = (SELECT id FROM users WHERE mail = '$mail')");
        $row = mysqli_fetch_assoc($cookieQuery);
        $dbcookie = $row['cookieValue'];

        if(hash('sha256', stripslashes(mysqli_real_escape_string($conn, $_COOKIE['PHPSESSID']))) == $dbcookie){
            return True;
        }
        else{
            return False;
        }
    }
?>
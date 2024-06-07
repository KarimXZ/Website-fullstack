<?php
    function authCheck(){
        $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
        session_start();
        $username = $_SESSION['username'];

        //Admin session control via db-stored cookie
        $cookieQuery = mysqli_query($conn, "SELECT cookieValue FROM adminCookies WHERE userId = (SELECT id FROM admins WHERE username = '$username')");
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
<?php
        $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');

        if ($conn->connect_error) {
            die("Bağlantı başarısız: " . $conn->connect_error);
        }
    
        session_start();
        require_once('php/authCheckUser.php');
    
        $username = $_SESSION['username'];
        $mail = $_SESSION['mail'];
        
        
        $busQ = mysqli_query($conn, "SELECT * FROM busses");

        
        function fetchStops($conn, $stopList){
            $stops = array();
            //$stopList = array($stopList);
            foreach($stopList as $stopId){
                $stopId = (int) $stopId;
                $stopQ = mysqli_query($conn, "SELECT stopName From stops WHERE id='$stopId'");
                $row = mysqli_fetch_assoc($stopQ);
                $stopName = $row['stopName'];
                $stops[] = $stopName;
            }
            return $stops;
        }
        include_once "html/Main.html";
?>
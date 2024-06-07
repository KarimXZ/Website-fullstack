<?php
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();

    require_once('../php/authCheckUser.php');
    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }
 
    if(authCheckUser()){
        $mail = $_SESSION['mail'];
        $id = $_GET['id'];
        
        $q = mysqli_query($conn, "SELECT * FROM bankCards WHERE ownerId = (SELECT id FROM users WHERE mail='$mail')");
        $row = mysqli_fetch_assoc($q);
        
        $cardNumber = $row['cardNumber'];
        $expiration = $row['expiration'];
        $cvv = $row['cvv'];
        $ownerId = $row['ownerId'];

        echo "  <!DOCTYPE html>
                <meta charset='utf-8'>
                <html>
                    <head>
                        <title>Otobüsü Düzenle</title>
                        <style>
                        body {
                            font-family: Arial, sans-serif;
                            background: linear-gradient(135deg, #ece9e6, #dcdcdc);
                            margin: 0;
                            padding: 0;
                        }
                        p {
                            font-size: 18px;
                            color: #333;
                            margin-top: 20px;
                        }
                        h3 {
                            color: #007BFF;
                            margin-top: 30px;
                            margin-left: 200px;
                        }
                        table {
                            border-collapse: collapse;
                            width: 80%;
                            margin: 20px auto;
                            border-radius: 50px;
                        }
                        th, td {
                            border: 1px solid #ccc;
                            padding: 8px;
                            text-align: left;
                
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                        input[type='submit'],
                        a {
                            background-color: #007BFF;
                            color: #fff;
                            padding: 8px 16px;
                            border: none;
                            border-radius: 5px;
                            text-decoration: none;
                            display: inline-block;
                            margin-top: 20px;
                        }
                        input[type='submit']:hover,
                        a:hover {
                            background-color: #0056b3;
                        }
                        .footer {
                            text-align: center;
                            padding: 20px;
                            background-color: rgba(255, 255, 255, 0.8);
                            width: 100%;
                            position:relative; /* Change position to relative */
                            bottom: 0;
                            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                            z-index: 1; /* Ensure footer is above content */
                            margin-top: 20px; /* Add margin to prevent overlap */ 
                        }
                        .footer a {
                            margin: 0 10px;
                            color: #007BFF;
                            text-decoration: none;
                            font-size: 24px;
                            transition: transform 0.2s;
                            display: inline-block;
                        }
                        .footer a:hover {
                            transform: scale(1.2);
                        }
                        .footer p {
                            margin: 10px 0 0;
                            font-size: 14px;
                            color: #555;
                        }
                        /* Update icon color */
                        .fab {
                            color: #ffff;
                        }
                        
                        .navbar {
                            background-color: #007BFF;
                            overflow: hidden;
                            display: flex;
                            justify-content: center;
                            padding: 0;
                        }
                        .navbar a {
                            color: #fff;
                            text-decoration: none;
                            padding: 14px 20px;
                            text-align: center;
                            font-size: 18px;
                            border-top-left-radius: 10px;
                            border-top-right-radius: 10px;
                            margin: 0 10px;
                            background-color: #007BFF;
                        }
                        .navbar a:hover, .navbar a.active {
                            background-color: #0056b3;
                            color: #fff;
                        }
                    </style>
                    </head>
                    <body><center>
                        <form method='post' action='../php/editBankCard.php'>
                            <p>Kart Numarası</p><input type='text' name='cardNumber' value='$cardNumber'>
                            <p>Son Kullanım Tarihi</p><input type='text' name='expiration' value='$expiration'>
                            <p>CVV/CVC</p><input type='text' name='cvv' value='$cvv'><br>
                            <input type='submit' value='Değiştir'>
                        </form>
                        <br>
                        <a href='index.php'>Geri Dön</a></center>
                    </body>
                </html>";
    }
    else{
     header('Location: ../login.html');   
    }
?>

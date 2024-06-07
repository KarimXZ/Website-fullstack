<?php
    require_once("../authCheck.php");
    
    $conn = new mysqli('localhost', 'dbadmin', 'cokgizlisifre123', 'project');
    session_start();

    if(authCheck()){
        $id = $_GET['id'];
        $q = mysqli_query($conn, "SELECT * FROM drivers");
        $row = mysqli_fetch_assoc($q);

        $id = $row['id'];
        $name = $row['name'];
        $surname = $row['surname'];
        $tckn =  $row['tckn'];
        $salary = $row['salary'];

        echo "  <!DOCTYPE html>
                <meta charset='utf-8'>
                <html>
                    <head>
                        <title>Şoförleri Düzenle</title>
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
                    <body>
                        <center>
                        <form method='post' action='actions/editDriver.php'>
                            <input type='hidden' name='id' value='$id' readonly>
                            <p>Şoför TCKN</p><input type='number' name='tckn' value='$tckn'>
                            <p>Şoför Adı</p><input type='text' name='name' value='$name'>
                            <p>Şoför Soyadı</p><input type='text' name='surname' value='$surname'>
                            <p>Şoför Maaşı</p><input type='number' name='salary' value='$salary'><br>
                            <input type='submit' value='Değiştir'>
                        </form>
                        </center>
                        <br>
                        <a href='manageStops.php'>Geri Dön</a>
                    </body>
                </html>";
    }
    else{
        header("Location: adminLogin.html");
    }
?>
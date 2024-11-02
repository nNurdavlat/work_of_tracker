<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homework</title>
</head>
<body>
    <form method="GET">
        <input type="datetime-local" name="Arrived_time"><br>
        <br><input type="datetime-local" name="Leaved_time"><br>
        <br><button>Tekshirish</button>
    </form>

<?php
    if($_GET['Arrived_time'] and $_GET['Leaved_time']){
        echo "<h3>Arrived_time: " . $_GET['Arrived_time'] . "</h3>";
        echo "<h3>Leaved_time: " . $_GET['Leaved_time'] . "</h3>";
    }
    $arrived = $_GET['Arrived_time'];
    $leaved = $_GET['Leaved_time'];



    
    $pdo = new PDO('mysql:host=localhost;dbname=work_of_traker', 'root', '1234');

    $quary = "INSERT INTO work_times(kelgan_vaqt, ketgan_vaqt) VALUES (:kelgan, :ketgan)";

    $stmt = $pdo->prepare($quary);

    $stmt->bindParam(':kelgan', $arrived);
    $stmt->bindParam(':ketgan', $leaved);

    
    $stmt->execute();
    ?>


<!-- // Bitmagan. Ekranga chiqish qoldi xolos-->

<?php
    $result = "SELECT * FROM work_times";
    $stmt = $pdo->prepare($result);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach($records as $res){
        print_r($res);
    }


    ?>

</body>
</html>
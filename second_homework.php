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
    $arrive = new DateTime($_GET['Arrived_time']);
    $leaved = new DateTime($_GET['Leaved_time']);
    $diffrent = $arrive->diff($leaved);
    echo "<h1>Siz: " . $diffrent->format('%d kun %h soat %i daqiqa %s soniya') . " ishladingiz</h1>";
    ?>

</body>
</html>
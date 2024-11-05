<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta ism="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Of Traker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-danger text-center">Work Of Tracker</h1>

    <div class="container mt-4">
        <form method="post">
            <div class="mb-3">
                <label for="ism" class="form-label">Ism</label>
                <input type="text" class="form-control" id="ism" aria-describedby="emailHelp" name="ism" required>
            </div>

            <div class="mb-3">
                <label for="kelgan_vaqt" class="form-label">Kelgan vaqt</label>
                <input type="datetime-local" class="form-control" id="kelgan_vaqt" name="kelgan_vaqt" required>
            </div>

            <div class="mb-3">
                <label class="form-check-label" for="ketgan_vaqt">Ketgan vaqt</label>
                <input type="datetime-local" class="form-control" id="ketgan_vaqt" name="ketgan_vaqt" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <?php

    const IshlashKerak = 8;

    $pdo = new PDO('mysql:host=localhost;dbname=work_of_traker', 'root', '1234');

    if (isset($_POST['kelgan_vaqt']) and isset($_POST['ketgan_vaqt']) and isset($_POST['ism'])) {
        if (!empty($_POST['ism']) and !empty($_POST['kelgan_vaqt']) and !empty($_POST['ketgan_vaqt'])) {
            $ism = $_POST['ism'];
            $kelgan_vaqt = new DateTime($_POST['kelgan_vaqt']);
            $ketgan_vaqt = new DateTime($_POST['ketgan_vaqt']);


            //Orasidagi vaqt uchun diff methodi yordamga keladi
            $diff = $kelgan_vaqt->diff($ketgan_vaqt);
            $hour = $diff->h;
            $minute = $diff->i;
            // $second = $diff->s;
            $total = ((IshlashKerak * 3600) - (($hour * 3600) + ($minute * 60)));

            $quary = "INSERT INTO work_times(kelgan_vaqt, ketgan_vaqt, ism, required_of) VALUES (:kelgan, :ketgan, :ism, :qarzi)";

            $stmt = $pdo->prepare($quary);

            $stmt->bindParam(':ism', $ism);
            $stmt->bindValue(':kelgan', $kelgan_vaqt->format("Y-m-d H:i"));
            $stmt->bindValue(':ketgan', $ketgan_vaqt->format("Y-m-d H:i"));
            $stmt->bindParam(':qarzi', $total);
            $stmt->execute();
            header("Location: class_work.php");
            exit();
        }
    }

    $SelectQuery = "SELECT * FROM work_times";
    $stmt = $pdo->query($SelectQuery);
    $records = $stmt->fetchAll();
    ?>



    <div class="container mt-4">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th>Ism</th>
                    <th>Kelgan vaqt</th>
                    <th>Ketgan vaqt</th>
                    <th>Qarizdorligi</th>
                </tr>
            </thead>


            <tbody>
                <?php
                foreach ($records as $rec) {
                    echo "<tr>
                            <th>{$rec['id']}</th>
                            <td>{$rec['ism']}</td>
                            <td>{$rec['kelgan_vaqt']}</td>
                            <td>{$rec['ketgan_vaqt']}</td>
                            <td>" . gmdate('H:i', $rec['required_of']) . "</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
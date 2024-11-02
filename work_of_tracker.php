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

    <div>
        <form method="post">
            <div class="mb-3">
                <label for="ism" class="form-label">Ism</label>
                <input type="text" class="form-control" id="ism" aria-describedby="emailHelp" name="ism">
            </div>

            <div class="mb-3">
                <label for="kelgan_vaqt" class="form-label">Kelgan vaqt</label>
                <input type="datetime-local" class="form-control" id="kelgan_vaqt" name="kelgan_vaqt">
            </div>

            <div class="mb-3">
                <label class="form-check-label" for="ketgan_vaqt">Ketgan vaqt</label>
                <input type="datetime-local" class="form-control" id="ketgan_vaqt" name="ketgan_vaqt">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=work_of_traker', 'root', '1234');

    if (isset($_POST['kelgan_vaqt']) and isset($_POST['ketgan_vaqt']) and isset($_POST['ism'])) {
        $ism = $_POST['ism'];
        $kelgan_vaqt = $_POST['kelgan_vaqt'];
        $ketgan_vaqt = $_POST['ketgan_vaqt'];

        $quary = "INSERT INTO work_times(kelgan_vaqt, ketgan_vaqt, ism) VALUES (:kelgan, :ketgan, :ism)";

        $stmt = $pdo->prepare($quary);

        $stmt->bindParam(':kelgan', $kelgan_vaqt);
        $stmt->bindParam(':ketgan', $ketgan_vaqt);
        $stmt->bindParam(':ism', $ism);

        $stmt->execute();
    }

    $SelectQuery = "SELECT * FROM work_times";
    $stmt = $pdo->query($SelectQuery);
    $records = $stmt->fetchAll();
    ?>
   


    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Ism</th>
                    <th scope="col">Kelgan vaqt</th>
                    <th scope="col">Ketgan vaqt</th>
                </tr>
            </thead>


            <tbody>
                <?php
                    foreach($records as $rec){
                        echo "<tr>
                            <th scope='row'>{$rec['id']}</th>
                            <td>{$rec['ism']}</td>
                            <td>{$rec['kelgan_vaqt']}</td>
                            <td>{$rec['ketgan_vaqt']}</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Of Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20200714/pngtree-modern-double-color-futuristic-neon-background-image_351866.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
        }

        h1 {
            color: #f8d7da;
            font-size: 2.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            margin-top: 20px;
        }

        label {
            font-size: 18px;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
        }

        table {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }

        table th,
        table td {
            color: #343a40;
        }

        table tbody tr:hover {
            background-color: #f8d7da;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Work Of Tracker</h1>

    <div class="container mt-4">
        <form method="post">
            <div class="mb-3">
                <label for="ism" class="form-label">Ism</label>
                <input type="text" class="form-control" id="ism" name="ism" required>
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

            <button form="export" type="submit" class="btn btn-success">Expert</button>
        </form>

        <form action="download.php" id="export" method="post">
            <input type="text" name="export" value="true" hidden="">
        </form>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th>Ism</th>
                    <th>Kelgan vaqt</th>
                    <th>Ketgan vaqt</th>
                    <th>Qarizdorligi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $records;
                $i = isset($_GET['page']) ? (int)$_GET['page'] : 0;
                foreach ($records as $rec) {
                    $i++;
                    echo "<tr>
                            <th>{$i}</th>
                            <td>{$rec['ism']}</td>
                            <td>{$rec['kelgan_vaqt']}</td>
                            <td>{$rec['ketgan_vaqt']}</td>
                            <td>" . gmdate('H:i', $rec['required_of']) . "</td>
                            <td><a href='work_of_tracker.php?done=" . $rec['id'] . "'>Done</a></td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Pasidegi 1 2 3 lar  -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                    global $workDay, $currentPage;
                    $disabled = $currentPage == 1 ? "disabled" : "";
                ?>

                <li class="page-item <?=$disabled?>"><a class="page-link" href="#">Previous</a></li>
                <?php
                    $pageCount = $workDay->calculatePageCount();
                    for ($page=1; $page <= $pageCount; $page++) { 
                        $active = $currentPage == $page ? 'active' : '';
                        echo "<li class='page-item $active''><a class='page-link'' href='work_of_tracker.php?page=" . $page . "''>" . $page . "</a></li>";
                    }


                ?>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
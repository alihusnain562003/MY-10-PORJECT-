<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "db4";

$connection = mysqli_connect($server, $username, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}

if (isset($_POST["project_name"])) { // Update the key to match your form input
    $project_name = $_POST["project_name"];
    $technology = $_POST["technology"];
    $functionality = $_POST["functionality"];
    $date = $_POST["date"]; // Assuming date is still needed

    $sqlinsert = "INSERT INTO tb4 (project_name, technology, functionality, date) VALUES ('$project_name', '$technology', '$functionality', '$date')";
    
    $res = mysqli_query($connection, $sqlinsert);

    if ($res) {
        echo "Inserted";
    }
}

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $delquery = "DELETE FROM tb4 WHERE id = '$id'";
    $resultdel = mysqli_query($connection, $delquery);

    if ($resultdel) {
        echo "Deleted";
        header("Location: todo.php");
        exit();
    }
}

if (isset($_POST["idupdate"])) {
    $id = $_POST["idupdate"];
    $project_name = $_POST["project_name_update"];
    $technology = $_POST["technology_update"];
    $functionality = $_POST["functionality_update"];
    $date = $_POST["date_update"];

    $update = "UPDATE tb4 SET project_name='$project_name', technology='$technology', functionality='$functionality', date='$date' WHERE id = '$id'";
    $result = mysqli_query($connection, $update);

    if ($result) {
        echo "Updated";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="todo.css"> <!-- Link to your CSS file -->
</head>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Your Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="todo.php" method="post">
                        <input type="hidden" name="idupdate" id="userid">
                        <div class="mb-3">
                            <label for="projectNameUpdate" class="form-label">Project Name</label>
                            <input type="text" class="form-control" name="project_name_update" id="projectNameUpdate">
                        </div>
                        <div class="mb-3">
                            <label for="technologyUpdate" class="form-label">Technology</label>
                            <input type="text" class="form-control" name="technology_update" id="technologyUpdate">
                        </div>
                        <div class="mb-3">
                            <label for="functionalityUpdate" class="form-label">Functionality</label>
                            <input type="text" class="form-control" name="functionality_update" id="functionalityUpdate">
                        </div>
                        <div class="mb-3">
                            <label for="dateUpdate" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date_update" id="dateUpdate">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form method="post" action="todo.php">
            <div class="mb-3">
                <label for="projectName" class="form-label">Project Name</label>
                <input type="text" class="form-control" name="project_name" id="projectName">
            </div>
            <div class="mb-3">
                <label for="technology" class="form-label">Technology</label>
                <input type="text" class="form-control" name="technology" id="technology">
            </div>
            <div class="mb-3">
                <label for="functionality" class="form-label">Functionality</label>
                <input type="text" class="form-control" name="functionality" id="functionality">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" id="date">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="container">
        <table class="table table-striped table-hover" id="Table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Technology</th>
                    <th scope="col">Functionality</th>
                    <th scope="col">Date</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlshow = "SELECT * FROM tb4";
                $results = mysqli_query($connection, $sqlshow);
                while ($itemofbi = mysqli_fetch_assoc($results)) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $itemofbi["id"] . "</th>";
                    echo "<td>" . $itemofbi["project_name"] . "</td>";
                    echo "<td>" . $itemofbi["technology"] . "</td>";
                    echo "<td>" . $itemofbi["functionality"] . "</td>";
                    echo "<td>" . $itemofbi["date"] . "</td>";
                    echo "<td>
                        <div class='d-grid gap-2 d-md-block'>
                            <button class='btn btn-primary Edit' data-bs-toggle='modal' data-bs-target='#exampleModal' type='button' id='" . $itemofbi["id"] . "'>Edit</button>
                            <button class='btn btn-danger Delete' type='button' id='" . $itemofbi["id"] . "'>Delete</button>
                        </div>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        let editkardo = document.getElementsByClassName("Edit");
        Array.from(editkardo).forEach((index) => {
            index.addEventListener("click", (i) => {
                let tr = i.target.parentNode.parentNode.parentNode;
                let project_name = tr.getElementsByTagName("td")[0].innerText;
                let technology = tr.getElementsByTagName("td")[1].innerText;
                let functionality = tr.getElementsByTagName("td")[2].innerText;
                let date = tr.getElementsByTagName("td")[3].innerText;
                
                document.getElementById("projectNameUpdate").value = project_name;
                document.getElementById("technologyUpdate").value = technology;
                document.getElementById("functionalityUpdate").value = functionality;
                document.getElementById("dateUpdate").value = date;
                document.getElementById("userid").value = i.target.id;
            });
        });

        let deletekardo = document.getElementsByClassName("Delete");
        Array.from(deletekardo).forEach((index) => {
            index.addEventListener("click", (i) => {
                let sno = i.target.id;
                if (confirm("Are you sure you want to delete?")) {
                    window.location = `todo.php?delete=${sno}`;
                }
            });
        });

        let table = new DataTable('#Table');
    </script>
</body>

</html>

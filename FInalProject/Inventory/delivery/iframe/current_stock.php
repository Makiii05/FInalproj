<?php
include("../../../conn.php");
session_start();


// Retrieve user data from the session
$userId = $_SESSION["user_id"];
$lastName = $_SESSION["user_lastname"];
$givenName = $_SESSION["user_givenname"];
$position = $_SESSION["user_position"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div>
        <table class='table table-striped' style='width: 100%;' >
            <thead>
                <tr><th width=99%>Product</th><th>Quantity</th></tr>
            </thead>
            <tbody>
            <?PHP
                $result = $conn->query("select * from tblstock");
                if(mysqli_num_rows($result) == 0){
                    echo "<tr><th colspan='2'><h6 class='text-secondary'>Currently no Records</h6></th></tr>";
                }else{
                    while($row=$result->fetch_assoc()){
                        echo "<tr>
                        <td>$row[fldproduct]</td>
                        <td>$row[fldquantity]</td>
                        </tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
    
    <script>
        setInterval(refresh, 10000);

        function refresh() {
            window.location.reload();
        }
    </script>
<!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
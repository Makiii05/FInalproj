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
    <div class="container" >
    <h3>Records</h3>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <button class="nav-link active" id="nav-delivery-tab" data-bs-toggle="tab" data-bs-target="#nav-delivery" type="button" role="tab" aria-controls="nav-delivery" aria-selected="true">Delivery</button>

                <button class="nav-link" id="nav-physical-tab" data-bs-toggle="tab" data-bs-target="#nav-physical" type="button" role="tab" aria-controls="nav-physical" aria-selected="false">Physical Count</button>

                <button class="nav-link" id="nav-transfer-tab" data-bs-toggle="tab" data-bs-target="#nav-transfer" type="button" role="tab" aria-controls="nav-transfer" aria-selected="false">Stock Transfer</button>

                <button class="nav-link" id="nav-wastages-tab" data-bs-toggle="tab" data-bs-target="#nav-wastages" type="button" role="tab" aria-controls="nav-wastages" aria-selected="false">Wastages</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active p-3" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">
                <table id="tableUsers" class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP
                            $result = $conn->query("select * from tblproduct where fldtype = 'Delivery'");
                            if(mysqli_num_rows($result) == 0){
                                echo "<tr><th colspan='5'><h6 class='text-secondary'>Currently no Records</h6></th></tr>";
                            }else{
                                while($row=$result->fetch_assoc()){
                                    echo "<tr>
                                    <td>$row[flddate]</td>
                                    <td>$row[fldproduct]</td>
                                    <td>$row[fldquantity]</td>
                                    <td>₱$row[fldunitprice]</td>
                                    <td>₱$row[fldtotalprice]</td>
                                    </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade p-3" id="nav-physical" role="tabpanel" aria-labelledby="nav-physical-tab">
                <table id="tableUsers" class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Physical Count</th>
                            <th>Current Stock</th>
                            <th>Variance</th>
                            <th>Unit Price</th>
                            <th>Total Loss</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP
                            $result = $conn->query("select * from tblproduct where fldtype = 'Physical Count'");
                            if(mysqli_num_rows($result) == 0){
                                echo "<tr><th colspan='7'><h6 class='text-secondary'>Currently no Records</h6></th></tr>";
                            }else{
                                while($row=$result->fetch_assoc()){
                                    echo "<tr>
                                    <td>$row[flddate]</td>
                                    <td>$row[fldproduct]</td>
                                    <td>$row[fldquantity]</td>
                                    <td>$row[fldcurrentStock]</td>
                                    <td>$row[fldvariance]</td>
                                    <td>₱$row[fldunitprice]</td>
                                    <td>₱$row[fldtotalprice]</td>
                                    </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade p-3" id="nav-transfer" role="tabpanel" aria-labelledby="nav-transfer-tab">
                <table id="tableUsers" class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Destination</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP
                            $result = $conn->query("select * from tblproduct where fldtype = 'Stock Transfer'");
                            if(mysqli_num_rows($result) == 0){
                                echo "<tr><th colspan='6'><h6 class='text-secondary'>Currently no Records</h6></th></tr>";
                            }else{
                                while($row=$result->fetch_assoc()){
                                    echo "<tr>
                                    <td>$row[flddate]</td>
                                    <td>$row[fldproduct]</td>
                                    <td>$row[fldquantity]</td>
                                    <td>$row[flddestination]</td>
                                    <td>₱$row[fldunitprice]</td>
                                    <td>₱$row[fldtotalprice]</td>
                                    </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="tab-pane fade p-3" id="nav-wastages" role="tabpanel" aria-labelledby="nav-wastages-tab">
                <table id="tableUsers" class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>No. of Loss</th>
                            <th>Reason</th>
                            <th>Unit Price</th>
                            <th>Total Loss</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP
                            $result = $conn->query("select * from tblproduct where fldtype = 'Wastages'");
                            if(mysqli_num_rows($result) == 0){
                                echo "<tr><th colspan='6'><h6 class='text-secondary'>Currently no Records</h6></th></tr>";
                            }else{
                                while($row=$result->fetch_assoc()){
                                    echo "<tr>
                                    <td>$row[flddate]</td>
                                    <td>$row[fldproduct]</td>
                                    <td>$row[fldquantity]</td>
                                    <td>$row[fldreason]</td>
                                    <td>₱$row[fldunitprice]</td>
                                    <td>₱$row[fldtotalprice]</td>
                                    </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

<!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
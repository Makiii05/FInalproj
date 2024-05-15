<?php
include("../../conn.php");
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
        li::marker{
            color: #212529;
        }
        .profile-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
<!-- Offcanvas Navigation -->
        <div class="offcanvas offcanvas-start bg-dark text-light" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel"><?PHP echo "$givenName ($position)"; ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <i class="bi bi-speedometer2"></i>
                        <a href="../../Dashboard/purchasing.php" class="btn py-4 d-inline-flex rounded text-light">
                            <b>Dashboard</b>
                        </a>
                    </li>
                    <li class="nav-item">
                    <i class="bi bi-card-list"></i>
                        <a href="../delivery/delivery.php" class="btn py-4 d-inline-flex rounded text-light">
                            <b>Inventory</b>
                        </a>
                    </li>
                    <li class="nav-item">
                    <i class="bi bi-envelope-plus-fill"></i>
                        <button class="btn py-4 dropdown-toggle rounded text-light" data-bs-toggle="collapse" data-bs-target="#report-collapse" aria-expanded="true" aria-current="true">
                            <b>Purchasing</b>
                        </button>
                        <div class="collapse" id="report-collapse">
                            <ul class="list-styled fw-normal pb-1 small">
                                <li><a href="purchase_request.php" class="btn rounded text-light">Purchase Requests</a></li>
                                <li><a href="purchase_order.php" class="btn rounded text-light">Purchase Order</a></li>
                                <li><a href="account_payable.php" class="btn rounded text-light">Account Payable</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
            <!-- Toggle Button -->
            <button class="btn btn-outline-secondary mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="bi bi-list"></i> Menu
            </button>

            <!-- Logo -->
            <a class="navbar-brand" href="../../Dashboard/purchasing.php">
                Business Namee
            </a>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown mx-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../Account/profile.php">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../Account/login.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <div class="col-md-6 py-3">
            <div class="profile-container" style="width: 1100px;">
                <h5 class="modal-title pb-3">Requests to Purchase</h5>

                    <?PHP
                    $result = $conn->query("select * from tblrequest where fldstatus = 'approved'");
                    if(mysqli_num_rows($result) == 0){
                        echo "<h6 class='text-secondary'>Currently no pending to purchase.</h6>";
                    }else{
                        echo "<table id='tableUsers' class='table table-striped' style='width: 100%;'>";
                        echo "<thead><tr align=center><th>Purchasing Officer</th><th>Purpose</th><th>Product</th><th>Details</th><th>Ordered</th><th>Cancel Order</th></tr></thead><tbody>";
                        while($row=$result->fetch_assoc()){
                            echo "<tr align=center>
                            <td>$row[fldrequestor]</td>
                            <td>$row[fldpurpose]</td>
                            <td>$row[fldproduct]</td>
                            <td><a class='btn' data-bs-toggle='modal' data-bs-target='#$row[id]'><i class='bi bi-question-circle-fill text-secondary'></i></a></td>
                            <td><a class='btn' href='../PHP_purchasing.php?OrderNow=$row[id]'><i class='bi bi-check-circle-fill text-primary text-center'></i></a></td>
                            <td><a class='btn' href='../PHP_purchasing.php?CancelOrder=$row[id]'><i class='bi bi-x-circle-fill text-danger'></i></a></td>
                            </tr>";
                        }
                        echo "</tbody></table>";
                    }
                    ?>

            </div>
        </div>
    </div>
<!-- modal details -->
    <?php
    $result = $conn->query("SELECT * FROM tblrequest where fldstatus = 'approved'");

    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='modal fade modal-xl' id='{$row['id']}' tabindex='-1'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>{$row['fldrequestor']}'s Requests</h5>
                        <button class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form>
                            <table width='100%'>
                                <tr>
                                    <td colspan='2'>
                                        <h5>Requestor's Information</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td width='50%'>
                                        <div class='form-group px-2'>
                                            <label for='Requestor'>Requestor:</label>
                                            <input readonly name='txtrequestor' class='form-control' id='Requestor' value='{$row['fldrequestor']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='Purpose'>Purpose:</label>
                                            <input readonly name='txtpurpose' class='form-control' id='Purpose' value='{$row['fldpurpose']}'>
                                        </div>
                                    </td>
                                    <td width='50%'>
                                        <div class='form-group px-2'>
                                            <label for='Date'>Date:</label>
                                            <input readonly name='txtdate' class='form-control' id='Date' value='{$row['flddate']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='Datereq'>Date Required:</label>
                                            <input readonly name='txtdatereq' class='form-control' id='Datereq' value='{$row['flddatereq']}'>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <h5>Product's Information</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <div class='form-group px-2' id='form-product'>
                                            <label for='product'>Product:</label>
                                            <input readonly name='txtproduct' class='form-control' id='product' value='{$row['fldproduct']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='Quantity'>Quantity:</label>
                                            <input readonly name='txtquantity' class='form-control' id='Quantity' value='{$row['fldquantity']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='description'>Description:</label>
                                            <input readonly name='txtdescription' class='form-control' id='description' value='{$row['flddesc']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='supplier'>Supplier:</label>
                                            <input readonly name='txtsupplier' class='form-control' id='supplier' value='{$row['fldsupplier']}'>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width='50%'>
                                        <div class='form-group px-2'>
                                            <label for='unitprice'>Unit Price:</label>
                                            <input readonly name='txtunitprice' class='form-control' id='unitprice' value='{$row['flduprice']}'>
                                        </div>
                                    </td>
                                    <td width='50%'>
                                        <div class='form-group px-2'>
                                            <label for='totalprice'>Total Price:</label>
                                            <input readonly name='txttotalprice' class='form-control' id='totalprice' value='{$row['fldtprice']}'>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }
    if(isset($_GET["CancelOrder"])){
        echo "<script>setTimeout(Hello, 250);function Hello(){alert('Order Canceled.');}</script>";
    }
    ?>
<!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
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
<!-- request form -->
    <div class="container">
        <div class="row">
            <div class="container text-end">
                <button type="button" class="btn btn-secondary my-2 mt-4" data-bs-toggle="modal" data-bs-target="#pending">Pending Requests</button>
            </div>
            <div class="col-md-6 py-3">
                <div class="profile-container" style="width: 1100px;">
                    <form method="post" action="../PHP_purchasing.php">
                        <table width="1050">
                            <tr>
                                <td colspan="2">
                                    <h5>Requestor's Information</h5>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <div class="form-group px-2">
                                        <label for="Requestor">Requestor:</label>
                                        <input required name="txtrequestor" type="text" class="form-control" id="Requestor" value="<?php echo "$lastName, $givenName"; ?>">
                                    </div>
                                    <div class="form-group px-2">
                                        <label for="Purpose">Purpose:</label>
                                        <select required onchange="myFunction()" name="txtpurpose" class="form-select" id="Purpose">
                                            <option value="New Product" selected>New Product</option>
                                            <option value="Restock">Restock</option>
                                        </select>                                    
                                    </div>
                                </td>
                                <td width="50%">
                                    <div class="form-group px-2">
                                        <label for="Date">Date:</label>
                                        <input required name="txtdate" type="date" class="form-control" id="Date" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group px-2">
                                        <label for="Datereq">Date Required:</label>
                                        <input required name="txtdatereq" type="date" class="form-control" id="Datereq">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h5>Product's Information</h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="form-group px-2" id="form-product">
                                        <label for="product">Product:</label>
                                        <input required name="txtproduct" type="text" class="form-control" id="product">
                                    </div>
                                    <div class="form-group px-2">
                                        <label for="Quantity">Quantity:</label>
                                        <input required name="txtquantity" type="number" class="form-control" id="Quantity">
                                    </div>
                                    <div class="form-group px-2">
                                        <label for="description">Description:</label>
                                        <input required name="txtdescription" type="text" class="form-control" id="description">
                                    </div>
                                    <div class="form-group px-2">
                                        <label for="supplier">Supplier:</label>
                                        <input required name="txtsupplier" type="text" class="form-control" id="supplier">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <div class="form-group px-2">
                                        <label for="unitprice">Unit Price:</label>
                                        <input required name="txtunitprice" type="number" class="form-control" id="unitprice" value="0">
                                    </div>
                                </td>
                                <td width="50%">
                                    <div class="form-group px-2">
                                        <label for="totalprice">Total Price:</label>
                                        <input required name="txttotalprice" type="number" class="form-control" id="totalprice" value="0">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="mt-2 px-2 text-end">
                                        <button type="submit" class="btn btn-secondary" name="sendReq">Submit</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal form -->
    <div class="modal fade modal-xl" id="pending" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal head -->
                <div class="modal-header">
                    <h5 class="modal-title">Pending Requests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <?PHP
                    $result = $conn->query("select * from tblrequest where fldstatus = 'requested'");
                    if(mysqli_num_rows($result) == 0){
                        echo "<h6 class='text-secondary'>Currently no pending request.</h6>";
                    }else{
                        echo "<table id='tableUsers' class='table table-striped' style='width: 100%;''>";
                        echo "<thead><tr><th>Requestor</th><th>Purpose</th><th>Product</th><th>Details</th><th><i class='bi bi-trash3-fill'></i></th></tr></thead><tbody>";
                        while($row=$result->fetch_assoc()){
                            echo "<tr>
                            <td>$row[fldrequestor]</td>
                            <td>$row[fldpurpose]</td>
                            <td>$row[fldproduct]</td>
                            <td><button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#$row[id]'><i class='bi bi-question-circle-fill text-secondary'></i></button></td>
                            <td><a href='../PHP_purchasing.php?delid=$row[id]&name=$row[fldrequestor]'><i class='bi bi-trash3-fill text-danger'></i></a></td>
                            </tr>";
                        }
                        echo "</tbody></table>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<!-- modal details -->
    <?php
    $result = $conn->query("SELECT * FROM tblrequest where fldstatus = 'requested'");

    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='modal fade modal-xl' id='{$row['id']}' tabindex='-1'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>{$row['fldrequestor']}'s Requests</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
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
                                            <input readonly name='txtrequestor' type='text' class='form-control' id='Requestor' value='{$row['fldrequestor']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='Purpose'>Purpose:</label>
                                            <input readonly name='txtpurpose' type='text' class='form-control' id='Purpose' value='{$row['fldpurpose']}'>
                                        </div>
                                    </td>
                                    <td width='50%'>
                                        <div class='form-group px-2'>
                                            <label for='Date'>Date:</label>
                                            <input readonly name='txtdate' type='date' class='form-control' id='Date' value='{$row['flddate']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='Datereq'>Date Required:</label>
                                            <input readonly name='txtdatereq' type='date' class='form-control' id='Datereq' value='{$row['flddatereq']}'>
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
                                            <input readonly name='txtproduct' type='text' class='form-control' id='product' value='{$row['fldproduct']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='Quantity'>Quantity:</label>
                                            <input readonly name='txtquantity' type='number' class='form-control' id='Quantity' value='{$row['fldquantity']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='description'>Description:</label>
                                            <input readonly name='txtdescription' type='text' class='form-control' id='description' value='{$row['flddesc']}'>
                                        </div>
                                        <div class='form-group px-2'>
                                            <label for='supplier'>Supplier:</label>
                                            <input readonly name='txtsupplier' type='text' class='form-control' id='supplier' value='{$row['fldsupplier']}'>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width='50%'>
                                        <div class='form-group px-2'>
                                            <label for='unitprice'>Unit Price:</label>
                                            <input readonly name='txtunitprice' type='number' class='form-control' id='unitprice' value='{$row['flduprice']}'>
                                        </div>
                                    </td>
                                    <td width='50%'>
                                        <div class='form-group px-2'>
                                            <label for='totalprice'>Total Price:</label>
                                            <input readonly name='txttotalprice' type='number' class='form-control' id='totalprice' value='{$row['fldtprice']}'>
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
    ?>

<!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        var purpose = document.getElementById("Purpose");
        var productList = document.getElementById("form-product");

        function myFunction() {
            var selectedPurpose = purpose.value;
            if (purpose.value == "Restock") {
                document.getElementById("form-product").innerHTML = "<label for='product'>Product:</label><select required name='txtproduct' class='form-select' id='product'><?php $result = $conn->query('SELECT fldproduct FROM tblstock');while ($row = $result->fetch_assoc()) {$product = $row['fldproduct'];echo "<option value='$product'>$product</option>";}?></select>";
            } else {
                document.getElementById("form-product").innerHTML = "<label for='product'>Product:</label><input required name='txtproduct' type='text' class='form-control' id='product'>";
            }
        }
    </script>
    <?PHP
    if(isset($_GET["Requested_Successfully"])){
        echo "<script>setTimeout(Hello, 250);function Hello(){alert('Requested Successfully.');}</script>";
    }elseif(isset($_GET["Deleted_Successfully"])){
        echo "<script>setTimeout(Hello, 250);function Hello(){alert('Deleted Successfully.');}</script>";
    }elseif(isset($_GET["Failed"])){
        echo "<script>setTimeout(Hello, 250);function Hello(){alert('Deleting failed! Requested by other user.');}</script>";
    }
    ?>
</body>
</html>
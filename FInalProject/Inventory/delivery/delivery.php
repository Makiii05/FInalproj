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
                                <li><a href="../purchasing/purchase_request.php" class="btn rounded text-light">Purchase Requests</a></li>
                                <li><a href="../purchasing/purchase_order.php" class="btn rounded text-light">Purchase Order</a></li>
                                <li><a href="../purchasing/account_payable.php" class="btn rounded text-light">Account Payable</a></li>
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
    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 text-white">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline pt-3"><h4>Insert Records</h4></span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <button type="button" class="btn text-white my-3" data-bs-toggle="modal" data-bs-target="#PhysicalCount"><i class="bi bi-hand-index"></i> Physical Count</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn text-white my-3" data-bs-toggle="modal" data-bs-target="#StockTransfer"><i class="bi bi-truck"></i> Stock Transfer</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn text-white my-3" data-bs-toggle="modal" data-bs-target="#Wastages"><i class="bi bi-trash3"></i> Wastages</button>
                    </li>

                </ul>
                <hr>
            </div>
        </div>
<!-- records -->
        <div class="col py-3">
            <div class="profile-container text-end">
                <button type="button" class="btn btn-secondary text-end" data-bs-toggle="offcanvas" data-bs-target="#demo">Current Stocks</button>
                <iframe src="iframe/stock_record.php" name="stockRecordIframe" frameborder="1" width="100%" height="500" style="overflow-y: scroll;"></iframe>
            </div>
        </div>
<!-- Current stock -->
        <div class="offcanvas offcanvas-end" id="demo">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title">Current Stocks</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="profile-container">
                    <h5>Current Stocks</h5>
                    <iframe src="iframe/current_stock.php" name="currentStockIframe" frameborder="1" width="100%" height="440" style="overflow-y: scroll;"></iframe>
                </div>
            </div>
        </div>
<!-- physical counts -->
        <div class="modal fade modal-md" id="PhysicalCount" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="PHP_delivery.php" method="get" target="stockRecordIframe">
                        <div class="modal-header">
                            <h5 class="modal-title">Physical Counts</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Date:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtdate" type="date" class="form-control" value="<?PHP echo date('Y-m-d'); ?>"/>
                            </div>
                            
                            <label>Product:</label>
                            <div class="mb-2 input-group">
                                <select required name='txtproduct' class='form-select'>
                                    <?php 
                                    $result = $conn->query('SELECT fldproduct FROM tblstock');
                                    while ($row = $result->fetch_assoc()) {
                                        $product = $row['fldproduct'];
                                        echo "<option value='$product'>$product</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <label class="form-label">Quantity:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtquantity" type="number" class="form-control"/>
                            </div>
                            
                            <label class="form-label">Unit Price:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtuprice" type="number" class="form-control"/>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <div class="mt-2 text-end">
                                <button type="submit" class="btn btn-secondary" name="PhysicalCount">Add Record</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- wastages modal -->
        <div class="modal fade modal-md" id="Wastages" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="PHP_delivery.php" method="get" target="stockRecordIframe">
                        <div class="modal-header">
                            <h5 class="modal-title">Wastages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Date:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtdate" type="date" class="form-control" value="<?PHP echo date('Y-m-d'); ?>"/>
                            </div>
                            
                            <label>Product:</label>
                            <div class="mb-2 input-group">
                                <select required name='txtproduct' class='form-select'>
                                    <?php 
                                    $result = $conn->query('SELECT fldproduct FROM tblstock');
                                    while ($row = $result->fetch_assoc()) {
                                        $product = $row['fldproduct'];
                                        echo "<option value='$product'>$product</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <label class="form-label">Number of Wastages:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtquantity" type="number" class="form-control"/>
                            </div>
                            
                            <label class="form-label">Unit Price:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtuprice" type="number" class="form-control"/>
                            </div>
                            
                            <label class="form-label">Reasons:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtreason" type="text" class="form-control"/>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <div class="mt-2 text-end">
                                <button type="submit" class="btn btn-secondary" name="Wastages">Add Record</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- stock transfer modal -->
        <div class="modal fade modal-md" id="StockTransfer" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="PHP_delivery.php" method="get" target="stockRecordIframe">
                        <div class="modal-header">
                            <h5 class="modal-title">Stock Transfer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Date:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtdate" type="date" class="form-control" value="<?PHP echo date('Y-m-d'); ?>"/>
                            </div>
                            
                            <label>Product:</label>
                            <div class="mb-2 input-group">
                                <select required name='txtproduct' class='form-select'>
                                    <?php 
                                    $result = $conn->query('SELECT fldproduct FROM tblstock');
                                    while ($row = $result->fetch_assoc()) {
                                        $product = $row['fldproduct'];
                                        echo "<option value='$product'>$product</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <label class="form-label">Quantity:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtquantity" type="number" class="form-control"/>
                            </div>
                            
                            <label class="form-label">Unit Price:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtuprice" type="number" class="form-control"/>
                            </div>
                            
                            
                            <label class="form-label">Destination:</label>
                            <div class="mb-2 input-group">
                                <input required name="txtdestination" type="text" class="form-control"/>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <div class="mt-2 text-end">
                                <button type="submit" class="btn btn-secondary" name="Transfer">Add Record</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
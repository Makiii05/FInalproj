<?php
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
                        <a href="../../Dashboard/admin.php" class="btn py-4 d-inline-flex rounded text-light">
                            <b>Dashboard</b>
                        </a>
                    </li>
                    <li class="nav-item">
                    <i class="bi bi-shop-window"></i>
                        <button class="btn dropdown-toggle py-4 rounded text-light" data-bs-toggle="collapse" data-bs-target="#sale-collapse" aria-expanded="true" aria-current="true">
                            <b>Sales</b>
                        </button>
                        <div class="collapse" id="sale-collapse">
                            <ul class="list fw-normal pb-1 small">
                                <li><a href="../../Sales/product_infos.php" class="btn rounded text-light">Products Informations</a></li>
                                <li><a href="../../Sales/Reports/cashier_report.php" class="btn rounded text-light">Cashier's Report</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                    <i class="bi bi-card-list"></i>
                        <button class="btn dropdown-toggle rounded py-4 text-light" data-bs-toggle="collapse" data-bs-target="#inventory-collapse" aria-expanded="true" aria-current="true">
                            <b>Inventory</b>
                        </button>
                        <div class="collapse" id="inventory-collapse">
                            <ul class="list fw-normal pb-1 small">
                                <li><a href="../users_profile.php" class="btn rounded text-light">User's Profile</a></li>
                                <li><a href="../requests.php" class="btn rounded text-light">Requests</a></li>
                                <li><a href="admin_delivery.php" class="btn rounded text-light">Delivery</a></li>
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
            <a class="navbar-brand" href="../../Dashboard/admin.php">
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
<!-- records -->
    <div class="col py-3">
        <div class="profile-container text-end">
            <button type="button" class="btn btn-secondary text-end" data-bs-toggle="offcanvas" data-bs-target="#demo">Current Stocks</button>
            <iframe src="iframe/stock_record.php" name="stockRecordIframe" frameborder="1" width="100%" height="500" style="overflow-y: scroll;"></iframe>
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
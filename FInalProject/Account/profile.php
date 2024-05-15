<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .profile-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
        .border{
            width: 250px;
            height: 250px;
        }
        .file-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<?php
session_start();


// Retrieve user data from the session
$userId = $_SESSION["user_id"];
$lastName = $_SESSION["user_lastname"];
$givenName = $_SESSION["user_givenname"];
$position = $_SESSION["user_position"];
$email = $_SESSION["user_email"];
$contact = $_SESSION["user_contact"];
$address = $_SESSION["user_address"];
$birthdate = $_SESSION["user_bday"];
$username = $_SESSION["user_username"];
$profPic = $_SESSION["user_profilepic"];
?>
<body>
    <div class="d-flex">
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
            <!-- Logo -->
            <a class="navbar-brand mx-3" href="../Dashboard/<?PHP 
                        switch($_SESSION["user_position"]){
                            case "Admin":
                                echo "admin";
                                break;
                            case "Cashier":
                                echo "cashier";
                                break;
                            case "Purchasing Officer":
                                echo "purchasing";
                                break;
                        } 
                        ?>.php">
                Business Namee
            </a>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown mx-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Dashboard/<?PHP 
                        switch($_SESSION["user_position"]){
                            case "Admin":
                                echo "admin";
                                break;
                            case "Cashier":
                                echo "cashier";
                                break;
                            case "Purchasing Officer":
                                echo "purchasing";
                                break;
                        } 
                        ?>.php">Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../Account/login.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <h1 class="my-4"><?php echo "$givenName"; ?>'s Profile</h1>
        <div class="row">
            <div class="col-md-6 py-3">
                <div class="profile-container" style="width: 1100px;">
                    <form>
                        <table width="1050">
                            <tr>
                                <td colspan="2">
                                    <h5>Personal Information</h5>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" rowspan="2">
                                    <div class="file-container">
                                        <div class="container border rounded" style="background-image: url(profPic/<?PHP echo"$profPic"; ?>); background-size: cover;">
                                        </div>
                                    </div>
                                </td>
                                <td width="50%">
                                    <div class="form-group">
                                        <label for="lastName">Last Name:</label>
                                        <input type="text" class="form-control" id="lastName" value="<?php echo $lastName; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="givenName">Given Name:</label>
                                        <input type="text" class="form-control" id="givenName" value="<?php echo $givenName; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Position:</label>
                                        <input type="text" class="form-control" id="position" value="<?php echo $position; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact:</label>
                                        <input type="text" class="form-control" id="contact" value="<?php echo $contact; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" id="address" value="<?php echo $address; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate">Birthdate:</label>
                                        <input type="text" class="form-control" id="birthdate" value="<?php echo $birthdate; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="mt-2 text-end">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateForm" class="btn btn-secondary">Update Profile</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-xl" id="updateForm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="PHP_account.php" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table style="width: 100%;">
                            <tr>
                                <td width=50%>
                                    <label for="lastname" class="form-label">Last Name:</label>
                                    <div class="mb-2 input-group">
                                        <input required name="Updlastname" type="text" id="lastname" class="form-control" value="<?PHP echo $lastName; ?>"/>
                                    </div>

                                    <label for="email" class="form-label">Email address:</label>
                                    <div class="mb-2 input-group">
                                        <input required name="Updemail" type="text" id="email" class="form-control" value="<?PHP echo $email; ?>"/>
                                    </div> 

                                    <label for="address" class="form-label">Current Address:</label>
                                    <div class="mb-2 input-group">
                                        <input required name="Updaddress" type="text" id="address" class="form-control" value="<?PHP echo $address; ?>"/>
                                    </div> 
                                </td>
                                <td width=50%>
                                    <label for="givenname" class="form-label">Given Name:</label>
                                    <div class="mb-2 input-group">
                                        <input required name="Updgivenname" type="text" id="givenname" class="form-control" value="<?PHP echo $givenName; ?>"/>
                                    </div>

                                    <label for="contact" class="form-label">Contact Number:</label>
                                    <div class="mb-2 input-group">
                                        <input required name="Updcontact" type="text" id="contact" class="form-control" value="<?PHP echo $contact; ?>"/>
                                    </div>

                                    <label for="bday" class="form-label">Birthdate:</label>
                                    <div class="mb-2 input-group">
                                        <input required name="Updbday" type="date" id="bday" class="form-control" value="<?PHP echo $birthdate;?>"/>
                                    </div>
                                
                                    <!-- <label for="pic" class="form-label">Profile Picture:</label>
                                    <div class="mb-2 input-group">
                                        <input required name="UpdprofPic" type="file" id="pic" class="form-control" value="<?PHP echo $profPic; ?>" accept=".png, .jpg, .jpeg"/>
                                    </div> -->
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div class="mt-2 text-end">
                            <button type="submit" class="btn btn-secondary" name="Update">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?PHP
    if(isset($_GET["Updated_Successfully"])){
        echo "<script>setTimeout(Hello, 250);function Hello(){alert('Updated Successfully.');}</script>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
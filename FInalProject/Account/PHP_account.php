<?php
include("../conn.php");

if (isset($_POST["txtlastname"])) { //SIGN UP
    $lastname = $_POST["txtlastname"];
    $givenname = $_POST["txtgivenname"];
    $email = $_POST["txtemail"];
    $contact = $_POST["txtcontact"];
    $address = $_POST["txtaddress"];
    $birthdate = $_POST["txtbday"];
    $username = $_POST["txtusername"];
    $password = $_POST["txtpassword"];
    $position = $_POST["txtposition"];

    $uploadDir = 'profPic/';

    // Create the directory if it doesn't exist
    if (isset($_FILES["profPic"]) && $_FILES["profPic"]["error"] == UPLOAD_ERR_OK) {
        $fileName = $_FILES["profPic"]["name"];
        $tmpName = $_FILES["profPic"]["tmp_name"];
        $fileSize = $_FILES["profPic"]["size"];
        $fileError = $_FILES["profPic"]["error"];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png");

        if (in_array($imageExtension, $allowedExtensions)) {
            if ($fileSize < 5000000) { // 5MB limit
                $newImageName = uniqid() . '.' . $imageExtension;

                move_uploaded_file($tmpName, $uploadDir . $newImageName);

                // Insert data into the database
                $conn->query("Insert into tblaccount (fldlastname, fldgivenname, fldemail, fldcontact, fldaddress, fldbday, flduser, password, fldposition, fldprofilepic) 
                values ('$lastname', '$givenname', '$email', '$contact', '$address', '$birthdate', '$username', '$password', '$position', '$newImageName')");

                header("location:signup.php?SignUp_Successfully");
            } else {
                echo "File size exceeds the limit of 5MB.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
        }
    } else {
        echo "Error uploading the file.";
    }
} elseif (isset($_POST["txtloginuser"])) { //LOGIN
    $user = $_POST["txtloginuser"];
    $pass = $_POST["txtloginpass"];

    $result = $conn->query("SELECT * FROM tblaccount WHERE flduser = '$user' AND password = '$pass'");
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Login successful
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_lastname"] = $row["fldlastname"];
        $_SESSION["user_givenname"] = $row["fldgivenname"];
        $_SESSION["user_position"] = $row["fldposition"];
        $_SESSION["user_email"] = $row["fldemail"];
        $_SESSION["user_contact"] = $row["fldcontact"];
        $_SESSION["user_address"] = $row["fldaddress"];
        $_SESSION["user_bday"] = $row["fldbday"];
        $_SESSION["user_username"] = $row["flduser"];
        $_SESSION["user_profilepic"] = $row["fldprofilepic"];

        if($_SESSION["user_position"] == "Admin"){
            header("Location: ../Dashboard/admin.php");
        }elseif($_SESSION["user_position"] == "Cashier"){
            header("Location: ../Dashboard/cashier.php");
        }elseif($_SESSION["user_position"] == "Purchasing Officer"){
            header("Location: ../Dashboard/purchasing.php");
        }
        exit;
    } else {
        header("Location: login.php?incorrect=true");
        exit;
    }
}elseif (isset($_GET["Updlastname"])) {
    session_start();
    $lastname = $_GET["Updlastname"];
    $givenname = $_GET["Updgivenname"];
    $email = $_GET["Updemail"];
    $contact = $_GET["Updcontact"];
    $address = $_GET["Updaddress"];
    $birthdate = $_GET["Updbday"];

    $conn->query("UPDATE `tblaccount` SET `fldlastname`='$lastname',`fldgivenname`='$givenname',`fldemail`='$email',`fldcontact`='$contact',`fldaddress`='$address',`fldbday`='$birthdate' WHERE id=$_SESSION[user_id]");
    $_SESSION["user_lastname"] = $lastname;
    
    header("Location: profile.php?Updated_Successfully");
}
?>
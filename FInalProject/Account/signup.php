<?PHP
include("../conn.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
</style>
    <body>
    <form action="PHP_account.php" method="POST" enctype="multipart/form-data">
        <div class="container" style="width: 1000px;">
            <div class="row justify-content-center my-2">
                <div class="list-group list-group-horizontal">
                    <div class="list-group-item" style="width: 500px;">
                        <div class="col py-3">
                                <label for="lastname" class="form-label">Last Name:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtlastname" type="text" id="lastname" class="form-control" placeholder="e.g. Dela Cruz" />
                                </div>

                                <label for="givenname" class="form-label">Given Name:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtgivenname" type="text" id="givenname" class="form-control" placeholder="e.g. John Doe" />
                                </div>

                                <label for="email" class="form-label">Email address:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtemail" type="text" id="email" class="form-control" placeholder="e.g. example@gmail.com" />
                                </div>

                                <label for="contact" class="form-label">Contact Number:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtcontact" type="text" id="contact" class="form-control" placeholder="e.g. 09123456789" />
                                </div> 

                                <label for="address" class="form-label">Current Address:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtaddress" type="text" id="address" class="form-control" placeholder="Barangay, Municipality, Province"/>
                                </div> 

                                <label for="bday" class="form-label">Birthdate:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtbday" type="date" id="bday" class="form-control"/>
                                </div>
                        </div>
                    </div>
                    <div class="list-group-item" style="width: 500px;">
                        <div class="col py-3">
                                <label for="Username" class="form-label">Username:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtusername" type="text" id="Username" class="form-control"/>
                                </div>

                                <label for="password" class="form-label">Password:</label>
                                <div class="mb-2 input-group">
                                    <input required name="txtpassword" type="password" id="password" class="form-control"/>
                                </div>

                                <label for="position" class="form-label">Position</label>
                                <div class="mb-2 input-group">
                                    <select required name="txtposition" class="form-select" id="position">
                                        <option value="Admin" selected>Admin</option>
                                        <option value="Cashier">Cashier</option>
                                        <option value="Purchasing Officer">Purchasing Officer</option>
                                    </select>
                                </div>
                                
                                <label for="pic" class="form-label">Profile Picture:</label>
                                <div class="mb-2 input-group">
                                    <input required name="profPic" type="file" id="pic" class="form-control" accept=".png, .jpg, .jpeg"/>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="list-group">
                    <div class="text-center list-group-item">
                        <div class="mt-2 text-center">
                            <button type="submit" class="btn btn-secondary">Sign Up</button>
                        </div>
                        <div class="col">
                            <small class="text-muted">Already have an account? <a href="login.php">Login Here</a></small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <?PHP
        if(isset($_GET["SignUp_Successfully"])){
            echo "<script>setTimeout(Hello, 250);function Hello(){alert('Sign Up Successful');}</script>";
        }
        ?>
    </body>
</html>
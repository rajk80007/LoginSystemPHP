<?php
        $showAlert=false;
        $showError = false;
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        
        include 'partials/_dbconnect.php';
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        // $exists = false;
        // Check whether this username Exists;
        $existSql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows >0) {
            // $exists = true;
            $showError = "Username Already Exists. Please try with different username";
        }
        else {
            $exists = false;
       
        if(($password == $cpassword)){
            $hash= password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp()); ";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;

                
            } 
        }
        
        else {
            $showError = "Confirm Password do not match.";
        }
    }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    require 'partials/_nav.php';
    ?>
    <?php
    if($showAlert){

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($showError){

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!'.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>
    <div class="container">
        <h1 class="text-center">Sign Up to our website</h1>
        <form action = "/raj/LoginSystem/signup.php" method = "post">
            <div class="mb-3 col-md-6 ">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name = "username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name = "password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="23" class="form-control" id="cpassword" name = "cpassword">
                <div id="emailHelp" class="form-text">Make sure to type the same password  .</div>
           
            </div>
            
            <button type="submit" class="btn btn-primary ">SignUp</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
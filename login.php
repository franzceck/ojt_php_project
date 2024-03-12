<?php
require 'connection.php';

session_start();

// Check if the user is already logged in
// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
//     header('Location: sidebar.php');
//     exit;
// }

$error = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=isset($_POST['username']) ? $_POST['username'] : '';
    $password=isset($_POST['password']) ? $_POST['password'] : '';
    // $username=$_POST['username'];
    // $password=$_POST['password'];

    $sql = "SELECT * FROM mss_users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)){
        $resultPassword = $row['password'];
        // Hash the input password and compare
        if(hash('sha256', $password) === $resultPassword){
            $_SESSION['loggedin'] = true;
            header('Location: dashboard.php');
            exit();
        }else{
            $error = "Wrong username or password";
        }
    }
    $error = "Wrong username or password";

}
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Lifesaver</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style1.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    


</head>
<body>
    <div class="row vh-100 g-0">
        <!-- LEFT SIDE -->
        <div class="col-lg-6 position-relative d-none d-lg-block">
            <div class="bg-holder" style="background-image: url(images/login_photo.jpg);">
            </div>
        </div>
        <!-- RIGHT SIDE -->
        <div class="col-lg-6">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-6">
                    <a href="#" class="d-flex justify-content-center mb-4">
                        <img src="images/login_logo.png" alt="" width="350">
                    </a>
                    <div class="text-center mb-3">
                        <h3 class="fw-bold">Log In</h3>
                        <p class="text-secondary">Get access to your account</p>
                        <span style="color: red;"><?php echo $error ?></span>
                    </div>
                    
                    <form method= "post" action="login.php">
                        <div class="input-group mb-3">
                           <span class="input-group-text">
                                <i class='bx bx-user'></i>
                           </span>
                           <input type="name" name="username" class="form-control form-control-lg fs-6" placeholder="Username" required>
                           
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class='bx bx-lock-alt' ></i>
                            </span>
                            <input type="password" name="password" class="form-control form-control-lg fs-6" placeholder="Password" required>
                         </div>
                         <div class="input-group mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small>
                                </label>
                            </div>
                            <div>
                                <small><a href="#">Forgot Password</a></small>
                            </div>
                         </div>
                         <button class="btn btn-primary btn-lg w-100 mb-3" name="login_btn">Login</button>
                    </form>
                    <div class="text-center">
                        <small>Back to <a href="index.php" class="fw-bold">Home</a></small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



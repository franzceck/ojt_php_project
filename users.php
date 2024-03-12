<?php
require 'connection.php';


session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

$errors = [];
$error = '';


if($_SERVER['REQUEST_METHOD']=='POST'){
    $first_name=isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name=isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $username=isset($_POST['username']) ? $_POST['username'] : '';
    $email=isset($_POST['email']) ? $_POST['email'] : '';
    $contact_number=isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
    $password=isset($_POST['password']) ? $_POST['password'] : '';

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Validate password
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        $errors[] = "Password must contain at least one uppercase letter";
    }
    if (!preg_match("/[a-z]/", $password)) {
        $errors[] = "Password must contain at least one lowercase letter";
    }
    if (!preg_match("/\d/", $password)) {
        $errors[] = "Password must contain at least one number";
    }
    if (!preg_match("/[@$!%*?&]/", $password)) {
        $errors[] = "Password must contain at least one special character";
    }

    // sCheck if username already exist
    $sql_check_username = "SELECT * FROM mss_users WHERE username = ?"; //create an SQL query
    $stmt_check_username = mysqli_prepare($conn, $sql_check_username);
    mysqli_stmt_bind_param($stmt_check_username, "s", $username);
    mysqli_stmt_execute($stmt_check_username);
    $result_check_username = mysqli_stmt_get_result($stmt_check_username);
    if(mysqli_num_rows($result_check_username) > 0) {
        $errors[] = "Username already exists";
    }

    if (empty($errors)) {
        // Hash the password
        $hashed_password = hash('sha256', $password);

        $sql = "INSERT INTO mss_users (first_name, last_name, username, email, contact_number, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $username, $email, $contact_number, $hashed_password);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo '<script>alert("Account created successfully");</script>';
            echo '<script>window.location.href = window.location.href;</script>'; // Reload the page
            
        } else {
            $error = "Error creating account: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Lifesaver</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style2.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>

    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>


</head>
<body>
    <div class="wrapper">
        <?php require 'sidebar.php' ?>
        <div class="main">
        <?php require 'navbar.php'; ?>
            <main class="content px-3 py-2">
                <div class="container">
                    <div class="mb-3">
                        <h4>Create Account</h4>
                    </div>
                    <hr>
                    <div class="container-fluid w-75 card">
                        <span class="alert" style="color:red; height: 5px;"><?php echo $error ?></span>

                        <!-- ACCOUNT CREATION FORM -->

                        <form method= "post" action="users.php">
                            <div class="input-group mb-2">
                               <span class="input-group-text">
                                    <!-- <i class='bx bx-user'></i> -->
                               </span>
                               <input type="text" name="first_name" class="form-control form-control-lg fs-6" placeholder="First Name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" required>                      
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                     <!-- <i class='bx bx-user'></i> -->
                                </span>
                                <input type="text" name="last_name" class="form-control form-control-lg fs-6" placeholder="Last Name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>" required>                      
                             </div>
                             <div class="input-group mb-2">
                                <span class="input-group-text">
                                     <!-- <i class='bx bx-user'></i> -->
                                </span>
                                <input type="text" name="username" class="form-control form-control-lg fs-6" placeholder="Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>                      
                             </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                     <!-- <i class='bx bx-user'></i> -->
                                </span>
                                <input type="email" name="email" class="form-control form-control-lg fs-6" placeholder="Email Address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>                      
                             </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                     <!-- <i class='bx bx-user'></i> -->
                                </span>
                                <input type="text" name="contact_number" class="form-control form-control-lg fs-6" placeholder="Contact Number" value="<?php echo isset($_POST['contact_number']) ? $_POST['contact_number'] : ''; ?>" required>                      
                             </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <!-- <i class='bx bx-lock-alt' ></i> -->
                                </span>
                                <input type="password" name="password" class="form-control form-control-lg fs-6" placeholder="Password" value="" required>
                             </div>
                             <!-- <label class="form-label" for="customFile"><br>Display Photo</label><input type="file" class="form-control" id="customFile" /> -->
                             
                             <div class="mb-2">
                             <a href="manage_users.php" class="btn btn-secondary mt-4" >Cancel</a>
                             <button type="submit" class="btn btn-primary mt-4" style="margin-left: 10px;" name="create_account_btn">Create Account</button>
                             </div>

                        </form>
                    </div>
    
            </main>
            
            
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
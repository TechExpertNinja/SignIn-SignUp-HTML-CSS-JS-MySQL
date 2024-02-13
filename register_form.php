<?php
// register_form.php
include 'config.php';

$errors = [];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    
    if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
        $errors[] = 'All fields are required.';
    } else {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        }

        if ($password != $cpassword) {
            $errors[] = 'Password mismatch.';
        }
    }

   
    if (empty($errors)) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $select_query = "SELECT * FROM user_form WHERE email = ?";
        $stmt = mysqli_prepare($conn, $select_query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = 'User already exists.';
        } else {
            
            $insert_query = "INSERT INTO user_form (name, email, password, user_type) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $user_type);
            mysqli_stmt_execute($stmt);

            header('Location:login_form.php');
            exit(); 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <!-- custom css file link-->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register now</h3>

            <!-- Error Message -->
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>

            <input type="text" name="name" required placeholder="Enter your name">
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="password" name="cpassword" required placeholder="Confirm your password">

            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register now" class="form-btn">

            <p>Already have an account? <a href="login_form.php">Login now</a></p>
        </form>
    </div>

    <footer style="display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">
        <div class="footer-content">
            <h6 style="margin: 0;">Developed By Lary . 2024</h6>
        </div>
    </footer>
</body>

</html>

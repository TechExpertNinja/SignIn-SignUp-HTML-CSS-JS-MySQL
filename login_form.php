<?php
    @include 'config.php';

    session_start();

        if(isset($_POST['submit'])) {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $pass = md5($_POST['password']);
                $cpass = md5($_POST['cpassword']);
                $user_type = $_POST['user_type'];

                $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

                $result = mysqli_query($conn, $select);

                if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_array($result);

                        if($row['$user_type'] == 'admin');

                            $_SESSION['admin_name'] = $row['name'];
                            header('location: admin_page.php');
                        }
                        elseif ($row['$user_type'] == 'user') {

                            $_SESSION['user_name'] = $row['name'];
                            header('location: user_page.php');
                        };
        }
        else {
            $error[] = 'Incorrect email or password!!';
        }
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>
    <!-- custom css file link-->
    <link rel="stylesheet" href="css/style.css">

    <script src="https://www.google.com/recaptcha/api.js?render=YOUR_SITE_KEY">
        //My SITE KEY IS: 
    </script>



</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>login now</h3>

<!--Error Message!-->
                <?php
                        if (isset($error)) {
                            foreach($error as $error) {
                                echo '<pan class="error-msg">'.$error.'</span>';
                            };
                        };
                    ?>

            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">

            <input type="submit" name="submit" value="login now" class="form-btn">

            <p>Don't have an account? <a href="register_form.php">sign up</a></p>
        </form>
    </div>




    <footer style="display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">
        <div class="footer-content">
            <h6 style="margin: 0;">Developed By Lary 2024</h6>
        </div>
    </footer>

</body>
</html>
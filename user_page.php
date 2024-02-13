<?php 
    
    $conn = mysqli_connect('locahost', 'root', '', '')


?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>admin page</title>

        <!-- custom css file link-->
        <link rel="stylesheet" href="css/style.css">

</head>
<body>

        <div class="container">
            <div class="content">
                <h3>Hi, <span>User</span></h3>
                <h1>Welcome <span></span></h1>
                <p>This is an user page</p>
                <a href="login_form.php" class="btn">login</a>
                <a href="register_form.php" class="btn">register</a>
                <a href="logout.php" class="btn">logout</a>
            </div>    
        </div>



    <footer style="display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">
        <div class="footer-content">
            <h6 style="margin: 0;">Developed By Lary 2024</h6>
        </div>
    </footer>
</body>
</html>
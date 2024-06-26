<?php 
    session_start();
    include("dbinit.php");
    $error="";
    $msg="";

    if(isset($_REQUEST['login']))
    {
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];

        $password= sha1($password);
        
        if(!empty($email) && !empty($password))
        {
            $sql = "SELECT * FROM register where email='$email' && password='$password'";
            $result=mysqli_query($dbc, $sql);
            $row=mysqli_fetch_array($result);
               if($row){
                    $_SESSION['ID']=$row['ID'];
                    $_SESSION['email']=$email;
                    header("location:index.php");
               }
               else{
                   $error = "<p class='alert alert-warning'>Email or Password doesnot match!</p> ";
               }
        }else{
            $error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php';?>
    <div class="login-container">
        <div class="login-image">
            <img src="Images/home.png">
        </div>
        <div class="login-text">
            <h1>Welcome to Cure Corner</h1><br>
            <div>
                <form class="login-form" method="post">
                    <h3>Log In Into Your Account</h3>

                    <?php echo $error; ?><?php echo $msg; ?>
                    <input type="email" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <a href="forgotPassword.php">Forgot Password?</a><br>

                    <button type="submit" name="login">LogIn</button>
                </form>
            </div><br>

            <h3>Don't have an account? <a href="signup.php">Register Here</a></h3>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
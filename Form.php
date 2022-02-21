<?php
    require_once('connreg.php');
    include_once('Mail/Exception.php');
    include_once('Mail/PHPMailer.php');
    include_once('Mail/SMTP.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    //require 'vendor/autoload.php';
 
    if (isset($_POST["register"]))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $con_pass = $_POST['cnfpassword'];
        $ok = 1;
        //print_r($_POST);
        if (!preg_match("/^[A-Za-z0-9\-\.\_]+@[A-Za-z0-9\-\.\_]+\.[a-zA-Z]{2,6}/i", $email)) {
            $email_valid = "<span style='color:red'>Input a valid Email.</span>";
            //echo "Email Accessed <br>";
            $ok = 0;
        }
    
        if (strlen($name) > 30 || strlen($name) < 3) {
            $name_valid = "<span style='color:red'>Name size should be in between 3 and 30</span>";
            //echo "EmaNameil Accessed <br>";
            $ok = 0;
        }
    
        if (strlen($pass) < 8) {
            $pass_valid = "<span style='color:red'>Password Lenght Should be at least 8</span>";
            //echo "P Accessed <br>";
            $ok = 0;
        }
    
        if ($pass != $con_pass) {
            $pass_con_valid = "<span style='color:red'>Password dosen't matches</span>";
            //echo "PC Accessed <br>";
            $ok = 0;
        }
        
 
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
 
        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
            //Send using SMTP
            $mail->isSMTP();
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = 'mdrafiujjaman5@gmail.com';
 
            //SMTP password
            $mail->Password = 'rasel@554659';
 
            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
 
            //Recipients
            $mail->setFrom('your_email@gmail.com', 'your_website_name');
 
            //Add a recipient
            $mail->addAddress($email, $name);
 
            //Set email format to HTML
            $mail->isHTML(true);
 
            $verification_code = random_int(100000, 999999);
            //var_dump($verification_code);
            //exit;
 
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
 
            $mail->send();
            // echo 'Message has been sent';
 
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
 
            // connect with database
           // $conn = mysqli_connect("localhost:8889", "root", "root", "test");
 
            // insert in users table
            if ($ok) {
                $pass = md5($pass);
                $sql = "INSERT INTO `registration` (`name`, `email`, `password`, verification_code) VALUES ('$name', '$email', '$pass', '$verification_code')";
                $query = mysqli_query($con, $sql);
        
                if ($query) {
                    header("Location: email-verification.php?email=" . $email);
        
                } else {
                    echo "<span style=\"color: red\" >Error:<span> " . mysqli_error($con);
                }
            }
            passError();


            // $sql = "INSERT INTO users(
            //     name, 
            //     email, 
            //     password,
            //     verification_code
                
            //     ) VALUES (
            //         '" . $name . "', 
            //         '" . $email . "', 
            //         '" . $encrypted_password . "', 
            //         '" . $verification_code . "'
            //         )";
            // mysqli_query($con, $sql);
 
            
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>
    <form action="" method="post">
        <div class="container">
        <h1>Register Here</h1>
        <p>Please fill in the details to create an account with us.</p>
        <hr>
        <label for="Name"><b>Enter Name</b></label>
        <input type="text"class="<?php echo (isset($name_valid)) ? "bd-red":"";?>" placeholder="Enter Name"  <?php echo (isset($name)) ? "value='$name'":"";?>name="name"><br>
        <?php echo (isset($name_valid)) ? "$name_valid":"";?>
        <br>
        <label for="email"><b>Enter Email</b></label>
        <input type="email" class="<?php echo (isset($email_valid)) ? "bd-red":"";?>" placeholder="Enter Email" <?php echo (isset($email)) ? "value='$email'":"";?> name="email"><br>
        <?php echo (isset($email_valid)) ? "$email_valid":"";?>
        <br>
        <label for="pwd"><b>Password</b></label>
        <input type="password" class="<?php echo (isset($pass_valid)) ? "bd-red":"";?>" placeholder="Enter Password" name="password"><br>
        <?php echo (isset($pass_valid)) ? "$pass_valid":"";?>
        <br>
        <label for="confirm"><b>Confirm Password</b></label>
        <input type="password" class="<?php echo (isset($pass_con_valid)) ? "bd-red":"";?>" placeholder="Confirm Password" name="cnfpassword">
        <br> <?php echo (isset($pass_con_valid)) ? "$pass_con_valid":"";?>
        <hr>
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <input type="submit" name="register" class="registerbtn" value="Register" />
        </div>
        <div class="container signin">
        <p>Already have an account? <a href="Login.php">Sign in</a>.</p>
        </div>
    </form>
    <style>
        .bd-red{
            border-color: red;
            
        }

        form{
            text-align: center;
        }
        h1{
            text-align: center;
            color: green;
            background-color: lightgrey;
        }
        label{
            padding: 5 em;
        }
        button{
            color: green;
            text-align: center;
        }
    </style>
</body>
</html>
<?php
    $myemail = "rasel@gmail.com";
    $mypass = "5546";

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        if($email == $myemail and $pass == $mypass){
            if(isset($_POST['remember'])){
                setcookie('email', $email, time()-1);
                session_start();
                $_SESSION['email'] = $email;
                header("location: welcome.php");
            }
        }else{
            echo "Inter Currect username or password. <a href= 'Login.php'>try again</a>";
        }
    }else{
        header("location: Login.php");
    }
?>
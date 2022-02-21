<?php
require_once('dbcnn.php');


if(isset($_GET['email'])){




    $email = $_GET['email'];
    if(isset($_POST['verify'])){
        $code = $_POST['code'];
    $sql = "UPDATE `registration`  SET
        email_verified_at = '1'
        WHERE email = '$email' AND verification_code = '$code'
    ";


    $res = mysqli_query($con, $sql);
    if($res){
        echo "Verification Successfull";
    } else {
        echo "Verification unsuccessful.";
    }
    }


}

?>

<form method="post">
    <input type="text" name="code" />
    <input type ="submit" name="verify" value = "Verify" />

</form>
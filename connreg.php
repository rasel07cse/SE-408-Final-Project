
<?php
include 'dbcnn.php';
//session_start();
//error_reporting(0);

// if(isset($_SESSION['username'])){
// 	header("Location: WebDesign.html");
// }

if (isset($_POST['registration'])) {
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
	
	if ($ok) {
		$pass = md5($pass);
		$sql = "INSERT INTO `registration` (`name`, `email`, `password`) VALUES ('$name', '$email', '$pass')";
		$query = mysqli_query($con, $sql);

		if ($query) {
			echo "<script>alert('Data Inserted Successfully.');windows.location.replace('http://localhost/FinalProject/form.php')</script>";

		} else {
			echo "<span style=\"color: red\" >Error:<span> " . mysqli_error($con);
		}
	}
	passError();
}

// echo "<pre>";
// if(isset($_POST['registration']))
// 	print_r($_POST);

// echo "</pre>";
function nameError($n = 0)
{
	if (isset($name_valid)) {
		if ($n == 1) echo "bd-red";
		else echo "<span color='red'>$name_valid</span>";
	}
}

function emailError($n = 0)
{
	if (isset($email_valid)) {
		if ($n == 1) echo "bd-red";
		else echo "<span color='red'>$email_valid</span>";
	}
}

function passError($n = 0)
{
	if (isset($pass_valid)) {
		if ($n == 1) echo "bd-red";
		else echo "<span color='red'>$pass_valid</span>";
	}
}

function passCError($n = 0)
{
	if (isset($pass_con_valid)) {
		if ($n == 1) echo "bd-red";
		else echo "<span color='red'>$pass_con_valid</span>";
	}
}


?>
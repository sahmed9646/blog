<?php 
	include '../lib/Session.php';
	Session::checkLogin();
?>

<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>


<?php 
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>password recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

	<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$email = $fm->validation($_POST['email']);
			$email = mysqli_real_escape_string($db->link, $email);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$msg = "<span style='color:red; font-size:18px'>Invalid Email Address!!!</span>";
				echo $msg;
			}else{
				$mailQuery = "SELECT * from user where email = '$email' limit 1";
				$mailCheck = $db->select($mailQuery);
				if ($mailCheck!=false) {
					while ($value = $mailCheck->fetch_assoc()) {
						$userid = $value['id'];
						$username = $value['userName'];
					}
					$text = substr($email, 0, 4);
					$random = rand(10000, 99999);
					$newPass = "$text$random";
					$password = md5($newPass); 

					$updateQuery = "UPDATE user set 
									password = '$password'
									where id = '$userid'";
					$updatedRow = $db->update($updateQuery);

					$to = "$email";
					$from = "rssfoundation@gmail.com";
					$headers = "From: $from\n";
					$headers .= 'MIME-Version: 1.0' ."\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' ."\r\n";
					$subject = "Your Password";
					$message = "Your Username is ".$username."And Password is ".$newPass."Please Visit Website To Login";

					$sendMail = mail($to, $subject, $message, $headers);
					if ($sendMail) {
						$msg = "<span style='color:green; font-size:18px'>please check your email for new password</span>";
					echo $msg;
					}else{
						$msg = "<span style='color:red; font-size:18px'>Email not sent,,please again </span>";
					echo $msg;
					}

				}else{
					$msg = "<span style='color:red; font-size:18px'>Email Address Does Not Exist !!!</span>";
					echo $msg;
				}
			}
		}
	?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="send email" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
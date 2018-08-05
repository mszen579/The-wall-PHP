<?php
require_once("new-connection.php");
session_start();
?>


<html>
<head>
<title>Login and Registration Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
	<body>
		<h1 style="text-align:center; font-family:arial; color:#3b5998">WELCOME TO FACEWALL</h1>

		<div id="noaccount">
		--------------------------------------------------------------------
		</div>

		<div>
		<form action="process.php" method="post" style="width:50%">

		<p style="font-size:20px;font-family:arial;text-align: center;">Please Provide Your Name: <input id="name" type="text" name="name" placeholder='Your name'></p>
		<p style="font-size:20px;font-family:arial;text-align: center;">Please Provide Your Email Address: <input id="email" type="email" name="email" placeholder='email'></p>
		<p style="font-size:20px;font-family:arial;text-align:center;">Enter your Password: <input  id="password" type="password" name="passw" placeholder='password'></p>


		<p style="font-size:20px;font-family:arial;text-align: center;"><input id="hidden1" type="hidden" name="Register" value="Register"></p>

		<input id="button" type = "submit" name="submit" value="Register" />


		</form>
			</div>
		<!--------------------------------------------------------------->
		<div id="login">
			<h2>Login...</h2>
		<form action="process.php" method="post" style="width:50%">

		<p>Enter you Email: <input id="email" type="text" name="email" ></p>

		<p>Enter your Password: <input id="password" type="password" name="passw" ></p>


		<p><input id="hidden2" type="hidden" name="login" value="login"></p>


		<input id="button2" type = "submit" name="submit2" value="Login:" />
		<br>
		</form>
		</div>


		<?php
		if (isset($_SESSION['loginErr'])){
			echo "<h3 style='color:red';>" .$_SESSION['loginErr'] .":" ."<h3>";
		}
		?>



	</body>

</html>


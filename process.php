<?php
session_start();
require_once("new-connection.php");


/////////////////The below code is for registration///////////////
if (isset($_POST['Register'])){


$name = $_POST['name'];
$password = md5($_POST['passw']);
$email = $_POST['email'];

$name       = stripcslashes($name);
$name       = trim($name);
$email       = stripcslashes($email);
$password    = stripcslashes($password);
$email       = trim($email);
$password    = trim($password);


$sql = "INSERT INTO users (name, passw, email) values ( '$name', '$password','$email')";
if(run_mysql_query($sql))
{
	$_SESSION['loggedin'] = true;
	$_SESSION['user'] = $email;
	header('location: main.php');
}
else
{
	$_SESSION['message'] = "Failed to add new value";
}


	if ($connection->query($sql) === true){
	echo "thanks for adding data";
}
else{
	echo "error1";
}
}

/////////////////the below code is for login Check///////////////////

if (isset($_POST['login'])){

$login = $_POST['login'];

$email=$_POST['email'];
$password=md5($_POST['passw']);

$email       = stripcslashes($email);
$password    = stripcslashes($password);
$email       = trim($email);
$password    = trim($password);

//Connect to the server and compare database has already been done through require_once function


	$log = "SELECT * FROM users WHERE email='$email' and passw='$password' ";
	$result = fetch_record($log);

	if($result) {
		$_SESSION['loggedin']=true;
		$_SESSION['user']=$_POST['email'];
		header('location: main.php');
	}
	else{
		echo 'Invalid Username or Password';
	}
}






///////////////the below code is for messages///////////////////
// AB I have commented the below line cause it still conflict with the login page

if (isset($_POST['form_source']) && $_POST['form_source']=='message')
{


$query = "INSERT INTO messages (message, users_uid) values ('{$_POST['message']}', '{$_POST['users_uid']}')";

if (run_mysql_query($query)){
	header('location: main.php');
}
else{
	echo "Error adding message";
}
}

///////////////the below code is for comments///////////////////
// AB I have commented the below line cause it still conflict with the login page



if (isset($_POST['form_source']) && $_POST['form_source']=='comment'){


$que = "INSERT INTO comments (comment, users_uid, messages_mid) VALUES ('{$_POST['comment']}', '{$_POST['users_uid']}', '{$_POST['messages_mid']}')";

if (run_mysql_query($que)){
	header('location: main.php');
}
else{
	echo "Error adding comment";
}
}




?>


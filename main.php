<?php
require_once("new-connection.php");
session_start();

$query = "SELECT * FROM users WHERE email = '{$_SESSION['user']}'";
$user = fetch_record($query);



$get_messages = "SELECT messages.mid, messages.message, users.name, messages.created 
				FROM messages
				 LEFT JOIN users 
				 ON messages.users_uid = users.uid 
				 ORDER BY messages.created DESC";
$messages = fetch_all($get_messages);


 


	for ($i=0; $i < count($messages); $i++) { 
		$id = $messages[$i]['mid'];
		$get_comments = "SELECT * FROM comments LEFT JOIN users ON users.uid = comments.users_uid WHERE comments.messages_mid = {$id};";
		$comment = fetch_all($get_comments);
		$messages[$i]['comments'] = $comment;
		
	}
	
?>


<!DOCTYPE html>
<html>
   <head>
	   <meta charset="utf-8">
	   <title>THE TIME LINE</title>
	   <link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>


		<div>
			<h3 id="headerformain" style="text-align:center; font-family:arial; color:white; background-color:#3b5998; border-radius: 8px; width: 100%";>THE TIME LINE</h3>
		</div>

		<div style="text-align:center; font-family:arial; color:white; background-color:#3b5998; border-radius: 8px; width: 100%";>
			<p class="right"><?php echo "<h2>" .'Welcome: ' .$user['name'] ."<h2>"; ?></p>  <!--we have to change the $result into $user-->
		</div>


	<div class="post"><!--this form for the wall-->
		<form action="process.php" method="POST">
			<textarea id='post' name='message' placeholder="What is in your mind!!!"></textarea>
			<input type="hidden" name='form_source' value="message">
			<input type="hidden" name='users_uid' value="<?php echo $user['uid'] ?>"> <!--(?=) is equal to (?php echo $user['uid']) -->
			<br>
			<input id='button3' type='submit' value="Post a message">
		</form>
	</div>



		<div style="text-align:left; font-family:arial; color:white; border-radius: 8px; width: 80%;">


			<?php foreach ($messages as $message){ ?>
				
				<h3><?= $message['name'] ?><h3>
				<h4><?= $message['message'] ?></h4>
				<h6><?= $message['created'] ?></h6>   
				<h6><?= '------------------------' ?></h6>
				

				<div background-color:gray><!--this form for the comments-->
					<!-- Comments -->
					<?php foreach ($message['comments'] as $comment) { ?>
						    <h4><?= $comment['name']?></h4>
							<p><?= $comment['comment'] ?></p>
							<h6><?= $comment['created']?></h6>
							
					<?php  } ?>
				</div>
				

				<form style="background-color:gray; border-radius: 8px; " action="process.php" method="POST">
					<textarea id='comment' name='comment' placeholder="comment on your friends wall !!!"></textarea>
					<input type="hidden" name='form_source' value="comment">
					<input type="hidden" name='users_uid' value="<?= $user['uid'] ?>"> <!--(?=) is equal to (?php echo $user['uid']) -->
					<input type="hidden" name='messages_mid' value="<?= $message['mid'] ?>"> <!--the first hidden is for the user id and this second hidden is for the message id "i.e the post done by the user" -->
					<input id='button3' type='submit' value="comment">
				</form>
			</div>
				  



<?php } ?>
		<div>
		<a href="logout.php" id="logoutb">Log out</a>
		</div>

	</body>
</html>





      
                




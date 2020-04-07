<?php
session_start();
$userid = $_SESSION['user']['id'];
$name = $_SESSION['user']['name'];
$lastname = $_SESSION['user']['lastname'];
if(isset($_POST['message'])){
	$mysql = new mysqli('127.0.0.1:3306','root','','chat_2');
	$mysql_2 = new mysqli('127.0.0.1:3306','root','','users');
	if($mysql->connect_errno){
		echo $mysql->connect_error;
	}
	$path_query = "SELECT `path` FROM `users` WHERE `id` = '$userid'";
	$path = $mysql_2->query($path_query)->fetch_row();
	$message = $_POST['message'];
	if($message){
		$query = "INSERT INTO `chat_2` (`text`, `userid`, `name`, `lastname`, `path`) VALUES ('$message','$userid','$name','$lastname', '$path[0]')";
	}
	$mysql->query($query);
	if($mysql->errno){
		echo $mysql->error;
	}
	$mysql->close();
	header('Location: http://markov1.local/blog.php');
}else{

}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Главаня страница</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/fontawesomecss/all.css">
    <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
</head>
<body>
	<?php
		if(isset($_POST['log_out'])){
			unset ($_SESSION['user']);
			session_destroy();
			header('Location: http://markov1.local/index.php');
		}
	?>
	<header class="header" id="header">
		<div class="container">
			<div class="all-head head">
				<div class="head__logo">
					Danil Markov
				</div>
				<div class="head__nav">	
					<nav>
						<ul class="head__nav__menu">
							<li><a href="index.php">Главная страница</a></li>
							<?php
								if(isset($_SESSION['user']['id'])){
									?><li><a href="about.php">О себе</a></li><?php
								}
							?>
							<li><a href="blog.php" class="head__nav__current-page">Диалоги</a></li>
							<li><a href="gallery.php">Галерея</a></li>
							<li><a href="game.php">Игра</a></li>
						</ul>
						<?php
						if(!isset($_SESSION['user'])) {?>
						<div class="head__nav__login-btn"><a href="login.php">Войти</a></div>
						<?php
						} else {
							echo('<h4 class="head__nav__name">'.$name." ".$lastname.'</h4>'); 
							echo("<form action='' method='POST'><input type='SUBMIT' name='log_out' value='Выйти' class='logout-btn'</input></form>");
							}
							?>
					</nav>
				</div>	
			</div>
		</div>
	</header>
	<section>
		<div class="chat_place">
			<div class="messages_window">
				<?php
					$mysql = new mysqli('127.0.0.1:3306','root','','chat_2');
					if($mysql->connect_errno){
						echo $mysql->connect_error;
						exit;
					}
					$query = ("SELECT * FROM `chat_2`");
					$result = $mysql->query($query);
					if($mysql->errno){
						echo $mysql->error;
						exit;
					}
					while ($row = $result->fetch_assoc()){
						if($row[$userid] = $userid){
						
							echo $row['name'].' '.$row['lastname'].' ---> '.$row['text'];
							echo "<br>";
						}else{
							echo $row['userid'];
							
							echo $row['name'].' '.$row['lastname'].' ---> '.$row['text'];
							echo "<br>";
						}
					}
					$mysql->close();	
				?>
			</div>
			<div class="input_form">
				<form action="" method="POST"> 
					<input type="text" name="message" placeholder="Сообщение" oninput="sendingButton(this)" id="message" >				
					<input type = "submit" class="send_btn" id="sending_button" value="Отправить" disabled>
				</form>
			</div>
		</div>
	</section>
	<script src="js/script_blog.js"></script>
</body>
</html>

<?php
session_start();
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
		}
	?>
	<header class="main-header" id="header">
		<div class="container">
			<div class="head">
				<div class="head__logo">
					Danil Markov
				</div>
				<div class="head__nav">	
					<nav>
						<ul class="head__nav__menu">
							<li><a href="index.php" class="head__nav__current-page">Главная страница</a></li>
							<?php
								if(isset($_SESSION['user']['id'])){
									?><li><a href="about.php">О себе</a></li><?php
								}
							?>
							<li><a href="blog.php">Диалоги</a></li>
							<li><a href="gallery.php">Галерея</a></li>
							<li><a href="game.php">Игра</a></li>
						</ul>
						<?php
							if(!isset($_SESSION['user'])) {
						?>
								<div class="head__nav__login-btn"><a href="login.php">Войти</a></div>
						<?php
							} else {
								echo('<h4 class="head__nav__name">'.$_SESSION['user']['name']." ".$_SESSION['user']['lastname'].'</h4>'); 
								echo("<form action='' method='POST'><input type='SUBMIT' name='log_out' value='Выйти' class='logout-btn'</input></form>");
								}
						?>
					</nav>
				</div>	
			</div>
			<div class="titles">
				<div class="titles__greeting">
					<h1>Добро<br>Пожаловать!</h1> 
				</div>
				<div class="titles__btn"> 
					<a href="" id="">Подробнее</a>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="container index-container">
			<div class="short-information">
				<div class="column-1"> 	
					<div class="about">
						<?php 
						if(isset($_SESSION['user']['id'])){
							echo ('<a href="about.php"><h1>О себе</h1></a>');
						}else{
							echo ('<h1>О себе</h1>');
						}?>
						<p>В этом разделе Вы<br> можете прочитать некоторую информацию обо мне.</p>
					</div>
					<div class="blog">
						<a href="blog.php"><h1>Блог</h1></a>
						<p>В этом разделе Вы<br> можете оставить свое сообщение. </p>
					</div>
				</div>	
				<div class="column-2">
					<div class="gallery">
						<a href="gallery.php"><h1>Галерея</h1></a>
						<p>В этом разделе Вы<br> можете просмотреть различные картинки.</p>
					</div>
					<div class="game">
						<a href="game.php"><h1>Игра</h1></a>
						<p>В этом разделе Вы<br> можете провести свое время, сыграв в игру.</p>
					</div>
				</div>	
			</div>	
		</div>
	</section>
	<footer class="main-footer">
		<div class="container">
			<div class="footer">
					
				<form action="" method="POST">
					<div class="footer__send-box">
							
						<?php
							if(!isset($_SESSION['user']['id'])){?>
								<div class="footer__send-message__name">
									<h3>имя</h3>
									<input type="text" size="50" name="feedback-name" onchange="validateInputName(this)">
									<div id="text-error_name"></div>
								</div>
								<div class="footer__send-message__email" >
									<h3 >email</h3>
									<input type="text" size="50" name="feedback-email" onchange="validateInputEmail(this)">
									<div id="text-error_email"></div>
								</div>
							<?php }?>		


						<div class="footer__send-message__message" >
							<h3>сообщение</h3>
							<input name="feedback-message"></input>
						</div>
						<div class="feedback-btn" >
							<input type="SUBMIT" id="feedback-btn" disabled> 
						</div>
					</div>
				</form>	
				<?php
						$mysql = new mysqli('127.0.0.1:3306','root','','users');
						$id = $_SESSION['user']['id'];
						if(isset($id)){
							$feedback_name = $_SESSION['user']['name'];
							$feedback_email = $_SESSION['user']['email'];
						}else{
							$feedback_name = $_POST['feedback-name'];
							$feedback_email = $_POST['feedback-email'];
						}
						$feedback_message = $_POST['feedback-message'];
						if(isset($feedback_name)&&isset($feedback_email)&&isset($feedback_message)){
							$result = $mysql->query("INSERT INTO `feedback`(`name`, `email`, `message`) VALUES ('$feedback_name', '$feedback_email', '$feedback_message')");
						}
						if($mysql->errno){
							echo $mysql->error;
						}
						if($result){
							echo("Сообщение успешно отправлено");
						}
				?>
				<div class="footer__info">
					<div class="footer__info__phone">
						<h3>номер телефона</h3>
					</div>
					<div class="footer__info__email">
						<h3>email</h3>
					</div>
					<div class="footer__info__social">
						<h3>соц. сети</h3>
						<div class="footer__info__social__icons">
							<div><a href="https://vk.com"><i class="fab fa-vk"></i></a></div>
							<div><a href="https://telegram.com"><i class="fab fa-telegram-plane"></i></a></div>
							<div><a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a></div>
							<div><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></div>
				        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="space"></div>
	</footer>
	<script src="js/validate_index.js"></script>
	
</body>
</html>

<?php
session_start();
$userid = $_SESSION['user']['id'];
$mysqli = new mysqli("127.0.0.1:3306", "root", "", "users");
if(isset($_POST['avatar_btn'])){
	header('Location: http://markov1.local/about.php');
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
							<li><a href="about.php" class="head__nav__current-page">О себе</a></li>
							<li><a href="blog.php">Диалоги</a></li>
							<li><a href="gallery.php">Галерея</a></li>
							<li><a href="game.php">Игра</a></li>
						</ul>
						<?php
						if(!isset($_SESSION['user'])) {?>
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
		</div>
	</header>
	<section>
		<div class="container">	
			<div class="page-about">	
				<div class="page-about__photo">
					<div class="avatar-about">
						<?php
							if(!isset($_SESSION['user']['id'])){
								echo('<img class="about_avatar" src="images/avatar.svg">');
							}else{
								$img_path_query = "SELECT `path` FROM `users` WHERE `id` = '$userid'";	
								$img_path = $mysqli->query($img_path_query)->fetch_row();
								echo('<img class="about_avatar" src="'. $img_path[0] .'">');
							?>
					</div>
					<div class="upload-btn">
						<form method="POST" enctype="multipart/form-data" action="">
							<input type="file" name="photo">
							<input type="submit" value="Сохранить и продолжить" name="avatar_btn">
						</form>
					</div>
						
						<?php }?>
				</div>
				<div class="page-about__info_about">
					<h3>О себе</h3>
					<p>
	                    
					</p>
					<button>Редактировать</button>
				</div>	
			</div>
				<div class="krinfo">
					<ul>
						<li>Имя: <?php echo($_SESSION['user']['name'])?></li>
						<li>Фамилия: <?php echo($_SESSION['user']['lastname'])?></li>
						<li>E-mail: <?php echo($_SESSION['user']['email'])?></li>
					</ul>
				</div>
		</div>
	</section>
	<footer class="all-footer">
		<div class="links container">
			<div class="links_1">
				<h3>Контакты</h3>
				<b>Номер телефона</b>&ensp;+7 999 999 99 99<br>
				<b>E-mail</b>&ensp;qwerty@gmail.com
			</div>
			<div class="links_1">
				<h3>Соц.сети</h3>
				<div class="icons footer__info__social__icons">
					<a href="https://vk.com"><i class="fab fa-vk"></i></a>
					<a href="https://telegram.com"><i class="fab fa-telegram-plane"></i></a>
					<a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
					<a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
				 </div>
			</div>
		</div>
	</footer>
</body>
</html>
<?php
	$uploadFile = '/save_img/' . basename($_FILES["photo"]["name"]);
	$uploadF = $_SERVER['DOCUMENT_ROOT'] . $uploadFile;
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadF)){
        if ($mysqli->connect_errno){
            echo $mysqli->connect_errno;
            exit;
		}
		$query = "UPDATE `users` SET `path` = '$uploadFile' WHERE `id` = '$userid'";
        $result = $mysqli->query($query);

        if ($result->errno){
            echo $mysqli->errno;
            exit;
		}
	}
?>
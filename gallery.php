<?php
session_start();
if(isset($_POST['gallery-btn'])){
	header('Location: http://markov1.local/gallery.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Главаня страница</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/gallery_styles.css">
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
							<?php
								if(isset($_SESSION['user']['id'])){
									?><li><a href="about.php">О себе</a></li><?php
								}
							?>
							<li><a href="blog.php">Диалоги</a></li>
							<li><a href="gallery.php" class="head__nav__current-page">Галерея</a></li>
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
		<div class="wrapper">
			<?php
				if(isset($_SESSION['user']['id'])){
					echo ('<div class="upload-gallery-btn">
						<form action="" method="POST" enctype="multipart/form-data">
							<input type="file" name="gallery">
							<input type="SUBMIT" name="gallery-btn">
						</form>
					</div>');
				}
			?>
			<div id="gallery" class="gallery">
				<?php
					$mysql = new mysqli('127.0.0.1:3306','root','','users');
					$num_string = $mysql->query("SELECT * FROM `gallery`");
					$id = 0;
					
				?>
				<div class="line">
					
						<?php	
							while($num_string->num_rows > $id){
								$id++;
								$path = $mysql->query("SELECT `path` FROM `gallery` WHERE `id` = '$id'")->fetch_row();
								echo('
								<div class="block">
								<img id = "'. $id .'"class="image" src="'. $path[0] .'">
								</div>
								');
								
							}
						?>
					
				</div>
				<div class="qwe">
					<div id="presentation" class="center">
						<div id="left" class=" " onclick="prev()"></div>
						<div id="right" class=" " onclick="next()"></div>
					</div>
				</div>
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
	<script src="js/scrpit_gallery.js"></script>
</body>
</html>
<?php
	$uploadFile = '/save_img/' . basename($_FILES["gallery"]["name"]);
	$uploadF = $_SERVER['DOCUMENT_ROOT'] . $uploadFile;
    if (move_uploaded_file($_FILES['gallery']['tmp_name'], $uploadF)){
        if ($mysqli->connect_errno){
            echo $mysqli->connect_errno;
            exit;
		}
		echo $uploadF;
		echo ('<br>');
		echo $uploadFile;
		$userid = $_SESSION['user']['id'];
		$query = "INSERT INTO `gallery` (`userid`, `path`) VALUES ('$userid','$uploadFile')";
		$result = $mysql->query($query);
		if ($result->errno){
            echo $mysqli->errno;
            exit;
		}
	}
?>
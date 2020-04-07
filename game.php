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
							<li><a href="gallery.php">Галерея</a></li>
							<li><a href="game.php" class="head__nav__current-page">Игра</a></li>
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
	<style>
    #block{
        width: 600px;
        height: 600px;
        display: flex;
        border: 2px solid;
        background-color: white;
    }
    .item{
        height: 100px;
        width: 100px;
        padding: 0;
        margin: 0;
        background-color: green;

    }
    .wall{
        height: 800px;
        width: 800px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: url("images/unnamed.png");
    }
    .box_1{
        position: absolute;
        background: url("images/iashchyk2.jpg") top / cover;
        width: 100px;   
        height: 100px;
        transform: translate(200px, 100px);
        outline: 1px solid;
        outline-offset: -1px;
    }
    .box_2{
        position: absolute;
        background: url("images/iashchyk2.jpg") top / cover no-repeat;
        width: 100px;   
        height: 100px;
        transform: translate(500px, 300px);
        outline: 1px solid;
        outline-offset: -1px;
    }
</style>
<div class="wall">
    <div id="block">
        <div class="item" id="item"></div>
        <div class="box_1">
        </div>
        <div class="box_2">
        </div>
    </div>
</div>
<script>
    // if(localStorage.getItem('') !== null){
    //     document.getElementById('count').innerHTML = localStorage.getItem('count');
    // } else {
    //     localStorage.setItem('count', 0);
    //     document.getElementById('count').innerHTML = "0";
    // }
    let Xchange = 0;
    let Ychange = 0;
    let change = 100;
    if(localStorage.getItem('Xchange') !== null){
        Xchange = Number(localStorage.getItem('Xchange'));
    }else{
        localStorage.setItem('Xchange', 0);
    }
    if(localStorage.getItem('Ychange') !== null){
        Ychange = Number(localStorage.getItem('Ychange'));
    }else{
        localStorage.setItem('Ychange', 0);
    }
    document.getElementById('item').style.transform = "translate(" + Xchange + "px," + Ychange + "px)";
    document.addEventListener("keydown", function(event){
        switch(event.code){
            case "ArrowLeft":
                if(Xchange == 0){
                    Xchange = 0;
                }else if(Xchange == 300 && Ychange == 100){
                    Xchange == 300; 
                    Ychange == 100;
                }
                else{
                    Xchange -= change;
                    document.getElementById('item').style.transform = "translate(" + Xchange + "px," + Ychange + "px)";
                }
                localStorage.setItem('Xchange', Xchange);
                localStorage.setItem('Ychange', Ychange);    
                break;
            case "ArrowRight":
                if(Xchange == 500){
                    Xchange = 500;
                
                }else if(Xchange == 100 && Ychange == 100){
                    Xchange == 100;
                    Ychange == 100;
                }else if(Xchange == 400 && Ychange == 300){
                    Xchange == 400;
                    Ychange == 300;
                }else{
                    Xchange +=change;        
                    document.getElementById('item').style.transform = "translate(" + Xchange + "px," + Ychange + "px)";
                    
                }
                localStorage.setItem('Xchange', Xchange);
                localStorage.setItem('Ychange', Ychange);
                break;
            case "ArrowUp":
                if(Ychange == 0){
                    Ychange = 0;
                }else if(Xchange == 200 && Ychange == 200){
                    Xchange == 200;
                    Ychange == 200;
                }else if(Xchange == 500 && Ychange == 400){
                    Xchange == 500;
                    Ychange == 400;
                }else{
                    Ychange -=change;        
                    document.getElementById('item').style.transform = "translate(" + Xchange + "px," + Ychange + "px)";
                    
                }
                localStorage.setItem('Xchange', Xchange);
                localStorage.setItem('Ychange', Ychange);
                break;
            case "ArrowDown":
                if(Ychange == 500){
                    Ychange = 500;
                }else if(Xchange == 200 && Ychange == 0){
                    Xchange == 200;
                    Ychange == 0;
                }else if(Xchange == 500 && Ychange == 200){
                    Xchange == 500;
                    Ychange == 200;
                }else{
                    Ychange +=change;        
                    document.getElementById('item').style.transform = "translate(" + Xchange + "px," + Ychange + "px)";
                    
                }
                localStorage.setItem('Xchange', Xchange);
                localStorage.setItem('Ychange', Ychange);
                break;
            // case "ArrowUp":
            //     plus();
            //     document.getElementById('block').style.backgroundColor = "black";
            //     break;
            // case "ArrowDown":
            //     plus();
            //     document.getElementById('block').style.backgroundColor = "yellow";
            //     break;
        }
    });
    // function plus(){
    //     let count = Number(localStorage.getItem('count'));
    //     count++;
    //     document.getElementById('count').innerHTML = count;
    //     localStorage.setItem('count', count);
    // }
</script>
	</section>




</body>
</html>
<?php

	session_start(); 
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: main.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
 <meta charset="utf8_polish_ci" />
	<meta http-equiv="X-UA-Compatible" content="IE=11,chrome=1" />
       <link  rel="stylesheet"            href="style3.css" type="text/css">
	   
	   <link  rel='stylesheet' media='screen and (min-width: 1000px) and (max-width: 1200px)' href='style3.css' />
<head>
<!--	<meta charset="utf8_polish_ci" />-->
<!--<meta charset="Windows-1250"/>-->
    <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=11,chrome=1" />
	<title>Formularz promocji na laserach</title>
		
	
</head>

<body>

	<div id="logo2" style="color:darkblue">
			<h1>FORMULARZ PROMOCJI NA LASERACH</h1>
	</div>
	<br/><br/>
		<div id="pic">
			<a href="https://laserpromocja.canpack.ad/logout.php"><img src="logo.jpg" id="ad"></a>
		</div>
	<br/><br><br> 

	<div id="panel">	

			<form action="zaloguj.php" method="post">
			<label for="username">Nazwa użytkownika:</label><br>
				<br> <input type="text" id="username" name="login" required /> <br>
			<label for="password">Hasło:</label> <br>
				<br> <input type="password" id="password" name="haslo" required /> <br>
					 <input type="submit" value="Zaloguj" />
	<?php		
	header('Content-type: text/html; charset=utf-8');

	if(isset($_SESSION['blad']) and $_SESSION['blad'] != ''){
	    echo '<span style="color: red"; >Nieprawidłowy login lub hasło</span>';
    } else {

	echo "ZALOGUJ SIĘ";
}
	?>
		</form>
	</div>
	
</body>
</html>










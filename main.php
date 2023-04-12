<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
	header('Location: index.php');
	exit();
}


?>

<?php if ($_SESSION['ranga'] == 'm') {
	header('Location: zatwierdzaniemistrz.php');
}

?>
<?php if ($_SESSION['ranga'] == 'k') {
	header('Location: managermain.php');
}
?>


<!DOCTYPE HTML>
<html lang="pl">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link data-brackets-id='4829' rel="stylesheet" href="style4.css" type="text/css">

<link data-brackets-id='4830' rel='stylesheet' media='screen and (min-width: 300px) and (max-width: 1900px)' href='style4.css' />

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Formularz promocji na laserach</title>

	<meta http-equiv="refresh" content=18000;URL="logout.php" />
	<style>
		@media screen and (min-width: 1000px) {
			.modal-content {

				width: 410px;
				margin: 0 auto;
				padding: 10px 1px 0px 15px;
				background: #fff;
				border: 1px solid silver;
				font: 16px calibri;
				letter-spacing: -1px;
				-webkit-box-shadow: 0 0 2px silver;
				-moz-box-shadow: 0 0 2px silver;
				box-shadow: 2px 2px 6px 6px silver;
			}

		}

		@media screen and (min-width: 401px) {
			.modal-content {

				width: 410px;
				margin: 0 auto;
				padding: 10px 1px 0px 15px;
				background: #fff;
				border: 1px solid silver;
				font: 16px calibri;
				letter-spacing: -1px;
				-webkit-box-shadow: 0 0 2px silver;
				-moz-box-shadow: 0 0 2px silver;
				box-shadow: 2px 2px 6px 6px silver;
			}

		}


		@media screen and (max-width: 400px) {
			.modal-content {

				margin: auto;
				/* 5% from the top, 15% from the bottom and centered */

				margin: auto;
				padding: auto;
				background: #fff;
				border: 1px solid silver;
				font: 16px calibri;
				letter-spacing: -1px;
				-webkit-box-shadow: 0 0 2px silver;
				-moz-box-shadow: 0 0 2px silver;
				box-shadow: 2px 2px 6px 6px silver;
				width: 100%;

			}

		}
	</style>

</head>

<body>


	<meta name="viewport" content="width=device-width, initial-scale=0.8">


	<div id="pic">
		<img src="logo.jpg" id="ad">
	</div>
	<br>

	<div id="panel1">

		<br>
		<div id="logo22">
			<label class="container">DODAJ FORMULARZ:
			</label>

		</div>

		<span id="rodzajformularza">
			<form action="formularz.php" method="post">


				<input type="submit" value="LASER PRASA" id="formularz" />

			</form>
		</span>
		<span id="rodzajformularza2">
			<form action="bluebox.php" method="post">


				<input type="submit" value="BLUEBOX" id="formularz" />


			</form>
		</span>
		<div id="logo22">
			<br><br><br>
			<label class="container">PRZEGLĄDAJ FORMULARZE:
			</label>
		</div>


		<span id="rodzajformularza">
			<form action="wyswietlanieprasa.php" method="post">


				<input type="submit" value="LASER PRASA" id="formularz" />

			</form>
		</span>
		<span id="rodzajformularza2">
			<form action="wyswietlaniebluebox.php" method="post">


				<input type="submit" value="BLUEBOX" id="formularz" />


			</form>
		</span>



		<div id="logo2">

			<br><br><br><br>

			<?php


			if (isset($_SESSION['user'])) {
				echo "<p> " . $_SESSION['user'] . ' [ <a href="logout.php">Wyloguj się!</a> ]</p>';
			} else {
				echo "<a href=/formularz/logout.php>Zaloguj się</a>";
			}

			?>


			</form>


		</div>
	</div>
	</div>
	</div>
	<br>

	<div id="panel1">


		<label> <a target="_blank" href="https://laserpromocja.canpack.ad/uploads/instrukcje/kontaktipomocautomatyk.pdf" onclick="window.openthis.href, 'okno'+Math.read" style=" margin: 37%; margin-top: 3%; color: darkblue; font: bold 16px Times;" href=" for=" uname" <b>Kontak i pomoc</b></a></label>
		<br><br>
	</div>

</body>

</html>

<script>
	var modal = document.getElementById('id01');

	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>
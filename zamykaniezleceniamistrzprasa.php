<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
	header('Location: index.php');
	exit();
}
?>

<?php if ($_SESSION['ranga'] == 'a') {
	header('Location: main.php');
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Image Preview and Upload PHP</title>
<meta http-equiv="refresh" content=18000;URL="logout.php" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>
<link rel="stylesheet" href="style16.css" type="text/css">

<link rel='stylesheet' media='screen and (min-width: 1000px) and (max-width: 1200px)' href='style7.css' />

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Formularz zatwierdzenia promocji na laserach przez mistrza</title>

	<style>
		.pic {
			width: 120px;
			height: 90px;

		}

		.picbig {
			position: fixed;

			left: 40%;
			top: 5%;
			width: 0px;
			-webkit-transition: width 0.3s linear 0s;
			transition: width 0.3s linear 0s;
			z-index: 10;
		}

		.pic:hover+.picbig {

			width: 400px;
		}
	</style>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>

</head>

<body>



	<div class="centered">

		<br />



		<div id="pic">
			<a href="https://laserpromocja.canpack.ad/zatwierdzaniemistrz.php"><img src="logo.jpg" id="ad"></a>
		</div>
		 
		<br><br>

		<div id="panel1">
			<br>
			<div id="logo22">
				<label class="container">MENU FORMULARZ:
				</label>

			</div>

			<span id="rodzajformularza">
				<form action="zatwierdzaniemistrz.php" method="post">


					<input type="submit" value="MENU GŁÓWNE" id="formularz" />

				</form>
			</span>
			<span id="rodzajformularza2">
				<form action="zatwierdzaniemistrzprasa.php" method="post">


					<input type="submit" value=" WSTECZ " id="formularz" />

				</form>
			</span>


			<div id="logo22">
				<br><br><br>
				<label class="container">PRZEGLĄDAJ FORMULARZE:
				</label>
			</div>


			<span id="rodzajformularza">
				<form action="wyswietlaniemistrzprasa.php" method="post">


					<input type="submit" value=" LASER PRASA " id="formularz" />

				</form>
			</span>
			<span id="rodzajformularza2">
				<form action="wyswietlaniemistrzbluebox.php" method="post">


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
			</div>

		</div>

		<br><br>



		<br>
		<div id="logo2">



			<label class="container" style="font-weight: bold;font-size: 18pt">WYBIERZ FORMULARZ DO ZAMKNIĘCIA:</H4>
			</label>


			<br><br>
		</div>


		<div id="logo5">


			<input id="myInput" type="text" style="margin-left:auto; color:darkblue" placeholder="Wyszukaj Indeks..."></textarea>
		</div>
		<br>

		<?php

		include_once "connect.php";

		$conn = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");

		mysqli_set_charset($conn, "utf8");



		if (!$conn) {
			echo "Błąd połączenia!";
		}
		$sql = "SELECT id, laser, user, edata, image, rodzajprojektu FROM nadruki WHERE status='1' AND rodzajprojektu='sekwencja' OR status='1' AND rodzajprojektu='plik tekstowy' ORDER BY id DESC ";
		$query = mysqli_query($conn, $sql);



		echo "<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' >";

		echo "<tr>";
		echo "<th>Zdjęcie kluczyka</th>";
		echo "<th>Indeks promocji - automatyk</th>";
		echo "<th>Indeks promocji - mistrz zmianowy</th>";
		echo "<th>Numer Formularza</th>";
		echo "<th>Nazwa pliku tekstowego automatyk</th>";
		echo "<th>Laser</th>";
		echo "<th>Mistrz \r\n zatwierdzający promocje</th>";
		echo "<th>Rodzaj promocji</th>";
		echo "</tr>";

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$id = $row["id"];
			$image = $row["image"];
			$laser = $row["laser"];
			$user = $row["user"];
			$datemade = $row["edata"];
			$datemade = strftime("%d-%m-%Y", strtotime($datemade));
			$rodzajprojektu = $row["rodzajprojektu"];

			extract($row);

		?>

		<?PHP

			if (isset($row["id"])) {


				$link = 'zamykaniezleceniamistrzselector.php';
			}
		}

		require_once "connect.php";
		$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
		mysqli_set_charset($conn, "utf8");

		$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE zatwierdzony='1' AND widoczny=1 ORDER BY id DESC ");
		$users = mysqli_fetch_all($results, MYSQLI_ASSOC);
		?>

		<span class="img-div">
			<div class="text-center img-placeholder" onClick="triggerClick()">


			</div>
			<?php foreach ($users as $user) : ?>
				<tbody id="myTable">
					<tr>
						<td> <img onclick="window.open(this.src)" class="pic" name="<?php 'uploads/prasa/' . $user["image"] ?>" onChange="displayImage(this)" id="<?php 'uploads/prasa/' . $user["image"] ?>" class="form-control" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" onClick="triggerClick()" id="profileDisplay" width="110" height="auto" alt="">
							<img class="picbig" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" alt=""></td>
						<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['indexautomatyk']; ?></a> </td>
						<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojekturamka']; ?></a> </td>
						<td>
							<p><a href="<?php echo $link; ?>?id=<?php echo $user['id']; ?> " <br> <?php echo $user['id']; ?> <br>Data promocji <?php echo $user['edata']; ?></p>
						</td>
						<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['pliktxtramka']; ?></a> </td>
						<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['laser']; ?></a> </td>
						<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['usermistrz']; ?></a> </td>
						<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzajprojektu']; ?></a> </td>
					</tr>
					</tr>
				<?php endforeach;

				?>
				</form>


		</span>
		</tbody>
		</table>

	</div>
	</div>

	</div>
	</div>
	<br>
	<div style="font-weight: bold;font-size: 14pt;padding:0px" id="logo2">
		<?php
		if (mysqli_num_rows($results) < 1) {
			echo 'Brak formularzy do zamknięcia';
		}
		?>
	</div>
	

	</iframe>


	<script>
		function reload() {
			document.getElementById('iframeid').src += '';
		}
		btn.onclick = reload;
	</script>

</body>

</html>
<script src="scripts2.js"></script>
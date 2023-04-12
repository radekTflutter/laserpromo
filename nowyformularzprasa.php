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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Image Preview and Upload PHP</title>
<meta http-equiv="refresh" content=18000;URL="logout.php" />
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<link rel="stylesheet" href="style20.css" type="text/css">

<link rel='stylesheet' media='screen and (min-width: 300px) and (max-width: 1900px)' href='style20.css' />

<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Formularz promocji na laserach</title>


	<style>
		.pic {
			width: 130px;
			height: auto;
		}

		.picbig {
			position: absolute;
			top: 10px;
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


	<div id="logo2" style="color:darkblue">
		<h1>FORMULARZ PROMOCJI NA LASERACH</h1>
	</div>

	<br />


	<div id="pic">
		<a href="https://laserpromocja.canpack.ad/main.php"><img src="logo.jpg" id="ad"></a>
	</div>

	<div class="col-">
		<div class="w3-row-padding">

			<div id="center">


				<br><br>

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
					</div>

				</div>



				<div class="row">
					<span id="logo3">

						<br>
						<h1>Wynik dodania formularza</h1>

					</span>

					<form method="post" enctype="multipart/form-data">

						<html lang="pl-PL">
						<meta charset="UTF-8" />



						<?php
						require_once "connect.php";
						$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
						mysqli_set_charset($conn, "utf8");
						$results = mysqli_query($conn, "SELECT * FROM nadruki  ORDER BY id DESC LIMIT 1");
						$users = mysqli_fetch_all($results, MYSQLI_ASSOC);


						?>
						<?php foreach ($users as $user) : ?>

						<?php endforeach;

						?>


						</span>

				</div>



				</form>
			</div>


			<meta charset="utf-8_polish_ci" />

			<a href=<?php require_once "connect.php";
					$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
					$sql = "SELECT id, laser, lnumer, nazwaimage, rodzaj, pnumer, edata, nazwaprojekturamka, plikxml, plikxmlramka,  pliktxtramka, infonadruku, uwagi, image, user, rodzajprojektu FROM nadruki ORDER BY id DESC LIMIT 1";

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						while ($row = $result->fetch_assoc()) {
							echo 'uploads/prasa/' . $row["image"];
						}
					}
					?> name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;"> </a>

		</div>



		</form>
	</div>

	<style>
		table {
			table-layout: fixed;
		}

		td {
			overflow: hidden;
			text-overflow: Ellipsis;
			Word-wrap: break-Word;
		}

		@media only screen and (max-width: 480px) {

			.tablemobile {
				overflow-x: auto;
				display: block;
			}
		}
	</style>
	<div class="tablemobile" style="display: inline-block; height: 40em; width: 100%; overflow-x: scroll; overflow-y: hidden">
		<div style="position: relative;">
			<div style="display: inline-block; position: absolute; left: 0px; top: 0px; height: 20em; ">

				<table style="border-collapse: collapse;">


					<div class="logo22">

						<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' <table class="table table-bordered">
							<thead>
								<th>Kluczyk</th>
								<th>Numer Formularza</th>
								<th>Nazwa zdjęcia</th>
								<th>Laser</th>
								<th>Numer Lasera</th>
								<th>Rodzaj wieczka</th>
								<th>Prasa</th>
								<th>Data promocji</th>
								<th>Nazwa promocji</th>
								<th>Rodzaj projektu</th>
								<th>Indeks promocji</th>
								<th>Plik XML</th>
								<th>Nazwa pliku XML</th>
								<th>Nazwa pliku TXT</th>
								<th>Informacja o nadruku</th>
								<th>Grafika</th>
								<th>Napis stały</th>
								<th>Dodatkowe <br> informacje <br> o nadruku</th>
								<th>Uwagi</th>
								<th>Użytkownik</th>
							</thead>
							<tbody>

								<?php

								require_once "connect.php";
								$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
								$results = mysqli_query($conn, "SELECT * FROM nadruki ORDER BY id DESC");
								$users = mysqli_fetch_all($results, MYSQLI_ASSOC);

								?>
								<span class="img-div">
									<div class="text-center img-placeholder" onClick="triggerClick()">
									</div>

									<tr>

										<td> <img onclick="window.open(this.src)" class="pic" name="<?php 'uploads/prasa/' . $user["image"] ?>" onChange="displayImage(this)" id="<?php 'uploads/prasa/' . $user["image"] ?>" class="form-control" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" onClick="triggerClick()" id="profileDisplay" width="110" height="auto" alt="">
											<img class="picbig" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" alt=""></td>
										<form action="galeriabluebox.php" method="POST">
											<meta http-equiv="content-type" content="text/html; charset=utf-8">
											<?php mysqli_set_charset($conn, "utf8"); ?>
											<td>
												<p> <label class="container"> <?php echo $user['id']; ?> </p>
											<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaimage']; ?></a> </td>
											<td> <a class="btn btn-success" id="laser" value="user"><?php echo $user['laser']; ?></a> </td>
											<td> <a class="btn btn-success" id="lnumer" value="user"><?php echo $user['lnumer']; ?></a> </td>
											<td> <a class="btn btn-success" id="rodzaj" value="user"><?php echo $user['rodzaj']; ?></a> </td>
											<td> <a class="btn btn-success" id="pnumer" value="user"><?php echo $user['pnumer']; ?></a> </td>
											<td> <a class="btn btn-success" id="edata" value="user"><?php echo $user['edata'];
																									echo ("<br>");
																									echo $user['time']; ?></a> </td>
											<td> <a class="btn btn-success" id="nazwaprojektuautomatyk" value="user"><?php echo $user['nazwaprojektuautomatyk']; ?></a> </td>
											<td> <a class="btn btn-success" id="rodzajprojektu" value="user"><?php echo $user['rodzajprojektu']; ?></a> </td>
											<td> <a class="btn btn-success" id="rodzajprojektu" value="user"><?php echo $user['indexautomatyk']; ?></a> </td>

											<td> <a class="btn btn-success" id="plikxml" value="user" download="<?php echo $user['plikxml']; ?>" href="uploads/xml/<?php echo $user['plikxml']; ?>"><?php echo $user['plikxml']; ?></a> </td>
											<td> <a class="btn btn-success" id="plikxmlramka" value="user"><?php echo $user['plikxmlramka']; ?></a> </td>
											<td> <a class="btn btn-success" id="pliktxtramka" value="user"><?php echo $user['pliktxtramka']; ?></a> </td>
											<td> <a class="btn btn-success" id="infonadruku" value="user"><?php echo $user['infonadruku']; ?></a> </td>
											<td> <a class="btn btn-success" id="grafika" value="user"><?php echo $user['grafika']; ?></a> </td>
											<td> <a class="btn btn-success" id="napisramkastaly" value="user"><?php echo $user['napisramkastaly']; ?></a> </td>
											<td> <a class="btn btn-success" id="napisramkainne" value="user"><?php echo $user['napisramkainne']; ?></a> </td>
											<td> <a class="btn btn-success" id="uwagi" value="user"><?php echo $user['uwagi']; ?></a> </td>
											<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['user']; ?></a> </td>
									</tr>
									</tr>
								</span>
							</tbody>
						</table>




						<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' <table class="table table-bordered">
							<thead>
								<th>Położenie <br> nadruku <br> STACJA 1 X</th>
								<th>Położenie <br> nadruku <br> STACJA 1 Y</th>
								<th>Położenie <br> nadruku <br> STACJA 2 X</th>
								<th>Położenie <br> nadruku <br> STACJA 2 Y</th>
								<th>Położenie <br> nadruku <br> STACJA 3 X</th>
								<th>Położenie <br> nadruku <br> STACJA 3 Y</th>
								<th>Prędkość</th>
								<th>Częstotliwość</th>
								<th>Dodatkowe parametry lasera</th>
								<th>Nazwa czcionki</th>
								<th>Wielkość</th>
								<th>Szerokość</th>
								<th>Odstęp między znakami</th>
								<th>Odstęp między wierszami</th>
								<th>Inne</th>
								<th>Data zapisu</th>



							</thead>
							<tbody>

								<td> <a class="btn btn-success" id="stacja1x" value="user"><?php echo $user['stacja1x']; ?></a> </td>
								<td> <a class="btn btn-success" id="stacja1y" value="user"><?php echo $user['stacja1y']; ?></a> </td>
								<td> <a class="btn btn-success" id="stacja2x" value="user"><?php echo $user['stacja2x']; ?></a> </td>
								<td> <a class="btn btn-success" id="stacja2y" value="user"><?php echo $user['stacja2y']; ?></a> </td>
								<td> <a class="btn btn-success" id="stacja3x" value="user"><?php echo $user['stacja3x']; ?></a> </td>
								<td> <a class="btn btn-success" id="stacja3y" value="user"><?php echo $user['stacja3y']; ?></a> </td>
								<td> <a class="btn btn-success" id="predkosc" value="user"><?php echo $user['predkosc']; ?></a> </td>
								<td> <a class="btn btn-success" id="czestotliwosc" value="user"><?php echo $user['czestotliwosc']; ?></a> </td>
								<td> <a class="btn btn-success" id="paraminne" value="user"><?php echo $user['paraminne']; ?></a> </td>
								<td> <a class="btn btn-success" id="nazwaczcionki" value="user"><?php echo $user['nazwaczcionki']; ?></a> </td>
								<td> <a class="btn btn-success" id="wielkosc" value="user"><?php echo $user['wielkosc']; ?></a> </td>
								<td> <a class="btn btn-success" id="szerokosc" value="user"><?php echo $user['szerokosc']; ?></a> </td>
								<td> <a class="btn btn-success" id="odstepmiedzyznakami" value="user"><?php echo $user['odstepmiedzyznakami']; ?></a> </td>
								<td> <a class="btn btn-success" id="odstepmiedzywierszami" value="user"><?php echo $user['odstepmiedzywierszami']; ?></a> </td>
								<td> <a class="btn btn-success" id="inne" value="user"><?php echo $user['inne']; ?></a> </td>
								<td> <a class="btn btn-success" id="dataform" value="user"><?php echo $user['dataform']; ?></a> </td>



								</tr>
								</tr>
								</span>
							</tbody>
						</table>

						<?php
						echo "</table>"; 

						?>
					</div>
			</div>
		</div>
	</div>





	</div>
	</div>


</body>

</html>
<script src="scripts2.js"></script>
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

<link rel="stylesheet" href="style20.css" type="text/css">

<link rel='stylesheet' media='screen and (min-width: 300px) and (max-width: 1900px)' href='style20.css' />

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Formularz zatwierdzenia promocji na laserach przez mistrza</title>

	<style>
		.pic {
			width: 130px;
			height: auto;
		}

		.picbig {
			position: absolute;
			left: 40%;
			width: 0px;
			-webkit-transition: width 0.3s linear 0s;
			transition: width 0.3s linear 0s;
			z-index: 10;
		}

		.pic:hover+.picbig {

			width: 400px;
		}
	</style>
	<style>
		blink {
			animation: blinker 1.6s linear infinite;
			color: red;
			font-size: 30px;
			font-weight: bold;
		}

		@keyframes blinker {
			50% {
				opacity: 0;
			}
		}
	</style>
</head>

<body>


	<div id="logo2" style="color:darkblue">
		<h1>FORMULARZ PROMOCJI NA LASERACH</h1>
	</div>

	<br />



	<div id="pic">
		<a href="https://laserpromocja.canpack.ad/zatwierdzaniemistrz.php"><img src="logo.jpg" id="ad"></a>
	</div>


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


				<input type="submit" value=" WSTECZ" id="formularz" />


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

	<?php
	$user = trim($_SESSION['user']);
	$idform = $_GET['id'];
	$data = date("H.i.s d-m-Y");

	if (isset($_POST['add'])) {
		$log = 'LOGFILE - ZATWIERDZANIE MISTRZ PODWÓJNY SEKWENCJA:' . "\r\n" .
			'NUMER FORMULARZA:' . $_POST['idform'] . ',' . "\r\n" .
			'NAZWA PROMOCJI:' . $_POST['nazwapromocjimistrz'] . ',' . "\r\n" .
			'INDEKS:' . $_POST['nazwaprojekturamkanew'] . ',' . "\r\n" .
			'ROZPOCZĘCIE DATA/CZAS:' . $_POST['rozpoczeciepromodata'] . '/' . $_POST['rozpoczeciepromoczas'] . ',' . "\r\n" .
			'INFORMACJA O NADRUKU:' . $_POST['ostatniekody'] . ',' . "\r\n" .
			'POTWIERDZENIE:' . $_POST['podwojnypotwierdz'] . ',' . "\r\n" .
			'UŻYTKOWNIK:' . $user . ',' . "\r\n" .
			'UWAGI:' . $_POST['uwagimistrz'] . ',' . "\r\n";
		$file = fopen("uploads/logfile/prasa/mistrz/" . "mistrz_" . $data . ".txt", "a+");
		fprintf( $file, "\xEF\xBB\xBF");
		fwrite($file, $log);
		fclose($file);
	}
	?>

	<div id="logo5">


		<br>



		<div class="row">
			<span id="logo3" class="blink">




				<blink>!!! UWAGA FORMULARZ O TYM SAMYM INDEKSIE !!!</blink>
			</span>

			<br><br>

		</div>



		</form>
	</div>




	<?php

	require_once "connect.php";
	$connect = @mysqli_connect($host, $db_user, $db_password, $db_name);
	mysqli_set_charset($connect, "utf8");


	$idform = $_GET['id'];
	$idpodw = $_GET['id'];
	$user = trim($_SESSION['user']);
	if (isset($_POST['add'])) {
		$indexform = $_POST['nazwaprojekturamkanew'];
		$textform = $_POST['pliktxtramkanew'];
		$idform = $_POST['idform'];
		$sql = " UPDATE nadruki SET nazwaprojekturamka ='" . $_POST["nazwaprojekturamkanew"] . "', usermistrz ='" . $user . "', nazwapromocjimistrz='" . $_POST["nazwapromocjimistrz"] . "', nazwaprojekturamkakopia ='" . $_POST["nazwaprojekturamkanew"] . "', podwojnypotwierdz='" . $_POST["podwojnypotwierdz"] . "',
		uwagimistrz ='" . $_POST["uwagimistrz"] . "', rozpoczeciepromodata ='" . $_POST["rozpoczeciepromodata"] . "', rozpoczeciepromoczas ='" . $_POST["rozpoczeciepromoczas"] . "', ostatniekody ='" . $_POST["ostatniekody"] . "',
		status=1, zatwierdzony=1 WHERE id='" . $_POST["idform"] . "' AND status=0";

		$results = mysqli_query($connect, $sql);
		header('Location: zatwierdzaniemistrzprasa.php');
		echo 'ZAPISANE!';
		exit();
	}
	$idform = $_GET['id'];

	?>
	</select>


	</span>


	<br>




	<?php
	if (isset($_GET['id'])) {
		$idform = $_GET['id'];
	} else {
		$idform = NULL;
	}
	if ($idform != NULL) {
		if ($idform !=   ['id']) {

			require_once "connect.php";

			$conn = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");

			mysqli_set_charset($conn, "utf8");



			if (!$conn) {
				echo "Błąd połączenia!";
			}
			$sql = "SELECT id, nazwaprojekturamka, laser, user, edata, indexautomatyk, rodzajprojektu FROM nadruki WHERE nazwaprojekturamka ='" . $_GET["nazwapromocji"] . "' ORDER BY id DESC ";
			$query = mysqli_query($conn, $sql);



			echo "<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' >";

			echo "<tr>";
			echo "<th>Zdjęcie wieczka</th>";
			echo "<th>Numer Formularza</th>";
			echo "<th>Indeks</th>";
			echo "<th>Nazwa promocji</th>";
			echo "<th>Laser</th>";
			echo "<th>Użytkownik</th>";
			echo "<th>Rodzaj promocji</th>";
			echo "</tr>";

			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$id = $row["id"];
				$indexautomatyk = $row["indexautomatyk"];
				$nazwaprojekturamka = $row["nazwaprojekturamka"];
				$laser = $row["laser"];
				$user = $row["user"];
				$datemade = $row["edata"];
				$datemade = strftime("%d-%m-%Y", strtotime($datemade));
				$rodzajprojektu = $row["rodzajprojektu"];

				extract($row);


	?>

			<?PHP

				if (isset($row["id"])) {


					$link = 'zatwierdzaniemistrzselector.php';
				}
			}

			require_once "connect.php";
			$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
			mysqli_set_charset($conn, "utf8");

			$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE nazwaprojekturamka ='" . $_GET["nazwapromocji"] . "' ORDER BY id DESC  ");
			$users = mysqli_fetch_all($results, MYSQLI_ASSOC);
			?>
			<span class="img-div">
				<div class="text-center img-placeholder" onClick="triggerClick()">

				</div>
				<?php foreach ($users as $user) : ?>
					<tr>
						<td> <img onclick="window.open(this.src)" class="pic" name="<?php 'uploads/prasa/' . $user["image"] ?>" onChange="displayImage(this)" id="<?php 'uploads/prasa/' . $user["image"] ?>" class="form-control" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" onClick="triggerClick()" id="profileDisplay" width="90" height="90" alt="">
							<img class="picbig" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" alt=""></td>
						<td>
							<p><a "<?php echo $link; ?> ?id=<?php echo $user['id']; ?> " <br> <?php echo $user['id']; ?> <br>Data promocji <?php echo $user['edata']; ?></p>
						</td>
						<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['indexautomatyk']; ?></a> </td>
						<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojekturamka']; ?></a> </td>
						<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['laser']; ?></a> </td>
						<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['user']; ?></a> </td>
						<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzajprojektu']; ?></a> </td>
					</tr>
					</tr>
		<?php endforeach;
			}
		} else {
			echo "";
		}


		?>
		</tbody>
		</table>



		<br>

		<div id="logo5">
			<h1 style="font-size:28px;">ZATWIERDZANIE:</h1>

		</div>


		</select>
			</span>


			<div class="centered">

				<div class="w3-section">

					<form action="zatwierdzaniemistrzpodwojny.php" method="post">

				</div>

				<div class="col-">
					<div class="w3-row-padding">

						<div id="center">
							<div class="w3-half">
								<div class="w3-card-4 w3-container">

									<div class="w3-section">

									</div>
									<div class="w3-section">

										<input type=hidden name="idform" value="<?php echo $idform; ?>">
										<div class="w3-section">
											<label>NAZWA PROMOCJI:</label>
											<input type="text" class="w3-input" name="nazwapromocjimistrz" id="nazwaprojekturamkanew" style="color:black;font-weight:bold" required class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz nazwe promocji"></textarea>

											<label> </label>
										</div>
										<div class="w3-section">
											<label>INDEKS:</label>
											<input type="text" class="w3-input" style="text-transform:uppercase;" name="nazwaprojekturamkanew" id="nazwaprojekturamkanew" style="color:black;font-weight:bold" required class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz nazwe promocji"></textarea>

											<label> </label>
										</div>
										<div class="w3-section">
											<label>ROZPOCZĘCIE DATA/CZAS:</label>
											<form action="zatwierdzaniemistrzindex.php" method="post">
												<input type=hidden name="idform" value="<?php echo $idform; ?>">

												<input type="date" name="rozpoczeciepromodata" class="w3-input" id="nazwaprojekturamkanew" style="color:black;font-weight:bold;width:45%" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>
												<input type="time" name="rozpoczeciepromoczas" class="w3-input" id="pliktxtramka" style="color:black;font-weight:bold;width:45%" placeholder="Wpisz nazwe pliku tekstowego" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>

												<label> </label>
										</div>

										<div class="w3-row">
										</div>
									</div>
								</div>

							</div>





							<div class="w3-half4">
								<div class="w3-card-4 w3-container">
									<div class="w3-section">

									</div>
									<div class="w3-section">
										<label>INFORMACJE O NADRUKU:</label>
										<form action="zatwierdzaniemistrzindex.php" method="post">
											<input type=hidden name="idform" value="<?php echo $idform; ?>">

											<input type="text" name="ostatniekody" class="w3-input" id="uwagimistrzaramka" style="color:black;font-weight:bold" class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Podaj znaki nadruku"></textarea>
											<label> </label>
									</div>


									<div class="w3-section">
										<label>UWAGI:</label>
										<input type="text" name="uwagimistrz" class="w3-input" id="uwagimistrzaramka" style="color:black;font-weight:bold" class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Uwagi"></textarea>

										<label> </label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<label style="margin-left:30%;">POŚWIADCZENIE:</label>
				</div>
				<div class="w3-section">
					<select name="podwojnypotwierdz" class="w3-input" style="width:auto;margin-left:30%;" type="text" placeholder="Wybierz" required>
						<option value="" disabled selected>WYBIERZ</option>
						<option>ZATWIERDZAM FORMULARZ O TYM SAMYM PLIKU TEKSTOWYM</option>

					</select>

					<br>
					<input type="submit" name="add" id="zatwierdzindex" style="color:white;font-weight:bold" value="ZATWIERDŹ" action="zatwierdzaniemistrzpodwojny.php" class="btn btn-info"></textarea>

					<br><br>

					<div class="centered">


						<div id="logo5">


							<h1 style="font-size:28px;">ZATWIERDZANY FORMULARZ:</h1>


						</div>
						<?php
						if (isset($_GET['id'])) {
							$idform = $_GET['id'];
						} else {
							$idform = NULL;
						}
						if ($idform != NULL) {
							if ($idform !=   ['id']) {

								require_once "connect.php";

								$conn = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");

								mysqli_set_charset($conn, "utf8");



								if (!$conn) {
									echo "Błąd połączenia!";
								}
								$sql = "SELECT id, nazwaprojekturamka, laser, user, edata, pliktxtramka, rodzajprojektu FROM nadruki WHERE id=$idform ";
								$query = mysqli_query($conn, $sql);



								echo "<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' >";

								echo "<tr>";
								echo "<th>Zdjęcie wieczka</th>";
								echo "<th>Numer Formularza</th>";
								echo "<th>Nazwa promocji</th>";
								echo "<th>Nazwa pliku TXT</th>";
								echo "<th>Laser</th>";
								echo "<th>Użytkownik</th>";
								echo "<th>Rodzaj promocji</th>";
								echo "</tr>";

								while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
									$id = $row["id"];
									$nazwaprojekturamka = $row["nazwaprojekturamka"];
									$pliktxt = $row["pliktxtramka"];
									$laser = $row["laser"];
									$user = $row["user"];
									$datemade = $row["edata"];
									$datemade = strftime("%d-%m-%Y", strtotime($datemade));
									$rodzajprojektu = $row["rodzajprojektu"];

									extract($row);


						?>

								<?PHP

									if (isset($row["id"])) {


										$link = 'zatwierdzaniemistrzselector.php';
									}
								}

								require_once "connect.php";
								$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
								mysqli_set_charset($conn, "utf8");

								$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE id=$idform ");
								$users = mysqli_fetch_all($results, MYSQLI_ASSOC);
								?>
								<span class="img-div">
									<div class="text-center img-placeholder" onClick="triggerClick()">

									</div>
									<?php foreach ($users as $user) : ?>
										<tr>
											<td> <img onclick="window.open(this.src)" class="pic" name="<?php 'uploads/prasa/' . $user["image"] ?>" onChange="displayImage(this)" id="<?php 'uploads/prasa/' . $user["image"] ?>" class="form-control" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" onClick="triggerClick()" id="profileDisplay" width="90" height="90" alt="">
												<img class="picbig" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" alt=""></td>
											<td>
												<p><a "<?php echo $link; ?> ?id=<?php echo $user['id']; ?> " <br> <?php echo $user['id']; ?> <br>Data promocji <?php echo $user['edata']; ?></p>
											</td>
											<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojekturamka']; ?></a> </td>
											<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['pliktxtramka']; ?></a> </td>
											<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['laser']; ?></a> </td>
											<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['user']; ?></a> </td>
											<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzajprojektu']; ?></a> </td>
										</tr>
										</tr>
							<?php endforeach;
								}
							} else {
								echo "";
							}


							?>
							</tbody>
							</table>




					</div>



</body>

</html>
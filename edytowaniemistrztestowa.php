g<?php

	session_start();
	if (!isset($_SESSION['zalogowany'])) {
		header('Location: index.php');
		exit();
	}
	if ($_SESSION['ranga'] == 'a') {
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
			width: 50px;
			height: 50px;
		}

		.picbig {
			position: absolute;
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
		<a href="https://laserpromocja.canpack.ad/zatwierdzaniemistrz.php"><img src="logo.jpg" id="ad"></a>
	</div>

	<br><br><br>

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
			<form action="edytowaniemistrzprasa.php" method="post">


				<input type="submit" value=" WSTECZ " id="formularz" />

			</form>
		</span>


		<div id="logo22">
			<br><br><br>
			<label class="container">PRZEGLĄDAJ FORMULARZE:
			</label>
		</div>

		<span id="rodzajformularza">
			<form action="wyswietlanieprasa.php" method="post">
				<input type="submit" value=" LASER  PRASA " id="formularz" />
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
	<br>
	<div id="logo5">
		<h1 style="font-size:28px;">EDYTOWANIE:</h1>
	</div>


	</select>
	</span>




	</div>
	</div>

	<?php
	$user = trim($_SESSION['user']);
	$idform = $_GET['id'];
	$data = date("H.i.s d-m-Y");

	if (isset($_POST['add'])) {
		$log = 'LOGFILE - EDYTOWANIE MISTRZ TESTOWA:' . "\r\n" .
			'NUMER FORMULARZA:' . $_POST['idform'] . ',' . "\r\n" .
			'NAZWA PROMOCJI:' . $_POST['nazwapromocjimistrz'] . ',' . "\r\n" .
			'ROZPOCZĘCIE DATA/CZAS:' . $_POST['rozpoczeciepromodata'] . '/' . $_POST['rozpoczeciepromoczas'] . ',' . "\r\n" .
			'INFORMACJE O NADRUKU:' . $_POST['ostatniekody'] . ',' . "\r\n" .
			'UŻYTKOWNIK:' . $user . ',' . "\r\n" .
			'UWAGI:' . $_POST['uwagimistrz'] . ',' . "\r\n";
		$file = fopen("uploads/logfile/prasa/mistrz/" . "mistrz_" . $data . ".txt", "a+");
		fprintf( $file, "\xEF\xBB\xBF");
		fwrite($file, $log);
		fclose($file);
	}
	?>


	<?php
	require_once "connect.php";

	$connect = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");

	mysqli_set_charset($connect, "utf8");

	$user = trim($_SESSION['user']);
	$idform = $_GET['id'];

	if (isset($_POST['add'])) {

		$sql = " UPDATE nadruki SET usermistrzedit ='" . $user . "', nazwapromocjimistrz='" . $_POST["nazwapromocjimistrz"] . "',
			uwagimistrz ='" . $_POST["uwagimistrz"] . "',
			rozpoczeciepromodata ='" . $_POST["rozpoczeciepromodata"] . "', rozpoczeciepromoczas ='" . $_POST["rozpoczeciepromoczas"] . "', ostatniekody ='" . $_POST["ostatniekody"] . "',
			status=1 WHERE id='" . $_POST["idform"] . "' AND status=1 ";


		$results = mysqli_query($connect, $sql);
		header('Location: edytowaniemistrzprasa.php');
		echo 'ZAPISANE!';
	}

	?>

	</select>
	</span>


	<?php

	$idform = $_GET['id'];
	require_once "connect.php";
	$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
	$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE id='$idform'");
	$row = mysqli_fetch_array($results);

	?>



	<div class="centered">

		<div class="w3-section">

			<form action="edytowaniemistrztestowa.php" method="post">

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
									<input type="text" class="w3-input" name="nazwapromocjimistrz" id="nazwaprojekturamkanew" style="color:black;font-weight:bold" value="<?php echo $row['nazwapromocjimistrz']; ?>" required class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz nazwe promocji"></textarea>

									<label> </label>
								</div>

								<div class="w3-section">
									<label>ROZPOCZĘCIE DATA/CZAS:</label>
									<form action="edytowaniemistrzpliktxt.php" method="post">
										<input type=hidden name="idform" value="<?php echo $idform; ?>">

										<input type="date" name="rozpoczeciepromodata" class="w3-input" id="nazwaprojekturamkanew" style="color:black;font-weight:bold;width:50%" required value="<?php echo $row['rozpoczeciepromodata']; ?>" class="form-control cols=" 90" rows="2" list="projekty"></textarea>
										<input type="time" name="rozpoczeciepromoczas" class="w3-input" id="pliktxtramka" style="color:black;font-weight:bold;width:50%" value="<?php echo $row['rozpoczeciepromoczas']; ?>" placeholder="Wpisz nazwe pliku tekstowego" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>

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
								<form action="edytowaniemistrzpliktxt.php" method="post">
									<input type=hidden name="idform" value="<?php echo $idform; ?>">

									<input type="text" name="ostatniekody" class="w3-input" id="uwagimistrzaramka" style="color:black;font-weight:bold" value="<?php echo $row['ostatniekody']; ?>" class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Podaj znaki nadruku"></textarea>
									<label> </label>
							</div>
							<div class="w3-section">
								<label>UWAGI:</label>
								<input type="text" name="uwagimistrz" class="w3-input" id="uwagimistrzaramka" style="color:black;font-weight:bold" value="<?php echo $row['uwagimistrz']; ?>" class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Uwagi"></textarea>

								<label> </label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<input type="submit" name="add" id="zatwierdzindex" style="color:white;font-weight:bold" value="ZATWIERDŹ" action="edytowaniemistrztestowa.php" class="btn btn-info"></textarea>
			</form>
			<br><br>
			<div id="logo5">
				<h1 style="font-size:28px;">EDYTOWANY FORMULARZ:</h1>
			</div>
			<br>
			<div class="logo22">
				<div class="tablemobile" style="display: inline-block; height: 16em; width: 100%; overflow-x: scroll; overflow-y: scroll">
					<div style="position: relative;">
						<div style="display: inline-block; position: absolute; left: 0px; top: 0px; height: 20em; ">

							<table style="border-collapse: collapse;">

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
										echo "<th>Zdjęcie Wieczka</th>";
										echo "<th>Numer Formularza</th>";
										echo "<th>Numer Lasera</th>";
										echo "<th>Rodzaj Wieczka</th>";
										echo "<th>Prasa</th>";
										echo "<th>Nazwa Promocji - Mistrz</th>";
										echo "<th>Plik XML</th>";
										echo "<th>Informacje o Nadruku - Mistrz</th>";
										echo "<th>Data Rozpoczęcia Promocji</th>";
										echo "<th>Godzina Rozpoczęcia Promocji</th>";
										echo "<th>Uwagi Mistrza</th>";
										echo "<th>Data Zakończenia Promocji</th>";
										echo "<th>Godzina Zakończenia Promocji</th>";
										echo "<th>Ilość Wieczek</th>";
										echo "<th>Nazwa Promocji - Automatyk</th>";
										echo "<th>Laser</th>";
										echo "<th>Użytkownik</th>";
										echo "<th>Rodzaj Promocji</th>";
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
														<img class="picbig" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" alt="">
													</td>
													<td>
														<p><a "<?php echo $link; ?> ?id=<?php echo $user['id']; ?> " <br> <?php echo $user['id']; ?> <br>Data promocji <?php echo $user['edata']; ?></p>
													</td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['lnumer']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzaj']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['pnumer']; ?></a> </td>
													<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojekturamka']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['plikxmlramka']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['ostatniekody']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rozpoczeciepromodata']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rozpoczeciepromoczas']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['uwagimistrz']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['zakonczeniepromodata']; ?></a> </td>
													<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['zakonczeniepromoczas']; ?></a> </td>
													<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['iloscwieczek']; ?></a> </td>
													<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojektuautomatyk']; ?></a> </td>
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

					</div>
					
</body>

</html>
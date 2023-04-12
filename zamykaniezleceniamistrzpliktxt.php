<?php

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>


<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Formularz zatwierdzenia promocji na laserach przez mistrza</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.pic {
			width: 130px;
			height: auto;
		}

		.picbig {
			position: absolute;
			left: 4%;
			top: 1%;
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
			<form action="zamykaniezleceniamistrzprasa.php" method="post">


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
		<h1 style="font-size:28px;">ZAMYKANIE ZLECENIA:</h1>
	</div>

	</select>
	</span>

	<?php
	$user = trim($_SESSION['user']);
	$idform = $_GET['id'];
	$data = date("H.i.s d-m-Y");

	if (isset($_POST['add'])) {
		$log = 'LOGFILE - ZAMYKANIE ZLECENIA MISTRZ PLIK TXT:' . "\r\n" .
			'NUMER FORMULARZA:' . $_POST['idform'] . ',' . "\r\n" .
			'NAZWA PROMOCJI:' . $_POST['nazwapromocjimistrz'] . ',' . "\r\n" .
			'INDEKS:' . $_POST['nazwaprojekturamkanew'] . ',' . "\r\n" .
			'ROZPOCZĘCIE DATA/CZAS:' . $_POST['rozpoczeciepromodata'] . '/' . $_POST['rozpoczeciepromoczas'] . ',' . "\r\n" .
			'ZAKOŃCZENIE DATA/CZAS:' . $_POST['zakonczeniepromodata'] . '/' . $_POST['zakonczeniepromoczas'] . ',' . "\r\n" .
			'PLIK TXT A-D:' . $_POST['pliktxtramkanew'] . ',' . "\r\n" .
			'PLIK TXT B-E:' . $_POST['pliktxtramkanew2'] . ',' . "\r\n" .
			'PLIK TXT C-F:' . $_POST['pliktxtramkanew3'] . ',' . "\r\n" .
			'PLIK TXT Z KODAMI:' . $_POST['pliktxtzkodami'] . ',' . "\r\n" .
			'3 PIERWSZE KODY Z PLIKU:' . $_POST['kodyzplikutxt'] . ',' . "\r\n" .
			'OSTATNIE KODY:' . $_POST['ostatniekody'] . ',' . "\r\n" .
			'ILOŚĆ WIECZEK:' . $_POST['iloscwieczek'] . ',' . "\r\n" .
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

		$sql = " UPDATE nadruki SET usermistrzzlecenie ='" . $user . "', uwagimistrz ='" . $_POST["uwagimistrz"] . "',
									ostatniekody ='" . $_POST["ostatniekody"] . "', ostatniekodykopia ='" . $_POST["ostatniekody"] . "', zakonczeniepromodata ='" . $_POST["zakonczeniepromodata"] . "', zakonczeniepromoczas ='" . $_POST["zakonczeniepromoczas"] . "', iloscwieczek ='" . $_POST["iloscwieczek"] . "', zatwierdzony=0,
									status=1 WHERE id='" . $_POST["idform"] . "' AND zatwierdzony=1";


		$results = mysqli_query($connect, $sql);
		header('Location: zamykaniezleceniamistrzprasa.php');
		echo 'ZAPISANE!';
	}

	?>



	<?php

	$idform = $_GET['id'];
	require_once "connect.php";
	$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
	$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE id='$idform'");
	$row = mysqli_fetch_array($results);

	?>

	<div class="centered">
		<form action="zamykaniezleceniamistrzpliktxt.php" style="padding:10px 0px;" method="post">


			<div class="centered">

				<div class="w3-section">


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
											<input type="text" class="w3-input" name="nazwapromocjimistrz" id="nazwaprojekturamkanew" value="<?php echo $row['nazwapromocjimistrz']; ?>" style="color:black;font-weight:bold" readonly class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz nazwe promocji"></textarea>

											<label> </label>
										</div>

										<div class="w3-section">
											<label>INDEKS:</label>
											<input type="text" class="w3-input" style="text-transform:uppercase;" name="nazwaprojekturamkanew" id="nazwaprojekturamkanew" value="<?php echo $row['nazwaprojekturamka']; ?>" hstyle="color:black;font-weight:bold" readonly class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz nazwe promocji"></textarea>

											<label> </label>
										</div>
										<div class="w3-section">
											<label>ROZPOCZĘCIE DATA/CZAS:</label>
											<input type=hidden name="idform" value="<?php echo $idform; ?>">

											<input type="date" name="rozpoczeciepromodata" class="w3-input" value="<?php echo $row['rozpoczeciepromodata']; ?>" readonly id="nazwaprojekturamkanew" style="color:black;font-weight:bold;width:55%" readonly class="form-control cols=" 90" rows="2" list="projekty"></textarea>
											<input type="time" name="rozpoczeciepromoczas" class="w3-input" id="pliktxtramka" readonly value="<?php echo $row['rozpoczeciepromoczas']; ?>" style="color:black;font-weight:bold;width:55%" readonly placeholder="Wpisz nazwe pliku tekstowego" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>

											<label> </label>
										</div>
										<div class="w3-section">
											<label>WYBIERZ PLIK TXT A-D:</label>
											<input name="pliktxtramkanew" class="w3-input" readonly type="text" ref="myFile" value="<?php echo $row['pliktxtramkamistrz']; ?>" required @change="selectedFile">

											<label> </label>
										</div>
										<div class="w3-section">
											<label>WYBIERZ PLIK TXT B-E:</label>
											<input name="pliktxtramkanew2" class="w3-input" readonly value="<?php echo $row['pliktxtramkamistrz2']; ?>" type="text" ref="myFile" @change="selectedFile">

											<label> </label>
										</div>
										<div class="w3-section">
											<label>WYBIERZ PLIK TXT C-F:</label>
											<input name="pliktxtramkanew3" class="w3-input" readonly value="<?php echo $row['pliktxtramkamistrz3']; ?>" type="text" ref="myFile" @change="selectedFile">

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
										<label>3 PIERWSZE KODY:</label>

										<input type=hidden name="idform" value="<?php echo $idform; ?>">

										<div id="app" v-cloak>

											<input name="kodyzplikutxt" class="w3-input" readonly value="<?php echo $row['kodyzplikutxt']; ?>" type="text" ref="myFile" @change="selectedFile">
											<div v-if="allcode.length">
												<input type="text" v-model="allcode.slice(0,3)" readonly required name="kodyzplikutxt" class="w3-input"></textarea>


												<p>Liczba wierszy w pliku: {{allcode.length}}.<br>3 pierwsze kody z pliku:</p>
												<ul>
													<li name="code" v-for="code in codes">{{code}}</li>
												</ul>
											</div>
										</div>

									</div>




									<div class="w3-section">
										<label> </label>
									</div>
									<div class="w3-section">
										<label>ZAKOŃCZENIE DATA/CZAS:</label>
										<input type="date" name="zakonczeniepromodata" id="nazwaprojekturamkanew" class="w3-input" style="color:black;font-weight:bold;width:55%" value="<?php echo $row['zakonczeniepromodata']; ?>" class="form-control cols=" 90" rows="2" list="projekty" required placeholder="Wpisz nazwe projektu"></textarea>
										<input type="time" name="zakonczeniepromoczas" id="pliktxtramka" class="w3-input" value="<?php echo $row['zakonczeniepromoczas']; ?>" style="color:black;font-weight:bold;width:55%" placeholder="Wpisz nazwe pliku tekstowego" class="form-control cols=" 90" rows="2" list="projekty" required placeholder="Wpisz nazwe pliku tekstowego"></textarea>
										<label> </label>
									</div>
									<div class="w3-section">
										<label>PODAJ OSTATNIE KODY:</label>
										<input type="text" name="ostatniekody" class="w3-input" id="uwagimistrzaramka" value="<?php echo $row['ostatniekody']; ?>" style="color:black;font-weight:bold" class="form-control cols=" 90" rows="2" list="projekty" placeholder="  3 OSTATNIO UŻYTE KODY"></textarea>

										<label> </label>
									</div>
									<div class="w3-section">
										<label>ILOŚĆ WIECZEK:</label>
										<input type="text" name="iloscwieczek" class="w3-input" id="uwagimistrzaramka" value="<?php echo $row['iloscwieczek']; ?>" style="color:black;font-weight:bold" class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Ilość wieczek"></textarea>
										<label> </label>
									</div>


									<div class="w3-section">
										<label>UWAGI:</label>
										<input type="text" name="uwagimistrz" class="w3-input" id="uwagimistrzaramka" value="<?php echo $row['uwagimistrz']; ?>" style="color:black;font-weight:bold" class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Uwagi"></textarea>

										<label> </label>
									</div>
								</div>
							</div>
						</div>
					</div>


					<input type="submit" name="add" id="zatwierdzindex" style="color:white;font-weight:bold" value="ZATWIERDŹ" action="zamykaniezleceniamistrzpliktxt.php" class="btn btn-info"></textarea>


		</form>
		<br><br>
		<div id="logo5">
			<h1 style="font-size:28px;">ZAMYKANY FORMULARZ</h1>
		</div>

		<div class="centered">

			<div class="tablemobile" style="display: inline-block; height: 20em; width: 100%; overflow-x: scroll; overflow-y: scroll">
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
									$conn = @mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");
									mysqli_set_charset($conn, "utf8");
									if (!$conn) {
										echo "Błąd połączenia!";
									}
								}
							}

							$sql = "SELECT id, laser, user, edata, image, rodzajprojektu FROM nadruki WHERE status='1' ORDER BY id DESC ";
							$query = mysqli_query($conn, $sql);


							echo "<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' >";

							echo "<tr>";
							echo "<th>Zdjęcie Kluczyka</th>";
							echo "<th>Numer Formularza</th>";
							echo "<th>Laser</th>";
							echo "<th>Rodzaj Wieczka</th>";
							echo "<th>Prasa</th>";
							echo "<th>Nazwa Promocji - Mistrz</th>";
							echo "<th>Plik XML</th>";
							echo "<th>Pierwsze Kody - Mistrz</th>";
							echo "<th>Data Rozpoczęcia Promocji</th>";
							echo "<th>Godzina Rozpoczęcia Promocji</th>";
							echo "<th>Uwagi Mistrza</th>";
							echo "<th>Data Zakończenia Promocji</th>";
							echo "<th>Godzina Zakończenia Promocji</th>";
							echo "<th>Ilość Wieczek</th>";
							echo "<th>Ostatnie Kody</th>";
							echo "<th>Nazwa Pliku TXT:<br> A-D</th>";
							echo "<th>Nazwa Pliku TXT:<br> B-E</th>";
							echo "<th>Nazwa Pliku TXT:<br> C-F</th>";
							echo "<th>Nazwa Promocji - Automatyk</th>";
							echo "<th>Nazwa Pliku TXT - Automatyk</th>";
							echo "<th>Laser</th>";
							echo "<th>Użytkownik</th>";
							echo "<th>Rodzaj Promocji</th>";
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
							}
							require_once "connect.php";
							$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
							mysqli_set_charset($conn, "utf8");

							$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE id= $idform ");
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
											<p><a ?id=<?php echo $user['id']; ?> <br> <?php echo $user['id']; ?> <br>Data promocji <?php echo $user['edata']; ?></p>
										</td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['laser']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzaj']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['pnumer']; ?></a> </td>
										<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojekturamka']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['plikxmlramka']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['kodyzplikutxt']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rozpoczeciepromodata']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rozpoczeciepromoczas']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['uwagimistrz']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['zakonczeniepromodata']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['zakonczeniepromoczas']; ?></a> </td>

										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['iloscwieczek']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['ostatniekody']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['pliktxtramkamistrz']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['pliktxtramkamistrz2']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['pliktxtramkamistrz3']; ?></a> </td>



										<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['pliktxtramka']; ?></a> </td>
										<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojektuautomatyk']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['laser']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['user']; ?></a> </td>
										<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzajprojektu']; ?></a> </td>

									</tr>
									</tr>
								<?php endforeach;

								?>

								</tbody>
						</table>
					</div>
				</div>

				<div class="centered">
				</div>
				<br>
</body>

</html>
<script>
	Vue.config.productionTip = false;
	Vue.config.devtools = false;

	const app = new Vue({
		el: '#app',
		data: {
			allcode: []
		},
		computed: {
			codes() {
				return this.allcode.slice(0, 3);
			}
		},
		methods: {
			selectedFile() {
				console.log('selected a file');
				console.log(this.$refs.myFile.files[0]);

				let file = this.$refs.myFile.files[0];
				if (!file || file.type !== 'text/plain') return;

				let reader = new FileReader();
				reader.readAsText(file, "UTF-8");

				reader.onload = evt => {
					let text = evt.target.result;
					this.allcode = text.split(/\r?\n/);

					if (this.allcode[this.allcode.length - 1] === '') this.allcode.pop();
				}

				reader.onerror = evt => {
					console.error(evt);
				}

			}
		}
	})
</script>
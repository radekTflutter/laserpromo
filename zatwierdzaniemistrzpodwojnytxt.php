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
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>

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
			<form action="zatwierdzaniemistrzprasa.php" method="post">


				<input type="submit" value="  WSTECZ  " id="formularz" />


			</form>
		</span>

		<br>

		<div id="logo2">
			<br><br><br>


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


	<div id="logo5">




		<div class="row">
			<span id="logo3" class="blink">




				<blink>!!! UWAGA FORMULARZ O TYM SAMYM PLIKU TEKSTOWYM !!!</blink>
			</span>

			<br> <br>

		</div>

		</form>
	</div>


	<?php
	$idform = $_GET['id'];
	$idpodw = $_GET['id'];
	$user = trim($_SESSION['user']);
	$data = date("H.i.s d-m-Y");

	if (isset($_POST['add'])) {
		$log = 'LOGFILE - ZATWIERDZANIE MISTRZ PODWOJNY PLIK TXT:' . "\r\n" .
			'NUMER FORMULARZA:' . $_POST['idform'] . ',' . "\r\n" .
			'NAZWA PROMOCJI:' . $_POST['nazwapromocjimistrz'] . ',' . "\r\n" .
			'INDEKS:' . $_POST['nazwaprojekturamkanew'] . ',' . "\r\n" .
			'ROZPOCZĘCIE DATA/CZAS:' . $_POST['rozpoczeciepromodata'] . '/' . $_POST['rozpoczeciepromoczas'] . ',' . "\r\n" .
			'PLIK TXT A-D:' . $_POST['pliktxtramkanew'] . ',' . "\r\n" .
			'PLIK TXT B-E:' . $_POST['pliktxtramkanew2'] . ',' . "\r\n" .
			'PLIK TXT C-F:' . $_POST['pliktxtramkanew3'] . ',' . "\r\n" .
			'PLIK TXT Z KODAMI:' . $_POST['pliktxtzkodami'] . ',' . "\r\n" .
			'3 pierwsze kody z pliku:' . $_POST['kodyzplikutxt'] . ',' . "\r\n" .
			'POTWIERDZENIE:' . $_POST['podwojnypotwierdztxt'] . ',' . "\r\n" .
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
	$connect = @mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");
	mysqli_set_charset($connect, "utf8");


	$idform = $_GET['id'];
	$idpodw = $_GET['id'];
	$user = trim($_SESSION['user']);

	if (isset($_POST['add'])) {
		$indexform = $_POST['nazwaprojekturamkanew'];
		$textform = $_POST['pliktxtramkanew'];
		$idform = $_POST['idform'];
		$sql = " UPDATE nadruki SET nazwaprojekturamka ='" . $_POST["nazwaprojekturamkanew"] . "', nazwaprojekturamkakopia ='" . $_POST["nazwaprojekturamkanew"] . "', usermistrz ='" . $user . "', nazwapromocjimistrz='" . $_POST["nazwapromocjimistrz"] . "', pliktxtzkodami='" . $_POST["pliktxtzkodami"] . "', podwojnypotwierdztxt='" . $_POST["podwojnypotwierdztxt"] . "',
									pliktxtramkamistrz ='" . $_POST["pliktxtramkanew"] . "', pliktxtramkamistrzkopia ='" . $_POST["pliktxtramkanew"] . "', kodyzplikutxt ='" . $_POST["kodyzplikutxt"] . "', kodyzplikutxtkopia ='" . $_POST["kodyzplikutxt"] . "', pliktxtramkamistrz2 ='" . $_POST["pliktxtramkanew2"] . "', pliktxtramkamistrz3 ='" . $_POST["pliktxtramkanew3"] . "', uwagimistrz ='" . $_POST["uwagimistrz"] . "',
									rozpoczeciepromodata ='" . $_POST["rozpoczeciepromodata"] . "', rozpoczeciepromoczas ='" . $_POST["rozpoczeciepromoczas"] . "', pliktxtramkamistrz2kopia ='" . $_POST["pliktxtramkanew2"] . "', pliktxtramkamistrz3kopia ='" . $_POST["pliktxtramkanew3"] . "',
									status=1, zatwierdzony=1 WHERE id='" . $_POST["idform"] . "' AND status=0";

		$results = mysqli_query($connect, $sql);
		header('Location: zatwierdzaniemistrzprasa.php');
		echo 'ZAPISANE!';
		exit();
	}

	?>

	<div class="tablemobile" style="display: inline-block;margin: auto; height: 15em; width: 100%; overflow-x: scroll; overflow-y: scroll">
		<div style="position: relative;">

			<table style="border-collapse: collapse;">


				<table>
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

					$sql = "SELECT * FROM nadruki WHERE 
	pliktxtramkamistrz ='" . $_GET["pliktxtramkamistrz"] . "' OR  pliktxtramkamistrz ='" . $_GET["pliktxtramkamistrz2"] . "' OR  pliktxtramkamistrz ='" . $_GET["pliktxtramkamistrz3"] . "'
	OR pliktxtramkamistrz2 ='" . $_GET["pliktxtramkamistrz2"] . "' OR pliktxtramkamistrz2 ='" . $_GET["pliktxtramkamistrz"] . "' OR  pliktxtramkamistrz2 ='" . $_GET["pliktxtramkamistrz3"] . "' 
	OR pliktxtramkamistrz3 ='" . $_GET["pliktxtramkamistrz3"] . "' OR pliktxtramkamistrz3 ='" . $_GET["pliktxtramkamistrz"] . "' OR  pliktxtramkamistrz3 ='" . $_GET["pliktxtramkamistrz2"] . "'
	ORDER BY id DESC ";
					$query = mysqli_query($conn, $sql);



					echo "<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' >";

					echo "<tr>";
					echo "<th>Zdjęcie wieczka</th>";
					echo "<th>Numer Formularza</th>";
					echo "<th>Nazwa promocji</th>";
					echo "<th>Indeks</th>";
					echo "<th>Nazwa pliku TXT: A-D</th>";
					echo "<th>Nazwa pliku TXT: B-E</th>";
					echo "<th>Nazwa pliku TXT: C-F</th>";
					echo "<th>Laser</th>";
					echo "<th>Mistrz - zatwierdzający</th>";
					echo "<th>Rodzaj promocji</th>";
					echo "</tr>";

					while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
						$id = $row["id"];
						$nazwapromocjimistrz = $row["nazwapromocjimistrz"];
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

					$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE 
		pliktxtramkamistrz ='" . $_GET["pliktxtramkamistrz"] . "' OR  pliktxtramkamistrz ='" . $_GET["pliktxtramkamistrz2"] . "' OR  pliktxtramkamistrz ='" . $_GET["pliktxtramkamistrz3"] . "'
	OR pliktxtramkamistrz2 ='" . $_GET["pliktxtramkamistrz2"] . "' OR pliktxtramkamistrz2 ='" . $_GET["pliktxtramkamistrz"] . "' OR  pliktxtramkamistrz2 ='" . $_GET["pliktxtramkamistrz3"] . "' 
	OR pliktxtramkamistrz3 ='" . $_GET["pliktxtramkamistrz3"] . "' OR pliktxtramkamistrz3 ='" . $_GET["pliktxtramkamistrz"] . "' OR  pliktxtramkamistrz3 ='" . $_GET["pliktxtramkamistrz2"] . "'
	ORDER BY id DESC  ");
					$users = mysqli_fetch_all($results, MYSQLI_ASSOC);
					?>

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
							<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwapromocjimistrz']; ?></a> </td>
							<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['nazwaprojekturamka']; ?></a> </td>
							<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['pliktxtramkamistrz']; ?></a> </td>
							<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['pliktxtramkamistrz2']; ?></a> </td>
							<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['pliktxtramkamistrz3']; ?></a> </td>
							<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['laser']; ?></a> </td>
							<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['usermistrz']; ?></a> </td>
							<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzajprojektu']; ?></a> </td>
						</tr>
						</tr>
					<?php endforeach;





					?>
					</tbody>
				</table>
		</div> <br>
	</div>

	<?php
	$nazwapromocjimistrz = $_GET['nazwapromocjimistrz'];
	$nazwaprojekturamkanew = $_GET['nazwaprojekturamkanew'];
	$rozpoczeciepromodata = $_GET['rozpoczeciepromodata'];
	$rozpoczeciepromoczas = $_GET['rozpoczeciepromoczas'];
	?>


	<div class="centered">
		<form action="zatwierdzaniemistrzpodwojnytxt.php" style="padding:10px 0px;" method="post">


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
											<input type="text" class="w3-input" name="nazwapromocjimistrz" value="<?php echo $nazwapromocjimistrz; ?>" id="nazwaprojekturamkanew" style="color:black;font-weight:bold" required class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz nazwe promocji"></textarea>

											<label> </label>
										</div>
										<div class="w3-section">
											<label>INDEKS:</label>
											<input type="text" class="w3-input" name="nazwaprojekturamkanew" value="<?php echo $nazwaprojekturamkanew; ?>" id="nazwaprojekturamkanew" style="color:black;font-weight:bold" required class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz index"></textarea>

											<label> </label>
										</div>

										<div class="w3-section">
											<label>ROZPOCZĘCIE DATA/CZAS:</label>
											<input type=hidden name="idform" value="<?php echo $idform; ?>">

											<input type="date" name="rozpoczeciepromodata" class="w3-input" value="<?php echo $rozpoczeciepromodata; ?>" id="nazwaprojekturamkanew" style="color:black;font-weight:bold;width:55%" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>
											<input type="time" name="rozpoczeciepromoczas" class="w3-input" value="<?php echo $rozpoczeciepromoczas; ?>" id="pliktxtramka" style="color:black;font-weight:bold;width:55%" placeholder="Wpisz nazwe pliku tekstowego" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>

											<label> </label>
										</div>
										<div class="w3-section">
											<label>WYBIERZ PLIK TXT A-D:</label>
											<input name="pliktxtramkanew" class="w3-input" type="file" accept=".txt,.csv" ref="myFile" required @change="selectedFile">

											<label> </label>
										</div>
										<div class="w3-section">
											<label>WYBIERZ PLIK TXT B-E:</label>
											<input name="pliktxtramkanew2" class="w3-input" type="file" accept=".txt,.csv" ref="myFile" required @change="selectedFile">

											<label> </label>
										</div>
										<div class="w3-section">
											<label>WYBIERZ PLIK TXT C-F:</label>
											<input name="pliktxtramkanew3" class="w3-input" type="file" accept=".txt,.csv" ref="myFile" required @change="selectedFile">

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
										<label>WYBIERZ PLIK TXT Z KODAMI<br>&nbsp;(SPIS TREŚCI LUB PLIK A-D):</label>

										<input type=hidden name="idform" value="<?php echo $idform; ?>">

										<div id="app" v-cloak>

											<input name="pliktxtzkodami" class="w3-input" accept=".txt,.csv" required type="file" ref="myFile" @change="selectedFile">
											<div v-if="allcode.length">
												<input type="text" v-model="allcode.slice(0,3)" required name="kodyzplikutxt" class="w3-input"></textarea>


												<p>Liczba wierszy w pliku: {{allcode.length}}.<br>3 pierwsze kody z pliku:</p>
												<ul>
													<li name="code" v-for="code in codes">{{code}}</li>
												</ul>


											</div>
										</div>

									</div>



									<label> </label>


									<label> </label>
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
					<select name="podwojnypotwierdztxt" class="w3-input" style="width:auto;margin-left:30%;" type="text" placeholder="Wybierz" required>
						<option value="" disabled selected>WYBIERZ</option>
						<option>ZATWIERDZAM FORMULARZ O TYM SAMYM PLIKU TEKSTOWYM</option>

					</select>
					<br>


					<input type="submit" name="add" id="zatwierdzindex" style="color:white;font-weight:bold" value="ZATWIERDŹ" action="zatwierdzaniemistrzpodwojnytxt.php" class="btn btn-info"></textarea>


		</form>



		<div id="logo5">
			<h1 style="font-size:28px;">ZATWIERDZANY FORMULARZ:</h1>
		</div>

		<div class="centered">
		</div>



		<div class="text-center img-placeholder" onClick="triggerClick()">

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
				$conn = @mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");
				mysqli_set_charset($conn, "utf8");
				if (!$conn) {
					echo "Błąd połączenia!";
				}
			}
		}

		$sql = "SELECT id, laser, user, edata, image, rodzajprojektu FROM nadruki WHERE status='0' ORDER BY id DESC ";
		$query = mysqli_query($conn, $sql);


		echo "<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' >";

		echo "<tr>";
		echo "<th>Zdjęcie wieczka</th>";
		echo "<th>Numer Formularza</th>";
		echo "<th>Indeks promocji - automatyk</th>";
		echo "<th>Nazwa Pliku TXT</th>";
		echo "<th>Laser</th>";
		echo "<th>Użytkownik</th>";
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
		}
		require_once "connect.php";
		$conn = @mysqli_connect($host, $db_user, $db_password, $db_name);
		mysqli_set_charset($conn, "utf8");

		$results = mysqli_query($conn, "SELECT * FROM nadruki WHERE id= $idform ");
		$users = mysqli_fetch_all($results, MYSQLI_ASSOC);
		?>

		<?php foreach ($users as $user) : ?>
			<tr>
				<td> <img onclick="window.open(this.src)" class="pic" name="<?php 'uploads/prasa/' . $user["image"] ?>" onChange="displayImage(this)" id="<?php 'uploads/prasa/' . $user["image"] ?>" class="form-control" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" onClick="triggerClick()" id="profileDisplay" width="90" height="90" alt="">
					<img class="picbig" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" alt="">
				</td>
				<td>
					<p><a ?id=<?php echo $user['id']; ?> <br> <?php echo $user['id']; ?> <br>Data promocji <?php echo $user['edata']; ?></p>
				</td>
				<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['indexautomatyk']; ?></a> </td>


				<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['pliktxtramka']; ?></a> </td>
				<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['laser']; ?></a> </td>
				<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['user']; ?></a> </td>
				<td> <a class="btn btn-success" id="user" value="user"><?php echo $user['rodzajprojektu']; ?></a> </td>
			</tr>
			</tr>
		<?php endforeach;

		?>
		</tbody>
		</table>

		<div class="centered">
		</div>
		<br><br><br><br><br><br><br><br>
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
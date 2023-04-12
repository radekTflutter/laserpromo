<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
	header('Location: index.php');
	exit();
}
?>
<?php if ($_SESSION['ranga'] == 'a') {
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


		body {
			font-family: Arial, Helvetica, sans-serif;
		}



		button {
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;

		}

		button:hover {
			opacity: 0.8;
		}

		.cancelbtn {
			width: auto;
			padding: 10px 18px;
			background-color: #f44336;
		}

		.imgcontainer {
			text-align: center;
			margin: auto;
			position: relative;
		}

		img.avatar {
			width: 40%;
			border-radius: 50%;
		}

		.container {
			padding: 9px;
		}

		span.psw {
			float: right;
			padding-top: 16px;
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
			<form action="zatwierdzaniemistrzprasa.php" method="post">
				<input type="submit" value="ZATWIERDZANIE PRASA" id="formularz2" />
			</form>
		</span>

		<div id="logo22">
			<br><br><br>
			<label class="container">PRZEGLĄDAJ FORMULARZE:
			</label>
		</div>

		<span id="rodzajformularza">
			<form action="wyswietlaniemistrzprasa.php" method="post">
				<input type="submit" value="LASER PRASA" id="formularz" />
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
	<br>

	<div id="logo5">
		<h1 style="font-size:28px;">ZATWIERDZANY FORMULARZ</h1>
	</div>
	<br>



	</form>

	</div>

	<?php
	$user = trim($_SESSION['user']);
	$idform = $_GET['id'];
	$data = date("H.i.s d-m-Y");

	if (isset($_POST['add'])) {
		$log = 'LOGFILE - ZATWIERDZANIE MISTRZ PLIK TXT:' . "\r\n" .
			'NUMER FORMULARZA:' . $_POST['idform'] . ',' . "\r\n" .
			'NAZWA PROMOCJI:' . $_POST['nazwapromocjimistrz'] . ',' . "\r\n" .
			'INDEKS:' . $_POST['nazwaprojekturamkanew'] . ',' . "\r\n" .
			'ROZPOCZĘCIE DATA/CZAS:' . $_POST['rozpoczeciepromodata'] . '/' . $_POST['rozpoczeciepromoczas'] . ',' . "\r\n" .
			'PLIK TXT A-D:' . $_POST['pliktxtramkanew'] . ',' . "\r\n" .
			'PLIK TXT B-E:' . $_POST['pliktxtramkanew2'] . ',' . "\r\n" .
			'PLIK TXT C-F:' . $_POST['pliktxtramkanew3'] . ',' . "\r\n" .
			'PLIK TXT Z KODAMI:' . $_POST['pliktxtzkodami'] . ',' . "\r\n" .
			'3 pierwsze kody z pliku:' . $_POST['kodyzplikutxt'] . ',' . "\r\n" .
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


	$indexform = "";
	$textform = "";
	$user = trim($_SESSION['user']);
	$idform = $_GET['id'];
	$idpodw = $_GET['id'];

	if (isset($_POST['add'])) {
		$indexform = $_POST['nazwaprojekturamkanew'];
		$textform = $_POST['pliktxtramkanew'];
		$textform2 = $_POST['pliktxtramkanew2'];
		$textform3 = $_POST['pliktxtramkanew3'];

		$sql_n = "SELECT * FROM nadruki WHERE nazwaprojekturamka='$indexform' ";
		$sql_i = "SELECT * FROM nadruki WHERE 
		pliktxtramkamistrz='$textform' OR pliktxtramkamistrz2='$textform2' OR pliktxtramkamistrz3='$textform3' OR
		pliktxtramkamistrz='$textform2' or pliktxtramkamistrz2='$textform' or pliktxtramkamistrz3='$textform' OR
		pliktxtramkamistrz='$textform3' or pliktxtramkamistrz2='$textform3' or pliktxtramkamistrz3='$textform2'
		";
		$res_u = mysqli_query($connect, $sql_n);
		$res_i = mysqli_query($connect, $sql_i);
		if (mysqli_num_rows($res_u)  > 0) {
			header("Location: zatwierdzaniemistrzpodwojnytxt.php?id=" . $_POST["idform"] . "&nazwapromocjimistrz=" . $_POST["nazwapromocjimistrz"] . "&nazwaprojekturamkanew=" . $_POST["nazwaprojekturamkanew"] . "&rozpoczeciepromodata=" . $_POST["rozpoczeciepromodata"] . "&rozpoczeciepromoczas=" . $_POST["rozpoczeciepromoczas"] . "&pliktxtramkamistrz=" . $_POST["pliktxtramkanew"] . "&pliktxtramkamistrz2=" . $_POST["pliktxtramkanew2"] . "&pliktxtramkamistrz3=" . $_POST["pliktxtramkanew3"] . "");
		}
		if (mysqli_num_rows($res_i) > 0) {
			header("Location: zatwierdzaniemistrzpodwojnytxt.php?id=" . $_POST["idform"] . "&nazwapromocjimistrz=" . $_POST["nazwapromocjimistrz"] . "&nazwaprojekturamkanew=" . $_POST["nazwaprojekturamkanew"] . "&rozpoczeciepromodata=" . $_POST["rozpoczeciepromodata"] . "&rozpoczeciepromoczas=" . $_POST["rozpoczeciepromoczas"] . "&pliktxtramkamistrz=" . $_POST["pliktxtramkanew"] . "&pliktxtramkamistrz2=" . $_POST["pliktxtramkanew2"] . "&pliktxtramkamistrz3=" . $_POST["pliktxtramkanew3"] . "");
		} else {
			$sql = " UPDATE nadruki SET nazwaprojekturamka ='" . $_POST["nazwaprojekturamkanew"] . "', nazwaprojekturamkakopia ='" . $_POST["nazwaprojekturamkanew"] . "', usermistrz ='" . $user . "', nazwapromocjimistrz='" . $_POST["nazwapromocjimistrz"] . "', pliktxtzkodami='" . $_POST["pliktxtzkodami"] . "',
									pliktxtramkamistrz ='" . $_POST["pliktxtramkanew"] . "', pliktxtramkamistrzkopia ='" . $_POST["pliktxtramkanew"] . "', kodyzplikutxt ='" . $_POST["kodyzplikutxt"] . "', kodyzplikutxtkopia ='" . $_POST["kodyzplikutxt"] . "', pliktxtramkamistrz2 ='" . $_POST["pliktxtramkanew2"] . "', pliktxtramkamistrz3 ='" . $_POST["pliktxtramkanew3"] . "', uwagimistrz ='" . $_POST["uwagimistrz"] . "',
									rozpoczeciepromodata ='" . $_POST["rozpoczeciepromodata"] . "', rozpoczeciepromoczas ='" . $_POST["rozpoczeciepromoczas"] . "', pliktxtramkamistrz2kopia ='" . $_POST["pliktxtramkanew2"] . "', pliktxtramkamistrz3kopia ='" . $_POST["pliktxtramkanew3"] . "',
									status=1, zatwierdzony=1 WHERE id='" . $_POST["idform"] . "' AND status=0";

			$results = mysqli_query($connect, $sql);
			header('Location: zatwierdzaniemistrzprasa.php');
			echo 'ZAPISANE!';
			exit();
		}
	}
	?>



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

	$sql = "SELECT id, laser, user, edata, image, time, rodzajprojektu FROM nadruki WHERE status='0' ORDER BY id DESC ";
	$query = mysqli_query($conn, $sql);


	echo "<table id='tfhover' style='width: auto; text-align:left; margin-left:auto; margin-right:auto;' class='tftable' border='1' >";

	echo "<tr>";
	echo "<th>Zdjęcie wieczka</th>";
	echo "<th>Indeks promocji - automatyk</th>";
	echo "<th>Numer Formularza</th>";
	echo "<th>Data/Godzina uruchomienia promocji</th>";
	echo "<th>Nazwa pliku TXT</th>";
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
		$time = $row["time"];
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
					<img class="picbig" src="<?php echo 'uploads/prasa/' . $user["image"] ?>" alt="">
				</td>
				<td> <a class="btn btn-success" id="imagename" value="imagename"><?php echo $user['indexautomatyk']; ?></a> </td>

				<td>
					<p><a ?id=<?php echo $user['id']; ?> <br> <?php echo $user['id']; ?> </p>
				</td>
				<td> <a class="btn btn-success" id="imagename" value="imagename"><br>Data promocji <?php echo $user['edata'];  ?><br>Godzina promocji <?php echo $user['time']; ?></a> </td>
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
		</div>
		</div>

		</select>
	</span>


	<div class="centered">
		<form action="zatwierdzaniemistrzpliktxt.php" style="padding:10px 0px;" method="post">


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
											<input type="text" class="w3-input" name="nazwapromocjimistrz" id="nazwaprojekturamkanew" style="color:black;font-weight:bold" required class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz nazwe promocji"></textarea>

											<label> </label>
										</div>
										<div class="w3-section">
											<label>INDEKS:</label>
											<input type="text" class="w3-input" name="nazwaprojekturamkanew" id="nazwaprojekturamkanew" style="color:black;font-weight:bold" required class="form-control cols=" 90" rows="2" list="projekty" placeholder="  Wpisz index"></textarea>

											<label> </label>
										</div>

										<div class="w3-section">
											<label>ROZPOCZĘCIE DATA/CZAS:</label>
											<input type=hidden name="idform" value="<?php echo $idform; ?>">

											<input type="date" name="rozpoczeciepromodata" class="w3-input" id="nazwaprojekturamkanew" style="color:black;font-weight:bold;width:55%" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>
											<input type="time" name="rozpoczeciepromoczas" class="w3-input" id="pliktxtramka" style="color:black;font-weight:bold;width:55%" placeholder="Wpisz nazwe pliku tekstowego" required class="form-control cols=" 90" rows="2" list="projekty"></textarea>

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


					<input type="submit" name="add" id="zatwierdzindex" style="color:white;font-weight:bold" value="ZATWIERDŹ" action="zatwierdzaniemistrzpliktxt.php" class="btn btn-info"></textarea>


		</form>


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
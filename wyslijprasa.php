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


<!DOCTYPE html>
<html lang="pl">

<meta charset="utf-8">
<title>Nowy Formularz</title>

<meta http-equiv="X-Ua-Compatible" content="IE=edge">
<link rel="stylesheet" href="style8.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<head>

	<link data-brackets-id='4830' rel='stylesheet' media='screen and (min-width: 800px) and (max-width: 1000px)' href='style8.css' />


</head>


<body>



	<form action="formularz.php" method="post">

		<br>
		<input type="submit" value="WSTECZ" class="w3-button w3-theme"></input>





		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Nowy formularz" />

	</form>


	<?php

	require_once "connect.php";
	$con = mysqli_connect($host, $db_user, $db_password, $db_name);
	if (mysqli_connect_errno()) {
		die("Błąd połączenia z bazą");
	}
	$con->query('SET NAMES utf8');
	$con->query('SET CHARACTER_SET utf8_unicode_ci');
	require_once('kompresja.php');

	if (isset($_POST['submit'])) {


		$xmlfile =  trim($_POST['plikxmlramka']);
		$data = date("Y-m-d H:i:s");
		$timeimage = date("H.i.s");
		$datamade = strftime("%d-%m-%Y", strtotime($datamade));
		$xmlfile = $_FILES["plikxml"];
		move_uploaded_file($xmlfile["tmp_name"], "uploads/xml/" . $data . "_" . $xmlfile["name"]);
		$plikxmlname = $data . "_" . $xmlfile["name"];

		$file =  trim($_POST['nazwaimage']);
		$data =  trim($_POST['edata']);

		$datamade = strftime("%d-%m-%Y", strtotime($data));

		$plik_tmp = $_FILES['image']['tmp_name'];
		$plik_nazwa = $_FILES['image']['name'];

		$co = array('ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż', 'Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó', 'Ś', 'Ź', 'Ż', ' ', '/', '#');
		$na = array('a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z', 'A', 'C', 'E', 'L', 'N', 'O', 'S', 'Z', 'Z', '', '_', '_');

		$plik_nazwa_new = $plik_nazwa;
		$plik_nazwa_new2 = str_replace($co, $na, $plik_nazwa_new);

		$plik_nazwa_wlasna = $file;
		$plik_nazwa_wlasna2 = str_replace($co, $na, $plik_nazwa_wlasna);


		$unixTimestamp = time();
		$mysqlTimestamp = date("Y-m-d H:i:s", $unixTimestamp);
		$datamade = strftime("%d-%m-%Y", strtotime($datamade));
		$target = "uploads/prasa/PRASA" . $datamade . $timeimage . $plik_nazwa_wlasna2;
		$imagename = "PRASA" . $datamade . $timeimage . $plik_nazwa_wlasna2 . $plik_nazwa_new2;
		$target = $target . $plik_nazwa_new2;

		echo $imagename;


		$time = strftime("%H:%M:%S", time());
		$date = strftime("%Y-%m-%d", time());


		$font = "fonts/ARIAL.TTF";
		$grey = imagecolorallocate($im, 128, 128, 128);
		$red = imagecolorallocate($im, 255, 0, 0);

		imagettftext($im, 10, 0, 11, 20, $grey, $font, $date);
		imagettftext($im, 10, 0, 10, 35, $grey, $font, $time);
		imagettftext($im, 10, 0, 10, 50, $red, $font, $imagename);
	}


	$_SESSION['user'];

	$file =  trim($_POST['nazwaimage']);
	$laser = trim($_POST['laser']);
	$rodzaj = trim($_POST['rodzaj']);
	$lnumer = trim($_POST['lnumer']);
	$pnumer = trim($_POST['pnumer']);
	$edata = trim($_POST['edata']);
	$time = trim($_POST['time']);
	$nazwaprojekturamka = '';
	$nazwaprojektuautomatyk = trim($_POST['nazwaprojektuautomatyk']);
	$plikxmlramka = trim($_POST['plikxmlramka']);
	$plikxml = $plikxmlname;
	$pliktxtramka = trim($_POST['pliktxtramka']);
	$infonadruku = trim($_POST['infonadruku']);
	$grafika = trim($_POST['grafika']);
	$napisramkastaly = trim($_POST['napisramkastaly']);
	$napisramkainne = trim($_POST['napisramkainne']);
	$indexautomatyk = trim($_POST['indexautomatyk']);
	$stacja1x = trim($_POST['stacja1x']);
	$stacja1y = trim($_POST['stacja1y']);
	$stacja2x = trim($_POST['stacja2x']);
	$stacja2y = trim($_POST['stacja2y']);
	$stacja3x = trim($_POST['stacja3x']);
	$stacja3y = trim($_POST['stacja3y']);
	$predkosc = trim($_POST['predkosc']);
	$czestotliwosc = trim($_POST['czestotliwosc']);
	$paraminne = trim($_POST['paraminne']);
	$nazwaczcionki = trim($_POST['nazwaczcionki']);
	$wielkosc = trim($_POST['wielkosc']);
	$szerokosc = trim($_POST['szerokosc']);
	$odstepmiedzyznakami = trim($_POST['odstepmiedzyznakami']);
	$odstepmiedzywierszami = trim($_POST['odstepmiedzywierszami']);
	$inne = trim($_POST['inne']);
	$dataform = $mysqlTimestamp;
	$uwagi = trim($_POST['uwagi']);
	$image = $imagename;
	$user = trim($_SESSION['user']);
	$rodzajprojektu = trim($_POST['rodzajprojektu']);
	$nazwaimage =  trim($_POST['nazwaimage']);
	$status = 0;
	$widoczny = 1;


	if (!$laser || !$rodzaj || !$lnumer || !$pnumer) {
		echo 'Brak wszystkich danych, wybierz wstaw formularz i spóbuj ponownie!';
		header('Location: formularz.php');
	}

	if (!get_magic_quotes_gpc()) {
		$laser = addslashes($laser);
		$rodzaj = addslashes($rodzaj);
		$lnumer = addslashes($lnumer);
		$pnumer = addslashes($pnumer);
		$edata = addslashes($edata);
		$time = addslashes($time);
		$nazwaprojekturamka = addslashes($nazwaprojekturamka);
		$nazwaprojektuautomatyk = addslashes($nazwaprojektuautomatyk);
		$plikxmlramka = addslashes($plikxmlramka);
		$plikxml = addslashes($plikxml);
		$pliktxtramka = addslashes($pliktxtramka);
		$infonadruku = addslashes($infonadruku);
		$grafika = addslashes($grafika);
		$napisramkastaly = addslashes($napisramkastaly);
		$napisramkainne = addslashes($napisramkainne);
		$indexautomatyk = addslashes($indexautomatyk);
		$stacja1x = addslashes($stacja1x);
		$stacja1y = addslashes($stacja1y);
		$stacja2x = addslashes($stacja2x);
		$stacja2y = addslashes($stacja2y);
		$stacja3x = addslashes($stacja3x);
		$stacja3y = addslashes($stacja3y);
		$predkosc = addslashes($predkosc);
		$czestotliwosc = addslashes($czestotliwosc);
		$paraminne = addslashes($paraminne);
		$nazwaczcionki = addslashes($nazwaczcionki);
		$wielkosc = addslashes($wielkosc);
		$szerokosc = addslashes($szerokosc);
		$odstepmiedzyznakami = addslashes($odstepmiedzyznakami);
		$odstepmiedzywierszami = addslashes($odstepmiedzywierszami);
		$inne = addslashes($inne);
		$dataform = addslashes($dataform);
		$uwagi = addslashes($uwagi);
		$image = addslashes($image);
		$user = addslashes($user);
		$rodzajprojektu = addslashes($rodzajprojektu);
		$nazwaimage = addslashes($nazwaimage);
	}


	$photo_name = ($_FILES['image']['name']);
	$imageFileType = pathinfo($target, PATHINFO_EXTENSION);
	$file = $photo_name;
	//$query = ['image'];
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	echo $pnumer;
	try {
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		}

		if (isset($_POST['submit'])) {

			if ($polaczenie->query("INSERT INTO nadruki (laser, pnumer, lnumer, rodzaj, edata, time, infonadruku, grafika, napisramkastaly, napisramkainne, stacja1x,
									stacja1y, stacja2x, stacja2y, stacja3x, stacja3y, image, nazwaprojektuautomatyk, rodzajprojektu, plikxml, plikxmlramka,
									 pliktxtramka, predkosc, czestotliwosc, paraminne, nazwaczcionki, wielkosc, szerokosc, odstepmiedzyznakami, odstepmiedzywierszami,
									  inne, uwagi, user, dataform, status, widoczny, indexautomatyk, nazwaimage) VALUES 
									('$laser', '$pnumer', '$lnumer', '$rodzaj', '$edata', '$time', '$infonadruku', '$grafika', '$napisramkastaly', 
									'$napisramkainne', '$stacja1x', '$stacja1y', '$stacja2x', '$stacja2y', '$stacja3x', '$stacja3y', '$image', '$nazwaprojektuautomatyk',
									  '$rodzajprojektu', '$plikxml', '$plikxmlramka', '$pliktxtramka', '$predkosc', '$czestotliwosc', '$paraminne', '$nazwaczcionki', '$wielkosc',
									   '$szerokosc', '$odstepmiedzyznakami', '$odstepmiedzywierszami', '$inne', '$uwagi', '$user', '$dataform', '$status', '$widoczny', '$indexautomatyk','" . $nazwaimage . "')")) {
				header('Location: nowyformularzprasa.php');
			}
		}
		$polaczenie->close();
	} catch (Exception $e) {
		echo '<span style="color:red;">Błąd serwera!</span>';
		echo '<br />Informacja DEV: ' . $e;
	}

	$query .= " VALUES('{$file}')";
	$result = mysqli_query($con, $query);

	if ($result && compress($_FILES['image']['tmp_name'], $target, 50)) {
		echo "<script>
				alert('Zdjęcie dodane');
				<?script>";
	} else {
		echo "<script>
				alert('Błąd podczas wysyłania');
				<?script>";
	}



	if ($wynik) echo  'Liczba formularzy dodanych do bazy:' . $con->affected_rows;

	?>
	

	<?php
	$user = trim($_SESSION['user']);

	$data = date("H.i.s d-m-Y");

	if (isset($_POST['submit'])) {
		$log = 'LOGFILE - WPROWADZANIE FORMULARZA:' . "\r\n" .
			'LASER:' . $_POST['laser'] . ',' . "\r\n" .
			'RODZAJ WIECZKA:' . $_POST['rodzaj'] . ',' . "\r\n" .
			'PRASA:' . $_POST['pnumer'] . ',' . "\r\n" .
			'DATA/CZAS:' . $_POST['edata'] . '/' . $_POST['time'] . ',' . "\r\n" .
			'LICZBA WIERSZY:' . $_POST['infonadruku'] . ',' . "\r\n" .
			'GRAFIKA:' . $_POST['grafika'] . ',' . "\r\n" .
			'NAPIS STAŁY:' . $_POST['napisramkastaly'] . ',' . "\r\n" .
			'INFORMACJA NADRUKU INNE:' . $_POST['napisramkainne'] . ',' . "\r\n" .
			'STACJA 1x:' . $_POST['stacja1x'] . ',' . "\r\n" .
			'STACJA 1y:' . $_POST['stacja1y'] . ',' . "\r\n" .
			'STACJA 2x:' . $_POST['stacja2x'] . ',' . "\r\n" .
			'STACJA 2y:' . $_POST['stacja2y'] . ',' . "\r\n" .
			'STACJA 3x:' . $_POST['stacja3x'] . ',' . "\r\n" .
			'STACJA 3y:' . $_POST['stacja3y'] . ',' . "\r\n" .
			'NAZWA ZDJĘCIA:' . $_POST['nazwaimage'] . ',' . "\r\n" .
			'NAZWA PLIKU ZDJĘCIA:' . $image . ',' . "\r\n" .
			'INDEKS:' . $_POST['indexautomatyk'] . ',' . "\r\n" .
			'NAZWA PROJEKTU:' . $_POST['nazwaprojektuautomatyk'] . ',' . "\r\n" .
			'RODZAJ PROJEKTU:' . $_POST['rodzajprojektu'] . ',' . "\r\n" .
			'NAZWA PLIKU TEKSTOWEGO:' . $_POST['pliktxtramka'] . ',' . "\r\n" .
			'PLIK XML:' . $plikxml . ',' . "\r\n" .
			'NAZWA PLIKU XML LUB TEMPLATE:' . $_POST['plikxmlramka'] . ',' . "\r\n" .
			'PRĘDKOŚĆ:' . $_POST['predkosc'] . ',' . "\r\n" .
			'CZĘSTOTLIWOŚĆ:' . $_POST['czestotliwosc'] . ',' . "\r\n" .
			'PARAMETRY LASERA INNE:' . $_POST['paraminne'] . ',' . "\r\n" .
			'NAZWA CZCIONKI:' . $_POST['nazwaczcionki'] . ',' . "\r\n" .
			'WIELKOŚĆ:' . $_POST['wielkosc'] . ',' . "\r\n" .
			'SZEROKOŚĆ:' . $_POST['szerokosc'] . ',' . "\r\n" .
			'ODSTĘP MIĘDZY ZNAKAMI:' . $_POST['odstepmiedzyznakami'] . ',' . "\r\n" .
			'ODSTĘP MIĘDZY WIERSZAMI:' . $_POST['odstepmiedzywierszami'] . ',' . "\r\n" .
			'CZCIONKA INNE:' . $_POST['inne'] . ',' . "\r\n" .
			'UWAGI:' . $_POST['uwagi'] . ',' . "\r\n" .
			'UŻYTKOWNIK:' . $user . ',' . "\r\n";
		$file = fopen("uploads/logfile/prasa/automatyk/" . "automatyk_" . $data . ".txt", "a+");
		fprintf( $file, "\xEF\xBB\xBF");
		fwrite($file, $log);
		fclose($file);
	}
	?>


	<h1>Wyniki dodania formularza</h1>

</body>

</html>
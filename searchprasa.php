<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
	header('Location: index.php');
	exit();
}
?>
<?php if ($_SESSION['ranga'] == 'k') {
	header('Location: managermain.php');
}
?>

<!doctype html>
<html>
<link rel="stylesheet" href="style8.css">

<head>
	<title>Wyszukiwanie</title>
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">
	<meta charset="utf-8" />
	<html lang="pl">
	<meta http-equiv="refresh" content=18000;URL="logout.php" />

<body>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="style8.css">

	<title>Wyszukiwanie</title>
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">
	<meta charset="utf-8_polish_ci" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	</head>


	</head>

	<body>

		<?php


		require_once "connect.php";

		$conn = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");

		mysqli_set_charset($conn, "utf8");


		if ($conn->connect_errno != 0) {
			echo "Error: " . $conn->connect_errno;
		}


		if (isset($_GET['keywords'])) {


			$keywords = $conn->escape_string($_GET['keywords']);
			$query = $conn->query("
	SELECT id, laser, rodzaj, pnumer, edata, indexautomatyk, nazwaprojektuautomatyk, plikxmlramka, pliktxtramka, 
		infonadruku, uwagi, nazwaimage, rodzajprojektu, user, uwagimistrz, nazwapromocjimistrz, nazwaprojekturamka, 
		pliktxtramkamistrz, pliktxtramkamistrz2, pliktxtramkamistrz3, kodyzplikutxt, ostatniekody, rozpoczeciepromodata,
		rozpoczeciepromoczas, zakonczeniepromodata, zakonczeniepromoczas, podwojnypotwierdztxt, podwojnypotwierdz, usermistrz
        FROM nadruki
        WHERE id LIKE '%{$keywords}%' AND widoczny=1
		OR laser LIKE '%{$keywords}%' AND widoczny=1
        OR rodzaj LIKE '%{$keywords}%' AND widoczny=1
        OR pnumer LIKE '%{$keywords}%' AND widoczny=1
        OR edata LIKE '%{$keywords}%' AND widoczny=1
		OR nazwaprojekturamka LIKE '%{$keywords}%' AND widoczny=1
		OR nazwaprojektuautomatyk LIKE '%{$keywords}%' AND widoczny=1
		OR plikxmlramka LIKE '%{$keywords}%' AND widoczny=1
		OR pliktxtramka LIKE '%{$keywords}%' AND widoczny=1
		OR infonadruku LIKE '%{$keywords}%' AND widoczny=1
		OR uwagi LIKE '%{$keywords}%' AND widoczny=1
		OR uwagi LIKE '%{$keywords}%' AND widoczny=1
		OR nazwaimage LIKE '%{$keywords}%' AND widoczny=1
		OR rodzajprojektu LIKE '%{$keywords}%' AND widoczny=1
		OR user LIKE '%{$keywords}%' AND widoczny=1
		OR nazwapromocjimistrz LIKE '%{$keywords}%' AND widoczny=1
		OR uwagimistrz LIKE '%{$keywords}%' AND widoczny=1
		OR podwojnypotwierdztxt LIKE '%{$keywords}%' AND widoczny=1
		OR podwojnypotwierdz LIKE '%{$keywords}%' AND widoczny=1
		OR pliktxtramkamistrz LIKE '%{$keywords}%' AND widoczny=1
		OR pliktxtramkamistrz2 LIKE '%{$keywords}%' AND widoczny=1
		OR pliktxtramkamistrz3 LIKE '%{$keywords}%' AND widoczny=1
		OR kodyzplikutxt LIKE '%{$keywords}%' AND widoczny=1
		OR ostatniekody LIKE '%{$keywords}%' AND widoczny=1
		OR rozpoczeciepromodata LIKE '%{$keywords}%' AND widoczny=1
		OR rozpoczeciepromoczas LIKE '%{$keywords}%' AND widoczny=1
		OR zakonczeniepromodata LIKE '%{$keywords}%' AND widoczny=1
		OR zakonczeniepromoczas LIKE '%{$keywords}%' AND widoczny=1
		OR indexautomatyk LIKE '%{$keywords}%' AND widoczny=1
		OR nazwapromocjimistrz LIKE '%{$keywords}%' AND widoczny=1
		
		
    ORDER BY id DESC");

		?>
			<div class="result-count">
				Znaleziono <?php echo $query->num_rows; ?> wyników.

			</div>
			<form action="wyszukajprasa.php" method="post">
				<br>
				<input type="submit" style="font-size:30px;margin-left:10%" value="Wstecz" />

			</form>
			<div class="tablemobile" style="display: inline-block; height: 35em; width: 100%; overflow-x: scroll; overflow-y: scroll">
				<div style="position: relative;">
					<div style="display: inline-block; position: absolute; left: 0px; top: 0px; height: 20em; ">

						<table style="border-collapse: collapse;">

						<?php
				
						echo <<<END

	<table>
		<thead>
			<tr>
				<th>Nr</th>
				<th>Laser</th>
				<th>Rodzaj wieczka</th>
				<th>Prasa</th>
				<th>Data</th>
				<th>Indeks - automatyk</th>
				<th>Nazwa projektu - automatyk</th>
				<th>Plik XML</th>
                <th>Nazwa pliku TXT - automatyk</th>
                <th>Informacja o nadruku</th>
                <th>Uwagi</th>
                <th>Nazwa zdjęcia kluczyka</th>
				<th>Rodzaj projektu</th>
				<th>Uzytkownik-automatyk</th>
				<th>Uwagi mistrza</th>
				<th>Nazwa promocji - mistrz</th>				
				<th>Indeks - mistrz</th>
				<th>Nazwa pliku TXT:A-D - mistrz</th>
				<th>Nazwa pliku TXT:B-E - mistrz</th>
				<th>Nazwa pliku TXT:C-F - mistrz</th>
				<th>Pierwsze kody</th>
				<th>Ostatnie kody</th>
				<th>Data rozpoczęcia promocji - mistrz</th>
				<th>Godzina rozpoczęcia promocji - mistrz</th>
				<th>Data zakończenia promocji - mistrz</th>
				<th>Godzina zakończenia promocji - mistrz</th>
				<th>Podwójny plik TXT - potwierdzenie mistrza</th>
				<th>Podwójny INDEX - potwierdzenie mistrza</th>
				<th>Uzytkownik-mistrz</th>

			</tr>
		</thead>
	<tbody>
		
END;

						$suma = 0;

						while ($result = mysqli_fetch_assoc($query)) {
							echo "\r\n\t\t\t<tr>";
							foreach ($result as $col) {
								echo "<td>$col</td>";
							}
							echo "</tr>";
						}
						echo <<<END
\r\n
		</tbody>
	</table>
END;

					}
						?>

	</body>

</html>
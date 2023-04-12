	<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>
		<?php if  ($_SESSION['ranga']== 'm')
	{
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
    <title>RAPORT</title>
    <meta http-equiv="refresh" content=18000;URL="logout.php"/>

    <link rel="stylesheet"            href="style17.css" type="text/css">
	   
	<link  rel='stylesheet' media='screen and (min-width: 1000px) and (max-width: 1200px)' href='style7.css' />
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Formularz zatwierdzenia promocji na laserach przez mistrza</title>
			
		<style>
			.pic{
				width:50px;
				height:50px;
			}
			.picbig{
				position: absolute;
				width:0px;
				-webkit-transition:width 0.3s linear 0s;
				transition:width 0.3s linear 0s;
				z-index:10;
			}
			.pic:hover + .picbig{

				width:400px;
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
				50% { opacity: 0; }
				}
		</style>
	</head>

<body>


 
												<!--          Logo            -->
    
	 
		
		
		
	<div id="pic">
		 <a href="https://laserpromocja.canpack.ad/main.php"><img src="logo.jpg" id="ad"></a>
	 </div>

											<!--    Identyfikacja,kluczyk    -->

	
		
	<br><br>

	<div id="panel1">
	<br>
	<div id="logo22">
	
		<label class="container">MENU FORMULARZ:
		</label>
	
		</div>
			<span id="rodzajformularza222">
				<form action="main.php" method="post">
					<input type="submit" value=" MENU GŁÓWNE " id="formularz"/>
				</form>   
			</span>
			<span id="rodzajformularza2">
				<form action="wyszukajprasa.php" method="post">
				</form>  	
			</span>
			<span id="rodzajformularza2223">
				<form action="wyszukajprasa.php" method="post">
					<input type="submit" value=" WYSZUKAJ " id="formularz"/>
				</form>  	
			</span>
		<br>
		
		<div id="logo22">
		<br><br>
			<label class="container">RAPORT:
			</label>
		</div>	
			<style>
				form{
					display: block;
					width: 100px;
					padding: 10px 25px;
					color: #696969;
					font-size: 16px;
					text-shadow: 0 0 1px blue;
					float: center;
					}
			</style>
		
			<span id="rodzajformularza222">
				<form action="raportprasadzien.php" method="post">
					<input type="submit" value=" DZIEŃ " id="formularz"/>
         		</form>
			</span>
			<span id="rodzajformularza2222">
		 		<form action="raportprasatydzien.php" method="post">
					<input type="submit" value=" TYDZIEN " id="formularz"/>
				</form>  
				</form>   
			</span>
		
			<span id="rodzajformularza2">
				<form action="raportprasamiesiac.php" method="post">
					<input type="submit" value="MIESIĄC" id="formularz"/>
				</form>

				<form action="raportdata.php" method="get">
					<span id="nazwaprojektu30">									
						DATA OD:&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="from" required /> 
					
				<br><br>
					<span>							
						&nbsp;&nbsp;&nbsp;&nbsp;DATA DO:&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="till" required /> 
					<br><br>
						
					</span>
				</span>
				<span id="rodzajformularza2">	
						<input type="submit" value="WYSZUKAJ DATA OD-DO" id="wyswietlanie30">
				</span>
					</form>  	
			</span>
		<div id="logo2">
		<br><br><br><br><br>
		</div>
		<br><br><br>
		<div id="logo2">
    	<br><br><br>
		<br><br><br><br>
		<?php
		
			
					if(isset ($_SESSION['user']))
					{
						echo "<p> ".$_SESSION['user'].' [ <a href="logout.php">Wyloguj się!</a> ]</p>';
					}
						else
					{
						echo "<a href=/formularz/logout.php>Zaloguj się</a>";
			
					}
		
		?>
		</div>

		</div> 
	</div> 


  
 		<?php


			require_once "connect.php";
					
					$conn = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");
					
					mysqli_set_charset($conn, "utf8");
					
			
			if ($conn->connect_errno!=0)
			{
				echo "Error: ".$conn->connect_errno;
			}

		
			if(isset($_POST['keywords'])) {
  

				$keywords = $conn->escape_string($_POST['keywords']);
				$query = $conn->query("
					SELECT id, laser, rodzaj, lnumer, pnumer, edata, nazwaprojekturamka, plikxmlramka, pliktxtramka, infonadruku, uwagi, image, user 
					FROM nadruki
					WHERE id LIKE '%{$keywords}%'
					OR laser LIKE '%{$keywords}%'
					OR rodzaj LIKE '%{$keywords}%'
					OR lnumer LIKE '%{$keywords}%'
					OR pnumer LIKE '%{$keywords}%'
					OR edata LIKE '%{$keywords}%'
					OR nazwaprojekturamka LIKE '%{$keywords}%'
					OR plikxmlramka LIKE '%{$keywords}%'
					OR pliktxtramka LIKE '%{$keywords}%'
					OR infonadruku LIKE '%{$keywords}%'
					OR uwagi LIKE '%{$keywords}%'
					OR uwagi LIKE '%{$keywords}%'
					OR image LIKE '%{$keywords}%'
					OR user LIKE '%{$keywords}%'
				ORDER BY id DESC"); 

		?>
    <div class="result-count">
        Znaleziono <?php echo $query->num_rows; ?> wyników.
        
	</div>
 		<form action="wyszukajprasa.php" method="post">
	<br>
			<input type="submit" value="Wstecz" />
	
	</form> 

		<?php
	
		echo<<<END
			<table>
				<thead>
					<tr>
						<th>Nr</th>
						<th>Laser</th>
						<th>Rodzaj</th>
						<th>Numer</th>
						<th>Prasa</th>
						<th>Data</th>
						<th>Nazwa promocji</th>
						<th>Plik XML</th>
						<th>Nazwa pliku TXT</th>
						<th>Informacja o nadruku</th>
						<th>Uwagi</th>
						<th>Zdjecie kluczyka</th>
						<th>Uzytkownik</th>
					</tr>
				</thead>
			<tbody>
				
		END;

		$suma = 0;
						
						while($result = mysqli_fetch_assoc($query ))
						{
							echo "\r\n\t\t\t<tr>";
							foreach($result as $col)
							{
								echo "<td>$col</td>";

							}
							echo "</tr>";
							
							
						}
		echo<<<END
		\r\n
				</tbody>
			</table>
		END;


				}
		?>

</body>
</html>
          

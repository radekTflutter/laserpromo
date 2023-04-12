<!DOCTYPE HTML>
<html lang="pl">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link data-brackets-id='4829' rel="stylesheet" href="style4.css" type="text/css">
<link data-brackets-id='4830' rel='stylesheet' media='screen and (min-width: 300px) and (max-width: 1900px)' href='style4.css' />

<head>
<html lang="pl">

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Formularz promocji na laserach</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body onload="readFile();">

<div id="output"></div>
	<script type="text/javascript" src="jquery-1.12.0.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=0.8">
	<?php header('Content-type: text/html; charset=iso-8859-2'); ?>
	<?php
	$data = date("H.i.s d-m-Y");
	echo $data;
	?>

 
<style>
{
  box-sizing: border-box;
}


.column {
  float: left;
  width: 15%;
  padding: 10px;
  height: auto; 
}

.row:after {
  content: "";
  display: table;
  clear: both;
}
table {
  border-spacing: auto;
  width: auto;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  width: auto;

}

tr:nth-child(even) {
  background-color: #f2f2f2
}
	</style>
	</head>
	<?php
	
if (isset($_GET['id'])) {
	$idform = $_GET['id'];
} else {
	$idform = NULL;
}


	$path2 = "uploads/logfile/prasa/automatyk/$idform";
	$path = "uploads/logfile/prasa/mistrz/$idform";
	
	$fileContent2 = NULL;
	$fileContent = NULL;
	
	$test = "uploads/logfile/prasa/automatyk/$idform";
	if(file_exists($test))
		{ 
		$fileContent2 = file_get_contents($path2);
		} 

	$test = "uploads/logfile/prasa/mistrz/$idform";
	if(file_exists($test))
	    {
			$fileContent = file_get_contents($path);
		}
 
	?>

	<div id="pic">
    <a href="https://laserpromocja.canpack.ad/main.php"><img src="logo.jpg" id="ad"></a>
  </div>
  <div >
    <a href="https://laserpromocja.canpack.ad/logfile.php" class="row">RESET</a>
  </div>
	<br><br>
	<div class="row">
				
	<div class="column" style="background-color:#bbb;">
		
			<h2>LOGI AUTOMATYK</h2>
			<input id="myInput2" type="text" placeholder="Wyszukaj..."></textarea>
			<br><br>
				<table>
					<tr>
						<tbody id='myTable2'>
							<td>
								<?php
						
						$link2 = 'https://laserpromocja.canpack.ad/logfile.php';
							 
								$path2='uploads/logfile/prasa/automatyk';
								$files2 = scandir($path2);
								$files2 = array_diff(scandir($path2), array('.', '..'));
								
								foreach($files2 as $file2){
									echo "<a href='https://laserpromocja.canpack.ad/logfile.php?id=$file2'>$file2<br/>\n</a>";
																		
								}
							
								?>
							</td>
						</tbody>
					</tr>
				</table>
			</p>
		</div>

		<div class="column" style="background-color:#aaa;">

			<h2>LOGI MISTRZ</h2>
			<input id="myInput" type="text" placeholder="Wyszukaj..."></textarea>
			<br><br>
		 		<table>
					<tr>
						<tbody id='myTable'>
							<td>
								<?php
						$link = 'https://laserpromocja.canpack.ad/logfile.php';
										 
						$path='uploads/logfile/prasa/mistrz';
						$files = scandir($path);
						$files = array_diff(scandir($path), array('.', '..'));
						foreach($files as $file){
							echo "<a href='https://laserpromocja.canpack.ad/logfile.php?id=$file'>$file<br/>\n</a>";
																
						}
								?>
							</td>
						</tbody>
					</tr>
				</table>
			</p>
		</div>
			<div style="text-align: left" class="column">
				<?php
					$fileContent = mb_convert_encoding($fileContent, 'HTML-ENTITIES', "UTF-8");
					$fileContent2 = mb_convert_encoding($fileContent2, 'HTML-ENTITIES', "UTF-8");
				?>
				<td >
   				 <?= nl2br('<b>' . $fileContent2)?>
				</td>
				<td >
   				 <?= nl2br('<b>' . $fileContent)?>
				</td>
			</div>
	</div>
			
</body>

</html>

<script>
		$(document).ready(function() {
			$("#myInput").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#myTable a").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			$("#myInput2").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#myTable2 a").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>

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
      
  
<?php  

      require_once "connect.php";
			
			$connect = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Błąd połączenia!");

   
 $indexform = ""; 
 $user = trim($_SESSION['user']);
 
 $idform =  trim($_POST['idform']);

 if (!get_magic_quotes_gpc())
      {
 $idform = addslashes($idform);
      }
			$sql = "UPDATE nadruki SET widoczny=0 WHERE id=$idform";
			$results = mysqli_query($connect, $sql);
			header('Location: wyswietlanieprasa.php');	
			echo "ZAPISANE!";
			
		
	


 
?>

<form action="wyswietlanieprasa.php" method="post">
	  
      <br>
      
      
      
      
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="WYŚWIETLANIE" />
      
      </form>    
      
    
        
       
        
   </body>
  </html>
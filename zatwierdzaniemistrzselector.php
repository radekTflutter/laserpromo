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
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <?php





    require_once "connect.php";
    $con = mysqli_connect($host, $db_user, $db_password, $db_name);
    mysqli_set_charset($con, "utf8");
    if (mysqli_connect_errno()) {
        die("Błąd połączenia z bazą");
    }




    $id =  trim($_GET['id']);

    echo $id;
    ?>
    &nbsp;&nbsp;
    <?php
    mysqli_set_charset($con, "utf8");
    $sql = "SELECT id, rodzajprojektu 
     FROM nadruki WHERE id=$id ";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);
    printf("%s (%s)\n", $row["rodzajprojektu"], $row["id"]);

    mysqli_free_result($result);

    mysqli_close($con);

    $rodzajprojektu = $row["rodzajprojektu"];
    echo  $rodzajprojektu;

    if ($rodzajprojektu == 'SEKWENCJA') {

        header("Location: zatwierdzaniemistrzindex.php?id=$id");
    } else if ($rodzajprojektu == 'PROMOCJA TESTOWA') {
        header("Location: zatwierdzaniemistrztestowa.php?id=$id");
    } else {
        header("Location: zatwierdzaniemistrzpliktxt.php?id=$id");
    }

    ?>



    <h1>WYBRANY FORMULARZ DO ZATWIERDZENIA</h1>





    <form action="zatwierdzaniemistrz.php" method="post">

        <br>




        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Zatwierdzanie formularzy" />

    </form>





</body>

</html>
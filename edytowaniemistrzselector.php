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

    <?php





    require_once "connect.php";
    $con = mysqli_connect($host, $db_user, $db_password, $db_name);
    if (mysqli_connect_errno()) {
        die("Błąd połączenia z bazą");
    }
    $con->query('SET NAMES utf8');
    $con->query('SET CHARACTER_SET utf8_unicode_ci');





    $id =  trim($_GET['id']);

    echo $id;
    ?>
    &nbsp;&nbsp;
    <?php

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

        header("Location: edytowaniemistrzindex.php?id=$id");
    } else if ($rodzajprojektu == 'PROMOCJA TESTOWA') {
        header("Location: edytowaniemistrztestowa.php?id=$id");
    } else {
        header("Location: edytowaniemistrzpliktxt.php?id=$id");
    }

    ?>



    <h1>WYBRANY FORMULARZ DO ZATWIERDZENIA</h1>





    <form action="zatwierdzaniemistrz.php" method="post">

        <br>




        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Zatwierdzanie formularzy" />

    </form>





</body>

</html>
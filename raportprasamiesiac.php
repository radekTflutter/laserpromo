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


			
<?php

define('FPDF_FONTPATH', 'font');
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Times', 'B', 14);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(276, 5, 'RAPORT PROMOCJI PRASA: MIESIECZNY', 0, 0, 'C');
        $this->Ln(20);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, 'Strona ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function HeaderTable()
    {
        $this->SetFont('helvetica', 'B', 7);
        $this->SetTextColor(0, 0, 0);
        $this->SetLineWidth(0.1);
        $this->SetFillColor(255, 255, 255);
        $this->SetDrawColor(0, 0, 0);
        $this->Cell(8, 10, '  ID', 1, 0, 1, 'C');
        $this->Cell(28, 10, '  NAZWA PROMOCJI', 1, 0, 1, 'C');
        $this->Cell(29, 5, '       ROZPOCZECIE', 1, 0, 1, 'C');
        $this->Cell(29, 5, '       ZAKONCZENIE', 1, 0, 1, 'C');
        $this->Cell(60, 10, '                      PLIK TEKSTOWY', 1, 0, 1, 'C');
        $this->Cell(80, 10, '                                     3 OSTATNIO UZYTE KODY', 1, 0, 1, 'C');
        $this->Cell(21, 10, ' UZYTKOWNIK', 1, 0, 1, 'C');
        $this->Cell(12, 10, ' LASER', 1, 0, 1, 'C');
        $this->Cell(11, 10, 'PRASA', 1, 0, 1, 'C');
        $this->Cell(-1, 5, '', 0, 1);

        $this->Cell(36, 5, '', 0, 0);
        $this->Cell(15, 5, '    DATA', 1, 0, 1, 'C');
        $this->Cell(14, 5, 'GODZINA', 1, 0, 1, 'C');
        $this->Cell(15, 5, '    DATA', 1, 0, 1, 'C');
        $this->Cell(14, 5, 'GODZINA', 1, 0, 1, 'C');

        $this->Ln();
    }
}


require_once "connect.php";
$mysqli = @mysqli_connect($host, $db_user, $db_password, $db_name);
$baza = "SELECT * FROM nadruki WHERE MONTH(rozpoczeciepromodata) = MONTH(NOW()) AND YEAR(rozpoczeciepromodata) = YEAR(NOW())
            ORDER BY rozpoczeciepromodata DESC";
$rezultat = $mysqli->query($baza);


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->SetFont('Arial', '', 16);
$pdf->SetTextColor(22, 74, 160);
$pdf->HeaderTable();

$pdf->Image('logo.jpg', 10, 7, 25, 0, '', 'https://laserpromocja.canpack.ad/raportprasa.php?');
$mysqli->set_charset("utf8");
if ($rezultat = $mysqli->query($baza)) {
    while ($row = $rezultat->fetch_assoc()) {
        $pdf->SetFont('Times', 'B', 8);
        $pdf->SetLineWidth(0.1);
        $pdf->AddFont('arialpl', '', 'arialpl.php');
        $pdf->SetFont('arialpl', '', 6);
        $text = $row['nazwaprojekturamka'];
        $text = iconv('UTF-8', 'iso-8859-2//TRANSLIT//IGNORE', $text);

        $text2 = $row['pliktxtramka'];
        $text2 = iconv('UTF-8', 'iso-8859-2//TRANSLIT//IGNORE', $text2);

        $text3 = $row['ostatniekody'];
        $text3 = iconv('UTF-8', 'iso-8859-2//TRANSLIT//IGNORE', $text3);

        $text4 = $row['usermistrz'];
        $text4 = iconv('UTF-8', 'iso-8859-2//TRANSLIT//IGNORE', $text4);

        $pdf->Cell(8, 10, $row['id'], 1, 0, 'C', 0);
        $pdf->Cell(28, 10, $text, 1, 0, 'C', 0);
        $pdf->Cell(15, 10, $row['rozpoczeciepromodata'], 1, 0, 'C', 0);
        $pdf->Cell(14, 10, $row['rozpoczeciepromoczas'], 1, 0, 'C', 0);
        $pdf->Cell(15, 10, $row['zakonczeniepromodata'], 1, 0, 'C', 0);
        $pdf->Cell(14, 10, $row['zakonczeniepromoczas'], 1, 0, 'C', 0);
        $pdf->Cell(60, 10, $text2, 1, 0, 'C', 0);
        $pdf->Cell(80, 10, $text3, 1, 0, 'C', 0);
        $pdf->Cell(21, 10, $text4, 1, 0, 'C', 0);
        $pdf->Cell(12, 10, $row['laser'], 1, 0, 'C', 0);
        $pdf->Cell(11, 10, $row['pnumer'], 1, 1, 'C', 0);
        $pdf->SetDrawColor(0, 0, 0);
    }
}

$mysqli->set_charset("utf8");

$pdf->output();


?>
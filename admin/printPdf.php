<?php
require('../fpdf/tfpdf.php');

class tPDF extends TFPDF
{
  // Cabecera de página
  function Header()
  {
    // Logo
    $this->Image('logo.png', 10, 8, 33);
    // Arial bold 15
    $this->SetFont('Arial', 'B', 15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30, 10, 'Title', 1, 0, 'C');
    // Salto de línea
    $this->Ln(20);
  }

  // Pie de página
  function Footer()
  {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial', 'I', 8);
    // Número de página
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}





include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
$ndb = new DataBase();

if (isset($_GET['id'])) :
  $budget = $_GET['id'];

  $consultSQL = "SELECT a.name, a.price, c.discount, c.date, d.firstname, d.lastname, d.email FROM ((treatmentsinterventions a INNER JOIN budgets_treatments b ON a.id = b.id_treatments) INNER JOIN budgets c ON c.id = b.id_budget) INNER JOIN users d ON d.id = c.customer_id WHERE c.id = " . $budget;
  $resultados = $ndb->send($consultSQL);

  $pdf = new tFPDF();
  $pdf->AddPage();
  // Add a Unicode font (uses UTF-8)
  $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
  $pdf->AddFont('DejaVuCond', '', 'DejaVuSans-Bold.ttf', true);

  $pdf->Image('../images/logo-dark.png', 10, 8, 70);

  $pdf->SetFont('DejaVuCond', '', 12);
  $pdf->SetX(125);
  $pdf->Write(10, 'PRESUPUESTO Nº ' . $budget);
  $pdf->Ln(25);

  // Select a standard font (uses windows-1252)
  $pdf->SetFont('Arial', '', 14);
  $pdf->Ln(10);
  $pdf->Write(5, 'CLIENTE:  ');
  $pdf->SetFont('DejaVuCond', '', 12);
  $pdf->Write(5, $resultados[0]["firstname"] . " " . $resultados[0]["lastname"]);

  $pdf->Ln(10);
  $pdf->SetFont('Arial', '', 14);
  $pdf->Write(5, 'FECHA:  ');
  $pdf->SetFont('DejaVuCond', '', 12);
  $pdf->Write(5, $resultados[0]["date"]);

  $pdf->Ln(10);
  $pdf->Ln(10);
  $pdf->SetFont('Arial', '', 14);
  $pdf->Write(5, 'TRATAMIENTO');
  $pdf->SetX(125);
  $pdf->Write(5, 'COSTE');

  $pos = 5;
  $amount = 0;
  if ($resultados) :
    foreach ($resultados as $tratamiento) :
      $pdf->Ln(10);
      $pdf->SetFont('DejaVuCond', '', 12);
      $pdf->Write($pos, "   " . $tratamiento["name"]);
      $pdf->SetX(125);
      $pdf->Write($pos, $tratamiento["price"]) . " €";
      $amount = $amount + $tratamiento["price"];
    endforeach;
    $pdf->Ln(15);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Write(5, 'TOTAL TRATAMIENTOS:  ');
    $pdf->SetX(125);
    $pdf->SetFont('DejaVuCond', '', 12);
    $pdf->Write(5, $amount . " €");
  else :
    $pdf->Cell(10, $linea, "SIN RESULTADOS");
  endif;

  $discount = $resultados[0]["discount"];

  $pdf->Ln(10);
  $pdf->SetFont('Arial', '', 14);
  $pdf->Write(5, 'DESCUENTOS APLICADOS:  ');
  $pdf->SetX(125);
  $pdf->SetFont('DejaVuCond', '', 12);
  $pdf->Write(5, $discount . " %");

  $pdf->Ln(10);
  $pdf->SetFont('Arial', '', 14);
  $pdf->Write(5, 'TOTAL A PAGAR:  ');
  $pdf->SetX(125);
  $pdf->SetFont('DejaVuCond', '', 12);
  $pdf->Write(5, $amount - ($amount * $discount / 100) . " €");

  $pdf->SetY(200);
  $pdf->SetX(20);
  $pdf->SetFont('DejaVu', '', 9);
  $pdf->Write(5, "Este presupuesto tiene valor méramente informativo. El importe final y los tratamientos definitivos se plasmarán en el correspondinte contrato entre el Cliente y la Clínica");

  $pdf->Output("D", "presupuesto.pdf");
  header("Content-type:application/pdf");
  header("Content-Disposition:inline;filename='presupuesto.pdf'");
endif;

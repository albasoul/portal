<?php
include('includes/config.php');
$id = $_GET['id'];
$ligjerata = new Ligjerata($id);
$link = $ligjerata->getLink();
		require_once('includes/pdf/fpdf.php');
		require_once('includes/pdf/fpdi.php');

		$pdf = new FPDI('P','mm','Letter'); // krijojm klasen e FPDI
		$pageCount = $pdf->setSourceFile($link);
		for($i=1; $i<=$pageCount; $i++){
			$template = $pdf->importPage($i, '/MediaBox');
			$pdf->addPage();
			$pdf->useTemplate($template,0,0,0,0,true);
		}
		
		$pdf->Output();
?>
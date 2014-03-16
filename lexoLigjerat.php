<?php
include('includes/config.php');
$id = $_GET['id'];
$ligjerata = new Ligjerata($id);
$link = $ligjerata->getLink();
		require_once('includes/pdf/fpdf.php');
		require_once('includes/pdf/fpdi.php');

		$pdf = new FPDI('P','mm','A4'); // krijojm klasen e FPDI
		$pageCount = $pdf->setSourceFile($link);
		for($i=1; $i<=$pageCount; $i++){
			$template = $pdf->importPage($i, '/MediaBox');
			$pdf->addPage('P','A4');
			$pdf->useTemplate($template,null,null,0,0,true);
		}
		
		$pdf->Output();
?>
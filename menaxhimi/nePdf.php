<?php 
require_once("../includes/pdf/dompdf_config.inc.php");
include('../includes/config.php');
$page = new Page();

$id = explode("-", $lidhja->real_escape_string($_GET['votaID']));

	if(!empty($_GET['fakulteti']) && is_numeric($_GET['fakulteti'])){
		$fak = $_GET['fakulteti'];
	}
	else{
		$fak = 1;
	}
	if(!empty($_GET['viti']) && is_numeric($_GET['viti'])){
		$viti = $_GET['viti'];
	}
	else{
		$viti = date('Y');
	}

$profesori = new Profesor($id[0]); // krijojm 1 objekt profesori permes ID
$lenda = new Lenda($id[1]); // krijojm 1 objekt Lenda permes ID


$emri_lendes = htmlentities($lenda->getEmri());
$p = htmlentities($profesori->getEmri()) . ' '.htmlentities($profesori->getMbiemri());

$paraqitja = '';
$paraqitja2 = '';
$paraqitja3 = '';
$mesatareArray= array();
$data_vleresimit = '01-04-2014';
$votimi = $lidhja->query("SELECT *,AVG(nota) as mesatarja FROM votat WHERE lenda='$emri_lendes' AND profesori='$p' AND fk_id=$fak AND YEAR(data)=$viti GROUP BY pyetja ORDER BY id");
	

if($pyetjet = $lidhja->query("SELECT pyetja FROM vleresim_komente WHERE lenda='$emri_lendes' AND profesori='$p' AND YEAR(data)=$viti GROUP BY pyetja ORDER BY id")){ // i marrim pyetjet...
	$paraqitja3 .= '<div class="clearfix"></div><br/><div class="row mendimet">';
		foreach($pyetjet as $pt){
			$pytja= $pt['pyetja'];
			$mendimet = $lidhja->query("SELECT * FROM vleresim_komente WHERE lenda='$emri_lendes' AND profesori='$p' AND pyetja='$pytja'"); //i marrim te gjitha mendimet per ate pyetje (1 nga 1 te gjitha pyetjet, foreach bree)
			$paraqitja3 .= '<div class="panel panel-default">';
				$paraqitja3 .= '<div class="panel-heading"> <h3 class="panel-title"><i class="fa fa-comment"></i> '.$pytja.'</h3> </div>
					<div class="panel-body">';
				foreach($mendimet as $mendimi){
					$paraqitja3 .= '<div class="col-md-4">';
					$paraqitja3 .= '<div class="well well-sm">'. $mendimi['mendimi'] . '</div>';
					$paraqitja3 .= '</div>';
				}
				$paraqitja3 .= '</div>';
			$paraqitja3 .= '</div>';
			$paraqitja3 .= '<div class="clearfix"></div><br/>';
		}
	$paraqitja3 .= '</div>';
	}
	else{

	}
?>
<?php $paraqitja .= '
<html>
<head>
	<title>Raporti ne PDF</title>
	<link href="../css/pdf.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<style type="text/css">
body{
	background-color:#fff;
	margin:0px;
	padding:0px;
}
</style>

</head>
<body>
<div class="row">
	<div class="row pdf">
		<p class="text-center"><img src="'.'../'.$page->getLogo().'"/></p>
		<p class="text-center pdf-title">'.$page->getTitle().'</p>
		<p class="text-center pdf-prof">'.htmlentities($profesori->getEmri()).' '.htmlentities($profesori->getMbiemri()).' - '.htmlentities($lenda->getEmri()).'</p>
	</div>
	<div class="col-md-12 pdf">
		<table class="table table-bordered">
			<thead><tr><th>Pyetja</th><th>Vler&euml;simi</th></tr><thead><tbody>';
				foreach($votimi as $v){
				$paraqitja.= '<tr><td>'.$v['pyetja'].'</td><td>'.$v['mesatarja'].'</td></tr>';
				array_push($mesatareArray, $v['mesatarja']);
				}
				$mes = array_sum($mesatareArray) / count($mesatareArray);
	$paraqitja.= '<tr><td>Totali</td><td>'.$mes.'</td></tr></tbody>
		</table>
		'.$paraqitja3.'
	<p class="text-left">Data: <strong>'.$data_vleresimit.'</strong></p>
	</div>
</div>
</body>
</html>';
//echo $paraqitja;
$dompdf = new DOMPDF();
$dompdf->load_html($paraqitja);
$dompdf->render();
$temp = $p . ' - ' . $lenda->getEmri();
$dompdf->stream($temp);
?>	

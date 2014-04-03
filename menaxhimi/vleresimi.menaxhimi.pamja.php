<?php
	if(!empty($_GET['viti']) && is_numeric($_GET['viti'])){
		$viti = $_GET['viti'];
	}
	else{
		$viti = date('Y');
	}
	if(!empty($_GET['semestri']) && is_numeric($_GET['semestri'])){
		$semestri = $_GET['semestri'];
	}
	else{
		$semestri = 1;
	}
	if(!empty($_GET['fakulteti']) && is_numeric($_GET['fakulteti'])){
		$fak = $_GET['fakulteti'];
	}
	else{
		$fak = 1;
	}
?>
	
<?php 
$paraqitja = '';
$mesatareArray= array();
if(!empty($_GET['votaID'])){ // per vetem 1 prof
	$id = explode("-", $lidhja->real_escape_string($_GET['votaID'])); // ndajme ID e profit me ate te lendes dhe i ruajme ne nje array
	$profesori = new Profesor($id[0]); // krijojm 1 objekt profesori permes ID
	$lenda = new Lenda($id[1]); // krijojm 1 objekt Lenda permes ID
	$emri_lendes = htmlentities($lenda->getEmri());
	$p = htmlentities($profesori->getEmri()) . ' '.htmlentities($profesori->getMbiemri());

	$votimi = $lidhja->query("SELECT *,AVG(nota) as mesatarja, MIN(nota) as minimalja, MAX(nota) as maksimalja FROM votat WHERE lenda='$emri_lendes' AND profesori='$p' AND fk_id=$fak GROUP BY pyetja ORDER BY id");
	foreach($votimi as $v){
		
		$paraqitja .='<li class="list-group-item"><span class="pyetja-votimit">'.$v['pyetja'].'</span><span class="col-md-1 pull-right"><strong>'.round($v['mesatarja'],3).'</strong></span><span class="col-md-1 pull-right hidden-xs hidden-sm">'.$v['maksimalja'].'</span><span class="col-md-1 pull-right hidden-xs hidden-sm">'.$v['minimalja'].'</span></li>';
		array_push($mesatareArray, $v['mesatarja']);
	}
	$temp = $votimi->fetch_assoc();
	$mes = array_sum($mesatareArray) / count($mesatareArray);

	echo '<a href="'.$_SERVER["HTTP_REFERER"].'" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Kthehu</a>
	<a class="btn btn-md btn-warning printo pull-right" href="nePdf.php?votaID='.$id[0].'-'.$id[1].'&fakulteti='.$fak.'&viti='.$viti.'"><i class="fa fa-print"></i> Printo</a>';

	echo '<div class="page-header vleresimi-header">
		  <h1>'.$p.' <small>'.$emri_lendes.'</small><span class="label label-danger pull-right"><abbr title="Mesatarja">'.$mes.'</abbr></span></h1>
		</div>';
	echo '<div class="col-md-12 text-left"><h5><strong>Pyetjet<span class="col-md-1 pull-right">Mesatarja</span><span class="col-md-1 pull-right hidden-xs hidden-sm"><abbr title="Nota maksimale">Max.</abbr></span><span class="col-md-1 pull-right hidden-xs hidden-sm"><abbr title="Nota minimale">Min.</abbr></span></strong></h5></div>';
	echo '<div class="clearfix"></div>';
	echo '<div class="row">';
	echo '<ul class="list-group vleresimi-pyetjet">';
		echo $paraqitja;
	echo '</ul>';
	echo '</div>';
	if($pyetjet = $lidhja->query("SELECT pyetja FROM vleresim_komente WHERE lenda='$emri_lendes' AND profesori='$p' GROUP BY pyetja ORDER BY id")){ // i marrim pyetjet...
	echo '<div class="clearfix"></div><br/><div class="row mendimet">';
		foreach($pyetjet as $pt){
			$pytja= $pt['pyetja'];
			$mendimet = $lidhja->query("SELECT * FROM vleresim_komente WHERE lenda='$emri_lendes' AND profesori='$p' AND pyetja='$pytja'"); //i marrim te gjitha mendimet per ate pyetje (1 nga 1 te gjitha pyetjet, foreach bree)
			echo '<div class="panel panel-primary">';
				echo '<div class="panel-heading"> <h3 class="panel-title"><i class="fa fa-comment"></i> '.$pytja.'</h3> </div>
					<div class="panel-body">';
				foreach($mendimet as $mendimi){
					echo '<div class="col-md-4">';
					echo '<div class="well">'. $mendimi['mendimi'] . '</div>';
					echo '</div>';
				}
				echo '</div>';
			echo '</div>';
			echo '<div class="clearfix"></div><br/>';
		}
	echo '</div>';
	}
	else{

	}

} // perfundon paraqitja e nje profesori
else{  
// fillon paraqitja e profesoreve
?>
<div class="row">
	<div class="col-md-9">
		<div class="col-md-12">
			<label>Viti</label>
			<ul class="list-inline">
			<?php $vitet = $lidhja->query("SELECT YEAR(data) as viti FROM votat GROUP BY YEAR(data)"); 
				foreach($vitet as $v){
					if($v['viti'] == $viti){
						echo '<li><a class="btn btn-default disabled" href="index.php?faqja=vleresimi&viti='.$v['viti'].'&semestri='.$semestri.'&fakulteti='.$fak.'">'.$v['viti'].'</a></li>';
					}
					else{
						echo '<li><a class="btn btn-default" href="index.php?faqja=vleresimi&viti='.$v['viti'].'&semestri='.$semestri.'&fakulteti='.$fak.'">'.$v['viti'].'</a></li>';
					}
				}
			?>
			</ul>
		</div>
		<div class="col-md-12">
			<label>Semestri</label>
			<ul class="list-inline">
			<?php
				$semestrat = $lidhja->query("SELECT semestri FROM votat GROUP BY semestri");
					foreach ($semestrat as $s) {
						if($s['semestri'] == $semestri){
							echo '<li><a class="btn btn-primary" href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$s['semestri'].'&fakulteti='.$fak.'">Semestri '.$s['semestri'].'</a></li>';
						}
						else{
							echo '<li><a class="btn btn-default" href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$s['semestri'].'&fakulteti='.$fak.'">Semestri '.$s['semestri'].'</a></li>';
						}
					}			
			?>
			</ul>
		</div>
	</div>
	<div class="col-md-3">
		<p><a href="index.php?faqja=pyetjet" class="btn btn-info"><i class="fa fa-pencil"></i> Ndrysho pyetjet</a></p>
		<label>Fakultetet</label>
		<?php
			$fk = getFakultetet(); // marrim fakultetet te gjitha
			echo '<ul class="list-unstyled">';
			foreach($fk as $f){
				if($f['id'] == $fak){
					echo '<li><a class="btn btn-block btn-primary" href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$semestri.'&fakulteti='.$f['id'].'">'.$f['emri'].'</a></li>';
				}
				else{
					echo '<li><a class="btn btn-block btn-default" href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$semestri.'&fakulteti='.$f['id'].'">'.$f['emri'].'</a></li>';
				}
			}
			echo '</ul>';
		?>
	</div>
</div>
<div class="row">
	<div class="vleresimi">
		<?php
			if($votat = getVotat($viti,$semestri,$fak)){
				echo '<div class="list-group votat">';
				foreach($votat as $v){
					$emri_profesorit = explode(" ", $v['profesori']);
					$emri_p = htmlentities($emri_profesorit[0]);
					$mbiemri_p = htmlentities($emri_profesorit[1]);
					$idProfit = $lidhja->query("SELECT id FROM profesoret WHERE emri='$emri_profesorit[0]' AND mbiemri='$emri_profesorit[1]'");
					$idProfit = $idProfit->fetch_assoc();
					$idLendes = $lidhja->query("SELECT id FROM lendet WHERE emri='$v[lenda]'");
					$idLendes = $idLendes->fetch_assoc();
					echo '<a href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$semestri.'&votaID='.$idProfit['id'].'-'.$idLendes['id'].'" class="list-group-item">
					<span class="col-md-3"><strong>'.$v['profesori'].'</strong></span>
					<span class="col-md-6">'.$v['lenda'].'</span>
					<span><span class="label label-primary"><abbr title="Mesatarja">'.round($v['mesatarja'],2).'</abbr></span></a>';
				}
				echo "</div>";
			}
			else{
				echo '<p class="bg-danger">Nuk ka vota</p>';
			}
		?>
	</div>
</div>
<?php
} // perfundon else
?>
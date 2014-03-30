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
		$semestri = 4;
	}
?>
	
<?php 
if(!empty($_GET['votaID'])){ // per vetem 1 prof
	$id = explode("-", $lidhja->real_escape_string($_GET['votaID'])); // ndajme ID e profit me ate te lendes dhe i ruajme ne nje array
	$profesori = new Profesor($id[0]); // krijojm 1 objekt profesori permes ID
	$lenda = new Lenda($id[1]); // krijojm 1 objekt Lenda permes ID
	$emri_lendes = $lenda->getEmri();
	$p = $profesori->getEmri() . ' '.$profesori->getMbiemri();
	$votimi = $lidhja->query("SELECT *,AVG(nota) as mesatarja, MIN(nota) as minimalja, MAX(nota) as maksimalja FROM votat WHERE lenda='$emri_lendes' AND profesori='$p' GROUP BY pyetja ORDER BY id");
	foreach($votimi as $v){
		echo 'Pyejta' . $v['pyetja'] . '<br/>';
		echo 'Maksimale: ' . $v['maksimalja']. '<br/>';
		echo 'Minimalja: ' . $v['minimalja'] . '<br/>';
		echo 'Mesatarja: ' . $v['mesatarja'] . '<br/>';
	}

} // perfundon paraqitja e nje profesori
else{  
// fillon paraqitja e profesoreve
?>
<div class="row">
	<div class="col-md-12">
		<label>Viti</label>
		<ul class="list-inline">
		<?php $vitet = $lidhja->query("SELECT YEAR(data) as viti FROM votat GROUP BY YEAR(data)"); 
			foreach($vitet as $v){
				if($v['viti'] == $viti){
					echo '<li><a class="btn btn-primary" href="index.php?faqja=vleresimi&viti='.$v['viti'].'&semestri='.$semestri.'">'.$v['viti'].'</a></li>';
				}
				else{
					echo '<li><a class="btn btn-default" href="index.php?faqja=vleresimi&viti='.$v['viti'].'&semestri='.$semestri.'">'.$v['viti'].'</a></li>';
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
						echo '<li><a class="btn btn-primary" href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$s['semestri'].'">Semestri '.$s['semestri'].'</a></li>';
					}
					else{
						echo '<li><a class="btn btn-default" href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$s['semestri'].'">Semestri '.$s['semestri'].'</a></li>';
					}
				}			
		?>
		</ul>
	</div>
</div>
<div class="row">
	<div class="vleresimi">
		<?php
			if($votat = getVotat($viti,$semestri)){
				echo '<div class="list-group votat">';
				foreach($votat as $v){
					$emri_profesorit = explode(" ", $v['profesori']);
					$idProfit = $lidhja->query("SELECT id FROM profesoret WHERE emri='$emri_profesorit[0]' AND mbiemri='$emri_profesorit[1]'");
					$idProfit = $idProfit->fetch_assoc();
					$idLendes = $lidhja->query("SELECT id FROM lendet WHERE emri='$v[lenda]'");
					$idLendes = $idLendes->fetch_assoc();
					echo '<a href="index.php?faqja=vleresimi&viti='.$viti.'&semestri='.$semestri.'&votaID='.$idProfit['id'].'-'.$idLendes['id'].'" class="list-group-item">
					<span class="col-md-3"><strong>'.$v['profesori'].'</strong></span>
					<span class="col-md-6">'.$v['lenda'].'</span>
					<span><span class="label label-primary">'.round($v['mesatarja'],2).'</span></a>';
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
<?php

include('includes/config.php');


$pyetjet = getPyetjet();
$studenti = new Studenti($_SESSION['s_id']);
$lendet = getLendetMeSemester($studenti->getSemestri(), $studenti->getDrejtimi());


if(!empty($_POST)){
	$i=0;
	foreach($lendet as $l){
		$lenda = new Lenda($l['id']);
		echo utf8_decode($lenda->getEmri()) . ' - ' .$_POST['emri_prof'][$i]. ' :<br/> ' ;
		foreach($pyetjet as $pyetje){
			print_r($_POST['nota'.$pyetje['id'].''.$i][0]);
			echo '<br/>';
		}
		echo '<br/>';
		$i++;
	}
	

}

?>
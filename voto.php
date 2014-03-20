<?php

include('includes/config.php');


$pyetjet = getPyetjet();
$studenti = new Studenti($_SESSION['s_id']);
$lendet = getLendetMeSemester($studenti->getSemestri(), $studenti->getDrejtimi());


if(!empty($_POST)){
	$i=0;
	foreach($lendet as $l){
		$lenda = new Lenda($l['id']);
		$j=0;
		foreach($pyetjet as $pyetje){
			echo utf8_decode($lenda->getEmri()) . ' - ' .$_POST['emri_prof'][$i]. ' : ' ;
			echo htmlentities($_POST['pyetja'][$j])	. ' ' ;
			echo ($_POST['nota'.$pyetje['id'].''.$i][0]);
			echo '<br/>';
			$j++;
		}
		echo '<br/>';
		$i++;
	}
	

}

?>
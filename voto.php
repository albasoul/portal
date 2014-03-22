<?php

include('includes/config.php');


$pyetjet = getPyetjet();
$studenti = new Studenti($_SESSION['s_id']);
$lendet = getLendetMeSemester($studenti->getSemestri(), $studenti->getDrejtimi());
	// Krijimi array, qe i permban te gjitha notat,rend, njera pas tjetres :p
		$pyetja = array();
		$lendetArray = array(); 
		$profesori = array();
		$nota = array();
		$data = array();
		$semestri = array();
		
if(!empty($_POST)){
	$i=0;
	$arrayTemp=0;
	foreach($lendet as $l){ // kjo vetem tregon sa lende jon n'at semeter te atij studenti, qaq'her perseritet forloop
		$lenda = new Lenda($l['id']);  //e krijom 1 lende objekt
		$prof = new Profesor($lenda->getProfID());
		$j=0;
		foreach($pyetjet as $pyetje){
			// ktu veq i kom kriju disa variabla t'perkohshme(temporary) 
				#$pyetja_temp = $_POST['pyetja'][$j]; // pyetja momentale, e pare, e dyte, etj.. 
			$pyetja_temp = $pyetje['pyetja'];
			$emri_lendes = utf8_decode($lenda->getEmri()); // emri per cilen lende po votohet
				#$emri_prof = $_POST['emri_prof'][$i]; // emri i profit
			$emri_prof = $prof->getEmri() . ' ' .$prof->getMbiemri();
			$nota_studentit = $_POST['nota'.$pyetje['id'].''.$i][0]; //nota sa i eshte dhene
			$data_pergjigjes = date('Y-m-d'); // data momentale e regjistrimit te notes
			$semestri_lendes = $lenda->getSemestri(); // semestrin e lendes

			// kontrollojm a jane shkruar ashtu si duhet vlerat, nese jo e kthejm nfaqe kryesore
			if(!kontrolloNoten($pyetja_temp, $emri_lendes, $emri_prof, $nota_studentit, $data_pergjigjes,$semestri_lendes)){
				header('Location: index.php?faqja=voto&gabim=1');
				die();
			}
			else{ // nese nota kontrollohet, dhe gjithqka ne rregull, ate e ruajme ne variablat array qe i kom kriju ma nalt
				// perdoret $j, sepse per secilen pytjet, rritet $j, dmth sa pytje i kem, qaq nota jon :p
				// nese i kem 10 pytje, per 3 profesora, =30 nota total nga 0 deri ne 29 behet $j. (qaq vlera ne array ruhen)
				$pyetja[$arrayTemp] = $pyetja_temp;
				$lendetArray[$arrayTemp] = $emri_lendes;
				$profesori[$arrayTemp] = $emri_prof;
				$nota[$arrayTemp] = $nota_studentit;
				$data[$arrayTemp] = $data_pergjigjes;
				$semestri[$arrayTemp] = $semestri_lendes;
			}
			$j++;
			$arrayTemp++;
		}
		$i++;
	}
	$shuma = count($nota); // veq i numrojm sa nota jon regjistru ne array;
	for($k=0; $k<$shuma; $k++){ // per krejt notat, regjistrojm nDatabas te dhenat
		regjistroVoten($pyetja[$k],$lendetArray[$k], $profesori[$k], $nota[$k], $data[$k], $semestri[$k]);
	}
	header('Location: index.php?faqja=voto&gabim=0');
	die();
}
	/*
		Funksioni qe kontrollon te gjitha votat para se mu regjistru ato nota ne server!
	*/
	function kontrolloNoten($pyetja, $lenda, $profesori, $nota, $data, $semestri){
		if(!is_numeric($nota)){
			return false;
		}
		else{
			if($nota < 0){
				$nota = 1;
			}
			elseif($nota>5){
				$nota = 5;
			}
		}
		return true;
	}
	/*
		Funksioni qe regjistron voten e nje studenti
		Parametrat qe i merr: emri_lendes, emri_mbiemri_profesorit, noten, daten, semestrin(e lendes)
		perdoret htmlentities sepse shkronjat ë,ç,etj. me i kthy si &euml, &ccedil,etj. (gjithashtu dhe hapesirat &amp;)
		ent_quotes, osht edhe per thonjza
		UTF-8 osht formati i shkronjave
		ENT_IGNORE eshte mos mi pranu disa shkronja si: \x8F ,etj... (sa per siguri :p )
	*/
	function regjistroVoten($pyetja,$lenda, $profesori, $nota, $data, $semestri){
		global $lidhja;
		$query = "INSERT INTO votat VALUES('','$pyetja','$lenda','$profesori',$nota,'$data',$semestri)";
		$lidhja->query($query); // regjistron ....
	}

?>
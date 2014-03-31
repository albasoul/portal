<?php

	#
	# Funksionet themelore per manipulim me te dhena
	# Te gjitha funksionet duhet te kene nje informacion se qfare bejne
	# ne kete lloj formati
	#

	#
	# kontrollon nese dokumenti 'funksionet.php' ka qasje ne menyre direkte
	# nese ka qasje ne menyre direkte dergoje tek faqja =index.php=
	#
	$a=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	 if($a === "funksionet.php"){
		header('Location: ../index.php');
		die();
	}

	/*
	*	Verifikimi i studentit per kyqje
	*	Kontrollon Email dhe Fjalekalimin
	*/
	function verifikojeStudentin($e, $p){
		global $lidhja;
		$studentQuery = $lidhja->query("SELECT SID FROM studentet WHERE email='$e' AND password='$p' LIMIT 1");
		if($studentQuery->num_rows == 1)
		{
			$sinfo = $studentQuery->fetch_assoc(); // Informacionet e studentit
			$_SESSION['s_id'] = $sinfo['SID'];
			$_SESSION['logged_in'] = TRUE;
			return TRUE;
		}
	}
	/*
	*	Verifikimi i menaxhuesit per kyqje
	*	Kontrollon username apo email dhe Fjalekalimin
	*/
	function verifikojePerdoruesin($e,$p){
		global $lidhja;
		$perdorues = $lidhja->query("SELECT id FROM perdoruesit WHERE (username='$e' AND password='$p') OR (email='$e' AND password='$p')") or die('Kontrolloni databasen e perdoruesve!');
		if($perdorues->num_rows == 1){
			$perdorues = $perdorues->fetch_assoc();
			$_SESSION['p_id'] = $perdorues['id'];
			$_SESSION['perdorues'] = TRUE;
			return TRUE;
		}
	}
	/*
	* Funksioni qe kthen te gjitha lendet (si array) me semestrin e caktuar, kthen vetem ID e lendeve
	*/
	function getLendetMeSemester($semestri,$s_did){
		global $lidhja;
		$lendetQuery = $lidhja->query("SELECT id FROM lendet WHERE semestri=$semestri AND drejtimi=$s_did");
		return $lendetQuery;
	}

	/*
	* Funksioni qe e rregullon paraqitjen e dates
	*/
	function rregulloDaten($d){
		$viti = date("Y", strtotime($d));
		$muaji = date("m", strtotime($d));
		$dita = date("d", strtotime($d));
		if($muaji == 1){
			$data = $dita . " Janar " . $viti;
		}
		elseif($muaji == 2){
			$data = $dita . " Shkurt " . $viti;
		}
		elseif($muaji == 3){
			$data = $dita . " Mars " . $viti;
		}
		elseif($muaji == 4){
			$data = $dita . " Prill " . $viti;
		}
		elseif($muaji == 5){
			$data = $dita . " Maj " . $viti;
		}
		elseif($muaji == 6){
			$data = $dita . " Qershor " . $viti;
		}
		elseif($muaji == 7){
			$data = $dita . " Korrik " . $viti;
		}
		elseif($muaji == 8){
			$data = $dita . " Gusht " . $viti;
		}
		elseif($muaji == 9){
			$data = $dita . " Shtator " . $viti;
		}
		elseif($muaji == 10){
			$data = $dita . " Tetor " . $viti;
		}
		elseif($muaji == 11){
			$data = $dita . " N&euml;ntor " . $viti;
		}
		elseif($muaji == 12){
			$data = $dita . " Dhjetor " . $viti;
		}
		return $data;
	}
	function paraqitArkiven($viti){
		global $lidhja;
		$muajt = $lidhja->query("SELECT MONTH(data) as muaji FROM lajmet WHERE YEAR(data)=$viti GROUP BY MONTH(data) ORDER BY MONTH(data) ASC");
			foreach($muajt as $muaji){
				$m = $muaji['muaji'];
				if($m == 1){
					$temp = "Janar";
				}
				elseif($m == 2){
					$temp = "Shkurt";
				}
				elseif($m == 3){
					$temp = "Mars";
				}
				elseif($m == 4){
					$temp =" Prill";
				}
				elseif($m == 5){
					$temp = "Maj" ;
				}
				elseif($m == 6){
					$temp ="Qershor";
				}
				elseif($m == 7){
					$temp = "Korrik";
				}
				elseif($m == 8){
					$temp = "Gusht";
				}
				elseif($m == 9){
					$temp = "Shtator";
				}
				elseif($m == 10){
					$temp ="Tetor";
				}
				elseif($m == 11){
					$temp = "N&euml;ntor";
				}
				elseif($m == 12){
					$temp ="Dhjetor";
				}
			echo '<li><a class="btn btn-link" href="index.php?faqja=lajmet&viti='.$viti.'&muaji='.$m.'">'.$temp.'</a></li>';
			}
	}
	function paraqitVitetEArkives(){
		global $lidhja;
		$vitet = $lidhja->query("SELECT YEAR(data) as viti FROM lajmet GROUP BY YEAR(data) ORDER BY YEAR(data) DESC");
		if($vitet->num_rows){
			foreach($vitet as $viti){
				echo '<li><a class="btn btn-link" href="index.php?faqja=lajmet&viti='.$viti['viti'].'">'.$viti['viti'].'</a></li>';
			}
		}
		else{
			echo '<li class="text-danger"> Nuk ka lajme! </li>';
		}
	}
	/*
		Funksioni qe i merr te gjitha pyetjet nga databasa
		Nese nuk ka pyetje kthen False
	*/
	function getPyetjet(){
		global $lidhja;
		$pyetjet = $lidhja->query("SELECT * FROM pyetjet") or die("Kontrolloni databasen e pyetjeve.");
		if($pyetjet->num_rows){
			return $pyetjet;
		}
		else{
			return FALSE;
		}
	}
	/*
		Funksioni qe i merr te gjitha fakultetet nga databasa
	*/
	function getFakultetet(){
		global $lidhja;
		$fakultetet = $lidhja->query("SELECT * FROM fakulteti ORDER BY id");
		if($fakultetet->num_rows){
			return $fakultetet;
		}
		else{
			return FALSE;
		}
	}
	/*
		Funksioni qe i merr te gjitha drejtimet nga databasa
	*/
	function getDrejtimet($fk_id=0){
		global $lidhja;
		if($fk_id == 0){
			$drejtimet = $lidhja->query("SELECT * FROM drejtimet ORDER BY f_id");
		}
		else{
			$drejtimet = $lidhja->query("SELECT * FROM drejtimet WHERE f_id=$fk_id ORDER by emri");
		}
		if($drejtimet->num_rows){
			return $drejtimet;
		}
		else{
			return FALSE;
		}
	}
	/*
		Funksioni qe i merr te gjithe perdoruesit
	*/
	function getPerdoruesit(){
		global $lidhja;
		$perdoruesit = $lidhja->query("SELECT id,emri,mbiemri,niveli FROM perdoruesit");
		if($perdoruesit->num_rows){
			return $perdoruesit;
		}
		else{
			return FALSE;
		}
	}
	function getVotat($viti, $semestri, $fakulteti){
		global $lidhja;
		if($votat = $lidhja->query("SELECT *, AVG(nota) as mesatarja FROM votat WHERE YEAR(data)=$viti AND semestri=$semestri AND fk_id=$fakulteti GROUP BY lenda")){
			if($votat->num_rows){
				return $votat;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
?>
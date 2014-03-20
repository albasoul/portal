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
	* Funksioni qe kthen te gjitha lendet (si array) me semestrin e caktuar, kthen vetem ID e lendeve
	*/
	function getLendetMeSemester($semestri){
		global $lidhja;
		$lendetQuery = $lidhja->query("SELECT id FROM lendet WHERE semestri=$semestri");
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
	function rregulloLajmin($lajmi){
		$lajmi2 = "";
		$ndare = explode("\n", $lajmi);
		foreach($ndare as $n){
			echo '<p>'.$n.'</p>';
		}
	}
	function paraqitArkiven($viti){
		global $lidhja;
		$muajt = $lidhja->query("SELECT MONTH(data) as muaji FROM lajmet WHERE YEAR(data)=$viti GROUP BY MONTH(data) ORDER BY MONTH(data) ASC");
		if($muajt->num_rows){
			$muaj = $muajt->fetch_assoc();
			if($muaj['muaji'] == 1){
				$temp = "Janar";
			}
			elseif($muaj['muaji'] == 2){
				$temp = "Shkurt";
			}
			elseif($muaj['muaji'] == 3){
				$temp = "Mars";
			}
			elseif($muaj['muaji'] == 4){
				$temp =" Prill";
			}
			elseif($muaj['muaji'] == 5){
				$temp = "Maj" ;
			}
			elseif($muaj['muaji'] == 6){
				$temp ="Qershor";
			}
			elseif($muaj['muaji'] == 7){
				$temp = "Korrik";
			}
			elseif($muaj['muaji'] == 8){
				$temp = "Gusht";
			}
			elseif($muaj['muaji'] == 9){
				$temp = "Shtator";
			}
			elseif($muaj['muaji'] == 10){
				$temp ="Tetor";
			}
			elseif($muaj['muaji'] == 11){
				$temp = "N&euml;ntor";
			}
			elseif($muaj['muaji'] == 12){
				$temp ="Dhjetor";
			}
		}
		foreach($muajt as $muaji){
			$m = $muaji['muaji'];
			echo '<li><a class="btn btn-link" href="index.php?faqja=lajmet&viti='.$viti.'&muaji='.$m.'">'.$temp.'</a></li>';
		}
	}
?>
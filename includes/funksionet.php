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
	/*
		Funksioni qe kthen votat sipas vitit, semestrit dhe fakultetit te caktuar
	*/
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
	/*
		Funksioni qe kontrollon a ka votuar studenti njeher ne ate semester
	*/
	function aKaVotuar($SID){
		global $lidhja;
		$votuar = $lidhja->query("SELECT SID FROM studentet WHERE nr_votimit=semestri AND SID=$SID");
		if($votuar->num_rows > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
		Funksioni qe kontrollon a ka afate te aktivizuara
	*/
	function afatAktiv(){
		global $lidhja;
		$temp = $lidhja->query("SELECT * FROM afatet WHERE active=1");
		if($temp->num_rows){
			$temp = $temp->fetch_assoc();
			return $temp;
		}
		else{
			return FALSE;
		}
	}
	/*
		Funksioni qe paraqet statusin e lendeve
	*/
	function paraqitStatusinLendeve($studenti){
		global $lidhja;
		if(($studenti->getSemestri()%2) == 1){
			if($lendet = getLendetMeSemester($studenti->getSemestri(), $studenti->getDrejtimi())){
				echo '<h1 class="text-center text-primary">Semestri '.$studenti->getSemestri().'</h1>';
				echo '<table class="table">';
				echo '<thead><tr><th>Lenda</th><th>Kredi</th><th>Nota</th></tr></thead>';
				echo '<tbody>';
				foreach($lendet as $l){
					$lenda = new Lenda($l['id']);
					if($nota = $studenti->getLendaKaluara($lenda->getID())) {
						echo '<tr class="success"><td><strong>'.$lenda->getEmri().'</strong></td><td>'.$lenda->getKredi().'</td><td><abbr title="'.$nota['data'].'"><strong>'.$nota['nota'].'</strong></abbr></td></tr>';
					}
					else{
						if(aEshteParaqiturLenda($lenda->getID(),$studenti)){
							echo '<tr class="info"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td></td></tr>';
						}
						else{
							echo '<tr class="active"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td></td></tr>';
						}	
					}
					
				}
				echo '<tbody>';
				echo '</table>';
			}
			else{
				echo 'Nuk ka lende';
			}
		}
		else{
			for($i=$studenti->getSemestri(); $i>=($studenti->getSemestri()-1); $i--){
				if($lendet = getLendetMeSemester($i, $studenti->getDrejtimi())){
					echo '<h2 class="text-center text-primary"><small>L&euml;nd&euml;t e semestrit <strong class="text-primary">'.$i.'</strong></small> </h2>';
					echo '<table class="table">';
					echo '<thead><tr><th>Lenda</th><th>Kredi</th><th>Nota</th></tr></thead>';
					echo '<tbody>';
					foreach($lendet as $l){
						$lenda = new Lenda($l['id']);
						if($nota = $studenti->getLendaKaluara($lenda->getID())) {
							echo '<tr class="success"><td><strong>'.$lenda->getEmri().'</strong></td><td>'.$lenda->getKredi().'</td><td><abbr title="'.$nota['data'].'"><strong>'.$nota['nota'].'</strong></abbr></td></tr>';
						}
						else{
							if(aEshteParaqiturLenda($lenda->getID(),$studenti)){
								echo '<tr class="info"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td></td></tr>';
							}
							else{
								echo '<tr class="active"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td></td></tr>';
							}	
						}
						
					}
					echo '<tbody>';
					echo '</table>';
				}
				else{
					echo 'Nuk ka lende';
				}
			}
		}
		
	}
	/*
		Funksioni qe ben pergatitjen e lendeve qe jane te mundshme per paraqitje
	*/
	function paraqitjaProvimeve($studenti){
		global $lidhja;
		$viti_studentit = $studenti->getViti();
		$drejtimi_studentit = $studenti->getDrejtimi();
		$semestri_studentit = $studenti->getSemestri();

		if($viti_studentit == 1){
			$lendet = $lidhja->query("SELECT * FROM lendet WHERE (semestri=1 OR semestri=2) AND drejtimi=$drejtimi_studentit");
		}
		elseif ($viti_studentit == 2) {
			$lendet = $lidhja->query("SELECT * FROM lendet WHERE (semestri=3 OR semestri=4) AND drejtimi=$drejtimi_studentit");
		}
		elseif ($viti_studentit == 3){
			$lendet = $lidhja->query("SELECT * FROM lendet WHERE (semestri=5 OR semestri=6) AND drejtimi=$drejtimi_studentit");
		}
		else{
			$lendet = $lidhja->query("SELECT * FROM lendet WHERE (semestri=7 OR semestri=8) AND drejtimi=$drejtimi_studentit");
		}

		if($lendet->num_rows){
			if(kaEleminuarVitin($viti_studentit,$studenti)) { // Nese ka marre nota ne te gjitha lendet e viteve te kaluara at'her mund ti paraqese provimet e atij viti (nese eshte ne semester te dyte ka te drejte paraqitje per dy semestrat)
				if($studenti->getSemestri()%2 == 1){
					$lendet = $lidhja->query("SELECT id FROM lendet WHERE drejtimi=$drejtimi_studentit AND semestri = $semestri_studentit");
				}
				else{
					$lendet = $lidhja->query("SELECT id FROM lendet WHERE drejtimi=$drejtimi_studentit AND (semestri=$semestri_studentit OR semestri=$semestri_studentit-1)");
				}
				if($lendet->num_rows){
					echo '<table class="table">';
					echo '<thead><tr><th>L&euml;nda</th><th>Kredi</th><th></th></tr></thead>';
					echo '<tbody>';
					foreach($lendet as $l){
						$lenda = new Lenda($l['id']); //krijojm nje objekt Lenda
						if($studenti->getLendaKaluara($l['id'])){
							#mos e paraqit lenden qe e ka te kaluar
						}
						elseif(aEshteParaqiturLenda($lenda->getID(),$studenti)){
							#mos e paraqit lenden qe eshte e paraqitur tashme -4-
						}
						else{
							echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td> <a data-toggle="modal" data-target="#paraqit-'.$lenda->getID().'" class="btn btn-primary btn-xs"> <i class="fa fa-check"></i> Paraqit</a></td></tr>';
							echo '
							<div class="modal fade" id="paraqit-'.$lenda->getID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-sm">
							    <div class="modal-content">
							    <form role="form" action="paraqitja.php" method="POST">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        <h4 class="modal-title" id="myModalLabel">Paraqit l&euml;nd&euml;n</h4>
							      </div>
							      <div class="modal-body text-center">
							      <input type="hidden" value="'.$lenda->getID().'" name="LID"/>';
							        echo '<p><abbr title="L&euml;nda"><i class="fa fa-file-text-o"></i></abbr> '.$lenda->getEmri().'</p>';
							        echo '<p>';
							        if(count($lenda->getProfID())>1){
							        	echo '<div class="col-md-12 text-left"><em><small>Zgjedhni profesorin</small></em>
							        	<select class="form-control" name="profesori">';
							        		echo '<option value="0"></option>'; #vlera default=0 qe studenti te mos gaboje me fillim
							        		foreach($lenda->getProfID() as $key => $id){
							        			$prof = new Profesor($id);
							        			echo '<option value="'.$id.'">'.$prof->getEmri().' '.$prof->getMbiemri().'</option>';
							        		}
							        	echo '</select></div>';
							        }
							        else{
							        	$temp = $lenda->getProfID();
							        	$prof = new Profesor($temp[0]);
							        	echo '<abbr title="Profesori"><i class="fa fa-user"></i></abbr> <strong> '.$prof->getEmri().' '.$prof->getMbiemri().'</strong>';
							        	echo '<input type="hidden" value="'.$prof->getID().'" name="profesori"/>';
							        }
							        echo '</p>';
							        echo '<p><abbr title="Kredi"><i class="fa fa-star-o"></i></abbr> '.$lenda->getKredi().'</p>';
							echo'</div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
							        <button type="submit" class="btn btn-success">Paraqite</button>
							      </div>
							    </form>
							    </div>
							  </div>
							</div>';
						}
					}
					echo '</tbody>';
					echo '</table>';
				}
				else{
					echo '<p class="text-center bg-primary">Nuk ka l&euml;nd&euml;.</p>';
				}
			}
			else{ //Nese nuk ka eleminuar vitin at'her paraqitja lendet e viteve te kaluara
				$s = semestriNgaViti($viti_studentit-1);
				$lendet = $lidhja->query("SELECT id FROM lendet WHERE drejtimi=$drejtimi_studentit AND (semestri<$s OR semestri=$s)");
				echo '<em class="text-primary"> Nuk keni eleminuar vitin '.($viti_studentit-1).', mund ti paraqitni vet&euml;m provimet e vitit t&euml; '.($viti_studentit-1).'</em>';
				echo '<table class="table">';
				echo '<thead><tr><th>Lenda</th><th>Kredi</th><th></th></tr></thead>';
				echo '<tbody>';
				foreach($lendet as $l){
					$lenda = new Lenda($l['id']);
					if($studenti->getLendaKaluara($l['id'])){
					}
					else{
						echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td><a href="" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Paraqit</a></td></tr>';
					}
				}
				echo '</tbody>';
				echo '</table>';
			}
		}
		else{
			echo '<p class="bg-primary text-center"> Nuk ka lende per paraqitje </p>';
		}
	}
	/*
		Funksioni qe kontrollon vitet paraprake te studentit, kontrollon lendet a jane te notuara te gjitha
	*/
	function kaEleminuarVitin($viti,$studenti){
		global $lidhja;
		$semestri_kaluar = semestriNgaViti($viti-1);
		$drejtimi = $studenti->getDrejtimi();
		$lendet = $lidhja->query("SELECT * FROM lendet WHERE (semestri=$semestri_kaluar OR semestri<$semestri_kaluar) AND drejtimi=$drejtimi");
		if($lendet->num_rows){
			$temp = TRUE;
			foreach($lendet as $l){
				if($info = $studenti->getLendaKaluara($l['id'])){
				}
				else{
					$temp = FALSE;
				}
			}
			return $temp;
		}
		else{
			return FALSE;
		}
		return TRUE;
	}
	/*
		Funksion qe kthen vitin sipas semestrit te dhene
	*/
	function vitiNgaSemestri($semestri){
		if($semestri == 1 OR $semestri==2){
			$viti = 1;
		}
		elseif($semestri == 3 OR $semestri ==4){
			$viti = 2;
		}
		elseif($semestri == 5 OR $semestri == 6){
			$viti = 3;
		}
		else{
			$viti = 4;
		}
		return $viti;
	}
	/*
		Funksioni qe kthen semestrin e dyt nga ai vit
	*/
	function semestriNgaViti($viti){
		if($viti == 1){
			$semestri =2;
		}
		elseif ($viti == 2) {
			$semestri =4;
		}
		elseif($viti == 3){
			$semestri = 6;
		}
		else{
			$semestri = 8;
		}
		return $semestri;
	}
	/*
		Funksion qe kontrollon a eshte paraqitur nje lende
	*/
	function aEshteParaqiturLenda($LID,$studenti){
		global $lidhja;
		$sid = $studenti->getSID();
		$temp = $lidhja->query("SELECT id FROM paraqitjet WHERE LID=$LID AND SID=$sid");
		if($temp->num_rows){
			return TRUE;
		}
		else{
			return FALSE;
		}
		return FALSE;
	}
	/*
		Funksioni qe kontrollon a i ka paraqitur studenti te gjitha lendet
	*/
	function paraqitjaPerfundoi($studenti){
		global $lidhja;
		$SID = $studenti->getSID();
		$drejtimi_studentit = $studenti->getDrejtimi();
		$semestri_studentit = $studenti->getSemestri();
		$viti = $studenti->getViti();
		if(kaEleminuarVitin($viti,$studenti)){
			if($studenti->getSemestri()%2 == 1){
				$lendet = $lidhja->query("SELECT id FROM lendet WHERE drejtimi=$drejtimi_studentit AND semestri = $semestri_studentit");
			}
			else{
				$lendet = $lidhja->query("SELECT id FROM lendet WHERE drejtimi=$drejtimi_studentit AND (semestri=$semestri_studentit OR semestri=$semestri_studentit-1)");
			}
		}
		else{
			$s = semestriNgaViti($viti_studentit-1);
			$lendet = $lidhja->query("SELECT id FROM lendet WHERE drejtimi=$drejtimi_studentit AND (semestri<$s OR semestri=$s)");
		}
		$perfundimi = TRUE;
		if($afati = afatAktiv()){
			if($afati['lloji'] == 0){
				foreach($lendet AS $l){
					$LID = $l['id'];
					$tempQuery = $lidhja->query("SELECT id FROM paraqitjet WHERE SID=$SID AND LID=$LID LIMIT 1");
					if($tempQuery->num_rows == 0){
						$perfundimi = TRUE;
					}
					else{

					}
				}
			}
			else{
				$lendetParaqitura = 0;
				foreach($lendet AS $l){
					$LID = $l['id'];
					$tempQuery = $lidhja->query("SELECT id FROM paraqitjet WHERE SID=$SID AND LID=$LID LIMIT 1");
					if($tempQuery->num_rows == 1){
						$lendetParaqitura++;
					}
					else{

					}
				}
				if($lendetParaqitura < 2){
					$perfundimi = FALSE;
				}
				else{
					$perfundimi = TRUE;
				}
			}
			return $perfundimi;
		}
	}
?>
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
							echo '<tr class="success"><td><strong>'.$lenda->getEmri().'</strong></td><td>'.$lenda->getKredi().'</td><td><abbr title="'.rregulloDaten($nota['data']).'"><strong>'.$nota['nota'].'</strong></abbr></td></tr>';
					}
					else{
						if($paraqitja = aEshteParaqiturLenda($lenda->getID(),$studenti)){
							$nota = notaParaqitjes($lenda->getID(),$studenti);
								$id_paraqitjes = $paraqitja['id'];
								$profesori = new Profesor($paraqitja['PID']);
								$nota = $paraqitja['nota'];
								if($nota == 0){ // nese profesori nuk e ka vendosur ende noten
									echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td><span class="bg-primary" style="padding:8px;"><i class="fa fa-info"></i> Paraqitur</span></td></tr>';
								}
								elseif($nota == 1){
									echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td><span style="padding:8px; background-color:#d43f3a; color:#fff;"><i class="fa fa-info"></i> Refuzim</span></td></tr>';
								}
								elseif ($nota == 5) { // nese profesori ja ka vendosur noten 5, at'her studenti bie automatikisht
									echo '<tr class="danger"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td>5</td></tr>';
								}
								else{ // nese profesori e ka vendosur noten, studenti duhet ta pranoje apo refuzoje
									echo '<tr class="info"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td>'.$nota.' <a data-toggle="modal" data-target="#paraqitje-'.$id_paraqitjes.'" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></a> <a data-toggle="modal" data-target="#refuzim-'.$id_paraqitjes.'" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i></a></td></tr>';
								// MODALI PER PRANIM NOTE
									echo'
									<!-- Modal -->
									<div class="modal fade" id="paraqitje-'.$id_paraqitjes.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-sm">
									  <form action="paraqitja.php?pranoNot='.$id_paraqitjes.'" method="POST" role="form">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									        <h4 class="modal-title" id="myModalLabel">Prano not&euml;n</h4>
									      </div>
									      <div class="modal-body">
									        <h3><small><abbr title="L&euml;nda"><i class="fa fa-book"></i></abbr> </small> '.$lenda->getEmri().'</h3>
									        <h3><small><abbr title="Profesori"><i class="fa fa-user"></i></abbr> </small> '.$profesori->getEmri().' '.$profesori->getMbiemri().'</h3>
									        <h3><small><abbr title="Nota"><i class="fa fa-certificate"></i></abbr> </small> '.$nota.'</h3>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
									        <button type="submit" class="btn btn-success">Prano</button>
									      </div>
									    </div>
									   </form>
									  </div>
									</div>';
									// MODALI PER REFUZIM NOTE
									echo'
									<!-- Modal -->
									<div class="modal fade" id="refuzim-'.$id_paraqitjes.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-sm">
									  <form action="paraqitja.php?refuzoNot='.$id_paraqitjes.'" method="POST" role="form">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									        <h4 class="modal-title" id="myModalLabel">Prano not&euml;n</h4>
									      </div>
									      <div class="modal-body">
									        <h3><small><abbr title="L&euml;nda"><i class="fa fa-book"></i></abbr> </small> '.$lenda->getEmri().'</h3>
									        <h3><small><abbr title="Profesori"><i class="fa fa-user"></i></abbr> </small> '.$profesori->getEmri().' '.$profesori->getMbiemri().'</h3>
									        <h3><small><abbr title="Nota"><i class="fa fa-certificate"></i></abbr> </small> '.$nota.'</h3>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
									        <button type="submit" class="btn btn-danger">Refuzo</button>
									      </div>
									    </div>
									   </form>
									  </div>
									</div>';
								}
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
							echo '<tr class="success"><td><strong>'.$lenda->getEmri().'</strong></td><td>'.$lenda->getKredi().'</td><td><abbr title="'.rregulloDaten($nota['data']).'"><strong>'.$nota['nota'].'</strong></abbr></td></tr>';
						}
						else{
							if($paraqitja = aEshteParaqiturLenda($lenda->getID(),$studenti)){
								$id_paraqitjes = $paraqitja['id'];
								$profesori = new Profesor($paraqitja['PID']);
								$nota = $paraqitja['nota'];
								if($nota == 0){ // nese profesori nuk e ka vendosur ende noten
									echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td><span class="bg-primary" style="padding:8px;"><i class="fa fa-info"></i> Paraqitur</span></td></tr>';
								}
								elseif($nota == 1){
									echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td><span style="padding:8px; background-color:#d43f3a; color:#fff;"><i class="fa fa-info"></i> Refuzim</span></td></tr>';
								}
								elseif ($nota == 5) { // nese profesori ja ka vendosur noten 5, at'her studenti bie automatikisht
									echo '<tr class="danger"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td>5</td></tr>';
								}
								else{ // nese profesori e ka vendosur noten, studenti duhet ta pranoje apo refuzoje
									echo '<tr class="info"><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td>'.$nota.' <a data-toggle="modal" data-target="#paraqitje-'.$id_paraqitjes.'" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></a> <a data-toggle="modal" data-target="#refuzim-'.$id_paraqitjes.'" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i></a></td></tr>';
								// MODALI PER PRANIM NOTE
									echo'
									<!-- Modal -->
									<div class="modal fade" id="paraqitje-'.$id_paraqitjes.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-sm">
									  <form action="paraqitja.php?pranoNot='.$id_paraqitjes.'" method="POST" role="form">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									        <h4 class="modal-title" id="myModalLabel">Prano not&euml;n</h4>
									      </div>
									      <div class="modal-body">
									        <h3><small><abbr title="L&euml;nda"><i class="fa fa-book"></i></abbr> </small> '.$lenda->getEmri().'</h3>
									        <h3><small><abbr title="Profesori"><i class="fa fa-user"></i></abbr> </small> '.$profesori->getEmri().' '.$profesori->getMbiemri().'</h3>
									        <h3><small><abbr title="Nota"><i class="fa fa-certificate"></i></abbr> </small> '.$nota.'</h3>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
									        <button type="submit" class="btn btn-success">Prano</button>
									      </div>
									    </div>
									   </form>
									  </div>
									</div>';
									// MODALI PER REFUZIM NOTE
									echo'
									<!-- Modal -->
									<div class="modal fade" id="refuzim-'.$id_paraqitjes.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-sm">
									  <form action="paraqitja.php?refuzoNot='.$id_paraqitjes.'" method="POST" role="form">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									        <h4 class="modal-title" id="myModalLabel">Prano not&euml;n</h4>
									      </div>
									      <div class="modal-body">
									        <h3><small><abbr title="L&euml;nda"><i class="fa fa-book"></i></abbr> </small> '.$lenda->getEmri().'</h3>
									        <h3><small><abbr title="Profesori"><i class="fa fa-user"></i></abbr> </small> '.$profesori->getEmri().' '.$profesori->getMbiemri().'</h3>
									        <h3><small><abbr title="Nota"><i class="fa fa-certificate"></i></abbr> </small> '.$nota.'</h3>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
									        <button type="submit" class="btn btn-danger">Refuzo</button>
									      </div>
									    </div>
									   </form>
									  </div>
									</div>';
								}
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
		$temp = $lidhja->query("SELECT id,PID,data,nota FROM paraqitjet WHERE LID=$LID AND SID=$sid");
		if($temp->num_rows){
			$temp = $temp->fetch_assoc();
			return $temp;
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
		$total = $lendet->num_rows; // numri total i lendeve qe do testohen se a jane te paraqitura ose a kane note
		$temp = 0; // Te gjitha lendet duhet te kontrollohen, nese eshte gjithqka ne rregull dhe te gjitha "kalojne testin" at'her $temp do jete e barabarte me $total e lendeve te testuara
		if($afati = afatAktiv()){
			if($afati['lloji'] == 0){ // nese eshte afat i rregullt
				foreach($lendet AS $l){
					$LID = $l['id'];
					$tempQuery = $lidhja->query("SELECT id FROM paraqitjet WHERE SID=$SID AND LID=$LID LIMIT 1");
					if($tempQuery->num_rows == 0){ // nese ajo lende nuk eshte e paraqitur nga ai student kontrollo nese ka note ajo lende
						$tempQuery2 = $lidhja->query("SELECT * FROM notat WHERE sid=$SID and lid=$LID LIMIT 1");
						if($tempQuery2->num_rows == 1){ // nese studenti ka note at'her mos e paraqit, perndryshe, lenda duhet te jete e gatshme per paraqitje
							$temp++;
						}
					}
					else{
						$temp++;
					}
				}
				if($temp == $total){
					return TRUE;
				}
				else{
					return FALSE;
				}

			}
			else{ // nese eshte afat i parregullt
				$lendetParaqitura = 0; // pasiqe eshte afat jo i rregullt duhet te ndalojme numrin e paraqitjeve nga studentet ne max. 2
				foreach($lendet AS $l){
					$LID = $l['id'];
					$tempQuery = $lidhja->query("SELECT id FROM paraqitjet WHERE SID=$SID AND LID=$LID LIMIT 1");
					if($tempQuery->num_rows == 1){
						$lendetParaqitura++; //llogarisim dhe ruajme numrin e lendeve te paraqitura
					}
					else{

					}
				}
				if($lendetParaqitura < 2){ //nese numri i lendeve eshte me i vogel se 2, 1 ose 0, at'her studenti ka mundesi ti paraqese provimet tjera
					$perfundimi = FALSE;
				}
				else{
					$perfundimi = TRUE; // nese studenti ka paraqitur tashme 2 provime, nuk i lejohet te paraqese me shume
				}
			}
			return $perfundimi;
		}
	}
?>
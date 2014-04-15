<?php
include('includes/config.php');
if(Studenti::loggedIn()){

}
else{
	header('Location: index.php');
	die();	
}
if(!empty($_POST['LID']) AND is_numeric($_POST['LID']) AND !empty($_POST['profesori']) AND is_numeric($_POST['profesori'])){
	$studenti = new Studenti($_SESSION['s_id']);
	$lenda = new Lenda($_POST['LID']);
	$prof = new Profesor($_POST['profesori']);

	$profat = $lenda->getProfID(); // ID e profesorave te asaj lende
	if($afati = afatAktiv()){
		$data_sot = date('Y-m-d');
		if($data_sot> $afati['data_fillimit'] && $data_sot< $afati['data_mbarimit']){
			if($lenda->getDrejtimi() == $studenti->getDrejtimi()){
				if(!$studenti->getLendaKaluara($lenda->getID())){
					if(in_array($prof->getID(), $profat)){ // kontrollojm nese ID e dhene eshte profesor i asaj lende te caktuar
						$SID = $studenti->getSID();
						$LID = $lenda->getID();
						$PID = $prof->getID();
						$data = date('Y-m-d');
						if($lidhja->query("INSERT INTO paraqitjet VALUES('',$SID,$LID,$PID,'$data',0)")){
							header('Location: index.php?faqja=paraqitja&mesazhi=paraqitja0');
							die();
						}
						else{
							header('Location: index.php?faqja=paraqitja&mesazhi=paraqitja1');
							die();
						}
					}
					else{
						header('Location: index.php?faqja=paraqitja&mesazhi=paraqitja1');
						die();
					}
				}
				else{
					header('Location: index.php?faqja=paraqitja&mesazhi=paraqitja1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=paraqitja&mesazhi=paraqitja1');
				die();
			}
		}
		else{
			header('Location: index.php?faqja=paraqitja&mesazhi=paraqitja1');
			die();
		}
	}
	else{
		header('Location: index.php?faqja=paraqitja&mesazhi=paraqitja1');
		die();
	}
}
if(!empty($_GET['pranoNot']) AND is_numeric($_GET['pranoNot'])){
	$id = $_GET['pranoNot'];
	$paraqitja = $lidhja->query("SELECT * FROM paraqitjet WHERE id=$id");
	if($paraqitja->num_rows > 0){
		$p = $paraqitja->fetch_assoc();
		$ID = $p['id'];
		$SID = $p['SID'];
		$LID = $p['LID'];
		$PID = $p['PID'];
		$nota = $p['nota'];
		$data = $p['data'];

		if($lidhja->query("INSERT INTO notat VALUES($SID,$LID,$PID,$nota,'$data')")){
			$lidhja->query("DELETE FROM paraqitjet WHERE id=$ID");
			header('Location: index.php?faqja=paraqitja&mesazhi=pranonote0');
			die();
		}
		else{
			header('Location: index.php?faqja=paraqitja&mesazhi=pranonote1');
			die();
		}
	}
	else{
		header('Location: index.php?faqja=paraqitja&mesazhi=nota1');
		die();
	}
}
if(!empty($_GET['refuzoNot']) AND is_numeric($_GET['refuzoNot'])){
	$id = $_GET['refuzoNot'];
	$studenti = new Studenti($_SESSION['s_id']);
	$temp_sid = $studenti->getSID();
	$paraqitja = $lidhja->query("SELECT * FROM paraqitjet WHERE id=$id AND SID=$temp_sid");
	if($paraqitja->num_rows > 0){
		$p = $paraqitja->fetch_assoc();
		$ID = $p['id'];
		$SID = $p['SID'];
		$LID = $p['LID'];
		$PID = $p['PID'];
		$nota = $p['nota'];
		$data = $p['data'];
		if($afati = afatAktiv()){
			if($lidhja->query("UPDATE paraqitjet SET nota=1 WHERE id=$ID")){
				header('Location: index.php?faqja=paraqitja&mesazhi=refuzonote0');
				die();
			}
			else{
				header('Location: index.php?faqja=paraqitja&mesazhi=refuzonote1');
				die();
			}
		}
		else{
			if($lidhja->query("DELETE FROM paraqitjet WHERE id=$ID")){
				header('Location: index.php?faqja=paraqitja&mesazhi=refuzonote0');
				die();
			}
			else{
				header('Location: index.php?faqja=paraqitja&mesazhi=refuzonote1');
				die();
			}
		}
	}
	else{
		header('Location: index.php?faqja=paraqitja&mesazhi=refuzonote1');
		die();
	}
}

?>
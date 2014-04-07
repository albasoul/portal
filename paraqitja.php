<?php
include('includes/config.php');
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
else{
	header('Location: index.php?faqja=paraqitja');
	die();
}

?>
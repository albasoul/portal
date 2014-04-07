<?php
include('includes/config.php');
if(!empty($_POST['LID']) AND is_numeric($_POST['LID']) AND !empty($_POST['profesori']) AND is_numeric($_POST['profesori'])){
	$studenti = new Studenti($_SESSION['s_id']);
	$lenda = new Lenda($_POST['LID']);
	$prof = new Profesor($_POST['profesori']);

	$profat = $lenda->getProfID(); // ID e profesorave te asaj lende

		if($lenda->getDrejtimi() == $studenti->getDrejtimi()){
			if(!$studenti->getLendaKaluara($lenda->getID())){
				if(in_array($prof->getID(), $profat)){ // kontrollojm nese ID e dhene eshte profesor i asaj lende te caktuar
					echo 'PO';
				}
				else{
					echo 'JO';
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
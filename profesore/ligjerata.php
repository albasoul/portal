<?php
include('../includes/config.php');
/*
	Nese profesori shton ligjerate
*/
if(!Profesor::loggedIn()){
	header('Location: index.php');
	die();
}
if(!empty($_GET['shtoligjerate']) && $_GET['shtoligjerate'] == 'true'){
	if(strlen(trim($_POST['emri'])) > 2 AND strlen(trim($_POST['alias']))>0){ //kontrolla qe emri i ligjerates te jete me i madhe se 2 karaktere dhe aliasi jo 0
		$profesori = new Profesor($_SESSION['profesori']); //krijojm profesorin
		$lenda = new Lenda($_POST['LID']); // krijojm lenden
		$id_lendes = $lenda->getID();
		$id_profit = $profesori->getID();
		$data = date('Y-m-d');
		#kontrollojm nese ai profesor eshte i lendes se caktuar
		$prof_id = $lenda->getProfID();
		if(!in_array($profesori->getID(), $prof_id)){
			header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=shtoligjerate1');
			die();
		}
		$emri = htmlentities($lidhja->real_escape_string($_POST['emri'])); //emri i ligjerates
		$alias = htmlentities($lidhja->real_escape_string($_POST['alias'])); // alias i ligjerates
		//kontrolla per ngarkimin e ligjerates
		if(is_uploaded_file($_FILES['ligjerata']['tmp_name'])){ //nese eshte ngarkuar ligjerata
			if(!$_FILES['ligjerata']['error']){ // nese nuk ka gabime gjate ngarkimit
				$lloji = $_FILES['ligjerata']['type'];
				if($lloji == 'application/pdf'){
					$ext = 'pdf';
				}
				elseif($lloji == 'application/vnd.ms-excel'){
					$ext = 'xls';
				}
				elseif($lloji == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
					$ext = 'xlsx';
				}
				elseif($lloji == 'application/vnd.ms-powerpoint'){
					$ext = 'ppt';
				}
				elseif($lloji == 'application/vnd.openxmlformats-officedocument.presentationml.presentation'){
					$ext = 'pptx';
				}
				elseif($lloji == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
					$ext = 'docx';
				}
				elseif($lloji == 'msword'){
					$ext = 'doc';
				}
				else{
					$ext = 'txt';
				}
				$link = Ligjerata::krijoLink($alias,$lenda->getSemestri(),$lenda->getDrejtimi(),$ext); // krijimi i linkut
				move_uploaded_file($_FILES['ligjerata']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/portal/'.$link);
				if($lidhja->query("INSERT INTO ligjeratat VALUES('','$emri','$alias','$link',$id_lendes,$id_profit,'$data')")){
					header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=shtoligjerate0');
					die();
				}
				else{
					unlink($_SERVER['DOCUMENT_ROOT'].'/portal/'.$link);
					header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=shtoligjerate1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=shtoligjerate1');
				die();
			}
		}
		else{
			header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=shtoligjerate1');
			die();
		}
	}
	else{
		header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=shtoligjerate1');
		die();
	}
}
/*
	Nese profesori ndryshon ligjerate
*/
if(!empty($_GET['ndryshoLigjerate']) && is_numeric($_GET['ndryshoLigjerate'])){
	if(strlen(trim(htmlentities($_POST['emri'])))>2 AND strlen(trim($_POST['alias']))>0){
		$profesori = new Profesor($_SESSION['profesori']); //krijojm profesorin
		$id = $lidhja->real_escape_string($_GET['ndryshoLigjerate']);
		$ligjerata = new Ligjerata($id);
		$PID = $profesori->getID();
		$temp=$lidhja->query("SELECT id FROM ligjeratat WHERE id=$id AND id_p=$PID");
		if($temp->num_rows > 0){
			$emri = htmlentities($lidhja->real_escape_string($_POST['emri']));
			$alias = htmlentities($lidhja->real_escape_string($_POST['alias']));
			if(is_uploaded_file($_FILES['ligjerata']['tmp_name'])){
				if(!$_FILES['ligjerata']['error']){ // nese nuk ka gabime gjate ngarkimit
					$lloji = $_FILES['ligjerata']['type'];
					if($lloji == 'application/pdf'){
						$ext = 'pdf';
					}
					elseif($lloji == 'application/vnd.ms-excel'){
						$ext = 'xls';
					}
					elseif($lloji == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
						$ext = 'xlsx';
					}
					elseif($lloji == 'application/vnd.ms-powerpoint'){
						$ext = 'ppt';
					}
					elseif($lloji == 'application/vnd.openxmlformats-officedocument.presentationml.presentation'){
						$ext = 'pptx';
					}
					elseif($lloji == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
						$ext = 'docx';
					}
					elseif($lloji == 'msword'){
						$ext = 'doc';
					}
					else{
						$ext = 'txt';
					}
					$link = $ligjerata->getLink(); // marrim linkun e kaluar
					$data = date('Y-m-d');
					move_uploaded_file($_FILES['ligjerata']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/portal/'.$link);
					if($lidhja->query("UPDATE ligjeratat SET emri='$emri', alias='$alias', data='$data',link='$link' WHERE id=$id")){
						header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=ndryshoLigjerate0');
						die();
					}
					else{
						header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=ndryshoLigjerate1');
						die();
					}
				}
				else{
					header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=ndryshoLigjerate1');
					die();
				}
			}
			else{
				if($lidhja->query("UPDATE ligjeratat SET emri='$emri', alias='$alias' WHERE id=$id")){
					header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=ndryshoLigjerate0');
					die();
				}
				else{
					header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=ndryshoLigjerate1');
					die();
				}
			}
		}
		else{
			header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=ndryshoLigjerate1');
			die();
		}
	}
	else{
		header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=ndryshoLigjerate1');
		die();
	}
}
/*
	Nese profesori fshin ligjerate
*/
if(!empty($_GET['fshijLigjerate']) && is_numeric($_GET['fshijLigjerate'])){
	$profesori = new Profesor($_SESSION['profesori']); //krijojm profesorin
	$id = $lidhja->real_escape_string($_GET['fshijLigjerate']);
	$ligjerata = new Ligjerata($id);
	$PID = $profesori->getID();
	$temp=$lidhja->query("SELECT id FROM ligjeratat WHERE id=$id AND id_p=$PID");
	if($temp->num_rows > 0){
		if($lidhja->query("DELETE FROM ligjeratat WHERE id=$id")){
			unlink($_SERVER['DOCUMENT_ROOT'].'/portal/'.$ligjerata->getLink());
			header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=fshijLigjerate0');
			die();
		}
		else{
			header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=fshijLigjerate1');
			die();
		}
	}
	else{
		header('Location: index.php?faqja=lendet&lenda='.$_POST['LID'].'&mesazhi=fshijLigjerate1');
		die();
	}
}

?>
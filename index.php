<?php
	# perfshije config.php
	include('includes/config.php');
	# e kqyrim lokacionin, kjo behet duke e marr linkun, dhe e marrim vetem emrin e fajllit psh: http://localhost/index.php. ne e marrim vetem fjalen "index"
	#test : $lokacioni =substr(substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1),0,-4);
	if(!empty($_GET['faqja'])){
		$faqja = $lidhja->real_escape_string($_GET['faqja']);
		if($faqja ==="index"){
			$lokacioni = "index";
		}
		elseif($faqja ==="lendet"){
			$lokacioni = "lendet";
		}
		elseif($faqja ==="lenda"){
			if(!empty($_GET['id']) && $_GET['id'] >0){
				$lokacioni = "lenda";
			}
			else{
				$lokacioni = "lendet";
			}
		}
		elseif($faqja === "lajmet"){
			$lokacioni = "lajmet";
		}
		elseif($faqja === "voto"){
			$lokacioni = "voto";
		}
		elseif ($faqja === "paraqitja") {
			$lokacioni = "paraqitja";
		}
		else{
			$lokacioni = "index";
		}
	}
	else{
		$lokacioni = "index";
	}
	$page = new Page();
	if(empty($_SESSION['s_id'])){
		$_SESSION['s_id']=0;
	}
	/*
	* Kontrollon nese faqja eshte e lejuar te kete qasje nga Administratori
	*/
	if($page->isActivated() == 1){
		/*
		* 	Kontrollon nese studenti eshte i kyqur permes funksionit loggedIn();
		*/
		if(Studenti::loggedIn()){
			/*
			* 	Krijo objektin studenti me SID te marrur nga $_SESSION['s_id']
			*/
			$studenti = new Studenti($_SESSION['s_id']);
			$page->showPamja($studenti,$page,$lokacioni);
		}
		else{
			if(!empty($_POST)){
				$email = $lidhja->real_escape_string($_POST['email']);
				$pass  = $lidhja->real_escape_string($_POST['password']);
				if(verifikojeStudentin($email,$pass)){
					header('Location: index.php');
					die();
				}
				else{
					header('Location: index.php?g=LogginFailed');
					die();
				}
			}
			else{
				/*
				* 	Nese nuk eshte i kyqur studenti, tregoja faqjen per kyqje
				*/
				$page->showLoggIn();
			}
		}
	}
	else{
		$page->hidePage($page);
	}
?>
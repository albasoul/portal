<?php
	# perfshije config.php
	include('includes/config.php');
	$page = new Page();
	if(empty($_SESSION['s_id'])){
		$_SESSION['s_id']=0;
	}
	/*
	* Kontrollon nese faqja eshte e lejuar te kete qasje nga Administratori
	*/
	if($page->isActivated()){
		/*
		* 	Kontrollon nese studenti eshte i kyqur permes funksionit loggedIn();
		*/
		if(Studenti::loggedIn()){
			/*
			* 	Krijo objektin studenti me SID te marrur nga $_SESSION['s_id']
			*/
			$studenti = new Studenti($_SESSION['s_id']);
			$page->showPage();
		}
		else{
			if(!empty($_POST)){
				$email = $lidhja->real_escape_string($_POST['email']);
				$pass  = $lidhja->real_escape_string($_POST['password']);
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
		$page->hidePage();
	}
?>
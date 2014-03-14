<?php
	# perfshije config.php
	include('includes/config.php');
	$page = new Page();
	if(empty($_SESSION['s_id'])){
		$_SESSION['s_id']=0;
	}
	$studenti = new Studenti($_SESSION['s_id']);
	if($page->isActivated()){
		if($studenti->loggedIn()){
			$page->showPage();
		}
		else{
			$page->showLoggIn();
		}
	}
	else{
		$page->hidePage();
	}
?>
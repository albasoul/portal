<?php
	# perfshije config.php
	include('includes/config.php');
	$page = new Page();
	if($page->isActivated()){
		#if($studenti->loggedIn()){
			$page->showPage();
		#}
		#else{
		#	$page->showLoggIn();
		#}
	}
	else{
		$page->hidePage();
	}
?>
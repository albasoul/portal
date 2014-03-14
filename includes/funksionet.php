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
		$studentQuery = $lidhja->query("SELECT ID FROM studentet WHERE email='$e' AND password='$p' LIMIT 1");
		# duhet me shtu kodin per me kqyr a ka rezultat edhe me ja dhon sesionit variablat...
	}
?>
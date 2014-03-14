<?php

	#
	# Lidhja me database
	# dhe informacione tjera themelore si session_start, cookie ,etj
	#
	
	$lidhja = new mysqli('localhost','portal_user','portal123','portal');
	if ($lidhja->connect_error) {
		echo 'Kontrolloni databasen.';
	}
?>
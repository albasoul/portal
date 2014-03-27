<?php

	#
	# Lidhja me database
	# dhe informacione tjera themelore si session_start, cookie ,etj
	#
	
	$lidhja = new mysqli('localhost','portal_user','K5rAp9NeJS3MLb4b','portal');
	if ($lidhja->connect_error) {
		echo 'Kontrolloni databasen.';
		die();
	}
	session_start();
	include('funksionet.php');

	$vendi_ruajtjes = "portal";
	/*
	* Perfshirja e klasave
	*/
	include($_SERVER['DOCUMENT_ROOT'].'/'.$vendi_ruajtjes.'/classes/page.class.php');
	include($_SERVER['DOCUMENT_ROOT'].'/'.$vendi_ruajtjes.'/classes/studenti.class.php');
	include($_SERVER['DOCUMENT_ROOT'].'/'.$vendi_ruajtjes.'/classes/lajmi.class.php');
	include($_SERVER['DOCUMENT_ROOT'].'/'.$vendi_ruajtjes.'/classes/lenda.class.php');
	include($_SERVER['DOCUMENT_ROOT'].'/'.$vendi_ruajtjes.'/classes/profesor.class.php');
	include($_SERVER['DOCUMENT_ROOT'].'/'.$vendi_ruajtjes.'/classes/ligjerata.class.php');
	include($_SERVER['DOCUMENT_ROOT'].'/'.$vendi_ruajtjes.'/classes/perdorues.class.php');

?>
<?php
/*
*	Klasa per krijimin e studenteve
*	Te gjitha funksionet per nje student gjinden ketu
*/
class Studenti{
	private $emri;
	private $mbiemri;
	private $foto;
	function __construct($sid){
		global $lidhja;
		$studentQuery = $lidhja->query("SELECT emri,mbiemri,lokacioni,email FROM studentet WHERE SID=$sid");
	}
	function getEmri(){

	}
	function getMbiemri(){

	}
	function getFoto(){

	}
	function loggedIn(){
		if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] === "loggedIn")
		{
			return True;
		}
		else
		{
			return False;
		}
}
?>
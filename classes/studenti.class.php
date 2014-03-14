<?php
/*
*	Klasa per krijimin e studenteve
*	Te gjitha funksionet per nje student gjinden ketu
*/
class Studenti{
	private $emri;
	private $mbiemri;
	private $email;
	private $lendet_kaluara;
	private $lokacioni;
	private $foto;
	function __construct($sid){
		global $lidhja;
		$studentQuery = $lidhja->query("SELECT emri,mbiemri,email,lendet_kaluara,lokacioni,foto FROM studentet WHERE SID=$sid LIMIT 1");
		if($studentQuery->num_rows == 1){
			$student = $studentQuery->fetch_assoc();
		$this->emri = $student['emri'];
		$this->mbiemri = $student['mbiemri'];
		$this->email = $student['email'];
		$this->lendet_kaluara = explode(",", $student['lendet_kaluara']);
		}
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
}
?>
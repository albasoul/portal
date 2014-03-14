<?php
/*
*	Klasa per krijimin e studenteve
*	Te gjitha funksionet per nje student gjinden ketu
*/
class Studenti{
	private $emri = "panjohur";
	private $mbiemri = "panjohur";
	private $email = "email@email.com";
	private $lendet_kaluara = array();
	private $lokacioni = "panjohur";
	private $foto = "img/studente/profil/default.png";

	/*
	* 	Krijon objetkin Studenti ne varesi nga $sid,
	*	nese nuk ka $sid atehere mirren vlerat Default
	*/
	function __construct($sid){
		global $lidhja;
		$studentQuery = $lidhja->query("SELECT emri,mbiemri,email,lendet_kaluara,lokacioni,foto FROM studentet WHERE SID=$sid LIMIT 1");
		if($studentQuery->num_rows == 1){
			$student = $studentQuery->fetch_assoc(); // marrja e informacioneve dhe ruajtja ne $student
			$this->emri = $student['emri'];
			$this->mbiemri = $student['mbiemri'];
			$this->email = $student['email'];
			$this->lendet_kaluara = explode(",", $student['lendet_kaluara']); // ndarja e ID te lendeve te kaluara ne nje Array 
			$this->lokacioni = $student['lokacioni'];
			$this->foto = $student['foto'];
		}
	}
	/*
	* 	Kthen emrin e studentit
	*/
	function getEmri(){
		return $this->emri;
	}
	/*
	* 	Kthen mbiemrin e studentit
	*/
	function getMbiemri(){
		return $this->mbiemri;
	}
	/*
	* 	Kthen lokacionin e fotografise se profilit te studentit
	*/
	function getFoto(){
		return $this->foto;
	}
	/*
	* 	Kthen lokacionin e studentit
	*/
	function getLokacioni(){
		return $this->lokacioni;
	}
	/*
	* 	Kthen emailin e studentit
	*/
	function getEmail(){
		return $this->email;
	}
	/*
	* 	Kthen ID e te gjitha lendeve te cilat i ka kaluar studenti
	*/
	function getLendetKaluara(){
		return $this->lendet_kaluara;
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
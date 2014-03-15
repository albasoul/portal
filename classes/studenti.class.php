<?php
/*
*	Klasa per krijimin e studenteve
*	Te gjitha funksionet per nje student gjinden ketu
*/
class Studenti{
	private $ID=0;
	private $SID=0;
	private $emri = "panjohur";
	private $mbiemri = "panjohur";
	private $email = "email@email.com";
	private $drejtimi = 0;
	private $semestri = 0;
	private $viti=0;
	private $lendet_kaluara = array();
	private $kredi=0;
	private $lokacioni = "panjohur";
	private $foto = "img/studente/profil/default.png";

	/*
	* 	Krijon objetkin Studenti ne varesi nga $sid,
	*	nese nuk ka $sid atehere mirren vlerat Default
	*/
	function __construct($sid){
		global $lidhja;
		$studentQuery = $lidhja->query("SELECT ID,SID,emri,mbiemri,email,drejtimi,semestri,lendet_kaluara,kredi,lokacioni,foto FROM studentet WHERE SID=$sid LIMIT 1");
		if($studentQuery->num_rows == 1){
			$student = $studentQuery->fetch_assoc(); // marrja e informacioneve dhe ruajtja ne $student

			$this->ID = $student['ID'];
			$this->SID = $student['SID'];
			$this->emri = $student['emri'];
			$this->mbiemri = $student['mbiemri'];
			$this->email = $student['email'];
			$this->drejtimi = $student['drejtimi'];
			$this->semestri = $student['semestri'];
			$this->lendet_kaluara = explode(",", $student['lendet_kaluara']); // ndarja e ID te lendeve te kaluara ne nje Array 
			$this->kredi = $student['kredi'];
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
	* 	Kthen drejtimin e studentit, ID e drejtimit jo emrin
	*/
	function getDrejtimi(){
		return $this->drejtimi;
	}
	/*
	* 	Kthen semestrin e studentit
	*/
	function getSemestri(){
		return $this->semestri;
	}
	/*
	* 	Funksion i vogel qe kallxon ncilin vit osht studenti
	*/
	function getViti(){
		if($this->semestri ==1 OR $this->semestri==2){
			$this->viti = 1;
		}
		elseif($this->semestri ==3 OR $this->semestri==4){
			$this->viti=2;
		}
		elseif($this->semestri==5 OR $this->semestri==6){
			$this->viti=3;
		}
		else{
			$this->viti=4;
		}
		return $this->viti;
	}
	/*
	* 	Kthen ID e te gjitha lendeve te cilat i ka kaluar studenti
	*/
	function getLendetKaluara(){
		return $this->lendet_kaluara;
	}
	function getKredi(){
		return $this->kredi;
	}
	function loggedIn(){
		if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE)
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
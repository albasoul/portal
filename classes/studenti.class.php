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
	private $kredi=0;
	private $lokacioni = "panjohur";
	private $foto = "img/studente/profil/default.png";

	/*
	* 	Krijon objetkin Studenti ne varesi nga $sid,
	*	nese nuk ka $sid atehere mirren vlerat Default
	*/
	function __construct($sid){
		global $lidhja;
		$studentQuery = $lidhja->query("SELECT ID,SID,emri,mbiemri,email,drejtimi,semestri,kredi,lokacioni,foto FROM studentet WHERE SID=$sid LIMIT 1");
		if($studentQuery->num_rows == 1){
			$student = $studentQuery->fetch_assoc(); // marrja e informacioneve dhe ruajtja ne $student
			$this->ID = $student['ID'];
			$this->SID = $student['SID'];
			$this->emri = $student['emri'];
			$this->mbiemri = $student['mbiemri'];
			$this->email = $student['email'];
			$this->drejtimi = $student['drejtimi'];
			$this->semestri = $student['semestri'];
			$this->kredi = $student['kredi'];
			$this->lokacioni = $student['lokacioni'];
			$this->foto = $student['foto'];
		}
	}
	/*
	* 	Kthen ID e studentit ne database qe e ka te regjistruar
	*/
	function getID(){
		return $this->ID;
	}
	/*
	* 	Kthen ID e studentit ne Fakulltet qe e ka te regjistruar : SID
	*/
	function getSID(){
		return $this->SID;
	}
	/*
	* 	Kthen emrin e studentit
	*/
	function getEmri(){
		return html_entity_decode($this->emri);
	}
	/*
	* 	Kthen mbiemrin e studentit
	*/
	function getMbiemri(){
		return html_entity_decode($this->mbiemri);
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
		return html_entity_decode($this->lokacioni);
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
	* 	Kontrollon a e ka kaluar ate lende te cakutar me $l_id
	*/
	function getLendaKaluara($l_id){
		global $lidhja;
		$sid= $this->SID;
		$notaQuery = $lidhja->query("SELECT * FROM notat WHERE sid=$sid AND lid=$l_id");
		// e kontrollon ne tabelen Nota a ekziston ai student me ate lende,
		// nese po, e kthen variablen $nota, qe permban note,daten,sid,id e lendes dmth (krejt).
		if($notaQuery->num_rows){
			$nota = $notaQuery->fetch_assoc();
			return $nota;
		}
		else{
			return FALSE;
		}
	}
	/*
		Funksioni qe kthen kredit totale te studentit
	*/
	function getKredi(){
		global $lidhja;
		$SID = $this->SID;
		$totalKredi = $lidhja->query("SELECT lid FROM notat WHERE sid=$SID");
		$totalTemp = 0;
		if($totalKredi->num_rows >0){
			foreach($totalKredi as $t){
				$lendQuery = $lidhja->query("SELECT kredi FROM lendet WHERE id=$t[lid]");
				$lendQuery = $lendQuery->fetch_assoc();
				$totalTemp = $totalTemp + $lendQuery['kredi'];
			}
			if($this->kredi != $totalTemp){
				$lidhja->query("UPDATE studentet set kredi=$totalTemp WHERE SID=$SID");
				return $totalTemp;
			}
			else{
				return $this->kredi;
			}
		}
		else{
			$lidhja->query("UPDATE studentet set kredi=$totalTemp WHERE SID=$SID");
			return $totalTemp;
		}
	}
	/*
		Funksioni qe tregon a eshte studenti i kyqur
	*/
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
	/*
		Funksioni qe llogarit numrin e Studenteve te regjistruar, eshte funksion qe ka qasje edhe pa u krijuar nje objekt: Studenti::getTotalStudentet()
	*/
	function getTotalStudentet(){
		global $lidhja;
		$total = $lidhja->query("SELECT * FROM studentet");
		if($total->num_rows){
			return $total->num_rows;
		}
		else{
			return false;
		}
	}
	/*
		Funksioni qe merr studentet nga drejtimi i caktuar
	*/
	function getStudentet($drejtimi_id,$faqja){
		global $lidhja;
		if($faqja ==0){
			$studentet = $lidhja->query("SELECT SID FROM studentet WHERE drejtimi=$drejtimi_id ORDER BY emri,mbiemri");
		}
		else{
			$perFaqe = 12;
			$momentale = ($faqja-1) * $perFaqe;
			$studentet = $lidhja->query("SELECT SID FROM studentet WHERE drejtimi=$drejtimi_id ORDER BY emri,mbiemri LIMIT $momentale, $perFaqe");
		}
		
		if($studentet->num_rows){
			return $studentet;
		}
		else{
			return FALSE;
		}
	}
}
?>
<?php
class Perdorues{
	private $id = 0;
	private $username = "panjohur";
	private $emri = "panjohur";
	private $mbiemri = "panjohur";
	private $email = "panjohur";
	private $tel = "panjohur";
	private $qyteti = "panjohur";
	private $rruga = "panjohur";
	private $niveli = 0;

	function __construct($temp_id){
		global $lidhja;
		$perdoruesi = $lidhja->query("SELECT username,emri,mbiemri,email,tel,qyteti,rruga,niveli FROM perdoruesit WHERE id=$temp_id") or die("Kontrolloni databasen e perdoruesve!");
		if($perdoruesi->num_rows){
			$p = $perdoruesi->fetch_assoc();
			$this->id= $temp_id;
			$this->username = $p['username'];
			$this->emri = $p['emri'];
			$this->mbiemri = $p['mbiemri'];
			$this->email = $p['email'];
			$this->tel = $p['tel'];
			$this->qyteti = $p['qyteti'];
			$this->rruga = $p['rruga'];
			$this->niveli = $p['niveli'];
		}
	}

	function getID(){
		return $this->id;
	}
	function getEmri(){
		return $this->emri;
	}
	function getMbiemri(){
		return $this->mbiemri;
	}
	function getUsername(){
		return $this->username;
	}
	function getEmail(){
		return $this->email;
	}
	function getTel(){
		return $this->tel;
	}
	function getQyteti(){
		return $this->qyteti;
	}
	function getRruga(){
		return $this->rruga;
	}
	function getNiveli(){
		return $this->niveli;
	}
	function loggedIn(){
		if(!empty($_SESSION['perdorues']) && $_SESSION['perdorues']==TRUE){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>
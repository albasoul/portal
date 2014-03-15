<?php
class Lenda{
	private $emri = "panjohur";
	private $drejtimi = 0;
	private $semestri = 0;
	private $kredi = 0;
	private $p_id = 0;
	
	function __construct($id){
		global $lidhja;
		$lendaQuery = $lidhja->query("SELECT emri,drejtimi,semestri,kredi,p_id FROM lendet WHERE id=$id");
		if($lendaQuery->num_rows > 0){
			$lenda = $lendaQuery->fetch_assoc();
			$this->emri = $lenda['emri'];
			$this->drejtimi = $lenda['drejtimi'];
			$this->semestri = $lenda['semestri'];
			$this->kredi = $lenda['kredi'];
			$this->p_id = $lenda['p_id'];
		}
	}
	function getEmri(){
		return $this->emri;
	}
	function getDrejtimi(){
		return $this->drejtimi;
	}
	function getSemestri(){
		return $this->semestri;
	}
	function getKredi(){
		return $this->kredi;
	}
	function getProfID(){
		return $this->p_id;
	}
}
?>
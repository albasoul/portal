<?php
class Lenda{
	private $id=0;
	private $emri = "panjohur";
	private $drejtimi = 0;
	private $semestri = 0;
	private $kredi = 0;
	private $p_id = 0;
	private $lloji = 'A';
	
	function __construct($id){
		global $lidhja;
		$lendaQuery = $lidhja->query("SELECT id,emri,drejtimi,semestri,kredi,p_id,lloji FROM lendet WHERE id=$id");
		if($lendaQuery->num_rows > 0){
			$lenda = $lendaQuery->fetch_assoc();
			$this->id = $lenda['id'];
			$this->emri = $lenda['emri'];
			$this->drejtimi = $lenda['drejtimi'];
			$this->semestri = $lenda['semestri'];
			$this->kredi = $lenda['kredi'];
			$this->p_id = $lenda['p_id'];
			$this->lloji = $lenda['lloji'];
		}
	}
	function getID(){
		return $this->id;
	}
	function getEmri(){
		return html_entity_decode($this->emri);
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
	function getLloji(){
		return $this->lloji;
	}
	function getLigjeratat(){
		global $lidhja;
		$id = $this->id;
		$ligjeratat = $lidhja->query("SELECT * FROM ligjeratat WHERE id_l=$id");
		if($ligjeratat->num_rows){
			return $ligjeratat;
		}
		else{
			return FALSE;
		}
	}
	function getTotalLendet(){
		global $lidhja;
		$total = $lidhja->query("SELECT * FROM lendet");
		if($total->num_rows){
			return $total->num_rows;
		}
		else{
			return false;
		}
	}
	function getLendet($did){
		global $lidhja;
		$total = $lidhja->query("SELECT id FROM lendet WHERE drejtimi=$did ORDER BY semestri");
		if($total->num_rows){
			return $total;
		}
		else{
			return FALSE;
		}
	}
}
?>
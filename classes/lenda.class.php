<?php
class Lenda{
	private $id=0;
	private $emri = "panjohur";
	private $drejtimi = 0;
	private $semestri = 0;
	private $kredi = 0;
	private $p_id = array();
	private $lloji = 'A';
	
	function __construct($id){
		global $lidhja;
		$lendaQuery = $lidhja->query("SELECT id,emri,drejtimi,semestri,kredi,lloji FROM lendet WHERE id=$id");
		if($lendaQuery->num_rows > 0){
			$lenda = $lendaQuery->fetch_assoc();
			$this->id = $lenda['id'];
			$this->emri = $lenda['emri'];
			$this->drejtimi = $lenda['drejtimi'];
			$this->semestri = $lenda['semestri'];
			$this->kredi = $lenda['kredi'];
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
		global $lidhja;
		$lid = $this->id;
		$profat = $lidhja->query("SELECT * FROM lendeprofesore WHERE LID=$lid");
		$profesoret = array();
		foreach($profat as $p){
			array_push($profesoret,$p['PID']);
		}
		return $profesoret;
	}
	function getLloji(){
		return $this->lloji;
	}
	function getLigjeratat($pid){ // ligjeratat sipas lendes se caktuar
		global $lidhja;
		$id = $this->id;
		$ligjeratat = $lidhja->query("SELECT * FROM ligjeratat WHERE id_l=$id AND id_p=$pid");
		if($ligjeratat->num_rows){
			return $ligjeratat;
		}
		else{
			return FALSE;
		}
	}
	function getTotalLendet(){ // numri total i lendeve
		global $lidhja;
		$total = $lidhja->query("SELECT * FROM lendet");
		if($total->num_rows){
			return $total->num_rows;
		}
		else{
			return false;
		}
	}
	function getLendet($did){ // lendet sipas drejtimit
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
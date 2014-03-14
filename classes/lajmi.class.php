<?php
class Lajmi{
	private $titulli = "panjohur";
	private $pershkrimi = "panjohur";
	private $body = "panjohur";
	private $data = "0000-00-00";
	private $foto = "img/fakultet/lajme/default.png"
	function __construct($id){
		global $lidhja;
		$lajmQuery = $lidhja->query("SELECT titulli,pershkrimi,body,data,foto FROM lajmet WHERE id=$id");
		if($lajmQuery->num_rows == 1){
			$lajmi = $lajmQuery->fetch_assoc();
			$this->titulli = $lajmi['titulli'];
			$this->pershkrimi = $lajmi['pershkrimi'];
			$this->body = $lajmi['body'];
			$this->data = $lajmi['data'];
			$this->foto = $lajmi['foto'];
		}
	}
	function getTitulli(){
		return $this->titulli;
	}
	function getPershkrimi(){
		return $this->pershkrimi;
	}
	function getBody(){
		return $this->body;
	}
	function getData(){
		return $this->data;
	}
	function getFoto(){
		return $this->foto;
	}

}
?>
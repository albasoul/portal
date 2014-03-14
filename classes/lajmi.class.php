<?php
class Lajmi{
	private $titulli = "panjohur";
	private $pershkrimi = "panjohur";
	private $body = "panjohur";
	private $data = "0000-00-00";
	private $foto = "img/fakultet/lajme/default.png";
	private $link = "panjohur";

	// sa here qe dojm me paraqit 1 lajm, thirrim klasen $lajmi = new Lajmi($id), 
	// edhe permes ksaj $id  ne i marrim te dhenat nga databasa
	// pastaj permes atyre te dhenave, qe i ruajm ne keto variabla private,
	// i krijojm edhe funksionet, psh: getTituli(), edhe e marrim direkt titullin...
	function __construct($id){ 
		global $lidhja;
		$lajmQuery = $lidhja->query("SELECT titulli,pershkrimi,body,data,foto,link FROM lajmet WHERE id=$id");
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
	function getLink(){
		return $this->link;
	}

}
?>
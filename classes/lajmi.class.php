<?php
class Lajmi{
	private $id=0;
	private $titulli = "panjohur";
	private $body = "panjohur";
	private $data = "0000-00-00";
	private $foto = "img/fakultet/lajme/default.png";

	// sa here qe dojm me paraqit 1 lajm, thirrim klasen $lajmi = new Lajmi($id), 
	// edhe permes ksaj $id  ne i marrim te dhenat nga databasa
	// pastaj permes atyre te dhenave, qe i ruajm ne keto variabla private,
	// i krijojm edhe funksionet, psh: getTituli(), edhe e marrim direkt titullin...
	function __construct($id){ 
		global $lidhja;
		$lajmQuery = $lidhja->query("SELECT id,titulli,body,data,foto FROM lajmet WHERE id=$id");
		if($lajmQuery->num_rows == 1){
			$lajmi = $lajmQuery->fetch_assoc();
			$this->id= $lajmi['id'];
			$this->titulli = $lajmi['titulli'];
			$this->body = $lajmi['body'];
			$this->data = $lajmi['data'];
			$this->foto = $lajmi['foto'];
		}
	}
	function getID(){
		return $this->id;
	}
	function getTitulli(){
		return utf8_encode($this->titulli);
	}
	function getBody(){
		return utf8_encode($this->body);
	}
	function getData(){
		return $this->data;
	}
	function getFoto(){
		return $this->foto;
	}
	/*
	* 	Funksion qe llogarit numrin total te lajmeve ne database
	* 	Kjo na nevojitet sidomos per me i caktu numrin e faqeve
	* 	Nese kemi 25 lajme, dhe i ndajme nga 10 lajme per faqe, at'her na duhen 3 faqe total!
	*/
	function totalLajmet(){
		global $lidhja;
		$total = $lidhja->query("SELECT * FROM lajmet");
		if($total->num_rows){
			return $total->num_rows;
		}
		else{
			return false;
		}
	}
	/*
	*	Funksioni qe merre lajmet per qdo faqe
	*	Merr ID e lajmeve duke filluar nga id me numrin p.sh:20.
	*	Dhe i merr edhe 10 rezultate te tjera, varesisht nga vlera e variables $perFaqe
	* 	Pastaj ne faqen tjeter merr lajmet nga id=30, dhe 10 rezultate tjera... etj etj etj
	*	Dmth krejt mvaret nga variabla $momentale, dhe nga variabla $perFaqe qe tregon numrin e lajmeve qe do mirren nga databasa
	*	Ketu mirren vetem ID, pasta ne forloop i krijom lajmet me class Lajmi permes ketyre ID te marra.
	*/
	function getLajmetID($v,$m){
		global $lidhja;
		if(!empty($v)) {
			if(!empty($m)){
				$lajmet = $lidhja->query("SELECT id FROM lajmet WHERE YEAR(data)=$v AND MONTH(data)=$m ORDER BY data DESC") or die($lidhja->error);
			}
			else{
				$lajmet = $lidhja->query("SELECT id FROM lajmet WHERE YEAR(data)=$v ORDER BY data DESC") or die($lidhja->error);
			}
		}
		if($lajmet->num_rows){
			return $lajmet;
		}
		else{
			return FALSE;
		}
	}

	/*
		Funksioni qe regjistron lajmin ne database
	*/
	function regjistroLajmin($t, $b, $f){
		global $lidhja;
		$data = date('Y-m-d H-m-s');
		$titulli = $lidhja->real_escape_string($t);
		$body = htmlentities($lidhja->real_escape_string($b));
		if(!empty($f)){
			$foto = $lidhja->real_escape_string($f);
		}
		else{
			$foto='';
		}
		if($lidhja->query("INSERT INTO lajmet VALUES('','$titulli','$body','$data', '$foto')")){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>
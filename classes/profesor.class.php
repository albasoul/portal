<?php
class Profesor{
	private $emri = "panjohur";
	private $mbiemri = "panjohur";
	private $email = "panjohur@email.com";
	private $lokacioni = "panjohur";
	private $foto = "img/fakultet/profesore/profil/default.png";

	function __construct($id){
		global $lidhja;
		$profQuery = $lidhja->query("SELECT emri,mbiemri,email,lokacioni,foto FROM profesoret WHERE id=$id");
		if($profQuery->num_rows){
			$prof = $profQuery->fetch_assoc();
			$this->emri = $prof['emri'];
			$this->mbiemri = $prof['mbiemri'];
			$this->email = $prof['email'];
			$this->lokacioni = $prof['lokacioni'];
			$this->foto = $prof['foto'];
		}
	}
	function getEmri(){
		return html_entity_decode($this->emri);
	}
	function getMbiemri(){
		return html_entity_decode($this->mbiemri);
	}
	function getEmail(){
		return $this->email;
	}
	function getLokacioni(){
		return html_entity_decode($this->lokacioni);
	}
	function getFoto(){
		return $this->foto;
	}
	function getTotalProfesoret(){
		global $lidhja;
		$total = $lidhja->query("SELECT * FROM profesoret");
		if($total->num_rows){
			return $total->num_rows;
		}
		else{
			return false;
		}
	}
	function getProfesoret(){
		global $lidhja;
		$profesoret = $lidhja->query("SELECT id,emri,mbiemri FROM profesoret ORDER BY emri,mbiemri");
		if($profesoret->num_rows){
			return $profesoret;
		}
		else{
			return false;
		}
	}
}

?>
<?php
class Profesor{
	private $id = 0;
	private $emri = "panjohur";
	private $mbiemri = "panjohur";
	private $email = "panjohur@email.com";
	private $lokacioni = "panjohur";
	private $foto = "img/fakultet/profesore/profil/default.png";
	private $lloji = 'A';
	private $gjinia = 'A';
	private $tel = 0;

	function __construct($id){
		global $lidhja;
		$profQuery = $lidhja->query("SELECT emri,mbiemri,email,lloji,gjinia,lokacioni,tel,foto FROM profesoret WHERE id=$id");
		if($profQuery->num_rows){
			$prof = $profQuery->fetch_assoc();
			$this->id = $id;
			$this->emri = $prof['emri'];
			$this->mbiemri = $prof['mbiemri'];
			$this->email = $prof['email'];
			$this->lokacioni = $prof['lokacioni'];
			$this->foto = $prof['foto'];
			$this->lloji = $prof['lloji'];
			$this->gjinia = $prof['gjinia'];
			$this->tel = $prof['tel'];
		}
	}
	function getID(){
		return $this->id;
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
	function getLloji(){
		return $this->lloji;
	}
	function getGjinia(){
		return $this->gjinia;
	}
	function getLokacioni(){
		return html_entity_decode($this->lokacioni);
	}
	function getTel(){
		return $this->tel;
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
	function getProfesoret($ch){
		global $lidhja;
		if($ch == 'T'){
			$profesoret = $lidhja->query("SELECT id,emri,mbiemri FROM profesoret ORDER BY emri,mbiemri");
		}
		else{
			$profesoret = $lidhja->query("SELECT id,emri,mbiemri FROM profesoret WHERE lloji='$ch' ORDER BY emri,mbiemri");
		}
		if($profesoret->num_rows){
			return $profesoret;
		}
		else{
			return false;
		}
	}
}

?>
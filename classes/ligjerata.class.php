<?php
class Ligjerata{
	private $emri = "panjohur";
	private $alias = "panjohur";
	private $link = "panjohur";
	private $l_id = 0;

	function __construct($id){
		global $lidhja;
		$id = $lidhja->real_escape_string($id);
		$ligjerataQuery = $lidhja->query("SELECT emri,alias,link,id_l FROM ligjeratat WHERE id=$id");
		if($ligjerataQuery->num_rows){
			$ligjerata = $ligjerataQuery->fetch_assoc();

			$this->emri = $ligjerata['emri'];
			$this->alias = $ligjerata['alias'];
			$this->link = $ligjerata['link'];
			$this->l_id = $ligjerata['id_l'];
		}
	}
	function getEmri(){
		return $this->emri;
	}
	function getAlias(){
		return $this->alias;
	}
	function getLink(){
		return $this->link;
	}
	function getLID(){
		return $this->l_id;
	}
	function getExtension(){
		/*
		* 	Per me kqyr qfar fajlli osht, pdf, ppt, pptx, etj..
		*	P.sh.: ligjerata.pdf
		*	Se pari kqyre madhesia: strlen($link) => 13
		* 	Pastaj kqyret pika(.) nga ana e djatht(fundi), strrpos($link, ".") => 9 (dmth ne poziten 9 osht pika)
		*								e bojm ktu +1 qe mos me marr edhe piken, por prej pozites 10 me fillu
		*	Pastaj permes substr($link, 9+1,13) e marrim perfundimin e fajllit, dmth pas pikes(.), ne kete rast del => pdf
		*/
		return substr($this->link, strrpos($this->link, ".")+1,strlen($this->link));
	}
}


?>
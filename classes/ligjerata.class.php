<?php
class Ligjerata{
	private $id = 0;
	private $emri = "panjohur";
	private $alias = "panjohur";
	private $link = "panjohur";
	private $l_id = 0;
	private $size = 0;

	function __construct($id){
		global $lidhja;
		$id = $lidhja->real_escape_string($id);
		$ligjerataQuery = $lidhja->query("SELECT id,emri,alias,link,id_l FROM ligjeratat WHERE id=$id");
		if($ligjerataQuery->num_rows){
			$ligjerata = $ligjerataQuery->fetch_assoc();

			$this->id = $ligjerata['id'];
			$this->emri = $ligjerata['emri'];
			$this->alias = $ligjerata['alias'];
			$this->link = $ligjerata['link'];
			$this->l_id = $ligjerata['id_l'];
			$this->size = filesize($ligjerata['link']);
		}
	}
	function getID(){
		return $this->id;
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
	//funksion i gatshem per mi kthy Byte ne MB
	function getMadhesia($max = null, $system = 'si', $retstring = '%01.2f %s')
	{	
		$size = $this->size;
	    $systems['si']['prefix'] = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	    $systems['si']['size']   = 1000;
	    $systems['bi']['prefix'] = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
	    $systems['bi']['size']   = 1024;
	    $sys = isset($systems[$system]) ? $systems[$system] : $systems['si'];
	    $depth = count($sys['prefix']) - 1;
	    if ($max && false !== $d = array_search($max, $sys['prefix'])) {
	        $depth = $d;
	    }
	    $i = 0;
	    while ($size >= $sys['size'] && $i < $depth) {
	        $size /= $sys['size'];
	        $i++;
	    }
	    return sprintf($retstring, $size, $sys['prefix'][$i]);
	}
	/*
	* Ky funksion e merr ID dhe e kontrollon a ekziston ajo ligjerat
	* Nese ekziston ligjerata, e krijon variablen $info si Array
	* Ne $infp[0]  ruan ID e ligjerates
	* Ne $info[1]  ruan emrin e ligjerates
	* Pastaj e kthen kete array, dhe i perdorim keto te dhena
	*/
	function kaLigjerat($id,$v){
		global $lidhja;
		if($v === "p"){ // Nese kerkohet 1 ligjerat e kaluar
			$ligjerat = $lidhja->query("SELECT id,emri FROM ligjeratat WHERE id<$id ORDER BY id DESC LIMIT 1");
		}
		elseif($v === "l"){ // Nese kerkohet ligjerata e ardhshme
			$ligjerat = $lidhja->query("SELECT id,emri FROM ligjeratat WHERE id>$id LIMIT 1");
		}
		else{
			return FALSE;
		}
		if($ligjerat->num_rows){
			$l = $ligjerat->fetch_assoc();
			$info = array();
			$info[0] = $l['id'];
			$info[1] = $l['emri'];
			return $info;
		}
		else{
			return FALSE;
		}
	}
}


?>
<?php
class Ligjerata{
	private $id = 0;
	private $emri = "panjohur";
	private $alias = "panjohur";
	private $link = "panjohur";
	private $l_id = 0;
	private $size = 0;
	private $p_id = 0;
	private $data = '0000-00-00';

	function __construct($id){
		global $lidhja;
		$id = $lidhja->real_escape_string($id);
		$ligjerataQuery = $lidhja->query("SELECT id,emri,alias,link,id_l,id_p,data FROM ligjeratat WHERE id=$id");
		if($ligjerataQuery->num_rows){
			$ligjerata = $ligjerataQuery->fetch_assoc();

			$this->id = $ligjerata['id'];
			$this->emri = $ligjerata['emri'];
			$this->alias = $ligjerata['alias'];
			$this->link = $ligjerata['link'];
			$this->l_id = $ligjerata['id_l'];
			$this->p_id = $ligjerata['id_p'];
			$this->data = $ligjerata['data'];
			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/portal/'.$ligjerata['link'])){
				$this->size = filesize($_SERVER['DOCUMENT_ROOT'].'/portal/'.$ligjerata['link']);
			}
			else{
				$this->size = 0;
			}
			
		}
	}
	function getID(){
		return $this->id;
	}
	function getEmri(){
		return html_entity_decode($this->emri);
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
	function getPID(){
		return $this->p_id;
	}
	function getData(){
		return $this->data;
	}
	function getExtension(){
		/*
		* 	Per me kqyr qfar fajlli osht, pdf, ppt, pptx, etj..
		*	P.sh.: ligjerata.pdf
		*	Se pari kqyre madhesia: strlen($link) => 13
		* 	Pastaj kqyret pika(.) nga ana e djatht(fundi), strrpos($link, ".") => 9 (dmth ne poziten 9 osht pika)
		*	e bojm ktu +1 qe mos me marr edhe piken, por prej pozites 10 me fillu
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
	function kaLigjerat($id,$v,$l_id,$p_id){
		global $lidhja;
		if($v === "p"){ // Nese kerkohet 1 ligjerat e kaluar
			$ligjerat = $lidhja->query("SELECT id,emri FROM ligjeratat WHERE id<$id AND id_l=$l_id AND id_p=$p_id ORDER BY id DESC LIMIT 1");
		}
		elseif($v === "l"){ // Nese kerkohet ligjerata e ardhshme
			$ligjerat = $lidhja->query("SELECT id,emri FROM ligjeratat WHERE id>$id AND id_l=$l_id AND id_p=$p_id LIMIT 1");
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
	function krijoLink($alias,$semestri,$drejtimi,$ext){
		

		global $lidhja;
		$d_alias = $lidhja->query("SELECT alias FROM drejtimet WHERE id=$drejtimi");
		$d_alias = $d_alias->fetch_assoc();

		
		$temp = true;
		while($temp == true){
			$dir = 'docs/ligjeratat/';
			$dir .= $d_alias['alias'].'/';
			$dir .= 'Semestri'.$semestri.'/';
			$random = rand(1000,99999);
			$temp = $alias.'-'.$random;

			$dir .= $temp .'.'. $ext;
			// kontrollimi per ligjeratat tjera, nese ekziston ajo ligjerate me ate emer, duhet emer tjeter
		
			$tmp = $lidhja->query("SELECT link FROM ligjeratat WHERE link='$dir' LIMIT 1");
			if($tmp->num_rows == 1){
				$temp = true;
			}
			else{
				$temp = false;
			}
		}
		return $dir;
	}
}
?>
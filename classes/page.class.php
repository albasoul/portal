<?php
#
#	Klasa per krijimin e nje objekti te faqes
#	ka funksione per faqen, si: getTitle(), getFooter(), isActivated();
#
class Page{
	private $title = "Titulli faqes";
	private $footer = "Copyright 2014";
	private $active = false;
	private $logoLink = "panjohur";
	private $vleresimi = 0;
	function __construct(){
		global $lidhja;
	##################################################
	#    Marrja e te dhenave nga databasa per faqen	 #
	##################################################
		$pageQuery = $lidhja->query('SELECT title,footer,activated,logo,vleresimi FROM page_info');
		if($pageQuery->num_rows == 1){
			$pageInfo = $pageQuery->fetch_assoc();
		}
		$this->title = $pageInfo['title'];
		$this->footer = $pageInfo['footer'];
		$this->active = FALSE;
		$this->logoLink = $pageInfo['logo'];
		$this->vleresimi = $pageInfo['vleresimi'];
		# nese eshte 1 beje faqen aktive #
		if($pageInfo['activated'] == 1) {
			$this->active = TRUE;
		}
	}
	/*
	* Funksioni per me marr titullin e faqes
	*/
	function getTitle(){
		return html_entity_decode($this->title);
	}
	function getLogo(){
		return $this->logoLink;
	}
	/*
	* Funksioni per me marr footer e faqes
	*/
	function getFooter(){
		return html_entity_decode($this->footer);
	}
	function setTitle($titulli){
		global $lidhja;
		$titulli = htmlentities($titulli, ENT_QUOTES, "UTF-8");
		$lidhja->query("UPDATE page_info SET title='$titulli'");
	}
	function setFooter($footer){
		global $lidhja;
		if(strlen(trim($footer))>3){
			$footer = htmlentities($footer, ENT_QUOTES, "UTF-8");
		}
		else{
			$footer = "Copyright &copy; 2014";
		}
		$lidhja->query("UPDATE page_info SET footer='$footer'");
		
	}
	/*
	* Funksioni per me kqyr a eshte faqja aktive
	*/
	function isActivated(){
		return $this->active;
	}
	function getVleresimi(){
		return $this->vleresimi;
	}

	/*
	* Funksioni qe perfshin dokumentin HTML per paraqitjen e faqes
	*/
	function showPamja($studenti,$page,$lokacioni){
		global $lidhja;
		if($lokacioni ==="index"){
			include('index.pamja.php');
		}
		elseif($lokacioni ==="lendet"){
			$temp = $lidhja->query("SELECT * FROM navbar WHERE link='$lokacioni' AND enabled=1");
			if($temp->num_rows == 1){
				include('lendet.pamja.php');
			}
			else{
				header('Location: index.php');
				die();
			}
		}
		elseif($lokacioni ==="lenda"){
			$temp = $lidhja->query("SELECT * FROM navbar WHERE link='lendet' AND enabled=1");
			if($temp->num_rows == 1){
				include('lenda.pamja.php');
			}
			else{
				header('Location: index.php');
				die();
			}
		}
		elseif($lokacioni === "lajmet"){
			$temp = $lidhja->query("SELECT * FROM navbar WHERE link='$lokacioni' AND enabled=1");
			if($temp->num_rows == 1){
				include('lajmet.pamja.php');
			}
			else{
				header('Location: index.php');
				die();
			}
		}
		elseif($lokacioni === "voto"){
			include('voto.pamja.php');
		}
		elseif ($lokacioni === "paraqitja") {
			include('paraqitja.pamja.php');
		}
		else{
			include('index.pamja.php');
		}
	}

	/*
	* Funksioni qe perfshin dokumentin HTML per paraqitjen e faqes
	*/
	function showLoggIn(){
		include('login.pamja.php');
	}

	/*
	* Funksioni qe perfshin dokumentin HTML per paraqitjen e faqes
	*/
	function hidePage($page){
		include('offline.pamja.php');
	}
	function headerNavbar(){
		global $lidhja;
		$navQuery = $lidhja->query("SELECT * FROM navbar WHERE enabled=1");
		if($navQuery->num_rows > 0){
			foreach($navQuery as $nav){
				echo '<li><a href="index.php?faqja='.$nav['link'].'" class="text-primary">'.html_entity_decode($nav['emri']).'</a></li>';
			}
		}
		else{
			return FALSE;
		}
	}
	function footerLinks(){
		global $lidhja;
		$footerLinksQuery = $lidhja->query("SELECT * FROM footer WHERE enabled=1");
		if($footerLinksQuery->num_rows > 0){
			foreach ($footerLinksQuery as $foo){
				if("dil" == strtolower($foo['emri'])){
					echo '<a href="'.$foo['link'].'"><span class="glyphicon glyphicon-log-out"></span></a> &nbsp;&nbsp;&nbsp;';
				}
				else{
					echo '<a href="'.$foo['link'].'">'.$foo['emri'].'</a> &nbsp;&nbsp;&nbsp;';
				}
			}
		}
		else{
			echo '';
		}
	}
	function deAktivizoFaqen(){
		global $lidhja;
		$lidhja->query("UPDATE page_info SET activated=0");
		return true;
	}
	function aktivizoFaqen(){
		global $lidhja;
		$lidhja->query("UPDATE page_info SET activated=1");
		return true;
	}
	function aktivizoVotim(){
		global $lidhja;
		$lidhja->query("UPDATE page_info SET vleresimi=1");
		return true;
	}
	function deAktivizoVotim(){
		global $lidhja;
		$lidhja->query("UPDATE page_info SET vleresimi=0");
		return true;
	}
}
?>
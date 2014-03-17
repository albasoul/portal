<?php
#
#	Klasa per krijimin e nje objekti te faqes
#	ka funksione per faqen, si: getTitle(), getFooter(), isActivated();
#
class Page{
	private $title;
	private $footer;
	private $active;
	function __construct(){
		global $lidhja;
	##################################################
	#    Marrja e te dhenave nga databasa per faqen	 #
	##################################################
		$pageQuery = $lidhja->query('SELECT title,footer,activated FROM page_info');
		if($pageQuery->num_rows == 1){
			$pageInfo = $pageQuery->fetch_assoc();
		}
		$this->title = $pageInfo['title'];
		$this->footer = $pageInfo['footer'];
		$this->active = FALSE;
		# nese eshte 1 beje faqen aktive #
		if($pageInfo['activated'] == 1){ $this->active = TRUE; }
		else{ $this->active = FALSE; }
	}
	/*
	* Funksioni per me marr titullin e faqes
	*/
	function getTitle(){
		return $this->title;
	}
	/*
	* Funksioni per me marr footer e faqes
	*/
	function getFooter(){
		return $this->footer;
	}
	/*
	* Funksioni per me kqyr a eshte faqja aktive
	*/
	function isActivated(){
		return $this->active;
	}

	/*
	* Funksioni qe perfshin dokumentin HTML per paraqitjen e faqes
	*/
	function showPamja($studenti,$page,$lokacioni){
		if($lokacioni ==="index"){
			include('index.pamja.php');
		}
		elseif($lokacioni ==="lendet"){
			include('lendet.pamja.php');
		}
		elseif($lokacioni ==="lenda"){
			include('lenda.pamja.php');
		}
		elseif($lokacioni === "lajmet"){
			include('lajmet.pamja.php');
		}
		else{
			include('login.pamja.php');
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
	function hidePage(){
		include('offline.pamja.php');
	}
	function headerNavbar(){
		global $lidhja;
		$navQuery = $lidhja->query("SELECT * FROM navbar WHERE enabled=1");
		if($navQuery->num_rows > 0){
			foreach($navQuery as $nav){
				echo '<li><a href="'.$nav['link'].'" class="text-primary">'.$nav['emri'].'</a></li>';
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
}
?>
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

}
?>
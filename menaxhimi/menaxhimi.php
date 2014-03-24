<?php
include($_SERVER['DOCUMENT_ROOT'].'/portal/includes/config.php');
$page = new Page();
	/*if(!empty($_POST['title-footer-submit'])){
		if(!empty($_POST['title']) && strlen($_POST['title']) >4 ){
			$titulli = $lidhja->real_escape_string($_POST['title']);
			$page->setTitle($titulli);
			header('Location: index.php?faqja=menaxhimi');
			die();
		}
	}*/
		if(!empty($_POST['online']) && $_POST['online']==1){
			if($page->deAktivizoFaqen()){
				echo '<input type="hidden" name="offline" value="1"/>
				<p class="bg-danger text-left"><input id="faqjaOnline" type="submit" class="btn btn-md btn-danger" value="Offline"/> Faqja &euml;sht&euml; ndaluar! <span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
		}
		elseif(!empty($_POST['offline']) && $_POST['offline']==1){
			if($page->aktivizoFaqen()){
				echo '<input type="hidden" name="online" value="1"/>
				<p class="bg-success text-left"><input id="faqjaOnline" type="submit" class="btn btn-md btn-success" value="Online"/> Faqja &euml;sht&euml; aktivizuar! <span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
		}
		if(!empty($_POST['votimOn']) && $_POST['votimOn']==1){
			if($page->deAktivizoVotim()){
				echo '<input type="hidden" name="votimOff" value="1"/>
				<p class="bg-danger text-left"><button id="faqjaOnline" type="submit" class="btn btn-md btn-danger">Offline</button> Vler&euml;simi &euml;sht&euml; ndaluar! <span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
		}
		elseif(!empty($_POST['votimOff']) && $_POST['votimOff']==1){
			if($page->aktivizoVotim()){
				echo '<input type="hidden" name="votimOn" value="1"/>
				<p class="bg-success text-left"><button id="faqjaOnline" type="submit" class="btn btn-md btn-success">Online</button> Vler&euml;simi &euml;sht&euml; aktivizuar! <span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
		}
	
?>
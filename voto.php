<?php
if(!empty($_POST)){
	$i=0;
	foreach($_POST['emri_lendes'] as $lenda){
		echo $lenda .' ' . $_POST['emri_prof'][$i]. '<br/>';
		$i++;
	}
}
?>
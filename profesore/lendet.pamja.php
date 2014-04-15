<div class="col-md-12 lendet-e-profesorit">
	<div class="list-group">
	<?php
		foreach($profesori->getLendet() as $l){
			$lenda = new Lenda($l['LID']);
			$did = $lenda->getDrejtimi();
			$tempQuery = $lidhja->query("SELECT alias,emri FROM drejtimet WHERE id=$did");
			$temp = $tempQuery->fetch_assoc();
			echo '<a href="index.php?faqja=lendet&lenda='.$lenda->getID().'" class="list-group-item">
			<strong>'.$lenda->getEmri().'</strong> <i class="fa fa-minus"></i>
			<abbr title="'.$temp['emri'].'">'.$temp['alias'].'</abbr> <i class="fa fa-minus"></i> ';
			if($lenda->getLloji() == "O"){
				echo '<abbr title="Obligative">'.$lenda->getLloji().'</abbr>';
			}
			else{
				echo '<abbr title="Zgjedhore">'.$lenda->getLloji().'</abbr>';
			}
			echo ' <i class="fa fa-minus"></i> <abbr title="Kredi">'.$lenda->getKredi().'</abbr>';
			echo '</a>';
		}
	?>
	</div>
</div>
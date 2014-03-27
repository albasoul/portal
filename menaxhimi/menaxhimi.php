<?php
include($_SERVER['DOCUMENT_ROOT'].'/portal/includes/config.php');
$page = new Page();
		/*
			Per me ndryshu titullin
		*/
		if(!empty($_POST['title-footer-submit'])){
			if(!empty($_POST['title']) && strlen($_POST['title']) >4 ){
				$titulli = $lidhja->real_escape_string($_POST['title']);
				$footer = $lidhja->real_escape_string($_POST['footer']);
				$page->setTitle($titulli);
				$page->setFooter($footer);
				header('Location: index.php?faqja=menaxhimi&mesazhi=page_info0');
				die();
			}
		}
		/*
			Per me aktivizu/ndalu faqen komplet
		*/
		if(!empty($_POST['online']) && $_POST['online']==1){
			if($page->deAktivizoFaqen()){
				echo '<input type="hidden" name="offline" value="1"/>
				<p class="bg-danger text-left"><input id="faqjaOnline" type="submit" class="btn btn-md btn-danger" value="Offline"/> Faqja &euml;sht&euml; ndaluar! <span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			die();
			}
		}
		elseif(!empty($_POST['offline']) && $_POST['offline']==1){
			if($page->aktivizoFaqen()){
				echo '<input type="hidden" name="online" value="1"/>
				<p class="bg-success text-left"><input id="faqjaOnline" type="submit" class="btn btn-md btn-success" value="Online"/> Faqja &euml;sht&euml; aktivizuar! <span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			die();
			}
		}
		/*
			Per me aktivizu/deaktivizu Votimin online
		*/
		if(!empty($_POST['votimOn']) && $_POST['votimOn']==1){
			if($page->deAktivizoVotim()){
				echo '<input type="hidden" name="votimOff" value="1"/>
				<p class="bg-danger text-left"><button id="faqjaOnline" type="submit" class="btn btn-md btn-danger">Offline</button> Vler&euml;simi &euml;sht&euml; ndaluar! <span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			die();
			}
		}
		elseif(!empty($_POST['votimOff']) && $_POST['votimOff']==1){
			if($page->aktivizoVotim()){
				echo '<input type="hidden" name="votimOn" value="1"/>
				<p class="bg-success text-left"><button id="faqjaOnline" type="submit" class="btn btn-md btn-success">Online</button> Vler&euml;simi &euml;sht&euml; aktivizuar! <span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			die();
			}
		}
		/*
			Per me shtu lajme
		*/
		if(!empty($_POST['permbajtja']) && !empty($_POST['titulli']) && strlen($_POST['titulli'])>0 && strlen(trim($_POST['permbajtja']))>0){
			$telejuara = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["fotografia"]["name"]);
			$extension = end($temp);
			$titulli = $_POST['titulli'];
			$body = $_POST['permbajtja'];
			/*
				$_FILES["fotografia"]["name"] - emri i fotos
				$_FILES["fotografia"]["type"] - lloji i fotos
				$_FILES["fotografia"]["size"] - madhesia (ne byte)
				$_FILES["fotografia"]["tmp_name"] - vendi i perkohshem ku u ruajt
				$_FILES["fotografia"]["error"] - error code, nese ndodh naj gabim, del 0 nese ka gabime...
			*/
				if ((($_FILES["fotografia"]["type"] == "image/gif")
					|| ($_FILES["fotografia"]["type"] == "image/jpeg")
					|| ($_FILES["fotografia"]["type"] == "image/jpg")
					|| ($_FILES["fotografia"]["type"] == "image/pjpeg")
					|| ($_FILES["fotografia"]["type"] == "image/x-png")
					|| ($_FILES["fotografia"]["type"] == "image/png"))
					&& ($_FILES["fotografia"]["size"] < 2000000)
					&& in_array($extension, $telejuara)){
					if ($_FILES["fotografia"]["error"] > 0)
					  {
						  header('Location: index.php?faqja=lajmet&mesazhi=lajm_foto1');
						  die();
					  }
					else{
					  	$random = rand(23243,214921);
					  	$lajmi = 'lajmi-'.$random.'.'.$extension;
					  	while(file_exists("../img/fakultet/lajme/" . $lajmi)){
					  		$random = rand(23243,214921);
					  		$lajmi = 'lajmi-'.$random.'.'.$extension;
					  	}
					  	if (file_exists("../img/fakultet/lajme/" . $lajmi))
					      {
					      echo $_FILES["fotografia"]["name"] . " ekziston... ";
					      }
					    else
					      {
					      	move_uploaded_file($_FILES["fotografia"]["tmp_name"], "../img/fakultet/lajme/" . $lajmi);
					      	$foto = "img/fakultet/lajme/" . $lajmi;
					      }
					}
				}
			if(Lajmi::regjistroLajmin($titulli, $body,$foto)){
	      		header('Location: index.php?faqja=lajmet&mesazhi=lajmet0');
				die();
			}
			else{
				header('Location: index.php?faqja=lajmet&mesazhi=lajmet1');
				die();
			}
		}

		/*
			Paraqitja e formes per ndryshim te fakultetit
		*/
		if(!empty($_GET['fakulteti']) && is_numeric($_GET['fakulteti'])){
			$id = $lidhja->real_escape_string($_GET['fakulteti']);

			$fakulteti = $lidhja->query("SELECT * FROM fakulteti WHERE id=$id");
			if($fakulteti->num_rows){
				$f = $fakulteti->fetch_assoc();
				echo '	
				<form role="form" action="menaxhimi.php" method="POST">
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Ndrysho fakultetin</h4>
			    	</div>
			    	<div class="modal-body">
			        	<input type="hidden" value="'.$id.'" name="id_fk"/>
			        	<div class="row">
			        		<div class="form-group col-md-9">
			        			<label for="emri">Emri</label>
			        			<input class="form-control" id="emri" name="emri_fk" type="text" value="'.$f['emri'].'" />
			        		</div>
			        		<div class="form-group col-md-3">
			        			<label for="alias">Alias</label>
			        			<input type="text" name="alias_fk" class="form-control" id="alias" value="'.$f['alias'].'" />
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="form-group col-md-9">
			        			';
			        			if($profesoret = Profesor::getProfesoret()){
			        				echo '<label for="profesori">Profesori</label>
			        					<select class="form-control" name="prof_fk" id="profesori">';
			        					echo '<option value="0"> = profesori = </option>';
			        						foreach($profesoret as $p){
			        							if($f['dekani'] == $p['id']){
			        								echo '<option selected value="'.$p['id'].'">'.$p['emri'].' '.$p['mbiemri'].'';
			        							}
			        							else{
			        								echo '<option value="'.$p['id'].'">'.$p['emri'].' '.$p['mbiemri'].'';
			        							}
			        							
			        						}
			        				echo '</select>';
			        			}
			        			else{
			        				echo'<p class="text-danger"> Nuk ka profesor&euml; </p>';
			        			}

			 echo'     		</div>
			        	</div>			        	
			    	</div>
			    	<div class="modal-footer">
			    		<button type="button" class="btn btn-default" data-dismiss="modal">Mbylle!</button>
			    		<button type="submit" class="btn btn-primary">Ruaje</button>
					</div>
				</form>
					';
			}
			else{
				header('Location: index.php?faqja=menaxhimi&mesazhi=fakultet1');
				die();
			}
		}
		/*
			Nese eshte ndryshuar fakulteti
		*/
		if(!empty($_POST['emri_fk'])) {
			if(strlen(trim($_POST['emri_fk'])) >5){
				$id = $_POST['id_fk'];
				$emri = $lidhja->real_escape_string($_POST['emri_fk']);
				$prof = $_POST['prof_fk'];
				$alias = $lidhja->real_escape_string($_POST['alias_fk']);
				if($lidhja->query("UPDATE fakulteti SET emri='$emri',dekani='$prof',alias='$alias' WHERE id=$id")){
					header('Location: index.php?faqja=menaxhimi&mesazhi=fakultet0');
					die();
				}
				else{
					header('Location: index.php?faqja=menaxhimi&mesazhi=fakultet1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=menaxhimi&mesazhi=fakultet1');
				die();
			}
		}
		/*
			Paraqitja e formes per ndryshim te drejtimit
		*/
		if(!empty($_GET['drejtimi']) && is_numeric($_GET['drejtimi'])){
			$id = $lidhja->real_escape_string($_GET['drejtimi']);
			$drejtimi = $lidhja->query("SELECT * FROM drejtimet WHERE id=$id");
			if($drejtimi->num_rows){
				$d = $drejtimi->fetch_assoc();
				echo '
				<form role="form" action="menaxhimi.php" method="POST">
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Ndrysho drejtimin</h4>
			    	</div>
			    	<div class="modal-body">
			        	<input type="hidden" value="'.$id.'" name="id_d"/>
			        	<div class="row">
			        		<div class="form-group col-md-9">
			        			<label for="emri">Emri</label>
			        			<input class="form-control" id="emri" name="emri_d" type="text" value="'.$d['emri'].'" />
			        		</div>
			        		<div class="form-group col-md-3">
			        			<label for="alias">Alias</label>
			        			<input type="text" name="alias_d" class="form-control" id="alias" value="'.$d['alias'].'" />
			        		</div>
			        	</div>	  
			        	<div class="row">
			    			<div class="form-group col-md-9">';
			    			 	if($fakultetet = getFakultetet()){
			    			 		echo '
			    			 		<label for="fakulteti">Fakulteti</label>
			    			 		<select name="fk_d" id="fakulteti" class="form-control">';
			    			 		foreach($fakultetet as $f){
			    			 			if($d['f_id'] == $f['id']){
			    			 				echo '<option selected value="'.$f['id'].'">'.$f['emri'].'</option>';
			    			 			}
			    			 			else{
			    			 				echo '<option value="'.$f['id'].'">'.$f['emri'].'</option>';
			    			 			}
			    			 		}
			    			 	echo '</select>';
			    			 	}
			    			 	else{
			    			 		echo '<p class="text-danger">Nuk ka fakultete.</p>';
			    			 	}
			    echo'		 </div>
			    		</div>      	
			    	</div>
			    	<div class="modal-footer">
			    		<button type="button" class="btn btn-default" data-dismiss="modal">Mbylle!</button>
			    		<button type="submit" class="btn btn-primary">Ruaje</button>
					</div>
			    </form>';
			}
		}
		/*
			Nese eshte ndryshuar drejtimi
		*/
		if(!empty($_POST['emri_d'])){
			if(strlen(trim($_POST['emri_d'])) >5){
				$id = $_POST['id_d'];
				$emri = $lidhja->real_escape_string($_POST['emri_d']);
				$fk = $_POST['fk_d'];
				$alias = $lidhja->real_escape_string($_POST['alias_d']);
				if($lidhja->query("UPDATE drejtimet SET emri='$emri',f_id=$fk,alias='$alias' WHERE id=$id")){
					header('Location: index.php?faqja=menaxhimi&mesazhi=drejtim0');
					die();
				}
				else{
					header('Location: index.php?faqja=menaxhimi&mesazhi=drejtim1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=menaxhimi&mesazhi=drejtim1');
				die();
			}
		}
		/*
			Paraqitja e formes per ndryshim te perdoruesit
		*/
		if (!empty($_GET['perdoruesi']) && is_numeric($_GET['perdoruesi'])) {
			$id = $lidhja->real_escape_string($_GET['perdoruesi']);
			$perdorues = new Perdorues($id);
			echo '
				<form role="form" action="menaxhimi.php" method="POST">
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Ndrysho p&euml;rdoruesin</h4>
			    	</div>
			    	<div class="modal-body">
			    	<input type="hidden" value="'.$id.'" name="id_p"/>
			        	<div class="row">
			    			<div class="form-group col-md-4">
			    				<label for="emri">Emri</label>
			    				<input type="text" class="form-control" value="'.$perdorues->getEmri().'" name="emri_p" id="emri" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="mbiemri">Mbiemri</label>
			    				<input type="text" class="form-control" name="mbiemri_p" value="'.$perdorues->getMbiemri().'" id="mbiemri" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="username">Username</label>
			    				<input type="text" class="form-control" name="username" value="'.$perdorues->getUsername().'" id="username" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-4">
			    				<label for="email">email</label>
			    				<input type="text" class="form-control" value="'.$perdorues->getEmail().'" name="email" id="email" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="password">Fjal&euml;kalimi i ri</label>
			    				<input type="password" class="form-control" name="password" id="password" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="password2">P&euml;rs&euml;rit fjal&euml;kalimin</label>
			    				<input type="password" class="form-control" name="password2" id="password2" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-3">
			    				<label for="tel">Nr. telefonit</label>
			    				<input type="tel" name="tel" id="tel" value="'.$perdorues->getTel().'" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-3">
			    				<label for="qyteti">Qyteti</label>
			    				<input type="text" name="qyteti" id="qyteti" value="'.$perdorues->getQyteti().'" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="adresa">Adresa</label>
			    				<input type="text" name="adresa" id="adresa" value="'.$perdorues->getRruga().'" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-2">
			    				<label for="niveli">Niveli</label>
			    				<select name="niveli" id="niveli" class="form-control">';
			    				if($perdorues->getNiveli() == 1){
			    					echo '<option value="1" selected>1</option>
			    						<option value="2">2</option>';
			    				}
			    				else{
			    					echo '<option value="1">1</option>
			    						<option value="2" selected>2</option>';
			    				}
			    		echo'	</select>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="modal-footer">
			    		<button type="button" class="btn btn-default" data-dismiss="modal">Mbylle!</button>
			    		<button type="submit" class="btn btn-primary">Ruaje</button>
					</div>
			    </form>';
		}
		/*
			Nese eshte ndryshuar perdoruesi
		*/
		if(!empty($_POST['emri_p'])){
			if(strlen(trim($_POST['emri_p'])) >2 && $_POST['password']===$_POST['password2']){
				$id = $_POST['id_p'];
				$emri = $lidhja->real_escape_string($_POST['emri_p']);
				$mbiemri = $lidhja->real_escape_string($_POST['mbiemri_p']);
				$username = $lidhja->real_escape_string($_POST['username']);
				$email = $lidhja->real_escape_string($_POST['email']);
				$pass = $lidhja->real_escape_string($_POST['password']);
				$fk = $_POST['fk_d'];
				$alias = $lidhja->real_escape_string($_POST['alias_d']);
				if($lidhja->query("UPDATE drejtimet SET emri='$emri',f_id=$fk,alias='$alias' WHERE id=$id")){
					header('Location: index.php?faqja=menaxhimi&mesazhi=perdorues0');
					die();
				}
				else{
					header('Location: index.php?faqja=menaxhimi&mesazhi=perdorues1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=menaxhimi&mesazhi=perdorues1');
				die();
			}
		}
		/*
			Paraqitja e formes per shtimin e fakultetit, shtimin e drejtimit, shtimin e perdoruesit/menaxherit
		*/
		if(!empty($_GET['shto'])){
			$shto = $lidhja->real_escape_string($_GET['shto']);
			if($shto == "fakultet"){
				echo '
				<form role="form" action="menaxhimi.php" method="POST">
					<input type="hidden" name="shto_forma" value="fakultet"/>
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Shto fakultet</h4>
			    	</div>
			    	<div class="modal-body">
			    		<div class="row">
			        		<div class="form-group col-md-9">
			        			<label for="emri">Emri</label>
			        			<input class="form-control" id="emri" name="shto_emri_fk" placeholder="emri i fakultetit" autofocus type="text" />
			        		</div>
			        		<div class="form-group col-md-3">
			        			<label for="alias">Alias</label>
			        			<input type="text" name="shto_alias_fk" placeholder="FSHK" class="form-control" id="alias"/>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="form-group col-md-9">';
			        			if($profesoret = Profesor::getProfesoret()){
			        				echo '<label for="profesori">Profesori</label>
			        					<select class="form-control" name="shto_prof_fk" id="profesori">';
			        					echo '<option value="0"> = profesori = </option>';
			        						foreach($profesoret as $p){
			        								echo '<option value="'.$p['id'].'">'.$p['emri'].' '.$p['mbiemri'].'';
			        						}
			        				echo '</select>';
			        			}
			        			else{
			        				echo '<p class="text-danger"> Nuk ka profesor&euml; </p>';
			        			}
			     echo' 		</div>
			        	</div>
			    	</div>
			    	<div class="modal-footer">
			    		<button type="button" class="btn btn-default" data-dismiss="modal">Mbylle!</button>
			    		<button type="submit" class="btn btn-primary">Ruaje</button>
					</div>
				</form>';
			}
			elseif($shto === "drejtim"){
				echo '
				<form action="menaxhimi.php" method="POST" role="form">
				<input type="hidden" name="shto_forma" value="drejtim"/>
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Shto drejtim</h4>
			    	</div>
			    	<div class="modal-body">
			    		<div class="row">
			    			<div class="form-group col-md-9">
			    				<label for="emri">Emri</label>
			    				<input type="text" class="form-control" placeholder="emri i drejtimit" name="shto_emri_d" id="emri" />
			    			</div>
			    			<div class="form-group col-md-3">
			    				<label for="alias">Alias</label>
			    				<input type="text" class="form-control" name="shto_alias_d" placeholder="DS" id="alias" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-9">';
			    			 	if($fakultetet = getFakultetet()){
			    			 		echo '
			    			 		<label for="fakulteti">Fakulteti</label>
			    			 		<select name="shto_fk_d" id="fakulteti" class="form-control">';
			    			 		foreach($fakultetet as $f){
			    			 			echo '<option value="'.$f['id'].'">'.$f['emri'].'</option>';
			    			 		}
			    			 	echo '</select>';
			    			 	}
			    			 	else{
			    			 		echo '<p class="text-danger">Nuk ka fakultete.</p>';
			    			 	}
			    echo'		 </div>
			    		</div>
			    	</div>
			    	<div class="modal-footer">
			    		<button type="button" class="btn btn-default" data-dismiss="modal">Mbylle!</button>
			    		<button type="submit" class="btn btn-primary">Ruaje</button>
					</div>
			    </form>';
			}
			elseif($shto === "perdorues"){
				echo '
				<form action="menaxhimi.php" method="POST" role="form">
					<input type="hidden" name="shto_forma" value="perdorues"/>
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Shto p&euml;rdorues</h4>
			    	</div>
			    	<div class="modal-body">
			    		<div class="row">
			    			<div class="form-group col-md-4">
			    				<label for="emri">Emri</label>
			    				<input type="text" class="form-control" placeholder="emri" name="shto_emri_p" id="emri" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="mbiemri">Mbiemri</label>
			    				<input type="text" class="form-control" name="shto_mbiemri_p" placeholder="mbiemri" id="mbiemri" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="username">Username</label>
			    				<input type="text" class="form-control" name="shto_username_p" placeholder="username" id="username" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-4">
			    				<label for="email">email</label>
			    				<input type="text" class="form-control" placeholder="email" name="shto_email_p" id="email" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="password">Fjal&euml;kalimi</label>
			    				<input type="password" class="form-control" name="shto_password_p" id="password" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="password2">P&euml;rs&euml;rit fjal&euml;kalimin</label>
			    				<input type="password" class="form-control" name="shto_password_p2" id="password2" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-3">
			    				<label for="tel">Nr. telefonit</label>
			    				<input type="tel" name="shto_tel_p" id="tel" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-3">
			    				<label for="qyteti">Qyteti</label>
			    				<input type="text" name="shto_qyteti_p" id="qyteti" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label for="adresa">Adresa</label>
			    				<input type="text" name="shto_adresa_p" id="adresa" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-2">
			    				<label for="niveli">Niveli</label>
			    				<select name="shto_niveli_p" id="niveli" class="form-control">
			    					<option value="1">1</option>
			    					<option value="2">2</option>
			    				</select>
			    			</div>
			    		</div>
			    	</div>
			    	<div class="modal-footer">
			    		<button type="button" class="btn btn-default" data-dismiss="modal">Mbylle!</button>
			    		<button type="submit" class="btn btn-primary">Ruaje</button>
					</div>
			    </form>';
			}
		}
		/*
			Per te shtuar nje fakultet/drejtim/perdorues
		*/
		if(!empty($_POST['shto_forma'])){
			$m = $lidhja->real_escape_string($_POST['shto_forma']);
			if($m === "fakultet"){
				if(!empty($_POST['shto_emri_fk']) && strlen(trim($_POST['shto_emri_fk']))>3){
					$emri_fk = $lidhja->real_escape_string($_POST['shto_emri_fk']);
					$alias_fk = $lidhja->real_escape_string($_POST['shto_alias_fk']);
					$prof_fk = $lidhja->real_escape_string($_POST['shto_prof_fk']);
					if($lidhja->query("INSERT INTO fakulteti VALUES('','$emri_fk','$alias_fk',$prof_fk)")){
						header('Location: index.php?faqja=menaxhimi&mesazhi=shtofakultet0');
						die();
					}
					else{
						header('Location: index.php?faqja=menaxhimi&mesazhi=shtofakultet1');
						die();
					}
				}
				else{
					header('Location: index.php?faqja=menaxhimi&mesazhi=shtofakultet1');
					die();
				}
			}
			elseif($m === "drejtim"){
				if(!empty($_POST['shto_emri_d']) && strlen(trim($_POST['shto_emri_d']))>3){
					$emri_d = $lidhja->real_escape_string($_POST['shto_emri_d']);
					$alias_d = $lidhja->real_escape_string($_POST['shto_alias_d']);
					$fk_d = $lidhja->real_escape_string($_POST['shto_fk_d']);
					if($lidhja	->query("INSERT INTO drejtimet VALUES('','$emri_d','$alias_d',$fk_d)")){
						header('Location: index.php?faqja=menaxhimi&mesazhi=shtodrejtim0');
						die();
					}
					else{
						header('Location: index.php?faqja=menaxhimi&mesazhi=shtodrejtim1');
						die();
					}
				}
				else{
					header('Location: index.php?faqja=menaxhimi&mesazhi=shtodrejtim1');
					die();
				}
			}
			elseif($m === "perdorues"){
				if(!empty($_POST['shto_emri_p']) && strlen(trim($_POST['shto_emri_p'])) 
					&& strlen(trim($_POST['shto_username_p']))>3
					&& strlen($_POST['shto_password_p'])>5
					&& ($_POST['shto_password_p'] == $_POST['shto_password2_p']))
				{
					$emri_p = $lidhja->real_escape_string($_POST['shto_emri_p']);
					$mbiemri_p = $lidhja->real_escape_string($_POST['shto_mbiemri_p']);
					$user = $lidhja->real_escape_string($_POST['shto_username_p']);
					$pass = $lidhja->real_escape_string($_POST['shto_password_p']);
					$email = $lidhja->real_escape_string($_POST['shto_email_p']);
					$tel = $lidhja->real_escape_string($_POST['shto_tel_p']);
					$qyteti = $lidhja->real_escape_string($_POST['shto_qyteti_p']);
					$rruga = $lidhja->real_escape_string($_POST['shto_adresa_p']);
					$niveli = $lidhja->real_escape_string($_POST['shto_niveli_p']);
					if($lidhja->query("INSERT INTO perdoruesit VALUES('','$user','$emri_p','$mbiemri_p','$email','$pass','$tel','$qyteti','$rruga',$niveli)")){
						header('Location: index.php?faqja=menaxhimi&mesazhi=shtoperdorues0');
						die();
					}
					else{
						header('Location: index.php?faqja=menaxhimi&mesazhi=shtoperdorues1');
						die();
					}
				}
				else{
					header('Location: index.php?faqja=menaxhimi&mesazhi=shtoperdorues1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=menaxhimi');
				die();
			}
		}
?>
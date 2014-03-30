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
		if(!empty($_GET['shto']) && $_GET['shto']==="lajm"){
			if(!empty($_POST['permbajtja']) && !empty($_POST['titulli']) && strlen($_POST['titulli'])>0 && strlen(trim($_POST['permbajtja']))>0){
				$telejuara = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["fotografia"]["name"]);
				$extension = end($temp);
				$titulli = htmlentities($lidhja->real_escape_string($_POST['titulli']));
				$body = $lidhja->real_escape_string($_POST['permbajtja']);
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
		}

		/*
			Per me shtu student
		*/
		if(!empty($_GET['shto']) && $_GET['shto']=="student"){
			if($_POST['password1'] === $_POST['password2']){
				if(strlen(($_POST['emri']))>1 && strlen($_POST['mbiemri'])>1 && is_numeric($_POST['kredi']) && is_numeric($_POST['semestri']) && is_numeric($_POST['SID'])){
					$SID = $lidhja->real_escape_string($_POST['SID']);
					$emri = htmlentities($lidhja->real_escape_string($_POST['emri']));
					$mbiemri = htmlentities($lidhja->real_escape_string($_POST['mbiemri']));
					$email = $lidhja->real_escape_string($_POST['email']);
					$d_id = $lidhja->real_escape_string($_POST['drejtimi']);
					$semestri = $lidhja->real_escape_string($_POST['semestri']);
					$kredi = $lidhja->real_escape_string($_POST['kredi']);
					$lokacioni = htmlentities($lidhja->real_escape_string($_POST['lokacioni']));
					$pass = $lidhja->real_escape_string($_POST['password1']);
					if($lidhja->query("INSERT INTO studentet VALUES('',$SID, '$emri', '$mbiemri', '$email', '$pass', $d_id,$semestri,$kredi,'$lokacioni','img/studente/profil/default.png')")) {
						header('Location: index.php?faqja=studentet&mesazhi=shtostudent0');
						die();
					}
					else{
						header('Location: index.php?faqja=studentet&mesazhi=shtostudent1');
						die();
					}
				}
				else{
					header('Location: index.php?faqja=studentet&mesazhi=shtostudent1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=studentet&mesazhi=shtostudent1');
				die();
			}
		}
		/*
			Per me ndryshu Studentin
		*/
		if(!empty($_GET['ndryshoStudentin']) && is_numeric($_GET['ndryshoStudentin'])){
			$SID = $lidhja->real_escape_string($_GET['ndryshoStudentin']);
			$studenti = new Studenti($SID);
			if($studenti->getEmri() === "panjohur"){
				header('Location: index.php?faqja=studentet&mesazhi=ndryshostudent1');
			}
			else{
				echo '
			<form action="menaxhimi.php?ndryshoS='.$studenti->getID().'" role="form" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h4 class="modal-title" id="myModalLabel">'.$studenti->getEmri().' '.$studenti->getMbiemri().'</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-3">
							<label class="control-label" for="sid">SID</label>
							<input type="number" class="form-control" name="SID" id="sid" value="'.$studenti->getSID().'"/>
						</div>
						<div class="form-group col-md-3">
							<label class="control-label" for="emri">Emri</label>
							<input type="text" class="form-control" name="emri" id="emri" value="'.$studenti->getEmri().'"/>
						</div>
						<div class="form-group col-md-3">
							<label class="control-label" for="mbiemri">Mbiemri</label>
							<input type="text" class="form-control" name="mbiemri" id="mbiemri" value="'.$studenti->getMbiemri().'"/>
						</div>
						<div class="form-group col-md-3">
							<label class="control-label" for="email">e-mail</label>
							<input type="text" class="form-control" name="email" id="email" value="'.$studenti->getEmail().'"/>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="drejtimi" class="control-label">Drejtimi</label>
		    				<select name="drejtimi" class="form-control" id="drejtimi">';
		    				if($drejtimet = getDrejtimet(0)){
		    					foreach($drejtimet as $d){
		    						if($d['id'] == $studenti->getDrejtimi()){
		    							echo '<option selected value="'.$d['id'].'">'.$d['emri'].'</option>';
		    						}
		    						else{
		    							echo '<option value="'.$d['id'].'">'.$d['emri'].'</option>';
		    						}
		    					}
		    				}
			echo'			</select>
						</div>
						<div class="form-group col-md-2">
			    			<label for="semestri" class="control-label">Semestri</label>
			    			<input type="number" class="form-control" name="semestri" id="semestri" value="'.$studenti->getSemestri().'" />
			    		</div>
			    		<div class="form-group col-md-2">
			    			<label for="kredi" class="control-label">Kredi</label>
			    			<input type="number" class="form-control" name="kredi" id="kredi" value="'.$studenti->getKredi().'"/>
			    		</div>
			    		<div class="form-group col-md-4">
			    			<label for="lokacioni" class="control-label">Adresa</label>
				    		<input type="text" id="lokacioni" class="form-control" name="lokacioni" value="'.$studenti->getLokacioni().'"/>
			    		</div>
					</div>
					<div class="row">
				      	<div class="form-group col-md-4">
				      		<label for="password1" class="control-label">Fjal&euml;kalimi i ri</label>
				    		<input type="password" autocomplete="off" class="form-control" name="password1" id="password1" />
				      	</div>
				      	<div class="form-group col-md-4">
				      		<label for="password2" class="control-label">P&euml;rs&euml;rit fjal&euml;kaliminin e ri</label>
				    		<input type="password" autocomplete="off" class="form-control" name="password2" id="password2" />
				    	</div>
				    </div>
				</div>
				<div class="modal-footer">
				    <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
				    <button type="submit" class="btn btn-primary">Ruaj</button>
				</div>
			</form>
				';
			}
		}
		/*
			Nese eshte ndryshuar studenti
		*/
		if(!empty($_GET['ndryshoS']) && is_numeric($_GET['ndryshoS'])){
				$ID = $lidhja->real_escape_string($_GET['ndryshoS']);
				$SID = $lidhja->real_escape_string($_POST['SID']);
				$emri = htmlentities($lidhja->real_escape_string($_POST['emri']));
				$mbiemri = htmlentities($lidhja->real_escape_string($_POST['mbiemri']));
				$email = $lidhja->real_escape_string($_POST['email']);
				$drejtimi = $lidhja->real_escape_string($_POST['drejtimi']);
				$semestri = $lidhja->real_escape_string($_POST['semestri']);
				$kredi = $lidhja->real_escape_string($_POST['kredi']);
				$lokacioni = $lidhja->real_escape_string($_POST['lokacioni']);
			if(strlen($_POST['password1'])>5){
				if($_POST['password1'] === $_POST['password2']){
					$pass = $lidhja->real_escape_string($_POST['password1']);
					if($lidhja->query("UPDATE studentet SET SID=$SID, emri='$emri', mbiemri='$mbiemri', email='$email', drejtimi=$drejtimi, semestri=$semestri, kredi=$kredi,lokacioni='$lokacioni',password='$pass' WHERE ID=$ID")){
						header('Location: index.php?faqja=studentet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndryshostudent0');
						die();
					}
					else{
						header('Location: index.php?faqja=studentet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndryshostudent1');
						die();
					}
				}
				else{
					header('Location: index.php?faqja=studentet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndryshostudent1');
					die();
				}
			}
			else{
				if($lidhja->query("UPDATE studentet SET SID=$SID, emri='$emri', mbiemri='$mbiemri', email='$email', drejtimi=$drejtimi, semestri=$semestri, kredi=$kredi,lokacioni='$lokacioni' WHERE ID=$ID")){
					header('Location: index.php?faqja=studentet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndryshostudent0');
					die();
				}
				else{
					header('Location: index.php?faqja=studentet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndryshostudent1');
					die();
				}
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
			        			if($profesoret = Profesor::getProfesoret('T')){
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
			    				<label class="control-label" for="emri">Emri</label>
			    				<input type="text" class="form-control" value="'.$perdorues->getEmri().'" name="emri_p" id="emri" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label class="control-label" for="mbiemri">Mbiemri</label>
			    				<input type="text" class="form-control" name="mbiemri_p" value="'.$perdorues->getMbiemri().'" id="mbiemri" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label class="control-label" for="username">Username</label>
			    				<input type="text" class="form-control" name="username" value="'.$perdorues->getUsername().'" id="username" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-4">
			    				<label class="control-label" for="email">email</label>
			    				<input type="text" class="form-control" value="'.$perdorues->getEmail().'" name="email" id="email" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label class="control-label" for="password">Fjal&euml;kalimi i ri</label>
			    				<input type="password" class="form-control" name="password" id="password" />
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label class="control-label" for="password2">P&euml;rs&euml;rit fjal&euml;kalimin</label>
			    				<input type="password" class="form-control" name="password2" id="password2" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-3">
			    				<label class="control-label" for="tel">Nr. telefonit</label>
			    				<input type="tel" name="tel" id="tel" value="'.$perdorues->getTel().'" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-3">
			    				<label class="control-label" for="qyteti">Qyteti</label>
			    				<input type="text" name="qyteti" id="qyteti" value="'.$perdorues->getQyteti().'" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-4">
			    				<label class="control-label" for="adresa">Adresa</label>
			    				<input type="text" name="adresa" id="adresa" value="'.$perdorues->getRruga().'" class="form-control"/>
			    			</div>
			    			<div class="form-group col-md-2">
			    				<label class="control-label" for="niveli">Niveli</label>
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
			    			<div class="row">
			    				<div class="col-md-4 col-md-offset-4 form-group has-error">
			    					<label class="control-label" for="password_old">Fjalekalimi juaj</label>
			    					<input type="password" name="password_old" class="form-control" id="password_old"/>
			    				</div>
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
			if(strlen(trim($_POST['emri_p'])) >2){
				$id = $_POST['id_p'];
				$p_id = $_SESSION['p_id'];
				$old_psw = $lidhja->real_escape_string($_POST['password_old']);
				$kontrolla = $lidhja->query("SELECT id FROM perdoruesit WHERE id=$p_id AND password='$old_psw' LIMIT 1");
				if($kontrolla->num_rows == 1){

				}
				else{
					header('Location: index.php?faqja=menaxhimi&mesazhi=perdorues1');
					die();
				}
				$emri = $lidhja->real_escape_string($_POST['emri_p']);
				$mbiemri = $lidhja->real_escape_string($_POST['mbiemri_p']);
				$username = $lidhja->real_escape_string($_POST['username']);
				$email = $lidhja->real_escape_string($_POST['email']);
				$tel = $lidhja->real_escape_string($_POST['tel']);
				$qyteti = $lidhja->real_escape_string($_POST['qyteti']);
				$adresa = $lidhja->real_escape_string($_POST['adresa']);
				$niveli = $lidhja->real_escape_string($_POST['niveli']);
				if(!empty($_POST['password']) && !empty($_POST['password2']) && strlen($_POST['password']) > 5) {
					$pass1 = $lidhja->real_escape_string($_POST['password']);
					$pass2 = $lidhja->real_escape_string($_POST['password2']);
					if($pass1===$pass2){
						$sql = "UPDATE perdoruesit SET username='$username',emri='$emri',mbiemri='$mbiemri',email='$email',password='$pass1',tel='$tel',qyteti='$qyteti',rruga='$adresa',niveli='$niveli' WHERE id=$id";
					}
				}
				else{
					$sql = "UPDATE perdoruesit SET username='$username',emri='$emri',mbiemri='$mbiemri',email='$email',tel='$tel',qyteti='$qyteti',rruga='$adresa',niveli=$niveli WHERE id=$id";
				}
				if($lidhja->query($sql)){
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
			        			if($profesoret = Profesor::getProfesoret('T')){
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
					$emri_fk = htmlentities($lidhja->real_escape_string($_POST['shto_emri_fk']));
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
					$emri_d = htmlentities($lidhja->real_escape_string($_POST['shto_emri_d']));
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
					&& ($_POST['shto_password_p'] == $_POST['shto_password_p2']))
				{
					$emri_p = htmlentities($lidhja->real_escape_string($_POST['shto_emri_p']));
					$mbiemri_p = htmlentities($lidhja->real_escape_string($_POST['shto_mbiemri_p']));
					$user = $lidhja->real_escape_string($_POST['shto_username_p']);
					$pass = $lidhja->real_escape_string($_POST['shto_password_p']);
					$email = $lidhja->real_escape_string($_POST['shto_email_p']);
					$tel = $lidhja->real_escape_string($_POST['shto_tel_p']);
					$qyteti = htmlentities($lidhja->real_escape_string($_POST['shto_qyteti_p']));
					$rruga = htmlentities($lidhja->real_escape_string($_POST['shto_adresa_p']));
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
		/*
			Per te ndryshuar nje lajm
		*/
		if(!empty($_GET['ndrysholajm']) && is_numeric($_GET['ndrysholajm'])){
			$id = $lidhja->real_escape_string($_GET['ndrysholajm']);
			$lajmi = new Lajmi($id);
			$foto = $lajmi->getFoto(); // linku i fotos vjeter
			$titulli = htmlentities($lidhja->real_escape_string($_POST['titulli']));
			$body = htmlentities($lidhja->real_escape_string($_POST['permbajtja']));

			$telejuara = array("gif", "jpeg", "jpg", "png", "PNG", "JPG", "JPEG");
			$temp = explode(".", $_FILES["fotografia"]["name"]);
			$extension = end($temp);

				if ((($_FILES["fotografia"]["type"] == "image/gif")
					|| ($_FILES["fotografia"]["type"] == "image/jpeg")
					|| ($_FILES["fotografia"]["type"] == "image/jpg")
					|| ($_FILES["fotografia"]["type"] == "image/pjpeg")
					|| ($_FILES["fotografia"]["type"] == "image/x-png")
					|| ($_FILES["fotografia"]["type"] == "image/png"))
					&& ($_FILES["fotografia"]["size"] < 2000000)
					&& in_array($extension, $telejuara))
				{
					if ($_FILES["fotografia"]["error"] > 0)
					  {
						  header('Location: index.php?faqja=lajmet&mesazhi=lajm_foto1');
						  die();
					  }
					else
					{
						unlink('../'.$foto);
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
				} // perfundon if i fotografis
			if($lidhja->query("UPDATE lajmet SET titulli='$titulli',body='$body',foto='$foto' WHERE id=$id")){
				header('Location: index.php?faqja=lajmet&mesazhi=lajmet0');
				die();
			}
			else{
				header('Location: index.php?faqja=lajmet&mesazhi=lajmet1');
				die();
			}
		}
		/*
			Per te ndryshuar lenden
		*/
		if(!empty($_GET['ndryshoLende']) && is_numeric($_GET['ndryshoLende'])){
			$id = $lidhja->real_escape_string($_GET['ndryshoLende']);
			$lenda = new Lenda($id);
			echo '
				<form action="menaxhimi.php?ndryshoL='.$id.'" method="POST" role="form">
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Ndrysho l&euml;nd&euml;n</h4>
			    	</div>
			    	<div class="modal-body">
			    		<div class="row">
			    			<div class="form-group col-md-12">
			    				<label for="emri">Emri</label>
			    				<input type="text" class="form-control" value="'.$lenda->getEmri().'" name="emri" id="emri" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-6">
				    			<label for="drejtimi" class="control-label">Drejtimi</label>
			    				<select name="drejtimi" class="form-control" id="drejtimi">';
			    				if($drejtimet = getDrejtimet(0)){
			    					foreach($drejtimet as $d){
			    						if($d['id'] == $lenda->getDrejtimi()){
			    							echo '<option selected value="'.$d['id'].'">'.$d['emri'].'</option>';
			    						}
			    						else{
			    							echo '<option value="'.$d['id'].'">'.$d['emri'].'</option>';
			    						}
			    					}
			    				}
				echo'			</select>
							</div>
							<div class="form-group col-md-6">
				    			<label for="profesori" class="control-label">Profesori</label>
			    				<select name="profesori" class="form-control" id="profesori">';
			    				if($profesoret = Profesor::getProfesoret('T')){
			    					foreach($profesoret as $p){
			    						if($p['id'] == $lenda->getProfID()){
			    							echo '<option selected value="'.$p['id'].'">'.$p['emri'].' '.$p['mbiemri'].'</option>';
			    						}
			    						else{
			    							echo '<option value="'.$p['id'].'">'.$p['emri'].' '.$p['mbiemri'].'</option>';
			    						}
			    					}
			    				}
				echo'			</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-2">
								<label for="semestri" class="control-label">Semestri</label>
								<input type="number" class="form-control" name="semestri" id="semestri" value="'.$lenda->getSemestri().'"/>
							</div>
							<div class="form-group col-md-2">
								<label for="kredi" class="control-label">Kredi</label>
								<input type="number" class="form-control" name="kredi" id="kredi" value="'.$lenda->getKredi().'"/>
							</div>
							<div class="form-group col-md-3">
				    			<label for="lloji" class="control-label">Lloji</label>
				    			<select name="lloji" id="lloji" class="form-control">';
				    			if($lenda->getLloji() == 'O'){
				    				echo '<option selected value="O">Obligative</option>
				    				<option value="Z">Zgjedhore</option>';
				    			}
				    			else{
				    				echo '<option value="O">Obligative</option>
				    				<option selected value="Z">Zgjedhore</option>';
				    			}
				echo'  			</select>
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
			Nese eshte ndryshuar lenda
		*/
		if(!empty($_GET['ndryshoL']) && is_numeric($_GET['ndryshoL'])){
			$id = $lidhja->real_escape_string($_GET['ndryshoL']);
			if(strlen(trim($_POST['emri']))>3){
				$emri = htmlentities(trim($lidhja->real_escape_string($_POST['emri'])));
				$drejtimi = $lidhja->real_escape_string($_POST['drejtimi']);
				$profesori = $lidhja->real_escape_string($_POST['profesori']);
				$semestri = $lidhja->real_escape_string($_POST['semestri']);
				$kredi = $lidhja->real_escape_string($_POST['kredi']);
				$lloji = $lidhja->real_escape_string($_POST['lloji']);
				if($lidhja->query("UPDATE lendet SET emri='$emri', drejtimi=$drejtimi, semestri=$semestri, kredi=$kredi, p_id=$profesori, lloji='$lloji' WHERE id=$id")){
					header('Location: index.php?faqja=lendet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndrysholende0');
					die();
				}
				else{
					header('Location: index.php?faqja=lendet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndrysholende1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=lendet&drejtimi='.$_SESSION['d_id'].'&mesazhi=ndrysholende1');
				die();
			}
		}
		/*
			Per te shtuar nje lende
		*/
		if(!empty($_GET['shto']) && $_GET['shto']==="lende"){
			$emri = htmlentities($lidhja->real_escape_string($_POST['emri']));
			$drejtimi = $lidhja->real_escape_string($_POST['drejtimi']);
			$semestri = $lidhja->real_escape_string($_POST['semestri']);
			$kredi = $lidhja->real_escape_string($_POST['kredi']);
			$profesori = $lidhja->real_escape_string($_POST['profesori']);
			$lloji = $lidhja->real_escape_string($_POST['lloji']);
			if($lidhja->query("INSERT INTO lendet VALUES('','$emri',$drejtimi,$semestri,$kredi,$profesori,'$lloji')")){
				header('Location: index.php?faqja=lendet&drejtimi='.$_SESSION['d_id'].'&mesazhi=shtolende0');
				die();
			}
			else{
				header('Location: index.php?faqja=lendet&drejtimi='.$_SESSION['d_id'].'&mesazhi=shtolende1');
				die();
			}
		}
		/*
			Per te ndryshuar profesorin
		*/
		if(!empty($_GET['ndryshoProf']) && is_numeric($_GET['ndryshoProf'])){
			$id = $lidhja->real_escape_string($_GET['ndryshoProf']);
			$prof = new Profesor($id);
			$rolet = array('R' => 'I rregullt', 'A'=>'Asistent', 'L'=> 'Ligj&euml;rues', 'S'=>'Asociuar');
			echo '
				<form action="menaxhimi.php?ndryshoP='.$id.'" method="POST" role="form">
					<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">Ndrysho profesorin</h4>
			    	</div>
			    	<div class="modal-body">
			    		<div class="row">
			    			<div class="form-group col-md-6">
			    				<label for="emri">Emri</label>
			    				<input type="text" class="form-control" value="'.$prof->getEmri().'" name="emri" id="emri" />
			    			</div>
			    			<div class="form-group col-md-6">
			    				<label for="mbiemri">Mbiemri</label>
			    				<input type="text" class="form-control" value="'.$prof->getMbiemri().'" name="mbiemri" id="mbiemri" />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="form-group col-md-6">
			    				<label for="email"><span class="glyphicon glyphicon-envelope"></span>  e-mail</label>
			    				<input type="email" class="form-control" value="'.$prof->getEmail().'" name="email" id="email" />
			    			</div>
			    			<div class="form-group col-md-3">
			    				<label for="lloji" class="control-label"><span class="glyphicon glyphicon-bookmark"></span> Roli</label>
			    				<select name="lloji" id="lloji" class="form-control">';
			    				foreach($rolet as $shkronja=>$dmth){
			    					if($shkronja == $prof->getLloji()){
			    						echo '<option selected value="'.$shkronja.'">'.$dmth.'</option>';
			    					}
			    					else{
			    						echo '<option value="'.$shkronja.'">'.$dmth.'</option>';
			    					}
			    				}
			    echo'			</select>
			    			</div>
			    			<div class="form-group col-md-3">
					    		<label for="gjinia" class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Gjinia</label>
					    		<select name="gjinia" id="gjinia" class="form-control">';
					    		if($prof->getGjinia() == 'M'){
					    			echo '<option selected value="M">M</option>
					    			<option value="F">F</option>';
					    		}
					    		else{
					    			echo '<option value="M">M</option>
					    			<option selected value="F">F</option>';
					    		}
					    			
				echo'    		</select>
					    	</div>
			    		</div>
			    		<div class="row">
						    	<div class="form-group col-md-7">
						    		<label for="lokacioni" class="control-label"><span class="glyphicon glyphicon-home"></span> Lokacioni</label>
						    		<input type="text" name="lokacioni" value="'.$prof->getLokacioni().'" id="lokacioni" class="form-control" />
						    	</div>
						    	<div class="form-group col-md-5">
						    		<label for="tel" class="control-label"><span class="glyphicon glyphicon-earphone"></span> Tel.</label>
						    		<input type="text" name="tel" id="tel" value="'.$prof->getTel().'" class="form-control" />
						    	</div>
			    		</div>
			    		<div class="row">
					    	<div class="form-group col-md-6">
					    		<label for="password" class="control-label"><span class="glyphicon glyphicon-lock"></span> Fjal&euml;kalimi</label>
					    		<input type="password" autocomplete="off" name="password" id="password" class="form-control" />
					    	</div>
					    	<div class="form-group col-md-6">
					    		<label for="password1" class="control-label"><span class="glyphicon glyphicon-lock"></span> P&euml;rs&euml;rit fjal&euml;kalimin</label>
					    		<input type="password" name="password1" id="password1" class="form-control" />
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
			Nese eshte ndryshuar profesori
		*/
		if(!empty($_GET['ndryshoP']) && is_numeric($_GET['ndryshoP'])){
			$id = $lidhja->real_escape_string($_GET['ndryshoP']);
			$emri = $lidhja->real_escape_string($_POST['emri']);
			$mbiemri = $lidhja->real_escape_string($_POST['mbiemri']);
			$email = $lidhja->real_escape_string($_POST['email']);
			$lloji = $lidhja->real_escape_string($_POST['lloji']);
			$gjinia = $lidhja->real_escape_string($_POST['gjinia']);
			$lokacioni = $lidhja->real_escape_string($_POST['lokacioni']);
			$tel = $lidhja->real_escape_string($_POST['tel']);
			if(strlen($_POST['password'])>0 && strlen($_POST['password1'])>5 && $_POST['password'] === $_POST['password1']){
				$pass = $lidhja->real_escape_string($_POST['password']);
				$sql = "UPDATE profesoret SET emri='$emri', mbiemri='$mbiemri', email='$email',password='$pass',lloji='$lloji',gjinia='$gjinia',lokacioni='$lokacioni',tel='$tel' WHERE id=$id";
			}
			else{
				$sql = "UPDATE profesoret SET emri='$emri', mbiemri='$mbiemri', email='$email',lloji='$lloji',gjinia='$gjinia',lokacioni='$lokacioni',tel='$tel' WHERE id=$id";
			}
			if($lidhja->query($sql)){
				header('Location: index.php?faqja=profesoret&lloji='.$_SESSION['ch'].'&mesazhi=ndryshoprof0');
				die();
			}
			else{
				header('Location: index.php?faqja=profesoret&lloji='.$_SESSION['ch'].'&mesazhi=ndryshoprof1');
				die();
			}
		}
		/*
			Per te shtuar nje profesor
		*/
		if(!empty($_GET['shto']) && $_GET['shto']==="profesor"){
			if(strlen($_POST['password'])>0 && strlen($_POST['password1'])>5 && $_POST['password'] === $_POST['password1']){
			$emri = $lidhja->real_escape_string($_POST['emri']);
			$mbiemri = $lidhja->real_escape_string($_POST['mbiemri']);
			$email = $lidhja->real_escape_string($_POST['email']);
			$lloji = $lidhja->real_escape_string($_POST['lloji']);
			$gjinia = $lidhja->real_escape_string($_POST['gjinia']);
			$lokacioni = $lidhja->real_escape_string($_POST['lokacioni']);
			$tel = $lidhja->real_escape_string($_POST['tel']);
			$pass = $lidhja->real_escape_string($_POST['password']);
				if($lidhja->query("INSERT INTO profesoret VALUES ('','$emri','$mbiemri','$email','$pass','$lloji','$gjinia','$lokacioni','$tel','img/fakultet/profesore/profil/default.png')")){
					header('Location: index.php?faqja=profesoret&lloji='.$_SESSION['ch'].'&mesazhi=shtoprof0');
					die();
				}
				else{
					header('Location: index.php?faqja=profesoret&lloji='.$_SESSION['ch'].'&mesazhi=shtoprof1');
					die();
				}
			}
			else{
				header('Location: index.php?faqja=profesoret&lloji='.$_SESSION['ch'].'&mesazhi=shtoprof1');
				die();
			}
			
		}
?>
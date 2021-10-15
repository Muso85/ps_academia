<!DOCTYPE html>
<?php include('config/config.php'); ?>
<?php include('serveur/db.php'); ?>

<?php 

session_start();

include("header.php");




if (isset($_POST['save'])){
	
	/*$_SESSION['success'] = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<i class='fa fa-ban-circle'></i><strong>Genial  : </br></strong>Image etablie avec success</div>";
	
	file_put_contents('serveur/log.txt', "\r\nErreur de modification  ".$target." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);
	*/
	
	$noms = $_POST['noms'];
	$sexe = $_POST['sexe'];
	$lieudenaissance = $_POST['lieudenaissance'];
	$datedenaissance = $_POST['datenaissance'];
	$adresse = $_POST['adresse'];
	$nationalite= $_POST['nationalite'];
	$telephone = $_POST['telephone'];
	$maladie = $_POST['maladie'];
	$matricule = $_POST['matricule'];
	$promotion = $_POST['promotion'];
	$autreinfo = $_POST['autreinfo'];
	$nompere = $_POST['nompere'];
	$nommere = $_POST['nommere'];
	$responsable = $_POST['responsable'];
	$telephoneresponsable = $_POST['telephoneresponsable'];
	$tuteur = $_POST['tuteur'];
	$anneeacademique = $anneeacademique;
	$etat = "ACTIVE";
	$dateop = date('Y-m-d h:i:sa');
	$img= "images/temp.PNG";
			
		
	$errors="";
	
	$check=$db->prepare("SELECT * FROM etudiants WHERE matricule=? AND anneeacademique=?");
	$check->execute(array($matricule,$anneeacademique));
	$nbr_check = $check->rowCount();
	
	if ($nbr_check==1){
		$_SESSION['success'] = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<i class='fa fa-ban-circle'></i><strong>Avertissement  : </br></strong>Ce Matricule existe déjà !</div>";
		file_put_contents('serveur/log.txt', "\r\nMatricule deja existant  ".$maricule."  dans l annee academique ".$anneeacademique."le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);

		}
		else{
			
			$insert=$db->prepare("INSERT INTO etudiants (id,noms,sexe,lieudenaissance,datenaissance,adresse,nationalite,telephone,maladie,matricule,promotion,autreinfo,nompere,nommere,responsable,telephoneresponsable,tuteur,anneeacademique,etat,dateop,img) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

			
			$insert->execute(array($noms,$sexe,$lieudenaissance,$datedenaissance,$adresse,$nationalite,$telephone,$maladie,$matricule,$promotion,$autreinfo,$nompere,$nommere,$responsable,$telephoneresponsable,$tuteur,$anneeacademique,$etat,$dateop,$img));
			
			if ($insert){
				
					$_SESSION['success'] = "<div class='alert alert-success'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<i class='fa fa-ban-circle'></i><strong>Genial  : </br></strong>Un etudiant ajouter avec success !</div>";
					
					file_put_contents('serveur/log.txt', "\r\nNouvelle etudiant ajouter  ".$maricule." - ".$noms. "  dans l'année academique ".$anneeacademique."le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);
					
					$message = "INSCRIPTION CONFIRMER  ".$noms." MATRICULE ".$matricule." # ".$promotion." # ".$anneeacademique." #  ".$nomunive ."  SERVICE D'ADMISSION" ;
					$messageresponsable = "SALUTATION  ".$responsable." VOUS ETES RESPOSABLE DE ".$noms." # ".$matricule." # ".$promotion." # ".$nomunive ." # MERCI SERVICE D'ADMISSION" ;
					
					
			if($modNotification == "TRUE"){ 
			
				?>
					<script>
			
					function notifieretudiant(){

						const tel = encodeURI("<?php echo $telephone; ?>");
						const msg = encodeURI("<?php echo $message; ?>");
						
						console.log(tel);
						//const url="https://api.twilio.com/2010-04-01/Accounts/AC5490d9e2dce15ccc95630ae46af5a3a3/Messages.json";
						//const auth ="AC5490d9e2dce15ccc95630ae46af5a3a3:2352280e9cc9ea0241583b644f18d6e1";
											const url="https://api.twilio.com/2010-04-01/Accounts/AC22456ee9430762d812f26d0ffdbef435/Messages.json";
											const auth ="AC22456ee9430762d812f26d0ffdbef435:0e4da6717a810cc1ed3461943b7aa281";

							const myHeader = new Headers({
								'Content-Type':'application/x-www-form-urlencoded',
								'Authorization':'Basic ' + btoa(auth)
							});

							const init = {
								method:'POST',
								headers: myHeader,
								mode:'cors',
								body:"To="+tel+"&From=iRealise&Body="+msg
								
							}

							fetch(url,init)
							.then(response => console.log(response))
							.catch(error =>console.log(error));

							}
					</script>
			
				<?PHP
				echo '<script> notifieretudiant(); </script>';
				file_put_contents('serveur/log.txt', "\r\nMessage envoye a l'étudiant  ".$maricule." - ".$noms. " - " .$telephone. " - " .$message. " |  dans l'année academique ".$anneeacademique." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);
				sleep(3);
			
			 }//fin modMessage
			
			
			
			
			 // resposable
			 if($modNotification == "TRUE"){ 
			
				?>
					<script>
			
					function notifierresponsable(){

						const tel = encodeURI("<?php echo $telephoneresponsable; ?>");
						const msg = encodeURI("<?php echo $messageresponsable; ?>");
						
						console.log(tel);
						//const url="https://api.twilio.com/2010-04-01/Accounts/AC5490d9e2dce15ccc95630ae46af5a3a3/Messages.json";
						//const auth ="AC5490d9e2dce15ccc95630ae46af5a3a3:2352280e9cc9ea0241583b644f18d6e1";

											const url="https://api.twilio.com/2010-04-01/Accounts/AC22456ee9430762d812f26d0ffdbef435/Messages.json";
											const auth ="AC22456ee9430762d812f26d0ffdbef435:0e4da6717a810cc1ed3461943b7aa281";

							const myHeader = new Headers({
								'Content-Type':'application/x-www-form-urlencoded',
								'Authorization':'Basic ' + btoa(auth)
							});

							const init = {
								method:'POST',
								headers: myHeader,
								mode:'cors',
								body:"To="+tel+"&From=iRealise&Body="+msg
								
							}

							fetch(url,init)
							.then(response => console.log(response))
							.catch(error =>console.log(error));

							}
					</script>
			
				<?PHP
				echo '<script> notifierresponsable(); </script>';
				file_put_contents('serveur/log.txt', "\r\nMessage envoye au responsable  ".$responsable." - ".$telephoneresponsable. " - " .$messageresponsable. " |  dans l'année academique ".$anneeacademique." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);
				sleep(5);
				
			 }//fin modMessage 2
			 
			 
			}// fin insert
		}
					
	
	
}



 ?>


    
 <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Inscription</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">HOME</a></li>
									<li class="breadcrumb-item active" aria-current="page">INSCIPTION</li>
								</ol>
							</nav>
						</div>
						
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<?php echo $anneeacademique; ?>
								</a>
							
							</div>
						</div>
					</div>
				</div>
				
				
				
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30 ">
    

				
			
				
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Nouvel étudiant</h4>
						<p class="mb-30">Inscription en ligne</p>
						
							<?php  if(isset($_SESSION['success'])){ 
							echo $_SESSION['success']; 
							$_SESSION['success']="";
							} 
							 ?>
				 
					</div>
					<div class="wizard-content">
						<form class="tab-wizard wizard-circle wizard" action="inscription.php" method="POST">
							<h5>Informations </h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label >Noms <span class="text-danger">*</span> :</label>
											<input type="text" name = "noms" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label >Sexe <span class="text-danger">*</span> :</label>
											<select  class="custom-select form-control" name="sexe">
												<option>Masculin</option>
												<option>Feminin</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Lieu de naiassance <span class="text-danger">*</span> :</label>
											<input type="text" name = "lieudenaissance" onkeyup="this.value = this.value.toUpperCase();" class="form-control" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date de naissance <span class="text-danger">*</span> :</label>
											<input type="date" name="datenaissance" class="form-control" required>
										</div>
									</div>
								</div>
								<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label >Adresse :</label>
											<input type="text" name="adresse" onkeyup="this.value = this.value.toUpperCase();" class="form-control " >
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label >Nationalité :</label>
											<input type="text" name="nationalite" onkeyup="this.value = this.value.toUpperCase();" class="form-control " >
										</div>
									</div>
								</div>
								
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label >Téléphone <span class="text-danger">*</span> :</label>
											<input type="text" name="telephone"  class="form-control " value="+243" required>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label >Maladie ou alergie :</label>
											<input type="text" name="maladie" onkeyup="this.value = this.value.toUpperCase();" class="form-control "  >
										</div>
									</div>
								</div>
							</section>
							<!-- Step 2 -->
							<h5>Affectation</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Matricule <span class="text-danger">*</span> :</label>
											<input type="text" name="matricule" onkeyup="this.value = this.value.toUpperCase();" placeholder="<?php echo $initialMatricule; ?>XXXX" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<label >Promotion <span class="text-danger">*</span> :</label>
										<select  data-live-search="true" class="selectpicker form-control" name="promotion">
										<?php
											$selpromotion=$db->prepare("SELECT * FROM auditoire WHERE anneeacademique='".$anneeacademique."'");
											$selpromotion->execute();
											while($data=$selpromotion->fetch()){
										?>
											
												<option><?PHP echo $data['designation']; ?></option>
											<?php } ?>
												
										</select>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Autres informations :</label>
											<textarea class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="autreinfo"></textarea>
										</div>
									</div>
								</div>
							</section>
							<!-- Step 3 -->
							<h5>Contact resposables</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nom Père :</label>
											<input type="text" name="nompere" onkeyup="this.value = this.value.toUpperCase();" class="form-control">
										</div>
										
										<div class="form-group">
											<label>Nom Mère :</label>
											<input type="text" name="nommere" onkeyup="this.value = this.value.toUpperCase();" class="form-control">
										</div>
										
										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Resposable financier :</label>
											<input type="text" name="responsable" onkeyup="this.value = this.value.toUpperCase();" class="form-control">
										</div>
										<div class="form-group">
											<label>Téléphone :</label>
											<input type="text" name="telephoneresponsable"  value="+243" class="form-control" required>
										</div>
									</div>
								</div>
							</section>
							<!-- Step 4 -->
							<h5>Complémentaires</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Tuteur :</label>
											<input type="text" name="tuteur" onkeyup="this.value = this.value.toUpperCase();" class="form-control">
										</div>
										<div class="form-group">
											<label>Etat</label>
											<input type="text" name="etat" value="Active" class="form-control" disabled>
										</div>
										<div class="form-group">
											<label>Date du jour</label>
											<input type="text" name="dateop" value="<?php echo date('Y-m-d  h:i:sa');?>" class="form-control" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Année academique</label>
											<input type="text" name="anneeacademique" value="<?php echo $anneeacademique;?>" class="form-control" disabled>
										</div>
										
										<div class="form-group">
											
											<input type="submit" name="save" value="ENREGISTRER"  class="form-control btn btn-success block" >
										</div>
										
									</div>
								</div>
							</section>
						</form>
					</div>
				</div>

		
				
				
				
				
				
				
				
				</div>

	
	
	
	
	
	
	
	
<?php include("footer.php"); ?>
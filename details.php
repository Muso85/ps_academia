<!DOCTYPE html>
<?php include('config/config.php'); ?>
<?php include('serveur/db.php');

include 'config/enlettre.php';

 ?>


<?php 

session_start();

include("header.php");








 ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    -->
	  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/profil.css">
<style>
#show_up{
	
	display: none;
}

</style>


 <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			
			
				
				<?PHP
						if(isset($_GET['matricule'])){
							$_SESSION['etudiant']= $_GET['matricule'];
							$etudiant= $_SESSION['etudiant'];
						}else{
							$etudiant= $_SESSION['etudiant'];
							}
						
					$SelEtudiant = $db->prepare("SELECT * FROM etudiants WHERE matricule='".$etudiant."' AND anneeacademique='".$anneeacademique."'");
					$SelEtudiant->execute();
					
					While($data=$SelEtudiant->fetch()){
						$noms = $data['noms'];
						$sexe = $data['sexe'];
						$lieudenaissance = $data['lieudenaissance'];
						$datedenaissance = $data['datenaissance'];
						$adresse = $data['adresse'];
						$nationalite= $data['nationalite'];
						$telephone = $data['telephone'];
						$maladie = $data['maladie'];
						$matricule = $data['matricule'];
						$promotion = $data['promotion'];
						$autreinfo = $data['autreinfo'];
						$nompere = $data['nompere'];
						$nommere = $data['nommere'];
						$responsable = $data['responsable'];
						$telephoneresponsable = $data['telephoneresponsable'];
						$tuteur = $data['tuteur'];
						
						$etat = $data['etat'];
						$dateop = $data['dateop'];
						$img= $data['img'];
					}
				?>
			
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30 " id="contentPrint">
				<?php if ($sexe=="Masculin"){echo '<h3 class="text text-center"> RESUME DE L\'ETUDIANT | '.date('Y-m-d  h:i:sa').'</H3>';} ?>
				<?php if ($sexe=="Feminin"){echo '<h3 class="text text-center"> RESUME DE L\'ETUDIANTE | '.date('Y-m-d  h:i:sa').' </H3>';} ?>
				
					
			
<div class="container">
    <div class="main-body">
					
				<?php  if(isset($_SESSION['success'])){ 
				echo $_SESSION['success']; 
				//$_SESSION['successp']="";
				} 
				 ?>
				 
				<?php  if(isset($_SESSION['successp'])){ 
				echo $_SESSION['successp']; 
				//$_SESSION['successp']="";
				} 
				 ?>
				 
					 <script>
						 function printDiv(divName) {
						 var printContents = document.getElementById(divName).innerHTML;
						 var originalContents = document.body.innerHTML;

						 document.body.innerHTML = printContents;

						 window.print();

						 document.body.innerHTML = originalContents;
					}
				</script>
				
				<style type="text/css" media="print">
				@page 
				{
				size: auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
				}
				</style>
				
          <!-- /Breadcrumb -->
		  
    
          <div class="row gutters-sm">
			
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
				  <style>
					#imageetudiant{
						width:256px;
						height: 256px;
						}
				  </style>
				  
	
                   <span class="user-icon"> <img src="<?php echo $img; ?>"  class="img img-resposive rounded"  > </span>
                    <div class="mt-3">
                      <h6><?php echo $noms; ?></h6>
                      <p class="text-secondary mb-1"><?php echo $promotion; ?></p>
               
                      <a class="btn btn-primary" data-toggle="modal" data-target="#changeimgetudiant">EDITER</a>
					  <?php if($modNotification=="TRUE"){ ?>
                      <button class="btn btn-outline-primary">MESSAGE</button>
                      <button class="btn btn-outline-success" onclick="printDiv('contentPrint');"><i class="fa fa-print"></i></button>
					  <?php } ?>
					  
					  <?php 
							$gettotal = $db->prepare('SELECT * FROM auditoire WHERE designation=? AND anneeacademique=?');
							$gettotal->execute(array($promotion,$anneeacademique));
							while($dataaudi=$gettotal->fetch()){
								$totalannuel = $dataaudi['montant'];
								}
					  ?>
					  <p class="text-secondary mb-1">TOTAL ANNUEL EST DE  <?php echo $totalannuel ; ?> USD</p>
                    </div>
                  </div>
                </div>
              </div>
           </div>
		   
		     
          <!-- /Breadcrumb -->
		   
		   
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">NOMS COMPLET</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $noms; ?>
                    </div>
                  </div>
                  <hr>
                
                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">TELEPHONE</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $telephone; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">RESPONSABLE</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $responsable; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">CONTACTS</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $telephoneresponsable; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
					
                      <a class="btn btn-primary " data-toggle="modal" data-target="#payer" href="#">PAYER FRAIS ACADEMIQUE</a>
					  
					   <a class="btn btn-success " href="#">SOLDE 45 USD</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


			<div class="row">
                <div class="col-sm-12 mb-12">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"></h6>
                        <div class="row">
      
						  <div class="col-md-12 col-lg-12">
							 <div id="tracking-pre"></div>
							 <div id="tracking">
								<div class="text-center tracking-status-intransit">
								   <p class="tracking-status text-tight">TRANSACTIONS RECENTES</p>
								</div>
								
								
								<div class="tracking-list">
								   <div class="tracking-item">
									  <div class="tracking-icon status-intransit">
										 <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
											<path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
										 </svg>
										 <!-- <i class="fas fa-circle"></i> -->
									  </div>
									  <div class="tracking-date">Aug 10, 2018<span>05:01 PM</span></div>
									  <div class="tracking-content">DESTROYEDPER SHIPPER INSTRUCTION<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
								   </div>

								</div>
							 </div>
						  </div>
					   </div>
                     
                    
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
				
				
				
				
				</div>

	
	
	
	
	
<div class="modal fade" id="payer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">PAYER FRAIS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
	  <form id="fupForm" name="form1" method="POST" action="serveur/payerfrais.php">
			<div class="md-form mb-5">
			  <label > NATURE FRAIS </label>
			  <select  data-live-search="true" class="selectpicker form-control"  name="nature">
								<option>FRAIS ACADEMIQUE</option>
								<?php
									$selpaye=$db->prepare("SELECT * FROM otherspayement WHERE anneeacademique='".$anneeacademique."'");
									$selpaye->execute();
									while($datapaye=$selpaye->fetch()){
								?>
									
										<option><?PHP echo $datapaye['designation']; ?></option>
									<?php } ?>
										
					</select>
			  <hr>
			    <label> MONTANT </label>
				 <input type="text" name="montant" id="montant" class="form-control "  onkeyup="enlettre();" placeholder="Montant" required> 
				 
			
				  <hr>
				  <label> MONTANT EN LETTRE</label>
				 <p type="text" id="enlettre"  name="enlettrepost"  >  </p>
				
				
				
			<script type="text/javascript">
				 function enlettre(){
					 var content = document.getElementById('montant').value;
					 var lettre = calcule(content);
				
					document.getElementById("enlettre").innerHTML= lettre;
				 
				 }
			</script>
				
				
				  <hr>
				  
				<label> MODE TRASANCTION </label>
				 <select  data-live-search="true" class="selectpicker form-control" id="mode" onchange="changeFunc();"  name="mode">
					<option value="CASH">CASH</option>
					<option value="BANQUE">BANQUE</option>
					<option value="CHEQUE">CHEQUE</option>
					<option value="NATURE">NATURE</option>
					<option value="MOBILEMONEY">MOBILE MONEY</option>
				</select>
				
				 <div id="banque" style="display: none" >
						<hr>
						<label> N° TRANSACTION | A FAVEUR </label>
						<input type="text" name="numtransaction"  class="form-control " onkeyup="this.value = this.value.toUpperCase();" placeholder="Transaction"> </br>

				 </div>
				  <hr>
				<label > OBSERVATIONS </label>

			  <input type="text" name="observation" class="form-control " onkeyup="this.value = this.value.toUpperCase();" placeholder="Observation"> </br>

			</div>

	

			  </div>
			  <div class="modal-footer d-flex justify-content-center">
				
				<input type="submit" name="savee" class="btn btn-primary" value="AJOUTER TRANSACTION" >
			  </div>
	  </form>
	   
		
					
				
				<script>

				jQuery(document).ready(function(){
				  $("#mode").change(function() {
					  if($(this).val() == "BANQUE" || $(this).val() == "CHEQUE"){

						  $("#banque").css('display', 'block');

					  }else{
						  $("#banque").css('display', 'none');
					  }
				  });
				});


				</script>
    </div>
  </div>
</div>


	
<?php include("footer.php"); ?>
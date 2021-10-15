<?php include('header.php'); ?>

	<?PHP
		$totaletudiant = $db->prepare("SELECT * FROM etudiants WHERE anneeacademique ='".$anneeacademique."'");
		$totaletudiant->execute();
		$nbrtotal= $totaletudiant->rowCount();
		
		$totalmale = $db->prepare("SELECT * FROM etudiants WHERE sexe='Masculin' AND anneeacademique ='".$anneeacademique."'");
		$totalmale->execute();
		$nbrtotalmale= $totalmale->rowCount();
		
		$totalfemale = $db->prepare("SELECT * FROM etudiants WHERE sexe='Feminin' AND anneeacademique ='".$anneeacademique."'");
		$totalfemale->execute();
		$nbrtotalfemale= $totalfemale->rowCount(); 
		
		$totalauditoire = $db->prepare("SELECT * FROM auditoire WHERE anneeacademique ='".$anneeacademique."'");
		$totalauditoire->execute();
		$nbrtotalauditoire= $totalauditoire->rowCount(); 

	?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Année Academique </h4>
							
						</div>
						
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
			<div class="row">
					<div class="col-md-12 col-sm-12">
					<center>	<?php if(isset($_SESSION['success'])){ echo $_SESSION['success']; $_SESSION['success']="";} ?> </center>
					</div>
			</div>
			

			<div class="row pb-10">
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo $nbrtotal; ?></div>
								<div class="font-14 text-secondary weight-500">Etudiants</div>
							</div>
							<div class="widget-icon">
								<div class="icon" > <i class="icon-copy ion-person-stalker"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo $nbrtotalmale; ?></div>
								<div class="font-14 text-secondary weight-500">Masculin</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#ffffff"><i class="icon-copy ion-male"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo $nbrtotalfemale; ?></div>
								<div class="font-14 text-secondary weight-500">Feminin</div>
							</div>
							<div class="widget-icon">
								<div class="icon"> <i class="icon-copy ion-female"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo $nbrtotalauditoire; ?></div>
								<div class="font-14 text-secondary weight-500">Auditoires</div>
							</div>
							<div class="widget-icon">
								<div class="icon"> <i class="icon-copy ion-calculator"></i>  </div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row pb-10">
				
				
				
				<div class="col-md-6 mb-20">
					<div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
						<div class="d-flex justify-content-between pb-20 text-white">
							<div class="icon h1 text-white">
								<i class="fa fa-calendar" aria-hidden="true"></i>
								<!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
							</div>
							<div class="font-14 text-right">
								<div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
								<div class="font-12">Since last month</div>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-end">
							<div class="text-white">
								<div class="font-14">Appointment</div>
								<div class="font-24 weight-500">1865</div>
							</div>
							<div class="max-width-150">
								<div id="appointment-chart"></div>
							</div>
						</div>
					</div>
					
				</div>
				
				
				
				
				
				<div class="col-md-6 mb-20">
					<div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#FFFFFF">
						
						<div class="d-flex justify-content-between align-items-end">
								
								<span class="btn btn-outline-success"> 
								Reunion de gestion  
								<a href="" class="btn btn-warning"> 
								<i class="icon-copy fa fa-bell-slash" aria-hidden="true"></i> 
								</a> 
								</span>
									

						</div>
					</div>
					
				</div>
				
			
			
			
			
			
			
			</div>

		
			<div class="card-box pb-10">
				<div class="h5 pd-20 mb-0">ETUDIANTS</div>
				 
				<table class="data-table table stripe hover nowrap">
				<?PHP
						$get_name = $db->prepare("SELECT * FROM etudiants WHERE anneeacademique=:annee");
						$get_name -> execute(array('annee'=>$anneeacademique));
					

				
				
				?>
					<thead>

						<tr>
							<th>#</th>
							<th>NOMS</th>
							
							<th>SEXE</th>
							<th>MATRICULE</th>
							<th>PROMOTION</th>
							
							<th>TELEPHONE.</th>
							<th>ETAT</th>
							<th class="datatable-nosort">ACTION</th>
						</tr>
					</thead>
					<tbody id="myTable1" style="padding:10px;">
					  <style>
					#imgstudent{
						width:90%;
						heigth: 80px;
						}
				  </style>
					<?php
						while($names = $get_name->fetch(PDO::FETCH_ASSOC)){
								
						 echo '<tr>';
						 
								   echo '<td><a href="details.php?matricule='.$names['matricule'].'"><span class="user-icon"> <img src='.$names['img'].' class="img img-resposive rounded"></span></a></td>';
						  
								   echo ' <td>
											<h7> '. $names['noms'] .'</h7><br> 
											<small class="text-muted"> '. $names['telephone'] .'</small>
										</td> ';
									echo '<td>'.$names['sexe'].'</td>';
									
								
									echo '<td>'.$names['promotion'].'</td>';
									echo '<td>'.$names['tuteur'].'</td>';
									
									echo '<td>'.$names['dateop'].'</td>';
									echo '<td>'.$names['etat'].'</td>';
									echo '<td><a href="details.php?matricule='.$names['matricule'].'" class="btn btn-primary" ><span class="fa fa-book"></span></a></td>';
									
							
							echo '</tr>'; 
			} ?>
						
					</tbody>
				</table>
				
			</div>

		




<?php include('footer.php');?>
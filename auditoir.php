<?php include('header.php'); ?>



	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Auditoire</h4>
							<button id="pay" class="btn btn-primary" data-toggle="modal" data-target="#saved" style="display: none;"  > </button>
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
			
			

		
			<div class="card-box pb-10">
			
			
				<div class="h5 pd-20 mb-0">AUDITOIRE
			
				<span class="float-right"><button class="btn btn-primary" data-toggle="modal" data-target="#addauditoire" ><span class="fa fa-plus"></span></button> </span>
				<BR><BR><BR>
				<?php
				
					if (isset($_SESSION['success'])){
						echo $_SESSION['success'];
						$_SESSION['success']="";
					}
				?>
				</div> 
				
				
				
				<table class="table table-reponsive triped">
					<thead>
						<tr>
							<th class="table-plus">#</th>
							<th>DESIGNATION</th>
							<th>TOTAL ANNUEL ($)</th>
							<th>ANNEE ACADEMIQUE</th>
														
							<th class="datatable-nosort">ACTION</th>
						</tr>
					</thead>
					<tbody>
					
					<?PHP
						$selusers=$db->prepare("SELECT * FROM auditoire ORDER BY id DESC");
						$selusers->execute();
						while($datausers=$selusers->fetch()){
					?>
						<tr>
							
							<td><?php echo $datausers['id'];?></td>
							<td><?php echo $datausers['designation'];?></td>
							<td><?php echo $datausers['montant'];?></td>
							<td><?php echo $datausers['anneeacademique'];?></td>
							
							<td>
								<div class="table-actions">
									<a href="editauditoire.php?id=<?php echo $datausers["id"]; ?>"    data-color="#e95959"><i class="dw dw-edit2"></i></a>

								</div>
							</td>
						</tr>
						<?php } ?>
						
					</tbody>
				</table>
			</div>

		








<div class="modal fade" id="addauditoire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Nouvel auditoire</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
	  <form id="fupForm" name="form1" method="POST" action="serveur/auditoire.php">
			<div class="md-form mb-5">
			  
			  <input type="text" name="designation" class="form-control " onkeyup="this.value = this.value.toUpperCase();" placeholder="Designation"> </br>
			  <input type="text" name="montant" class="form-control " placeholder="Montant annuel"> </br>

			</div>

		

			  </div>
			  <div class="modal-footer d-flex justify-content-center">
				
				<input type="submit" name="save" class="btn btn-primary" value="ENREGISTRER" >
			  </div>
	  </form>
    </div>
  </div>
</div>




	<div class="modal fade" id="saved" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body text-center font-18">
					<h3 class="mb-20">Confirmation!</h3>
					<div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
					Année ajouter avec succes
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
				</div>
			</div>
		</div>
	</div>



<?php include('footer.php');?>
<?php include('header.php'); ?>



	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Année Academique</h4>
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
			
			
				<div class="h5 pd-20 mb-0">ANNEE ACADEMIQUE
			
				<span class="float-right"><button class="btn btn-primary" data-toggle="modal" data-target="#add" ><span class="fa fa-plus"></span></button> </span>
				<BR><BR><BR>
				<?php
				
					if (isset($_SESSION['success'])){
					
						echo  $_SESSION['success'];
						$_SESSION['success']="";
					}
				?>
				</div> 
				
				
				
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th class="table-plus">#</th>
							<th>Designation</th>
							
							<th class="datatable-nosort">Actions</th>
						</tr>
					</thead>
					<tbody>
					
					<?PHP
						$selannee=$db->prepare("SELECT * FROM t_annee ORDER BY id ASC");
						$selannee->execute();
						while($data=$selannee->fetch()){
					?>
						<tr>
							
							<td><?php echo $data['id'];?></td>
							<td><?php echo $data['designation'];?></td>
							<td>
								<div class="table-actions">
									<a href="deleteannee.php?id=<?php echo $data["id"]; ?>"    data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
								</div>
							</td>
						</tr>
						<?php } ?>
						
					</tbody>
				</table>
			</div>

		








<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Nouvelle année academique</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
	  <form id="fupForm" name="form1" method="POST" action="serveur/addannee.php">
			<div class="md-form mb-5">
			  Année academique
			  <input type="text" name="designation" id="designation" class="form-control validate" placeholder="Exemple 2020-2021">
			  
			</div>

		

			  </div>
			  <div class="modal-footer d-flex justify-content-center">
				
				<input type="submit" name="save" class="btn btn-primary" value="ENREGISTRER" id="butsave">
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
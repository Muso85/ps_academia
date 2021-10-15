<?php include('header.php'); ?>



	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Utilisateurs</h4>
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
			
			
				<div class="h5 pd-20 mb-0">UTILISATEURS
			
				<span class="float-right"><button class="btn btn-primary" data-toggle="modal" data-target="#add" ><span class="fa fa-plus"></span></button> </span>
				<BR><BR><BR>
				<?php
				
					if (isset($_SESSION['success'])){
					
						echo  $_SESSION['success'];
						$_SESSION['success']="";
					}
				?>
				</div> 
				
				
				
				<table class="data-table table hover multiple-select-row nowrap">
					<thead>
						<tr>
							<th class="table-plus">#</th>
							<th>Username</th>
							<th>Password</th>
							<th>Noms</th>
							<th>Téléphone</th>
						
							<th>Rôle</th>
							<th>Etat</th>
							
							<th class="datatable-nosort">Actions</th>
						</tr>
					</thead>
					<tbody>
					
					<?PHP
						$selusers=$db->prepare("SELECT * FROM t_users ORDER BY id DESC");
						$selusers->execute();
						while($datausers=$selusers->fetch()){
					?>
						<tr>
							
							<td><?php echo $datausers['id'];?></td>
							<td><?php echo $datausers['username'];?></td>
							<td><?php echo $datausers['password'];?></td>
							<td><?php echo $datausers['noms'];?></td>
							<td><?php echo $datausers['telephone'];?></td>
				
							<td><?php echo $datausers['role'];?></td>
							<td><?php echo $datausers['etat'];?></td>
							<td>
								<div class="table-actions">
									<a href="editusers.php?id=<?php echo $datausers["id"]; ?>"    data-color="#e95959"><i class="dw dw-edit2"></i></a>
									<a href="deleteusers.php?id=<?php echo $datausers["id"]; ?>"    data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>

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
        <h4 class="modal-title w-100 font-weight-bold">Nouvel utilisateur</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
	  <form id="fupForm" name="form1" method="POST" action="serveur/addusers.php">
			<div class="md-form mb-5">
			  
			  <input type="text" name="username" class="form-control " placeholder="Username"> </br>
			  <input type="text" name="password" class="form-control " placeholder="Password"> </br>
			  <input type="text" name="noms" class="form-control " placeholder="Noms"> </br>
			  <input type="text" name="telephone" value="+243" class="form-control " placeholder="Téléphone"> </br>
			  <input type="text" name="poste"  class="form-control " placeholder="Poste"> </br>
			  <input type="text" name="role"  class="form-control " placeholder="ADMIN OU USER"> </br>
			  
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
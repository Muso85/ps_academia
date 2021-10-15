<!DOCTYPE html>
<?php include('config/config.php'); ?>
<?php include('serveur/db.php'); ?>

<?php 

session_start();

include("header.php");




if (isset($_POST['save'])){
	
	$_SESSION['success'] = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<i class='fa fa-ban-circle'></i><strong>Genial  : </br></strong>Image etablie avec success</div>";
	
	file_put_contents('serveur/log.txt', "\r\nErreur de modification  ".$target." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);

					
	
	
}



 ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    -->
	  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    	  
<style>
#show_up{
	
	display: none;
}

</style>


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
									<li class="breadcrumb-item active" aria-current="page">LISTES</li>
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
    

				<h3>SELECTION PROMOTION</h3>
				<?php  if(isset($_SESSION['success'])){ 
				echo $_SESSION['success']; 
				$_SESSION['success']="";
				
				
				} 
				 ?>
				
				<script>
				$(document).ready(function(e){
					$("#search").keyup(function(){
						$("#show_up").show();
						var text = $(this).val();
						$.ajax({
							type: 'GET',
							url: 'search.php',
							data: 'txt=' + text,
							success: function(data){
								$("#show_up").html(data);
							}
						});
					})
				});
				</script>
			<div class="row">
				<div class="col-md-6">
					<form action="getlistebypromo.php" method="POST">
					<select  data-live-search="true" class="selectpicker form-control"  name="promotion">
								<?php
									$selpromotion=$db->prepare("SELECT * FROM auditoire WHERE anneeacademique='".$anneeacademique."'");
									$selpromotion->execute();
									while($data=$selpromotion->fetch()){
								?>
									
										<option><?PHP echo $data['designation']; ?></option>
									<?php } ?>
										
					</select>
					</div>
					<div class="col-md-6">
						<input type="submit" class="btn btn-primary btn-block" value="VOIR" name="voir">
					</div>
					</form>
				</div>
								
								
					<br>
					<form class="form-horizontal form-material" method="POST" action="#">
							<div class="form-group">
								<div class="col-md-12">
									<input type="text" name="names" onkeyup="this.value = this.value.toUpperCase();" class="form-control pl-0 form-control-line" id="search" placeholder="Recherche par noms ..." /> 
								</div>
							</div>
							
							
							
							
					</form>
				
				
				
				  <div class="table m-t-40">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="border-top-0" >#</th>
										<th class="border-top-0">NOM - POST </th>
										<th class="border-top-0">SEXE</th>
										
										<th class="border-top-0">PROMOTION</th> 
										<th class="border-top-0">TUTEUR</th> 
										
										<th class="border-top-0">DATE INSC</th> 
										<th class="border-top-0">ETAT </th>
										<th class="border-top-0">ACTION</th> 
									</tr>
								</thead>
								<tbody id="show_up" >
									<span > </span >
									
									   
									
								</tbody>
							</table>
							
							
						</div>
				
				
				
				
				</div>

	
	
	
	
	
	
	
	
<?php include("footer.php"); ?>
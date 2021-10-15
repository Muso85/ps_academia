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
				
				<script>
						 function printDiv(divName) {
						 var printContents = document.getElementById(divName).innerHTML;
						 var originalContents = document.body.innerHTML;

						 document.body.innerHTML = printContents;

						 window.print();

						 document.body.innerHTML = originalContents;
					}
				</script>
				
				
				
				
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30 " id="listeetudiant">
				<style type="text/css" media="print">
				@page 
				{
				size: auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
				}
				</style>
				
				<div class="row">
					<div class="col col-md-10">
						<h3>LISTE ETUDIANTS  <?PHP echo $_POST['promotion'];?>   </h3> 
					</div>
					<div class="col col-md-2">
						<button class="btn btn-outline-success" onclick="printDiv('listeetudiant');"><i class="fa fa-print"></i></button>
					</div>
				</div>
				
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
								
								
					<br>
					
				
				
				
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
								<tbody  >
									<?php
						$get_name = $db->prepare("SELECT * FROM etudiants WHERE promotion=:promotion AND anneeacademique=:annee");
						$get_name -> execute(array('promotion'=>$_POST['promotion'], 'annee'=>$anneeacademique));
					

						while($names = $get_name->fetch(PDO::FETCH_ASSOC)){
								
						 echo '<tr>';
						 
								   echo '<td><a href="details.php?matricule='.$names['matricule'].'"><span class="user-icon"> <img src='.$names['img'].' class="img img-resposive rounded" style="whith: 50%;"></span></a></td>';
						  
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
				
				
				
				
				</div>

	
	
	
	
	
	
	
	
<?php include("footer.php"); ?>
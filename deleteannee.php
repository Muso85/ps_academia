<?php include("header.php");
session_start();
?>

<?php
$msg = "";
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$identifiant= $_SESSION['id'];
			 
			 
				 $insert = $db->prepare('DELETE FROM t_annee WHERE id=?');
				 $insert->execute(array($identifiant));

					
					$_SESSION['success'] = "<div class='alert alert-success'>
											<button type='button' class='close' data-dismiss='alert'>&times;</button>
											<i class='fa fa-ban-circle'></i><strong>Confirmation  : </br></strong>Année academique supprimé avec success</div>";
				 
					echo '<script> window.location="anneeacademique.php";</script>';

				
	} 


?>



<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Confirmation</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">HOME</a></li>
									<li class="breadcrumb-item active" aria-current="page">EFFACER UNE ANNEE</li>
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
				
				
				
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				
				
				
				<?php
					
					if (isset($_GET['id'])){
						$_SESSION['id'] = $_GET['id'];
					}
					
					echo $_SESSION['id'];
					function getannee($id){
						global $db;
						
						$data=array();
						$req=$db->prepare("SELECT * FROM t_annee WHERE id='".$id."'");
						$req->execute();
						while($resultat=$req->fetch()){
							$data['designation'] = $resultat['designation'];
							$data['id'] = $resultat['id'];
							
						}
						return $data;
					}
				   
				   $cetteannee = getannee($_SESSION['id']);
				   
				   
				   ?>
											   <H1> Voulez vous effacer l'année <b> <?php echo $cetteannee['designation']; ?> </b></H1>
											   
												
												<form class="form-material" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" Method="POST">
															<input type="hidden" name="id" value ="<?php echo $cetteannee['id']; ?>" class="form-control" >

																											
                                                            
															<div class="form-group">
                                                                <input type="submit" name="ok" value="SUPRIMER" class="btn btn-danger" >
                                                                <a href="anneeacademique.php"  class="btn btn-primary" > ANNULLE </a>
                                                                
                                                            </div>
                                                            
                                                           
                                                        </form>
                                               
				
				
				
				
				
				
				</div>
			</div>


<?php include("footer.php");?>
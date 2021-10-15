<!DOCTYPE html>
<?php include('config/config.php'); ?>
<?php include('serveur/db.php'); ?>

<?php 

session_start();

include("header.php");




if (isset($_POST['Upload'])){

	$profilimagename= time()."_".$_FILES['profilImage']['name'];
	
	$target = "images/".$profilimagename ;
	$imageFileType = $_FILES['profilImage']['type'];
	

		if ( $imageFileType == "image/png" || $imageFileType == "image/jpeg" ) {
				if (move_uploaded_file($_FILES['profilImage']['tmp_name'],$target) ){
					
					$update=$db->prepare("UPDATE t_users SET img=? WHERE username=?");
					$update->execute(array($target, $_SESSION['user']));
					$_SESSION['success'] = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<i class='fa fa-ban-circle'></i><strong>Genial  : </br></strong>Image etablie avec success</div>";
					
					file_put_contents('serveur/log.txt', "\r\nModification image vers  ".$target." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);

					header("refresh: 3; url=index.php");
				}
				else{
					$_SESSION['success'] = "<div class='alert alert-warning'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<i class='fa fa-ban-circle'></i><strong>Avertissement  : </br></strong>Image non etablie </div>";
					file_put_contents('serveur/log.txt', "\r\nErreur de modification  ".$target." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);

				}
		} else{
					$_SESSION['success'] = "<div class='alert alert-danger'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<i class='fa fa-ban-circle'></i><strong>Annulation  : </br></strong>Type non valide juste JPG ou PNG </div>";
					
					file_put_contents('serveur/log.txt', "\r\nSelection erronee de  image   ".$profilimagename." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);

		}			
	
}



 ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    -->
	
	<link href="vendors/pic.css" rel="stylesheet" >

    
 <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Modifier image de profil</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">HOME</a></li>
									<li class="breadcrumb-item active" aria-current="page">Modifier image</li>
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
				
				
				
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30 text-center">
    

				<h1>Editer image</h1>
				<?php  if(isset($_SESSION['success'])){ 
				echo $_SESSION['success']; 
				$_SESSION['success']="";
				
				
				} 
				 ?>
				
				

				
				<form action="editpicture.php" method="POST" enctype="multipart/form-data" >
					<div class="input-group mb-3">
					  <img src="images/temp.png" class="img img-responsive" onclick="triggerClick()" id ="profilDisplay">
					  <br>
					  <input type="file"  onchange="displayImage(this)" name="profilImage" id="profilImage" style="display:none;"  >
					</div>
					
					<div class="input-group mb-3 text-center">
					  
					 <input type="submit" value="Modifier Image" class="btn btn-success btn-block" name="Upload" > 
					</div>
				</form>
				
				<script>
					function triggerClick(){
						document.querySelector("#profilImage").click();
						
					}
					
					function displayImage(e){
						if(e.files[0]){
							var reader= new FileReader();
							reader.onload = function(e){
								document.querySelector("#profilDisplay").setAttribute('src', e.target.result);
							}
							reader.readAsDataURL(e.files[0]);
						}
					}
				</script>
	
	
	
	
	
	
	
	
<?php include("footer.php"); ?>
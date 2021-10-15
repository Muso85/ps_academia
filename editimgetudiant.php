<?php
include("serveur/db.php");
session_start();

if (isset($_POST['Upload'])){
	$matricule=$_POST['matricule'];
	$profilimagename= time()."_".$_FILES['profilImage']['name'];
	
	$target = "images/".$profilimagename ;
	$imageFileType = $_FILES['profilImage']['type'];
	

		if ( $imageFileType == "image/png" || $imageFileType == "image/jpeg" ) {
				if (move_uploaded_file($_FILES['profilImage']['tmp_name'],$target) ){
					
					$update=$db->prepare("UPDATE etudiants SET img=? WHERE matricule=? AND anneeacademique=?");
					$update->execute(array($target, $_SESSION['etudiant'], $_SESSION['ANNEEACADEMIQUE']));
					$_SESSION['success'] = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<i class='fa fa-ban-circle'></i><strong>Genial  : </br></strong>Image etablie avec success</div>";
					
					file_put_contents('serveur/log.txt', "\r\nModification image vers  ".$target." le ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);

					header("refresh: 3; url=details.php");
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


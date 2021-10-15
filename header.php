<!DOCTYPE html>
<?php include('serveur/db.php'); ?>
<?php include('config/config.php'); ?>
<?php include('config/nbrtolettre.php'); ?>



<?php 

session_start();

if($_SESSION['user']==""){
	header("location:login.php");
}

/*
	$selUser=$db->prepare("SELECT * FROM t_users Where username=?");
	$selUser->execute(array($_SESSION['user']));
	while($dataUser=$selUser->fetch()){
		$user = $dataUser['username'];
		$username= $dataUser['noms'];
		$userrole = $dataUser['role'];
		$imageProfil = $dataUser['img'];
		if ($imageProfil == ""){
			$imageProfil= "images/temp.PNG";
		}
	}
	

  */
  
	getUser();




$selannee=$db->prepare("SELECT * FROM t_annee ORDER BY id DESC LIMIT 1");
$selannee->execute();
while($data=$selannee->fetch()){
	$derniereanne=$data['designation'];
}

		
if($_SESSION['ANNEEACADEMIQUE'] == "" ){	
$_SESSION['ANNEEACADEMIQUE'] = $derniereanne;
$anneeacademique= $_SESSION['ANNEEACADEMIQUE'];
}else
{
	$anneeacademique= $_SESSION['ANNEEACADEMIQUE'];
}
	




 ?>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo Application::nomunive; ?></title>

	<!-- Site favicon -->
	

	
	
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="js/dataTable.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/timeline1.css">
	
	
	<link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css">

	<!-- Global site tag (gtag.js) - Google Analytics 
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>-->
	

	
	
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>

	<?php 
		// PRELOADER
		if(Application::preload=="TRUE"){
	 ?>
				<div class="pre-loader">
					<div class="pre-loader-box">
						<div class="loader-logo"><img src="<?php echo Application::logopreload; ?>" alt=""></div>
						<div class='loader-progress' id="progress_div">
							<div class='bar' id='bar1'></div>
						</div>
						<div class='percent' id='percent1'>0%</div>
						<div class="loading-text">
							Loading...
						</div>
					</div>
				</div>
		<?php } ?>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
						
						</div>
					</div>
				</form>
				
				
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
		
		
			
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"> 
					
				
						<span class="user-icon">
							<img src="<?php echo $imageProfil; ?>"  class="img img-responsive"  style="width:76px; heigth:76px;" alt="">
						</span>
						<span class="user-name"><?php echo getUser(); //$username; ?></span>
					</a>
					<?php if($userrole=="ADMIN") { ?>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="editpicture.php"  ><i class="dw dw-settings2"></i> CHANGE IMAGE PROFIL</a>

							<a class="dropdown-item" href="anneeacademique.php" ><i class="dw dw-user1"></i> AJOUTER ANNEE</a>
							
							<a class="dropdown-item" href="users.php"><i class="dw dw-user1"></i> AJOUTER UTILISATEURS</a>
							<a class="dropdown-item" href="auditoir.php"><i class="dw dw-settings2"></i> AJOUTER AUDITOIRES </a>
							<a class="dropdown-item" href="autrespayement.php"><i class="dw dw-settings2"></i> AJOUTER PAIEMENTS </a>
							<a class="dropdown-item" href="#"><i class="dw dw-settings2"></i> CONFIG  SMS</a>
							<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> DECONNEXION</a>
						</div>
					<?php } else { ?>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> MODIFIER PROFIL</a>
							<a class="dropdown-item" href="" data-toggle="modal" data-target="#changeannee" ><i class="dw dw-settings2"></i> CHANGE ANNEE ACADEMIQUE</a>
							<a class="dropdown-item" href="editpicture.php"  ><i class="dw dw-settings2"></i> CHANGE IMAGE PROFIL</a>

							<a class="dropdown-item" href="inscription.php"><i class="dw dw-settings2"></i> INCRIPTION</a>
							<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> NOTIFICATION SMS</a>
							<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> DECONNEXION</a>
						</div>
					<?php } ?>
					
					
				</div>
			</div>
			
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Parametres de vue
				<span class="btn-block font-weight-400 font-12">Interface HM</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Background enttete</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">Claire</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Foncé</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Background menu</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">Claire</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Foncé</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Icones menu</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Icon liste</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Réinitialiser</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="<?php echo  Application::logofonce; ?>" alt="" class="dark-logo">
				<img src="<?php echo  Application::logoclaire; ?>" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">TDB</span>
						</a>
						<ul class="submenu">
							<li><a href="index.php">HOME</a></li>
							
						
						</ul>
					</li>
					
					<?php if(Application::modInscription=="TRUE") { ?>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon dw dw-edit2"></span><span class="mtext">INSCRIPTION</span>
							</a>
							<ul class="submenu">
								<li><a href="inscription.php">NOUVEL ETUDIANT</a></li>
								<li><a href="getlist.php">LISTE ETUDIANT</a></li>
							
							</ul>
						</li>
					<?php } ?>
					
					
					<?php if(Application::modPaiement=="TRUE") { ?>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-money"></span> <span class="mtext">PAIEMENTS</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">RECOUVREMENT</a></li>
							<li><a href="javascript:;">EXPORTER</a></li>
							<li><a href="javascript:;">AUTRES PAIEMNT</a></li>
							
						
						</ul>
					</li>
					<?php } ?>
					
					<?php if(Application::modAgenda=="TRUE") { ?>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-calendar1"></span><span class="mtext">AGENDA</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">NOUVELLE TACHE</a></li>
							<li><a href="javascript:;">LISTE DE TACHES</a></li>
						</ul>
					</li>
					<?php } ?>
				
					<?php if(Application::modNotification=="TRUE") { ?>
					<li>
						<a href="javascript:;" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat3"></span><span class="mtext">Notifications</span>
						</a>
					</li>
					<?php } ?>
					
					<?php if(Application::modRapport=="TRUE") { ?>
					<li>
						<a href="javascript:;" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">Rapports</span>
						</a>
					</li>
					
					<?php } ?>
					
					
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit-2"></span><span class="mtext">Extractions</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">Etudiant</a></li>
							<li><a href="javascript:;">Payement</a></li>
				
						</ul>
					</li>
					<li>
						<a href="javascript:;" target="_blank" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-paper-plane1"></span>
							<span class="mtext">Mise en jour</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

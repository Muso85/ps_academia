<!DOCTYPE html>
<?PHP
include("config/config.php");
include("serveur/db.php");


session_start();

if (isset($_POST['connexion'])){
	
	$username= $_POST['username'];
	$password= $_POST['password'];
	
	$connect = $db->prepare("SELECT * FROM t_users Where username=? AND password=?");
	$connect->execute(array($username,$password));
	
	$nbruser = $connect->rowCount();
	
	while($data=$connect->fetch()){
			$user = $data['username'];
			$noms = $data['noms'];
			$role = $data['role'];
			$img = $data['img'];
	}
	if($nbruser==1){
		$_SESSION['user'] = $user;
	
		file_put_contents('serveur/log.txt', "\r\nConnexion utilisateur   ".$user."-".$noms." |  ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);
		header("Location:index.php");
								
	}else
	{
	 $_SESSION['success'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Avertissement!</strong>  Connexion non etablie.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>';
		file_put_contents('serveur/log.txt', "\r\nErreur de connexion utilisateur   ".$username." -  Psw ".$password." |  ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);
	}
}


?>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo $nomuniv; ?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.php">
					<img src="<?php echo $logopreload; ?>" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="#">CONNEXION</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?php echo $imagelogin; ?>" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">CONNEXION <?PHP echo $nomunive; ?></h2>
						</div>
						<form action="login.php" method="POST">
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="vendors/images/briefcase.svg" class="svg" alt=""></div>
										<span>Je suis</span>
										Utilisateur
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user">
										<div class="icon"><img src="vendors/images/person.svg" class="svg" alt=""></div>
										<span>Je suis</span>
										Administateur
									</label>
								</div> 
							<?php if(isset($_SESSION['success'])){ echo "<br>". $_SESSION['success']; $_SESSION['success']="";} ?> </center>

							</div>
							<div class="input-group custom">
								<input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" name="password" class="form-control form-control-lg" placeholder="**********">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="forgot-password.php">Password oublié ?</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<input type="submit" class="btn btn-primary btn-lg btn-block" value="CONNEXION" name="connexion">
									</div>
									
								</div>
							</div>
						</form>
						
						
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>
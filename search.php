<?php
session_start();
// create a new function
function search($text){
	
	// connection to the Ddatabase
	include('serveur/db.php');
	include('config/config.php');
	// let's filter the data that comes in
	$text = htmlspecialchars($text);
	// prepare the mysql query to select the users 
	$get_name = $db->prepare("SELECT * FROM etudiants WHERE noms LIKE concat('%', :name, '%') AND anneeacademique=:annee");
	// execute the query
	$get_name -> execute(array('name' => $text, 'annee'=>$_SESSION['ANNEEACADEMIQUE']));
	// show the users on the page
	while($names = $get_name->fetch(PDO::FETCH_ASSOC)){
		// show each user as a link
		//echo '<a href="">'.$names['nom'].'</a>';
		
		 echo '<tr>';
		 
				   echo '<td><a href="details.php?matricule='.$names['matricule'].'><span class="user-icon"> <img src='.$names['img'].' class="img img-resposive rounded"></span></a></td>';
		  
				   echo ' <td>
							<h7> '. $names['noms'] .'</h7> 
							<small class="text-muted"> '. $names['telephone'] .'</small>
						</td> ';
						
					echo '<td>'.$names['sexe'].'</td>';
					
				
					echo '<td>'.$names['promotion'].'</td>';
					echo '<td>'.$names['tuteur'].'</td>';
					
					echo '<td>'.$names['dateop'].'</td>';
					echo '<td>'.$names['responsable'].'</td>';
					echo '<td><a href="details.php?matricule='.$names['matricule'].'" class="btn btn-primary" ><span class="fa fa-book"></span></a></td>';
					
			
			echo '</tr>'; 
		
	}
}
// call the search function with the data sent from Ajax
search($_GET['txt']);
?>
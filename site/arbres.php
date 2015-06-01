<!DOCTYPE html>
<html>
 
	<?php
	try{
		$connexionBD=new PDO('mysql:host=<host>;dbname=<NOM DE MA BASE>;charset=utf8','<nom utilisateur>','<mon mot de passe>');
		}
		catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
		
	?>
	
	<head>
		<title>Liste des arbres</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="penguin.ico" type="image/x-icon"/> 
		<link rel="icon" href="penguin.ico" type="image/x-icon"/>
	</head>
	<body>
		<balise id="hautdepage"></balise> 
		<div id=head><h1> Protection des arbres</h1> </div>
		<div id=nav><a href="index.php">Accueil</a> &nbsp <a href="arbres.php"> Arbres </a> &nbsp <a href="protecteurs.php"> Protecteurs </a> &nbsp <a href= "ajoutarbre.php"> Ajouter des arbres </a></div>
		</br>
		<div id=corps>
			<?php
				$sql = 'SELECT distinct type_arbre, pays_foret, nom_foret FROM foret fo ,arbre ar where ar.num_arbre NOT IN (select distinct num_arbre from protection ) and ar.num_foret=fo.num_foret ORDER BY nom_foret, type_arbre ;';
				$requete1 = $connexionBD->prepare($sql);
				$requete1->execute();
				$resultats = $requete1->fetchAll(PDO::FETCH_ASSOC);
				
				$sql2='SELECT distinct count(*) From arbre ar where ar.num_arbre NOT IN (select distinct num_arbre from protection ) ;';
				$requete2= $connexionBD->prepare($sql2);
				$requete2->execute();
				$resultats2= $requete2->fetchAll(PDO::FETCH_ASSOC);
				
				echo "On doit encore protéger ";  print_r ($resultats2[0]['count(*)']); echo" arbres, parmi lesquels on trouve:";
				echo '<table><thead><tr><th>Type arbre</th><th>Nom</th><th>Pays</th></thead><tbody>';
				foreach($resultats as $num){
					echo "<tr><td>".$num["type_arbre"]."</td><td>".$num["nom_foret"]."</td><td>".$num["pays_foret"]."</td></tr>";
				}
				echo "</table>";
				echo '</tbody></table>';
			?>
		<p> Vous voulez nous aider? Vous voulez protéger des arbres? n'attendez plus! <A HREF="mailto:adressebidon42@yolo.com"> contactez nous </A> </p>
		<a href="#hautdepage"> Retourner en haut de la page </a> 
		</br>
		<p2> Ce site vous est proposé par Alexandre De Vaugelade, étudiant en IG3 de Polytech Montpellier</p2> 
		</div>
	</body>
	</html>
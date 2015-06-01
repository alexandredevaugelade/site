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
		<title>Liste des protecteurs</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="penguin.ico" type="image/x-icon"/> 
		<link rel="icon" href="penguin.ico" type="image/x-icon"/>
	</head>
	<body>
		<div id=head><h1> Protection des arbres</h1> </div>
		<div id=nav><a href="index.php">Accueil</a> &nbsp <a href="arbres.php"> Arbres </a> &nbsp <a href="protecteurs.php"> Protecteurs </a> &nbsp <a href= "ajoutarbre.php"> Ajouter des arbres </a></div>
		</br>
		<div id=corps>
			<p> Nous remercions chaleuresement nos contributeurs qui participent à la protection des forêts.</p>
			<?php
				$sql = 'SELECT distinct nom_protecteur,prenom_protecteur,pays_protecteur,nombre_protection FROM protecteur where num_protecteur IN(select distinct num_protecteur from protection) order by (nombre_protection) DESC;';
				$requete = $connexionBD->prepare($sql);
				$requete->execute();
				$resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
				
			echo '<table><thead><tr><th>Nom</th><th>Prénom</th><th>Pays</th><th>Nombre de protection</th></thead><tbody>';
			 foreach($resultats as $num)
			{
			  echo "<tr><td>".$num["nom_protecteur"]."</td><td>".$num["prenom_protecteur"]."</td><td>".$num["pays_protecteur"]."</td><td>".$num["nombre_protection"]."</td></tr>";
			}
			echo "</table>";
			 echo '</tbody></table>';
			?>
			<a href="#hautdepage"> Retourner en haut de la page </a> 
			</br>
			<p2> Ce site vous est proposé par Alexandre De Vaugelade, étudiant en IG3 de Polytech Montpellier</p2> 
		</div>
	</body>
</html>
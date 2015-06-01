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
		<title>Accueil</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="penguin.ico" type="image/x-icon"/> 
		<link rel="icon" href="penguin.ico" type="image/x-icon"/>
	</head>
	<body>
		<balise id="hautdepage"></balise> 
		<div id=head><h1> Protection des arbres</h1> </div>
		<div id=nav><a class="bouton" href="index.php">Accueil</a> &nbsp <a class="bouton" href="arbres.php"> Arbres </a> &nbsp <a class="bouton" href="protecteurs.php"> Protecteurs </a> &nbsp <a href= "ajoutarbre.php"> Ajouter des arbres </a></div>
		</br>
		<div id=corps>
			<p> Bienvenue sur notre site </p>
			<p> Ce site a pour but de vous sensibiliser aux dangers que courent les forêts. Ce site vous permet de savoir quelles forêts dans le monde ont besoin d'être protégées. Vous pourrez aussi trouver toutes les espèces d'arbre qui sont menacées.</p>
			</br>
			<P style="text-align:center"><img src="http://freethumbs.dreamstime.com/1583/big/free_15830855.jpg"></P>
			</br>
			<p> Nous protégeons actuellement: </p>

			<?php
				$sql = 'SELECT * FROM foret;';
				$requete = $connexionBD->prepare($sql);
				$requete->execute();
				$resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
				
			echo '<table><thead><tr><th>Nom de forêt</th><th>Pays forêt</th></thead><tbody>';
			foreach($resultats as $num){
				echo "<tr><td>".$num["nom_foret"]."</td><td>".$num["pays_foret"]."</td></tr>";
			}
			echo "</table>";
			echo '</tbody></table>';
			?>
			<a href="destruction.php"> signaler une destruction de forêt </a>
			</br>
			<a href="#hautdepage"> Retourner en haut de la page </a> 
			</br>
			<p2> Ce site vous est proposé par Alexandre De Vaugelade, étudiant en IG3 de Polytech Montpellier</p2> 
		</div>
	</body>
	</html>
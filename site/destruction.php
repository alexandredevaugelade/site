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
		<title>Destruction foret</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="penguin.ico" type="image/x-icon"/> 
		<link rel="icon" href="penguin.ico" type="image/x-icon"/>
	</head>
	<body>
		<balise id="hautdepage"> </balise> 
		<div id=head><h1> Protection des arbres</h1> </div>
		<div id=nav><a href="index.php">Accueil</a> &nbsp <a href="arbres.php"> Arbres </a> &nbsp <a href="protecteurs.php"> Protecteurs </a> &nbsp <a href= "ajoutarbre.php"> Ajouter des arbres </a></div>
		</br>
		<div id=corps>
			<p> si vous avez été témoin, merci de signaler la destruction d'une forêt.</p>
			<form method="post" action"destruction.php">

			<label for="pseudo">la forêt détruite<br />
			<input type="text" name="foret" id="foret" size="30" required />
			<br />
		
			<label for="pseudo"> pays de la foret détruite<br />
			<input type="text" name="paysforet" id="paysforet" size="30" required/>
			<br />
			<br />					
			<input type="submit" value="Valider" class="valider" />
			</br>
		
			<?php
			if(!empty($_POST))
			{
				
				$foret=$_POST['foret'];
				$paysforet=$_POST['paysforet'];
				$sql2='select distinct count(*) from foret where nom_foret=:foret and pays_foret=:paysforet;';
				$requete2 = $connexionBD->prepare($sql2);
				$requete2->execute(array(':foret'=>$foret,':paysforet'=>$paysforet));
				$resultat2 = $requete2->fetchAll(PDO::FETCH_ASSOC);
				if($resultat2[0]['count(*)']==1){
				$sql1='DELETE FROM foret where nom_foret=:foret AND pays_foret=:paysforet;';
				$requete1 = $connexionBD->prepare($sql1);
				$requete1->execute(array(':foret'=>$foret,':paysforet'=>$paysforet));
				$resultat1 = $requete1->fetchAll(PDO::FETCH_ASSOC);
				echo "La forêt a été retirée de notre base de données. Nous sommes déçu d'apprendre sa destruction.";	
				}
				else{
					echo "La forêt n'était pas référencée";
				}
			}
		
			?>
			</br>
			</form>
			<a href="#hautdepage"> Retourner en haut de la page </a> 
			</br>
			<p2> Ce site vous est proposé par Alexandre De Vaugelade, étudiant en IG3 de Polytech Montpellier</p2> 
		</div>
	</body>
</html>
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
		<balise id="hautdepage"></balise> 
		<title>Ajout d'arbre</title>
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
			<p> Vous pouvez ajouter ici des arbres à protéger.</p>
			<form method="post" action"ajoutarbre.php">
			<label for="pseudo">Type d'arbre à protéger<br />
			<input type="text" name="arbre" id="arbre" size="30" required/>
			<br />
			<label for="pseudo">La forêt dans laquelle se trouve l'arbre<br />
			<input type="text" name="foret" id="foret" size="30" required />
			<br />
			
			<label for="pseudo"> Pays où se trouve l'arbre<br />
			<input type="text" name="paysforet" id="paysforet" size="30" required />
			<br />
			
			<label for="pseudo">Le nombre d'abre qu'il faut protéger<br />
			<input type="number" name="nombrearbre" id="nombrearbre" size="2" min="1" max="99"/>
			<br />
							
			<br />	
						
			<input type="submit" value="Valider" class="valider" />	
			</br>
			<?php
			if(!empty($_POST))
			{
				//On doit créer les variables
				$arbre =   $_POST['arbre'];
				$foret = $_POST['foret'];
				$paysforet= $_POST['paysforet'];
				$nombrearbre=$_POST['nombrearbre'];
				$sql2='insert into foret (nom_foret,pays_foret) VALUES(:foret,:paysforet);';
				$requete2=$connexionBD->prepare($sql2);
				$requete2->execute(array(':foret'=>$foret,':paysforet'=>$paysforet));
				$sql3='select num_foret from  foret where nom_foret=:foret and pays_foret=:paysforet ;';
				$requete3 = $connexionBD->prepare($sql3);
				$requete3 ->execute(array(':foret'=>$foret,'paysforet'=>$paysforet));
				$resultat3=$requete3->fetchAll(PDO::FETCH_ASSOC);
				$idforet=($resultat3[0]['num_foret']);
				for($i=1;$i<=$nombrearbre;$i++){
				$sql1='insert into arbre(type_arbre,num_foret)VALUES(:arbre,:numforet) ;';
				$requete1 = $connexionBD->prepare($sql1);
				$requete1->execute(array(':arbre'=>$arbre,':numforet'=>$idforet));
				$resultat1 = $requete1->fetchAll(PDO::FETCH_ASSOC);}
			
				echo "Vos "; print_r($nombrearbre); echo" arbres ont été ajoutés avec succès!";
			}
			?>
			</br>
			<a href="#hautdepage"> Retourner en haut de la page </a>
			</br>
			<p2> Ce site vous est proposé par Alexandre De Vaugelade, étudiant en IG3 de Polytech Montpellier</p2> 
		</div> 
	</body>
</html>
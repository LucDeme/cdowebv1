<?php


try
{
	echo '<br />';
    $bdd = new PDO('mysql:host=localhost;dbname=bdcdoweb;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM document' );
$nom = $bdd->query('SELECT * FROM utilisateur');
$pret = $bdd->query('SELECT * FROM pret');
$tab = $reponse->fetch();
 $tab = $nom->fetch();?>
<body>   
<h2 id="titreco">Bonjour </h2>
<?php 
$iddoc = $_GET['iddoc'];
$iduser = $_GET['iduser'];
$iddoci = (int)$iddoc;
$iduseri = (int)$iduser;
var_dump($iddoci);

$strSQL = 'INSERT INTO reservation(dateReservation, idUtilisateur, idDocument) values(NOW(), "'.$iduseri.'", "'.$iddoci.'")';
	if($bdd->exec($strSQL)) {
		echo "reservation effectué<br />";
	}
	var_dump($strSQL);



?><script type='text/javascript'>document.location.replace('./compte.php');</script>
<?php
include("./menu.php");//on inclut le session start
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">Sign In</p>
                <form method="post" name="formlogin" class="login">
                	<input type="text" placeholder="Username" name="user" required />
                	<input type="password" placeholder="Password" name="password" required/>
                	<input type="submit" value="login" name="login" class="btn btn-success btn-sm" />
                </form>
            </div>
        </div>
    </div>
</div>

<?php
//CONNEXION

if (isset($_POST["login"])) // on verifie le mdp et usename
{ 
	$mdp_crypt = sha1($_POST["password"]);//on crypte le mdp
	$username = $_POST["user"];//on stock le login 
	$control = verification($mdp_crypt, $username)[0]["count(*)"];//on vérifie si il y a une correspondance
	if (intval($control) > 0)//connecté (si control est supérieur a 1)
	{ 
		echo "connecté";
		$_SESSION['estAuthentifié']=true;
		if ($_SESSION['estAuthentifié']===true)
		{
	    echo "<script type='text/javascript'>document.location.replace('./document.php');</script>";//redirection vers la page document
		}
	}
	else { //non connecté on affiche une alerte
		echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><div class='container'><div class='row justify-content-center'><div class='col-4'><div class='alert alert-danger' role='alert'>
	  Mot de passes incorect! veuillez réessayer.
	</div></div></div>" ;
	}
}



Function verification($mdp_crypt, $username)
{
		try
	{
	    $bdd = new PDO('mysql:host=localhost;dbname=bdcdoweb;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}
	$requete = "SELECT count(*) FROM `utilisateur` WHERE `emailUtilisateur` = '".$username."' and `mdpUtilisateur` = '".$mdp_crypt."'";
	$reponse = $bdd->query($requete);
	
	return $reponse->fetchAll();
}
?>
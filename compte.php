<?php
include("./menu.php");
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bdcdoweb;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM reservation, document' ); 
$nom = $bdd->query('SELECT * FROM utilisateur');
$tab = $nom->fetch();?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
        <li><a href="./document.php">Document</a></li>
        <li class="active"><a href="#">Mon Compte</a></li>
        </ul>
		<ul class="nav navbar-nav navbar-right">
        <li><a href="./deconnexion.php">Deconnexion</a></li>
      </ul>
    </div>
  </div>
</nav>
<body>   
<h2 id="titreco">Bonjour <b><?php echo $tab['nomUtilisateur'];?></b> bienvenue sur votre espace perso </h2 >
<h1 id="titreco">reservation</h1>
<table class="table" >
<br>
  <tr>
    <th>ID reservation</th>
    <th>Titre document</th>
    <th>Auteur</th>
    <th>Date reservation</th>
  </tr> 

  <?php //on affiche les ligne du tableau avec la boucle while
  while ($tabs = $reponse->fetch())
  {

  ?>

  <tr>
    <td><?php echo $tabs['idReservation'];?></td>
    <td><?php echo $tabs['titreDocument'];?></td>
    <td><?php echo $tabs['nomauteurDocument'];?></td>
    <td><?php echo $tabs['dateReservation'];?></td>
  </tr>
<?php
}
?>
</table>

</body>



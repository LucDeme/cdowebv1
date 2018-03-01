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
$reponse = $bdd->query('SELECT * FROM document group by titreDocument');
$useer = $bdd->query('SELECT * FROM utilisateur group by idUtilisateur');
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Document</a></li>
        <li><a href="./compte.php">Mon Compte</a></li>
      </ul>
<ul class="nav navbar-nav navbar-right">
        <li><a href="./deconnexion.php">Deconnexion</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<table class="table" >
<tr>
    <th><b></b></th>
    <th><b>Titre document</b></th>
    <th>Auteur document</th>
    <th>Theme document</th>
    <th>Type document</th>
    <th>Editeur document</th>
    <th>voir</th>
    <th>Réserver</th>
</tr>

<?php //on affiche les ligne du tableau avec la boucle while
while ($donnees = $reponse->fetch())

{ 
  $donne = $useer->fetch();?>
<tr>
    <th><?php echo "<input type='hidden' name='tab[".$donnees['idDocument']."]' value='".$donnees['idDocument']."'>" ?>
    <th><?php echo $donnees['titreDocument'];?></th>
    <th><?php echo $donnees['typeDocument'];?></th>
    <th><?php echo $donnees['themeDocument'];?></th>
    <th><?php echo $donnees['nomauteurDocument'];?></th>
    <th><?php echo $donnees['editeurDocument'];?></th>
    <?php $reference =  $donnees['idDocument']."¤".$donnees['titreDocument']."¤".$donnees['nomauteurDocument']."¤".$donnees['themeDocument']."¤".$donnees['typeDocument']
    ."¤".$donnees['editeurDocument']."¤".$donnees['resumeDocument']; ?>
    <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalReserver_"
     onclick="test('<?php echo $reference; ?>')">Voir</button></th>

<?php
$iduser = $donne['idUtilisateur'];
echo $iduser;
$iddoc = $donnees['idDocument'];
echo $iddoc;
   echo "<th>    <form method=POST action='action.php?iddoc=".$iddoc."&iduser=".$iduser."'>"?>
   <input type="hidden" name="iddoc" value="<?php echo "".$donnees['idDocument']."" ?>"></input>
   <input type="hidden" name="iduser" value="<?php echo "".$donne['idUtilisateur']."" ?>"></input>
        <input class="btn btn-primary" type="submit" value="Réserver" /> 
      </form></th>
</tr>
<?php
 }
 $useer->closeCursor();
$reponse->closeCursor();
?>
</table>
<!-- Modal -->
<div class="modal fade" id="ModalReserver_" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Réserver un document</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <span id="info"></span> <br>
      </div>
    <form method=POST action='action.php?iddoc=$iddoc'>
   <input type="hidden" name="iddoc" value="<?php echo "".$donnees['idDocument']."" ?>"></input>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="Sauvegarder" /> 
      </form>
      </div>
    </div>
  </div>
</div>



</body>
<script type="text/javascript">
 
function test(reference){
 
var tabref = reference.split("¤");

document.getElementById("info").innerHTML = "<b>Titre</b> : " + tabref[1] + " <br><b>Nom auteur</b> : " + tabref[2]  +" <br><b>TypeDocument </b>: " + tabref[4]+" <br><b>Resume Document </b>: " + tabref[6] ;

  
}

</script>

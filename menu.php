<?php

session_start();

include_once 'Config.php';

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE
, Config::UTILISATEUR, Config::MOTDEPASSE); 

if(isset($_GET['id'])) 
{
    $getid = $_GET['id'];
    $requser = $db->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
    $requser->execute([":identifiant" => $getid]);
    
    $userinfo = $requser->fetch();

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu</title>
    </head>
    <body>
        <h2>Menu de <?php echo $userinfo['prenom']; ?></h2>
        <br /><br />
        Identifiant = <?php echo $userinfo['identifiant']; ?>
        <br />
        Nom = <?php echo $userinfo['nom']; ?>

        <?php 
        if(isset($_SESSION['id']) AND $userinfo['identifiant'] == $_SESSION['id'])
        {
        ?>
        <a href="deconnexion.php">Deconnexion</a>
        <?php
        }
        else
        {
        header("location: index.php");
        }
        ?>
        
        
    </body>
</html>


<?php
}       //Si l'id existe ça affiche la page     
?>

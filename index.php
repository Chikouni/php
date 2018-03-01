<?php

include_once 'Config.php';

session_start();

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE
, Config::UTILISATEUR, Config::MOTDEPASSE); 

if(isset($_POST['formconnexion']))
{
    $id= htmlspecialchars($_POST['identifiant']);
    $mdp= $_POST['motdepasse'];
    
    $requser = $db->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
    $requser->execute([":identifiant" => $_POST['identifiant']]);
            
    $numRows = $requser->rowCount();
    
    if($numRows >= 1)
    {
            $row = $requser->fetchAll()[0];

            if(password_verify($mdp, $row['mdp']))
            {
                $userinfo = $row;
                $_SESSION['id'] = $userinfo['identifiant'];  //Je capte pas trop pourquoi on fait ça mais askip c'est obligé
                $_SESSION['mdp'] = $userinfo['mdp'];

                
                header("location: menu.php?id=".$_SESSION['id']);
               //quand l'identifiant et le mot de passe sont bons
            }
            else
            {
                    echo "Mauvais mot de passe";
            }
    }
    else
    {
            echo "Identifiant inconnu";
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
    </head>
    <body>
        
<form method="post" action="">
    <p>
        <label>Votre pseudo</label> : <input type="text" name="identifiant" />
    </p>
    <p>
        <label>Votre mail</label> : <input type="password" name="motdepasse" />
    </p>
    
    <input type="submit" name="formconnexion" value="OK">

</form>

    </body>
</html>

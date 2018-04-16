<?php
include_once 'config.php';
include_once 'navbar.php';

session_start();

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE
, Config::UTILISATEUR, Config::MOTDEPASSE);

if((!isset($_SESSION['connect'])) || (empty($_SESSION['connect']))){
        header("location: connexion.php");
        exit();
    }
    
        $req = $db->prepare("SELECT * FROM chatroom WHERE idProprio = :idProprio");
        $req -> bindParam(':idProprio', $_SESSION['id']);
        $req -> execute();
        $cr = $req->fetchAll();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="meschatrooms.css" rel="stylesheet" type="text/css"/>
        <title>Mes Chatrooms</title>
    </head>
    <body>
        <div class="container">
            <div class="menu ">

                <h1>Mes Chatrooms</h1>

                <div class="liste">
                    <div class="btn-group-vertical">
                        
                        <?php 
                        
                        for ($i = 0; $i < count($cr); $i++) {
                        echo  '<a href="chatroom.php?id='.$cr[$i]['idChatroom'].'" class="btn btn-success" type="button">' .$cr[$i]['nom']. '</a>';
                        }
                        ?>
                        
                    </div>
                </div>
                
                <a href="creation.php" class="btn btn-success grosbouttons" type="button">Créer une chatroom</a>

            </div>
        </div>
    </body>
    <footer>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </footer>
</html>



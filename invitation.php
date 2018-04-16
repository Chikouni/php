<?php
include_once 'navbar.php';
include_once 'config.php';

session_start();

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE
        , Config::UTILISATEUR, Config::MOTDEPASSE);

if ((!isset($_SESSION['connect'])) || (empty($_SESSION['connect']))) {
    header("location: connexion.php");
    exit();
}

$req = $db->prepare("SELECT * FROM invitation WHERE idDestinataire = :idDestinataire");
$req->bindParam(':idDestinataire', $_SESSION['id']);
$req->execute();
$inv = $req->fetchAll();


if (isset($_POST['accepte'])) {

    $invitation = $_POST['invitation'];
    $chatroom = $_POST['chatroom'];
    $nomcr = $_POST['nomcr'];

    $req1 = $db->prepare("INSERT INTO userdanscr (idChatroom, idUtilisateur, nom) VALUES (:idChatroom, :idUtilisateur, :nom)");
    $req1->bindParam(':idChatroom', $chatroom);
    $req1->bindParam(':idUtilisateur', $_SESSION['id']);
    $req1->bindParam(':nom', $nomcr);
    $req1->execute();

    $req2 = $db->prepare("DELETE FROM invitation WHERE idInvitation = :idInvitation");
    $req2->bindParam(':idInvitation', $invitation);
    $req2->execute();
    
    header("location: menu.php");
}

if (isset($_POST['refuse'])) {

    $invitation = $_POST['invitation'];
    $chatroom = $_POST['chatroom'];
    $nomcr = $_POST['nomcr'];

    $req2 = $db->prepare("DELETE FROM invitation WHERE idInvitation = :idInvitation");
    $req2->bindParam(':idInvitation', $invitation);
    $req2->execute();
    
    header("location: menu.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="invitation.css" rel="stylesheet" type="text/css"/>
        <title>Invitations</title>
    </head>
    <body>
        <div class="container">
            <div class="menu ">

                <h1>Invitations</h1><br/>

                <div class="liste">
                    <div class="btn-group-vertical">

                        <?php
                        for ($i = 0; $i < count($inv); $i++) {
                            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$inv[$i]["idInvitation"].'">Invitation de ' . $inv[$i]['idEnvoyeur'] . '</button>';
                        }
                        ?>

                    </div>
                </div>

                <!-- The Modal -->

                <?php for ($i = 0; $i < count($inv); $i++) { ?>
                    <div class="modal fade" id="myModal<?php echo $inv[$i]["idInvitation"] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Option invitation</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <input type="hidden" value="<?php echo $inv[$i]["idInvitation"] ?>" name="invitation">
                                        <input type="hidden" value="<?php echo $inv[$i]["idChatroom"] ?>" name="chatroom">
                                        <input type="hidden" value="<?php echo $inv[$i]["nom"] ?>" name="nomcr">
                                        <input class="btn btn-success" type="submit" name="accepte"  value="Accepter">
                                    </form>

                                    <form method="post" action="">
                                        <input type="hidden" value="<?php echo $inv[$i]["idInvitation"] ?>" name="invitation">
                                        <input type="hidden" value="<?php echo $inv[$i]["idChatroom"] ?>" name="chatroom">
                                        <input type="hidden" value="<?php echo $inv[$i]["nom"] ?>" name="nomcr">
                                        <input class="btn btn-success" type="submit" name="refuse"  value="Décliner">
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
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

<?php

include_once 'Point.php';

/**
 * Un polygone composé de points
 *
 * @author Alan
 */
class Polygone {

    private $id;
    public $listeDesPoints;
    public $couleur;

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function __construct(array $desPoints, $uneCouleur) {
        $this->listeDesPoints = $desPoints;
        $this->couleur = $uneCouleur;
    }

    public function __toString() {
        $chaineDesPoints = "";

        for ($i = 0; $i < count($this->listeDesPoints); $i++) {
            $chaineDesPoints .= $this->listeDesPoints[$i];
            if ($i < count($this->listeDesPoints) - 1) {
                $chaineDesPoints .= ";";
            }
        }

        return "[" . $chaineDesPoints . "]";
    }

    public function Enregistrer() {
        $db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE
                , Config::UTILISATEUR, Config::MOTDEPASSE);

        $req = $db->prepare("INSERT INTO polygones (couleur) "
                . "VALUES (:couleur)");
        $req->bindParam(":couleur", $this->couleur);

        $req->execute();

        $this->id = $db->lastInsertId();

        //je ferme la connexion
        $db = null;

        //il faut enregistrer les points du polygone
        foreach ($this->listeDesPoints as $p) {
            //j'enregistre chaque point lié à l'id de mon
            //polygone
            $p->Enregistrer($this->id);
        }
    }

    public function MettreAJour() {
        //todo
        //mettre à jour le polygone

        //il faut metter à jour les points du polygone
        

    }

    public function Supprimer() {
        //todo
        //en n'oubliant pas de supprimer les points aussi
    }

}

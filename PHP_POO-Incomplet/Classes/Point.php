<?php

/**
 * Représentation d'un point dans un repère à deux dimensions
 *
 * @author Alan
 */
class Point {

    private $id;
    private $x;
    private $y;

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getX() {
        return $this->x;
    }

    public function setX($value) {
        $this->x = $value;
    }

    public function getY() {
        return $this->y;
    }

    public function setY($value) {
        $this->y = $value;
    }

    /**
     * Constructeur de point
     * @param entier $abscisse Abscisse du point
     * @param entier $ordonnee Ordonnée du point
     */
    public function __construct($abscisse, $ordonnee) {
        //avec le setter
        $this->setX($abscisse);
        //ou en direct
        $this->y = $ordonnee;
    }

    public function __toString() {
        return "($this->x,$this->y)";
    }

    public function CalculerDistance(Point $autrePoint) {
        return sqrt(
                pow($this->x - $autrePoint->x, 2) +
                pow($this->y - $autrePoint->y, 2)
        );
    }

    public function Enregistrer($id_polygone) {
        $db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASE
                , Config::UTILISATEUR, Config::MOTDEPASSE);

        $req = $db->prepare("INSERT INTO points (x,y,idPolygone)"
                . "VALUES (:x,:y,:id_polygone)");
        $req->bindParam(":x", $this->x);
        $req->bindParam(":y", $this->y);
        $req->bindParam(":id_polygone", $id_polygone);
        $req->execute();

        //je ferme la connexion
        $db = null;
    }
    public function MettreAJour() {
        //todo
    }

}

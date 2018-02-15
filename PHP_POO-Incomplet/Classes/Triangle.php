<?php

include_once 'Polygone.php';

/**
 * Description of Triangle
 *
 * @author Alan
 */
class Triangle extends Polygone {

    private $estEquilateral;

    public function getEstEquilateral() {
        return $this->estEquilateral;
    }

    public function __construct(Point $p1, Point $p2, Point $p3, $uneCouleur) {
        parent::__construct([$p1, $p2, $p3], $uneCouleur);

        $cote1 = $p1->CalculerDistance($p2);
        $cote2 = $p2->CalculerDistance($p3);
        $cote3 = $this->listeDesPoints[2]->CalculerDistance($this->listeDesPoints[0]);

        $this->estEquilateral = ($cote1 == $cote2 && $cote2 == $cote3);
    }

    public static function getTriangles(){
        $db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASE
                , Config::UTILISATEUR, Config::MOTDEPASSE);

        $req=$db->prepare("select * from polygones");
        $req->execute();
        
        $resultat=$req->fetchAll();
        
        $triangles=[];
        
        foreach ($resultat as $ligne) {
            $tri=Triangle::getTriangle($ligne["id"]);
            
            $triangles[]=$tri;
            
            
        }
        $db=null;
        
        return $triangles;
        
    }
    public static function getTriangle($id){
        $db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASE
                , Config::UTILISATEUR, Config::MOTDEPASSE);
        
        $req=$db->prepare("select * from polygones where id=:id");
        $req->bindParam(":id",$id);
        $req->execute();
        
        $resultat=$req->fetchAll();
        
        foreach ($resultat as $ligne) {
            $reqPoints=$db->prepare("select * from points "
                    . " where idPolygone=:idPolygone");
            $reqPoints->bindParam(":idPolygone", $ligne["id"]);
            
            $reqPoints->execute();
            $resultatPoint=$reqPoints->fetchAll();
            
            $points=[];
            
            foreach ($resultatPoint as $lignePoint) {
                $p=new Point($lignePoint["x"],$lignePoint["y"]);
                $p->setId($lignePoint["id"]);
                $points[]=$p;
            }
            
            $tri=new Triangle($points[0],$points[1],$points[2]
                    , $ligne['couleur']);
            $tri->setId($ligne["id"]);
        }
        
        $db=null;
        
        return $tri;
    }
}

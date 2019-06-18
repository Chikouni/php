<?php
//version manuelle
//$x1=$_POST['x1'];
//$y1=$_POST['y1'];
//$x2=$_POST['x2'];
//$y2=$_POST['y2'];
//$x3=$_POST['x3'];
//$y3=$_POST['y3'];

//pour les joueurs : la version boucle
for ($i = 1; $i < 4; $i++) {
    $x="x$i";
    $y="y$i";
    
    $$x=$_POST[$x];
    $$y=$_POST[$y];
}

$couleur=$_POST["couleur"];


include_once 'Config.php';
include_once 'Classes/Point.php';
include_once 'Classes/Polygone.php';
include_once 'Classes/Triangle.php';

$tri=new Triangle(
            new Point($x1,$y1)
            , new Point($x2,$y2)
            , new Point($x3,$y3)
            , $couleur
        );

$tri->Enregistrer();

header("location: index.php");
die();


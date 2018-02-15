<?php
$titre = "Modifier Triangle";

include_once 'header.php';

$id=$_GET["id"];
$tri=Triangle::getTriangle($id);
?>

<h1><?php echo $titre ?></h1>
<hr>
<form action="modifierTriangle_action.php" method="post" class="form-horizontal">
<!-- todo -->
</form>

<?php
include_once 'footer.php';

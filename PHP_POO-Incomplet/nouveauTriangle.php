<?php
$titre = "Nouveau Triangle";

include_once 'header.php';
?>

<h1><?php echo $titre ?></h1>
<hr>
<form action="nouveauTriangle_action.php" method="post" class="form-horizontal">
    <?php for ($i = 1; $i < 4; $i++) { ?>
        <h3>Point <?php echo $i ?></h2>
            <div class="form-group">
                <label for="x<?php echo $i ?>" class="control-label col-sm-2">X</label>
                <div class="col-sm-3">
                    <input required type="number" min="0" max="1000" step="1" name="x<?php echo $i ?>" id="x<?php echo $i ?>"
                           class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="y<?php echo $i ?>" class="control-label col-sm-2">Y</label>
                <div class="col-sm-3">
                    <input required type="number" min="0" max="1000" step="1" name="y<?php echo $i ?>" id="y<?php echo $i ?>"
                           class="form-control">
                </div>
            </div>
        <?php } ?>
        <h3>Couleur</h3>
        <div class="form-group">
            <label for="couleur" class="control-label col-sm-2"></label>
            <div class="col-sm-3">
                <input type="color" class="form-control" id="couleur" name="couleur">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
                <a href="index.php" class="btn btn-default">annuler</a>
                    
                <input type="submit" class="btn btn-primary" value="enregistrer">
            </div>
        </div>
</form>

<?php
include_once 'footer.php';

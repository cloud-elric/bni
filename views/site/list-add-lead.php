<?php
    foreach($empresas as $empresa){
?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            <?= $empresa->txt_username ?>
        </button>
        <img src="<?= Yii::$app->urlManager->createAbsoluteUrl(['uploads/imagenesUsers/']) . "/" . $empresa->txt_imagen ?>" height="205" width="250">
        <br/>
<?php
    }
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Generar nuevo lead</h4>
            </div>
            <div class="modal-body">
                <form action="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/add-lead']) ?>">
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Notas</label>
                        <input type="text" name="descripcion" class="form-control">
                    </div>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
      <ul class="list-group">
  
        <?php
        foreach ($empresas as $empresa) {
            ?>
        <li class="list-group-item js_click" data-toggle="modal" data-target="#myModal" data-id="<?= $empresa->id_usuario ?>">
            <div class="media-left">
                <div class="profile-empresa" style="background-image:url(<?= Yii::$app->urlManager->createAbsoluteUrl(['uploads/imagenesUsers/']) . "/" . $empresa->txt_imagen ?>)">
                </div>
            </div>
            <div class="media-body text-center">            
                <label class="nombre-empresa"><?= $empresa->txt_username ?></label>
            </div>    
                    
        </li>        
            
        <?php

    }
    ?>
      </ul>  
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Generar nuevo lead</h4>
            </div>
            <div class="modal-body">
                <form id="form_datos" action="<?= Yii::$app->urlManager->createAbsoluteUrl(['modUsuarios/site/add-lead']) ?>" method='post'>
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
                        <textarea  name="descripcion" class="form-control">
                        </textarea>
                        <input type="hidden" name='destino' class='hidden-input'>
                    </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id="js_form_submit" type="submit" class="btn btn-primary ">Enviar lead</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.js_click').on('click', function(e){
        e.preventDefault()
        var id = $(this).data('id');
        $('.hidden-input').val(id);
    });

    $('#js_form_submit').on('click', function(e) {
        e.preventDefault();
        var form = $('#form_datos');
        if (form.find('.has-error').length) {
		    return false;
        }

        $.ajax({
            url : form.attr('action'),
            type : 'post',
            data: form.serialize(),
            success : function(response) {
                if (response.status == 'success') {
                    swal({
                        title: "Email enviado correctamente",
                        text: "Se a enviado un email con la información del lead",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Correcto",
                        closeOnConfirm: false,
                        },
                        function(isConfirm){
                        if (isConfirm) {
                            window.location.href = "<?= Yii::$app->urlManager->createAbsoluteUrl(['site/dash-board']) ?>";
                        }
                    });
                }else{
                    swal("Cancelado", "Error al enviar el email.", "error");
                }
            }
        });
	});
</script>
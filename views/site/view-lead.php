
<?php
if (Yii::$app->request->isAjax) {
  ?>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-6 form-group">
        <p><span class="glyphicon glyphicon-user"></span> <b>Nombre:</b> <u><?= $lead->txt_nombre_contacto ?></u></p>
      </div>

      <div class="col-md-6 form-group">
        <p><span class="glyphicon glyphicon-earphone"></span> <b>Teléfono:</b> <u><?= $lead->txt_numero_contacto ?></u></p>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
          <p><span class="glyphicon glyphicon-comment"></span> <b>Notas:</b></p>
          <p><?= $lead->txt_descripcion ?></p>
      </div>
    </div>

      <?php
      if ($lead->id_usuario_lead_destino == $idUser) {
        ?>
         <div class="row">
            <div class="col-md-12 text-center">
              <button id="js_boton_atender" class="btn btn-primary" data-url="<?= Yii::$app->urlManager->createAbsoluteUrl(['modUsuarios/site/atender-lead?token=']) . $lead->txt_token ?>">Atender</button>
            </div>  
          </div>    
      <?php

    }
    ?>
    
</div>
<?php

}
?>




<?php
if ($lead->id_usuario_lead_destino == $idUser) {
  ?>
<script>
  $('#js_boton_atender').on('click', function(){
    //e.preventDefault();
    var url = $(this).data('url');

    swal({
      title: "Confirmación",
      text: "¿Atendiste este lead?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, atendido!",
      closeOnConfirm: false
    },
    function(){
      $.ajax({
        url: url,
        success: function(response){
          if(response.status == 'success'){
            swal({
              title: "Email enviado correctamente",
              text: "Se a enviado un email para preocesar su pedido",
              type: "success",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Correcto",
              },
              function(isConfirm){
              if (isConfirm) {
                  window.location.href = "<?= Yii::$app->urlManager->createAbsoluteUrl(['site/dash-board']) ?>";
              }
            });
          }else{
            swal("Cancelado", "Error al guardar datos.", "error");            
          }
        }
      });
      
    });
  });
</script>

    <?php 
  } ?>
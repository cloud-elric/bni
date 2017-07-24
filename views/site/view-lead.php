<div class="row">
  <div class="col-md-4">
    <h3>Nombre</h3>
    <p><?= $lead->txt_nombre_contacto ?></p>
  </div>
  <div class="col-md-4">
    <h3>Telefono</h3>
    <p><?= $lead->txt_numero_contacto ?></p>
  </div>
  <div class="col-md-4">
    <h3>Notas</h3>
    <p><?= $lead->txt_descripcion ?></p>
  </div>
  <?php
    if($lead->id_usuario_lead_destino == $idUser){
  ?>
      <button id="js_boton_atender" class="btn btn-primary" data-url="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/atender-lead?token=']) . $lead->txt_token ?>">Atender</button>
  <?php
    }
  ?>
</div>

<script>
  $('#js_boton_atender').on('click', function(){
    //e.preventDefault();
    var url = $(this).data('url');

    swal({
      title: "Estas seguro?",
      text: "Atendiste correctamente el pedido!",
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
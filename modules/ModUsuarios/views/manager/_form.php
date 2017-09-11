<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ent-usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'txt_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_apellido_paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_apellido_materno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'repeatEmail')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true]) ?>

    <img id="previewImage" alt="imagen" height="205" width="250">
 	<?= $form->field($model, 'imagen', ['options'=>['file-field input-field col s12 m6']])->fileInput(['class'=>'imageProfile'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(".imageProfile").on("change",function (){    
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg","image/gif"];

        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
            return false;
        }
    
	    sizeImage = (file.size)/1048576;

        if(sizeImage>2){
            //toastrError("Image must be less than 2MB");
            return false;
        }
  
        var reader = new FileReader();

        // Set preview image into the popover data-content
        reader.onload = function (e) {

            //$(".myFiler").css('opacity', '1');
            //$(".myFiler p").hide();
            //$(".myFile p").css('opacity', '.45');
            $("#previewImage").removeAttr( 'style' );

            $('#previewImage').load(function() {
                // $("#previewImage").attr('src', e.target.result);
                $(".myFiler").css("background-image", "none");

                // Obtiendo tamaños de la imagen
                var imgS = document.getElementById('previewImage');
                var realWidth = imgS.clientWidth;
                var realHeight = imgS.clientHeight;

                // alert(realWidth + " - " + realHeight);

                // Asignando Alto o Ancho a imagen
                if(realWidth >= realHeight){
                    $("#previewImage").css("height", "250px");
                }
                else if(realHeight > realWidth){
                    $("#previewImage").css("width", "250px");
                }

                // Variables para centrar imagen
                var modWidth = $("#previewImage").width();
                var modHeight = $("#previewImage").height();

                var modWidthMide = modWidth / 2;
                var modHeightMide = modHeight / 2;

                // Ajustando la imagen al centro
                if(realWidth >= realHeight){
                    $("#previewImage").css("marginLeft", "-" + modWidthMide + "px");
                    $("#previewImage").css("left", "50%");
                }
                else if(realHeight > realWidth){
                    $("#previewImage").css("marginLeft", "-" + modWidthMide + "px");
                    $("#previewImage").css("left", "50%");
                    $("#previewImage").css("marginTop", "-" + modHeightMide + "px");
                    $("#previewImage").css("top", "50%");
                }
    	

            }).attr('src',e.target.result);
        }        
        reader.readAsDataURL(file);
        console.log(file);
    });
</script>

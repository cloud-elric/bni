<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel">
    <div class="panel-body">
        <h1 class="text-center">Registrarse</h1>
        <?php $form = ActiveForm::begin(["id"=>"form-register"]); ?>

        <div class="col-md-12">
            <div class="container-image-profile" id="previewImage">
                <?= $form->field($model, 'imagen', ['options' => ['class' => 'file-field input-field col s12 m6']])->fileInput(['class' => 'imageProfile']) ?>
            </div>
        </div> 

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'txt_username')->textInput(['maxlength' => true, 'placeholder' => 'Nombre'])->label(false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'txt_apellido_paterno')->textInput(['maxlength' => true, 'placeholder' => 'Apellido paterno'])->label(false) ?>
            </div>    
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true, 'placeholder' => 'Email'])->label(false) ?>
            </div>
            
            <div class="col-md-6">
                <?= $form->field($model, 'repeatEmail')->textInput(['maxlength' => true, 'placeholder' => 'Repetir email'])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Contraseña'])->label(false) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true, 'placeholder' => 'Repetir contraseña'])->label(false) ?>
            </div>
        </div>   

        <div class="col-md-12 text-center">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Registrarse' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'btn-sign']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>

$(document).ready(function () {
$('body').on('beforeSubmit', 'form#form-register', function (e) {

    e.preventDefault();
    var form = $(this);
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
        return false;
    }

    if($(".imageProfile").get(0).files.length == 0){
                swal("Espera", "Debes ingresar una imagen", "warning");
                return false;
    }


    
});
});



    $(".imageProfile").on("change",function (){    
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg","image/gif"];

        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
            return false;
        }
    
	    sizeImage = (file.size)/1048576;

        if(sizeImage>2){
            swal("Espera", "Tu imagen debe ser menor a 2MB", "warning");
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
                // if(realWidth >= realHeight){
                //     $("#previewImage").css("height", "250px");
                // }
                // else if(realHeight > realWidth){
                //     $("#previewImage").css("width", "250px");
                // }

                // Variables para centrar imagen
                // var modWidth = $("#previewImage").width();
                // var modHeight = $("#previewImage").height();

                // var modWidthMide = modWidth / 2;
                // var modHeightMide = modHeight / 2;

                // Ajustando la imagen al centro
                // if(realWidth >= realHeight){
                //     $("#previewImage").css("marginLeft", "-" + modWidthMide + "px");
                //     $("#previewImage").css("left", "50%");
                // }
                // else if(realHeight > realWidth){
                //     $("#previewImage").css("marginLeft", "-" + modWidthMide + "px");
                //     $("#previewImage").css("left", "50%");
                //     $("#previewImage").css("marginTop", "-" + modHeightMide + "px");
                //     $("#previewImage").css("top", "50%");
                // }
    	

            }).css('background-image',"url("+e.target.result+")");
        }        
        reader.readAsDataURL(file);
        
        $(".container-image-profile label").hide();

    });
</script>

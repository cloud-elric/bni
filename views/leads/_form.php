<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntLeads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ent-leads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario_lead_destino')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_usuario_lead_origen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'txt_nombre_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_numero_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fch_creacion')->textInput() ?>

    <?= $form->field($model, 'fch_atencion_lead')->textInput() ?>

    <?= $form->field($model, 'b_habilitado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

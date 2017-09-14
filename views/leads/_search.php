<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntLeadsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ent-leads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_lead') ?>

    <?= $form->field($model, 'id_usuario_lead_destino') ?>

    <?= $form->field($model, 'id_usuario_lead_origen') ?>

    <?= $form->field($model, 'txt_descripcion') ?>

    <?= $form->field($model, 'txt_token') ?>

    <?php // echo $form->field($model, 'txt_nombre_contacto') ?>

    <?php // echo $form->field($model, 'txt_numero_contacto') ?>

    <?php // echo $form->field($model, 'fch_creacion') ?>

    <?php // echo $form->field($model, 'fch_atencion_lead') ?>

    <?php // echo $form->field($model, 'b_habilitado') ?>

    <?php // echo $form->field($model, 'b_atendido') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

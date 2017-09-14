<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EntLeads */

$this->title = $model->id_lead;
$this->params['breadcrumbs'][] = ['label' => 'Ent Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-leads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_lead], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_lead], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_lead',
            'id_usuario_lead_destino',
            'id_usuario_lead_origen',
            'txt_descripcion:ntext',
            'txt_token',
            'txt_nombre_contacto',
            'txt_numero_contacto',
            'fch_creacion',
            'fch_atencion_lead',
            'b_habilitado',
            'b_atendido',
        ],
    ]) ?>

</div>

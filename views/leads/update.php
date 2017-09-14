<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntLeads */

$this->title = 'Update Ent Leads: ' . $model->id_lead;
$this->params['breadcrumbs'][] = ['label' => 'Ent Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lead, 'url' => ['view', 'id' => $model->id_lead]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ent-leads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

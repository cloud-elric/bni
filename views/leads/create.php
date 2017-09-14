<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntLeads */

$this->title = 'Create Ent Leads';
$this->params['breadcrumbs'][] = ['label' => 'Ent Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-leads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

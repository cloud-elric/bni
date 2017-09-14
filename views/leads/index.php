<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EntLeadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ent Leads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-leads-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ent Leads', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_lead',
            'id_usuario_lead_destino',
            'id_usuario_lead_origen',
            'txt_descripcion:ntext',
            'txt_token',
            // 'txt_nombre_contacto',
            // 'txt_numero_contacto',
            // 'fch_creacion',
            // 'fch_atencion_lead',
            // 'b_habilitado',
            // 'b_atendido',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

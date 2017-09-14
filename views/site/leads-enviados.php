<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
 <?php Pjax::begin(['id'=>'example', 'timeout'=>5000]); ?>
 <?php echo GridView::widget([
    'filterModel' => $searchModel,
        'dataProvider' => $leadsEnviados,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fch_creacion',
            'b_atendido',
        ],
]);?>

<?php Pjax::end(); ?>
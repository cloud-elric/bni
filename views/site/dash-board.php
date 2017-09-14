<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\modules\ModUsuarios\models\Utils;
use app\models\Calendario;

$this->registerJsFile ( '@web/js/dash-board.js', [ 
    'depends' => [ 
            \app\assets\AppAsset::className () 
    ] 
] );

?>
<br>

<div class="row">
        <div class="col-md-4 col-md-offset-8 form-group">
            <a href="<?= Url::base() . '/site/list-add-lead' ?>">
                <button class="btn btn-primary btn-block">
                    Agregar LEAD <span class="glyphicon glyphicon-share-alt"></span> 
                </button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel lead-primary">
                <div class="panel-body">

                    <h2 class="text-title-lead"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></h2>

                    <h5>
                        Leads enviados
                    </h5>
                </div>
                <div class="panel-footer">
                    <?= $leadsEnviados->getTotalCount(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel lead-warning">
                    <div class="panel-body">
                        <h2 class="text-title-lead"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></h2>
                        <h5>
                            Leads por resolver
                        </h5>
                    </div>
                    <div class="panel-footer">
                        <?= $leadsPendientes->getTotalCount(); ?>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel lead-success">
                    <div class="panel-body">
                        <h2 class="text-title-lead"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h2>
                        <h5>
                            Leads completos
                        </h5>
                    </div>
                    <div class="panel-footer">
                        <?= $leadsCompletos->getTotalCount(); ?>
                    </div>
            </div>
        </div>
    </div>

<div class="row">    
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="text-center">
                    Mis leads enviados
                </h4>
            </div>
            <div class="panel-body">
                <?php Pjax::begin(['id' => 'pjax-leads-enviados', 'timeout' => 5000]); ?>
                <?php echo GridView::widget([
                     'rowOptions' =>  function ($model, $key, $index, $grid) {
                        return ['data-token' => $model['txt_token']];
                    },
                    'tableOptions' => ["class" => "table table-hover"],
                    'summaryOptions' => ['class' => "summary pull-right"],
                    'filterModel' => $searchModel,
                    'dataProvider' => $leadsEnviados,
                    'columns' => [
                        [

                            'attribute' => 'enviadoNombre',
                            'value' => 'idUsuarioLeadDestino.txt_username'
                        ],
                        [
                            'attribute' => 'fch_creacion',
                            'value' => function ($model) {

                                return Calendario::getDateComplete($model->fch_creacion);
                            },
                            'filter'=>'',
                        ],

                        [
                            'attribute' => 'b_atendido',
                            'filter' => array("0" => "No", "1" => "Sí"),
                            'value' => function ($model) {

                                return $model->b_atendido ? "Sí" : "No";
                            }
                        ],
                    ],
                ]); ?>
                
                <?php Pjax::end(); ?>
            </div>
        </div>        
    </div>

    <div class="col-md-6">
    <div class="panel">
        <div class="panel-heading">
            <h4 class="text-center">
                Mis leads
            </h4>
        </div>
        <div class="panel-body">
        <?php Pjax::begin(['id' => 'pjax-leads-recibidos', 'timeout' => 5000]); ?>
        <?php echo GridView::widget([
             'rowOptions' =>  function ($model, $key, $index, $grid) {
                return ['data-token' => $model['txt_token']];
            },
            'tableOptions' => ["class" => "table table-hover"],
            'summaryOptions' => ['class' => "summary pull-right"],
            'filterModel' => $searchModel,
            'dataProvider' => $leadsRecibidos,
            'columns' => [
                [

                    'attribute' => 'enviadoNombre',
                    'value' => 'idUsuarioLeadOrigen.txt_username'
                ],
                [
                    'attribute' => 'fch_creacion',
                    'value' => function ($model) {

                        return Calendario::getDateComplete($model->fch_creacion);
                    },
                    'filter'=>'',
                ],

                [
                    'attribute' => 'b_atendido',
                    'filter' => array("0" => "No", "1" => "Sí"),
                    'value' => function ($model) {

                        return $model->b_atendido ? "Sí" : "No";
                    }
                ],
            ],
        ]); ?>
        
        <?php Pjax::end(); ?>
        </div>
    </div>        
</div>
</div>


<!-- Modal -->
<div id="modal-lead" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Información del lead</h4>
      </div>
      <div class="modal-body">
            


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

    

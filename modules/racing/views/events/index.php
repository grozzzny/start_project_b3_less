<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
            <?= $this->render('../_menu')?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="page-header-toolbar">
            <div class="sort-wrapper">
                <div class="btn-group toolbar-item" role="group" aria-label="">
                    <?= Html::a(Yii::t('app', 'Create Events'), ['create'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="events-index">
                <div class="table-responsive">
                    <?php Pjax::begin(); ?>
                                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
            'name',
            'description:ntext',
            'loaction_id',
            [
                'attribute' => 'time_from',
                'value' => function($model){
                    /** @var \app\models\Events $model */
                    return Yii::$app->formatter->asDatetime($model->time_from);
                }
            ],
            //'time_from:datetime',
            //'time_to:datetime',
            //'active',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'buttonOptions' => ['class' => 'btn btn-default'],
                                'template' => '<div class="text-nowrap">{update} {delete}</div>',
                                'buttons' => [
                                    'update' => function($name, $model, $key){
                                        return Html::a('<i class="fas fa-pencil-alt mr-0" aria-hidden="true"></i>', ['update', 'id' => $model->primaryKey], ['class' => 'btn btn-primary']);
                                     },
                                     'delete' => function($name, $model, $key){
                                        return Html::a('<i class="fas fa-trash mr-0" aria-hidden="true"></i>', ['delete', 'id' => $model->primaryKey], [
                                            'class' => 'btn btn-primary',
                                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                            'data-method' => 'post',
                                        ]);
                                    }
                                ]
                            ],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

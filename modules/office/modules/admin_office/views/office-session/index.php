<?php

use app\components\BlameableTrait;
use app\models\User;
use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeClients;
use app\modules\office\models\OfficeSession;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\office\models\search\OfficeSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rus', 'Заседания');
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
                    <?= $this->render('../_form_create_btn', ['label' => Yii::t('rus', 'Добавить заседание')])?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="office-session-index">
                    <div class="table-responsive">
                    <?php Pjax::begin(); ?>
                                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            [
                                'attribute' => 'account_id',
                                'value' => function($model){ return $model->accountName; },
                                'filter' => OfficeAccount::select2FilterSettings($searchModel)
                            ],
                            [
                                'attribute' => 'client_id',
                                'value' => function($model){ /** @var OfficeSession $model */ return $model->client->full_name; },
                                'filter' => OfficeClients::select2Filter($searchModel)
                            ],
                            [
                                'attribute' => 'case_id',
                                'value' => function($model){ /** @var OfficeSession $model */ return $model->case->name; },
                                'filter' => OfficeCase::select2Filter($searchModel)
                            ],
                            [
                                'attribute' => 'datetime_act',
                                'value' => function($model){ /** @var OfficeSession $model */ return $model->datetimeActFormat; },
                                'filter' => false
                            ],
                            [
                                'attribute' => 'created_by',
                                'value' => function($model){ /** @var BlameableTrait $model */ return $model->createdByEmail; },
                                'filter' => User::select2CreatedBy($searchModel)
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => function($model){return date('d.m.Y H:i', $model->created_at);},
                                'filter' => false,
                            ],

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

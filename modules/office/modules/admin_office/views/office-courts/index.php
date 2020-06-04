<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Office Courts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
        </div>
    </div>
    <div class="col-md-12">
        <div class="page-header-toolbar">
            <div class="sort-wrapper">
                <div class="btn-group toolbar-item" role="group" aria-label="">
                    <?= Html::a(Yii::t('app', 'Create Office Courts'), ['create'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="office-courts-index">

                    <?php Pjax::begin(); ?>
                
                                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
            'account_id',
            'name',
            'address',
            'phone',

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
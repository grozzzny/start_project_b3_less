<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\office\models\search\OfficeEmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rus', 'Сотрудники');
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
                    <?= $this->render('../_form_create_btn', ['label' => Yii::t('rus', 'Добавить сотрудника')])?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="office-employee-index">

                    <?php Pjax::begin(); ?>

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
                            'full_name',
                            [
                                'attribute' => 'user_email',
                                'value' => function($model){
                                    /** @var OfficeEmployee $model */
                                    return $model->user->email;
                                },
                                'label' => Yii::t('rus', 'Email')
                            ],

                            [
                                'attribute' => 'role',
                                'value' => function($model){
                                    /** @var OfficeEmployee $model */
                                    return $model->roleLabel;
                                },
                                'filter' => OfficeEmployee::roles()
                            ],
                            'priority',
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

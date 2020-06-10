<?php


namespace app\modules\office\models;


use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

class Relation extends BaseObject
{
    const RELATION_CONSULTATION = 'consultation';
    const RELATION_CASE = 'case';
    const RELATION_SESSION = 'session';
    const RELATION_CLIENT = 'client';
    const RELATION_DOCUMENT = 'document';
    const RELATION_TASK = 'task';

    public static function label($relation)
    {
        return ArrayHelper::getValue([
            self::RELATION_CONSULTATION => Yii::t('rus', 'Консультация'),
            self::RELATION_CASE => Yii::t('rus', 'Дело'),
            self::RELATION_SESSION => Yii::t('rus', 'Заседание'),
            self::RELATION_CLIENT => Yii::t('rus', 'Клиент'),
            self::RELATION_DOCUMENT => Yii::t('rus', 'Документ'),
            self::RELATION_TASK => Yii::t('rus', 'Задача'),
        ], $relation);
    }

    public static function registerJsChangeRelations($model)
    {
        /** @var RelationsInterface $model */
        $keys = array_keys($model->relations());
        $relation = empty($model->relation) ? $keys[0] : $model->relation;

        $js = <<<JS
            var showRelations = function(relation) {
                $('[data-relation]').hide();
                $('[data-relation="'+relation+'"]').show();
            };
            showRelations('$relation');
            
            var changeRelations = function() {
               showRelations($(this).val());
            }
JS;
        Yii::$app->view->registerJs($js, View::POS_END);
    }

    public static function when($relation)
    {
        return function($model) use ($relation) {
            return $model->relation == $relation;
        };
    }

    public static function whenClient($model, $relation)
    {
        $id = Html::getInputId($model, 'relation');
        return <<<JS
            function (attribute, value) { return $('#$id').val() == '$relation'; }
JS;

    }
}
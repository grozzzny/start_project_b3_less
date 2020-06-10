<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "office_correspondence".
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property int|null $employee_id
 * @property string|null $sender
 * @property string|null $recipient
 * @property string|null $description
 * @property string|null $mail_number
 * @property int|null $cost
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class OfficeCorrespondence extends \yii\db\ActiveRecord
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_correspondence';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'case_id', 'client_id', 'employee_id', 'cost', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sender', 'recipient', 'description', 'mail_number'], 'string', 'max' => 255],
            [[
                'account_id',
            ], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
            'case_id' => Yii::t('rus', 'Дело'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'employee_id' => Yii::t('rus', 'Сотрудник'),
            'sender' => Yii::t('rus', 'Отправитель'),
            'recipient' => Yii::t('rus', 'Получатель'),
            'description' => Yii::t('rus', 'Краткое содержание'),
            'mail_number' => Yii::t('rus', 'Почтовый идентификатор'),
            'cost' => Yii::t('rus', 'Сумма'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeCorrespondenceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeCorrespondenceQuery(get_called_class());
    }
}

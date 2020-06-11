<?php

namespace app\modules\office\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\office\models\OfficeEmployee;

/**
 * OfficeEmployeeSearch represents the model behind the search form of `app\modules\office\models\OfficeEmployee`.
 */
class OfficeEmployeeSearch extends OfficeEmployee
{
    public $user_email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'account_id', 'priority', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['role', 'full_name'], 'safe'],
            ['user_email', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OfficeEmployee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'account_id' => $this->account_id,
            'priority' => $this->priority,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'role', $this->role]);
        $query->andFilterWhere(['like', 'full_name', $this->full_name]);

        $query->joinWith('user');
        $query->andFilterWhere(['like', 'user.email', $this->user_email]);

        return $dataProvider;
    }
}

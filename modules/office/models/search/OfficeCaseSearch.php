<?php

namespace app\modules\office\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\office\models\OfficeCase;

/**
 * OfficeCaseSearch represents the model behind the search form of `app\modules\office\models\OfficeCase`.
 */
class OfficeCaseSearch extends OfficeCase
{
    public $subject;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'account_id', 'client_id', 'curator_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['number', 'category', 'subject'], 'safe'],
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
        $query = OfficeCase::find();

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
            'account_id' => $this->account_id,
            'client_id' => $this->client_id,
            'curator_id' => $this->curator_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'OR',
            ['like', 'civil_subject_dispute', $this->subject],
            ['like', 'criminal_essence_charge', $this->subject],
            ['like', 'execution_subject_execution', $this->subject],
            ['like', 'administrative_subject_dispute', $this->subject],
            ['like', 'instruction_essence_order', $this->subject],
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}

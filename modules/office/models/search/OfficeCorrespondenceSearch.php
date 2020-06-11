<?php

namespace app\modules\office\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\office\models\OfficeCorrespondence;

/**
 * OfficeCorrespondenceSearch represents the model behind the search form of `app\modules\office\models\OfficeCorrespondence`.
 */
class OfficeCorrespondenceSearch extends OfficeCorrespondence
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'account_id', 'case_id', 'client_id', 'employee_id', 'cost', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sender', 'recipient', 'description', 'mail_number'], 'safe'],
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
        $query = OfficeCorrespondence::find();

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
            'case_id' => $this->case_id,
            'client_id' => $this->client_id,
            'employee_id' => $this->employee_id,
            'cost' => $this->cost,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'recipient', $this->recipient])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'mail_number', $this->mail_number]);

        return $dataProvider;
    }
}

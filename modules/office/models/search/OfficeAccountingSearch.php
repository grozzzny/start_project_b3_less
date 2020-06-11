<?php

namespace app\modules\office\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\office\models\OfficeAccounting;

/**
 * OfficeAccountingSearch represents the model behind the search form of `app\modules\office\models\OfficeAccounting`.
 */
class OfficeAccountingSearch extends OfficeAccounting
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cost', 'transaction_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'account_id'], 'integer'],
            [['type', 'note', 'target'], 'safe'],
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
        $query = OfficeAccounting::find();

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
            'cost' => $this->cost,
            'transaction_id' => $this->transaction_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'account_id' => $this->account_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'target', $this->target]);

        return $dataProvider;
    }
}

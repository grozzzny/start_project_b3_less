<?php

namespace app\modules\office\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\office\models\OfficeDocuments;

/**
 * OfficeDocumentsSearch represents the model behind the search form of `app\modules\office\models\OfficeDocuments`.
 */
class OfficeDocumentsSearch extends OfficeDocuments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'account_id', 'case_id', 'consultation_id', 'client_id', 'datetime_act', 'court_id', 'term_appeal', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['category', 'category_act', 'name', 'file', 'note', 'result'], 'safe'],
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
        $query = OfficeDocuments::find();

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
            'consultation_id' => $this->consultation_id,
            'client_id' => $this->client_id,
            'datetime_act' => $this->datetime_act,
            'court_id' => $this->court_id,
            'term_appeal' => $this->term_appeal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'category_act', $this->category_act])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'result', $this->result]);

        return $dataProvider;
    }
}

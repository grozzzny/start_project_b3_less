<?php

namespace app\modules\office\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\office\models\OfficeClients;

/**
 * OfficeClientsSearch represents the model behind the search form of `app\modules\office\models\OfficeClients`.
 */
class OfficeClientsSearch extends OfficeClients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'account_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['full_name', 'phone', 'date_of_birth', 'place_of_birth', 'place_registration', 'place_residence', 'passport_number', 'passport_date', 'passport_institution', 'passport_photo'], 'safe'],
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
        $query = OfficeClients::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'place_of_birth', $this->place_of_birth])
            ->andFilterWhere(['like', 'place_registration', $this->place_registration])
            ->andFilterWhere(['like', 'place_residence', $this->place_residence])
            ->andFilterWhere(['like', 'passport_number', $this->passport_number])
            ->andFilterWhere(['like', 'passport_date', $this->passport_date])
            ->andFilterWhere(['like', 'passport_institution', $this->passport_institution])
            ->andFilterWhere(['like', 'passport_photo', $this->passport_photo]);

        return $dataProvider;
    }
}

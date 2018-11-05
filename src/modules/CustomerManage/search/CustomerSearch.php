<?php

namespace thienhungho\CustomerManagement\modules\CustomerManage\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use thienhungho\CustomerManagement\modules\CustomerBase\Customer;

/**
 * thienhungho\CustomerManagement\modules\CustomerManage\search\CustomerSearch represents the model behind the search form about `thienhungho\CustomerManagement\modules\CustomerBase\Customer`.
 */
 class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['avatar', 'first_name', 'last_name', 'company', 'phone', 'email', 'website', 'vat_number', 'language', 'address', 'country', 'city', 'state', 'zip_code', 'currency', 'created_at', 'updated_at', 'status', 'type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'vat_number', $this->vat_number])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}

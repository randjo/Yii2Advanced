<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Branches;

/**
 * BranchesSearch represents the model behind the search form about `backend\models\Branches`.
 */
class BranchesSearch extends Branches
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'address', 'created_date', 'status', 'company_id'], 'safe'],
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
        $query = Branches::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('company');
        
        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'company_id' => $this->company_id,
            'branches.created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['ilike', 'branches.name', $this->name])
            ->andFilterWhere(['ilike', 'branches.address', $this->address])
            ->andFilterWhere(['ilike', 'branches.status', $this->status])
            ->andFilterWhere(['ilike', 'companies.name', $this->company_id]);

        return $dataProvider;
    }
}

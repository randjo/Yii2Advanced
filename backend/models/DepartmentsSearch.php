<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Departments;

/**
 * DepartmentsSearch represents the model behind the search form about `backend\models\Departments`.
 */
class DepartmentsSearch extends Departments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer', 'ttt'],
            [['name', 'created_date', 'status', 'branch_id', 'company_id'], 'safe'],
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
        $query = Departments::find();

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
        $query->joinWith('branch');

        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'branch_id' => $this->branch_id,
//            'company_id' => $this->company_id,
            'departments.created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'departments.name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'companies.name', $this->company_id])
            ->andFilterWhere(['like', 'branches.name', $this->branch_id]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use app\components\MonthPagination;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * NoticeSearch represents the model behind the search form about `app\models\Notice`.
 */
class NoticeSearch extends Notice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['oncreate', 'message'], 'safe'],
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
        $query = Notice::find();
        $countQuery = clone $query;

        $months = Notice::find()->groupBy(['MONTH(FROM_UNIXTIME(\'oncreate\'))', 'YEAR(FROM_UNIXTIME(\'oncreate\'))'])->count();
        $pages = new MonthPagination(['totalCount' => $months]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
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
            'oncreate' => $this->oncreate,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        $query->groupBy(['oncreate']);

        $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $dataProvider;
    }
}

<?php

namespace culturePnPsu\learningCenter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use culturePnPsu\learningCenter\models\LearningCenter;

/**
 * LearningCenterSearch represents the model behind the search form of `culturePnPsu\learningCenter\models\LearningCenter`.
 */
class LearningCenterSearch extends LearningCenter
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['history','learningCenterRange'], 'safe'],
        ];
    }
    public $learningCenterRange;

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
        $query = LearningCenter::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'history', $this->history]);

        return $dataProvider;
    }
}

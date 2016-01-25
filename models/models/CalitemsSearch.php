<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Calitems;

/**
 * CalitemsSearch represents the model behind the search form about `app\models\Calitems`.
 */
class CalitemsSearch extends Calitems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cal_id', 'tool_id'], 'integer'],
            [['result', 'cuase'], 'safe'],
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
        $query = Calitems::find();

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
            'cal_id' => $this->cal_id,
            'tool_id' => $this->tool_id,
        ]);

        $query->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'cuase', $this->cuase]);

        return $dataProvider;
    }
}

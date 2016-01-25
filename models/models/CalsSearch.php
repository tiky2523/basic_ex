<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cals;

/**
 * CalsSearch represents the model behind the search form about `app\models\Cals`.
 */
class CalsSearch extends Cals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['caldate', 'by', 'remark', 'regdate', 'updatedate'], 'safe'],
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
        $query = Cals::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (isset($_GET['CalsSearch']) && !($this->load($params) && $this->validate())) {
                return $dataProvider;
                    }
      

        $query->andFilterWhere([
            'id' => $this->id,
            //'caldate' => $this->caldate,
            'user_id' => $this->user_id,
            'regdate' => $this->regdate,
            'updatedate' => $this->updatedate,
        ]);

        $date = explode('&', $this->caldate);
            if(count($date) > 1)
            {
                $date1 = date("Y-m-d", strtotime($date[0]));
                $date2 = date("Y-m-d", strtotime($date[1]));
                $query->andFilterWhere(['and', 'caldate >= "'.$date1.'"' ,  'caldate <= "'.$date2.'"']);
            }
            else
            {
                $query->andFilterWhere(['caldate' => $this->caldate]);
            }  
            
        $query->andFilterWhere(['like', 'by', $this->by])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}

<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tools;

/**
 * ToolsSearch represents the model behind the search form about `app\models\Tools`.
 */
class ToolsSearch extends Tools
{
    /**
     * @inheritdoc
     */
    public $allSearch;
    public function rules()
    {
        return [
            [['id', 'registool_id',  'company_id', 'department_id', 'user_id'], 'integer'],
            [['tooltype_id','allSearch','buydate', 'okdate', 'yearbudget', 'budget', 'serial',
                'model', 'wardate', 'howbuy', 'exprie', 'expriedate', 'expriecase', 'fnumber', 
                'lnumber', 'pictool','pictoolname', 'regdate', 'updatedate'], 'safe'],
            [['price'], 'number'],
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
        $query = Tools::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->query->joinWith('registool');
        $dataProvider->query->joinWith('deptool');
        $dataProvider->query->joinWith('comtool');
        $dataProvider->query->joinWith('tooltypetool');
        
        $query->andFilterWhere([
            //'id' => $this->id,
            //'registool_id' => $this->registool_id,
            //'tooltype_id' => $this->tooltype_id,
            //'buydate' => $this->buydate,
            //'okdate' => $this->okdate,
            //'company_id' => $this->company_id,
            //'price' => $this->price,
           // 'wardate' => $this->wardate,
           // 'department_id' => $this->department_id,
            //'expriedate' => $this->expriedate,
           // 'user_id' => $this->user_id,
           // 'regdate' => $this->regdate,
           // 'updatedate' => $this->updatedate,
        ]);

        $query->orFilterWhere(['like', 'yearbudget', $this->allSearch])
            ->orFilterWhere(['like', 'budget', $this->allSearch])
            ->orFilterWhere(['like', 'serial', $this->allSearch])
            ->orFilterWhere(['like', 'model', $this->allSearch]) 
            ->orFilterWhere(['like', 'expriecase', $this->allSearch])
            ->orFilterWhere(['like', 'companys.company_name', $this->allSearch])    
            ->orFilterWhere(['like', 'registools.name_list', $this->allSearch])
            ->andFilterWhere(['like', 'tooltypes.type_name', $this->tooltype_id])    
            ->orFilterWhere(['like', 'departments.name', $this->allSearch])    
                ;

        return $dataProvider;
    }
}

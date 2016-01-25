<?php

namespace app\controllers;

use Yii;
use app\models\Cals;
use app\models\CalsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Calitems;
use app\models\CalitemsSearch;
use app\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\components\AccessRule;
use yii\filters\AccessControl;
use dektrium\user\models\User;

/**
 * CalsController implements the CRUD actions for Cals model.
 */
class CalsController extends Controller
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=> ['create','delete','view','update','index'],
                'ruleConfig'=>[
                    'class'=>AccessRule::className()
                ],
                'rules'=>[
                    [
                        'actions'=>['create','delete','view','update','index'],
                        'allow'=> true,
                        'roles'=>[                                                      
                            User::ROLE_ADMIN

                        ]
                    ],                                     
                ]
            ]
        ];
    }

    /**
     * Lists all Cals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndex1()
    {
        $searchModel = new CalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndex2()
    {
        $searchModel = new CalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cals model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cals();

        $modelsCalitems = [new Calitems];

        if ($model->load(Yii::$app->request->post()) && $model->save())
            {
            $modelsCalitems = Model::createMultiple(Calitems::classname());
            Model::loadMultiple($modelsCalitems, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCalitems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsCalitems as $modelCalitems) {
                            $modelCalitems->cal_id = $model->id;
                            if (! ($flag = $modelCalitems->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }            
        } 
        else {
            return $this->render('create', [
                'model' => $model,
                'modelsCalitems' => (empty($modelsCalitems)) ? [new Calitems] : $modelsCalitems
            ]);
        }
    }

    /**
     * Updates an existing Cals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsCalitems = $model->calitem;

       if ($model->load(Yii::$app->request->post()) && $model->save())
            {
            $oldIDs = ArrayHelper::map($modelsCalitems, 'id', 'id');
            $modelsCalitems = Model::createMultiple(Calitems::classname(), $modelsCalitems);
            Model::loadMultiple($modelsCalitems, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsCalitems, 'id', 'id')));            
        
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCalitems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Calitems::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsCalitems as $modelCalitems) {
                            $modelCalitems->cal_id = $model->id;
                            if (! ($flag = $modelCalitems->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }            
        } 
        else {
            return $this->render('update', [
                'model' => $model,
                'modelsCalitems' => (empty($modelsCalitems)) ? [new Calitems] : $modelsCalitems
            ]);
        }
    }

    /**
     * Deletes an existing Cals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cals::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionReport2(){
        $date1 = "";
        $date2 = "";       
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];           
        }
        
        $sql = "SELECT c.caldate,re.name_list,t.model, CONCAT(t.fnumber,'-',t.lnumber) as numberpas
            ,d.`name` as dep ,ci.result ,ci.cuase 
            FROM calitems ci 
            LEFT JOIN cals c ON c.id=ci.cal_id
            LEFT JOIN tools t ON t.id=ci.tool_id
            LEFT JOIN registools re ON re.id=t.registool_id
            LEFT JOIN departments d ON d.id=t.department_id
            WHERE c.caldate BETWEEN '$date1' and '$date2'";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([            
            'allModels' => $rawData,
            'pagination' =>FALSE
        ]);
        return $this->render('report2', [
                    'dataProvider' => $dataProvider,                    
                    'sql' => $sql,
                    'rawData'=>$rawData,
                    'date1' => $date1,
                    'date2' => $date2,                   
                    
        ]);
    }
}

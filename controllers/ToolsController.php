<?php

namespace app\controllers;

use Yii;
use app\models\Tools;
use app\models\ToolsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
/**
 * ToolsController implements the CRUD actions for Tools model.
 */
class ToolsController extends Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tools models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ToolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex1() {
        $searchModel = new ToolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index1', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2() {
        $searchModel = new ToolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex3() {
        $searchModel = new ToolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable')) {
            $_id = $_POST['editableKey'];
            $model = $this->findModel($_id);
            $post = [];
            $posted = current($_POST['Tools']);
            $post['Tools'] = $posted;
            if ($model->load($post)) {
                $model->save();
                if (isset($posted['lnumber'])) {
                    $output = $model->lnumber;
                }
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            echo $out;
            return;
        }
        return $this->render('index3', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex4() {
        $searchModel = new ToolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index4', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex5() {
        $searchModel = new ToolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index5', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDetail($tooltype_id) {
        $searchModel = new ToolsSearch([
            'tooltype_id' => $tooltype_id
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('detail', [ 
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tools model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tools model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tools();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'pictool_img');

            if ($file->size != 0) {
                $model->pictool = $file->name;
                $file->saveAs('pictools/' . $file->name);
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tools model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->expriecase = $model->getArray($model->expriecase);
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'pictool_img');

            if (isset($file->size) && $file !== 0) {
                $model->pictool = $file->name;
                $file->saveAs('pictools/' . $file->name);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tools model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tools model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tools the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tools::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionReport1() {

        $sql = "SELECT rt.name_list,CONCAT(t.fnumber,'-',t.lnumber) as numberpas,t.yearbudget,t.price ,d.`name` as dep 
            ,ROUND((t.price/rt.`year`),2) as peryeaer
            ,year(NOW())+543 - t.yearbudget as yearuse
            ,ROUND(t.price-((ROUND((t.price/rt.`year`),2)) * (year(NOW())+543 - t.yearbudget)),2) as decra
            FROM tools t
            LEFT JOIN registools rt on rt.id=t.registool_id
            LEFT JOIN departments d ON d.id=t.department_id
            LEFT JOIN tooltypes tt ON tt.id=t.tooltype_id ";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE
        ]);
        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'rawData' => $rawData,
        ]);
    }
    public function actionToollists() {
        $sql="SELECT tt.type_name ,COUNT(t.id) as total FROM tools t 
                LEFT JOIN tooltypes tt on tt.id=t.tooltype_id
                GROUP BY tt.id";
        $connection = Yii::$app->db;
        $data = $connection->createCommand($sql)->queryAll();

         for ($i = 0; $i < sizeof($data); $i++) {  
            $total[] = $data[$i]['total'] * 1;            
            $type_name[] = $data[$i]['type_name'];
        }
        $dataProvider = new ArrayDataProvider([
                'allModels'=>$data,
                //'sort'=>['attributes'=>['type_name','total']],
            ]);

         return $this->render('toollists',[
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'total' => $total,
                    'type_name' => $type_name,                   

        ]);
    } 
    
    public function actionIndivtoollists($type_name) {
        $sql="SELECT tt.type_name,r.name_list,CONCAT(t.fnumber,'-',t.lnumber) as tnumber,d.`name` as dep,t.* 
                FROM tools t 
                LEFT JOIN tooltypes tt on tt.id=t.tooltype_id
                LEFT JOIN registools r on r.id=t.registool_id
                LEFT JOIN departments d on d.id=t.department_id
                WHERE tt.type_name='$type_name'";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        return $this->renderAjax('indiv_toollists', [
                    'rawData' => $rawData,
                    'sql' => $sql, 
                    'type_name'=>$type_name
        ]);
    }
}

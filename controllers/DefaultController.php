<?php

namespace culturePnPsu\learningCenter\controllers;

use Yii;
use culturePnPsu\learningCenter\models\LearningCenter;
use culturePnPsu\learningCenter\models\LearningCenterSearch;
use culturePnPsu\learningCenter\models\LearningCenterHistory;
use culturePnPsu\learningCenter\models\LearningCenterRange;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;

/**
 * DefaultController implements the CRUD actions for LearningCenter model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
        
        public function actionIndex()
    {
        $searchModel = new LearningCenterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LearningCenter model.
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
     * Creates a new LearningCenter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LearningCenter();
        $modelsHistory = [new LearningCenterHistory];
        
        if ($model->load(Yii::$app->request->post())){
            
            $post = Yii::$app->request->post();
            //print_r($post);
            //exit();
            
           $modelsHistory = Model::createMultiple(LearningCenterHistory::classname());
            Model::loadMultiple($modelsHistory, Yii::$app->request->post());
            
            //  print_r($modelsHistory);
            // exit();

            // validate person and houses models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsHistory) && $valid;

            if ($valid) {
                $model->history = $post['LearningCenterHistory'];
                if ($model->save(false)) {
                      return $this->redirect(['view', 'id' => $model->id]);
                }
            }
           
        }
        
         return $this->render('create', [
                'model' => $model,
                'modelsHistory' => $modelsHistory
            ]);
    }

    /**
     * Updates an existing LearningCenter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsHistory = [new LearningCenterHistory];

         if ($model->load(Yii::$app->request->post())){
             $post = Yii::$app->request->post();
            //print_r($post);
            //exit();
            
           $modelsHistory = Model::createMultiple(LearningCenterHistory::classname());
            Model::loadMultiple($modelsHistory, Yii::$app->request->post());
            
            //  print_r($modelsHistory);
            // exit();

            // validate person and houses models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsHistory) && $valid;

            if ($valid) {
                $model->history = $post['LearningCenterHistory'];
                if ($model->save(false)) {
                      return $this->redirect(['view', 'id' => $model->id]);
                }
            }
         }
        
        
        
        
        return $this->render('update', [
            'model' => $model,
            'modelsHistory' => $modelsHistory
        ]);
        
    }
    
    public function actionRange($id)
    {
        $model = $this->findModel($id);
        $modelsRange = $model->learningCenterRange;

         if ($model->load(Yii::$app->request->post())){
             $post = Yii::$app->request->post();
            
                $flag = false;
                $transaction = Yii::$app->db->beginTransaction();
                try {
                        LearningCenterRange::deleteAll(['learngin_center_id'=>$model->id]);
                        foreach ($post['LearningCenterRange'] as $key => $val) {
                            $range = new LearningCenterRange();
                            $range->learngin_center_id = $model->id;
                            $range->title = $val['title'];
                            $range->time = $val['time'];
                            $range->note = $val['note'];
                            
                            if (!($flag = $range->save())) {
                                break;
                            }
                            
                        }
                    
                    
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                    
                    
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            
         }
        
        
        
        
        return $this->render('range', [
            'model' => $model,
            'modelsRange' => (empty($modelsRange)?[new LearningCenterRange]:$model->learningCenterRange)
        ]);
        
    }

    /**
     * Deletes an existing LearningCenter model.
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
     * Finds the LearningCenter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LearningCenter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LearningCenter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

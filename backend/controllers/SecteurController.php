<?php

namespace backend\controllers;

use Yii;
use backend\models\Secteur;
use backend\models\Activite;
use backend\models\ActiviteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;


class SecteurController extends Controller
{
    /**
     * {@inheritdoc}
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

    /**
     * Lists all Secteur_economique models.
     * @return mixed
     */
    public function actionIndex($id_secteur)
    {
        if(isset($id_secteur)){
        $secteur_ecos = Activite::find()
                        ->where(['id_secteur'=>$id_secteur])
                        ->orderBy('id_secteur DESC')
                       ;
        $dataProvider = new ActiveDataProvider([
                        'query' => $secteur_ecos,
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
        }else{
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
        }              
    
        $searchModel = new ActiviteSearch();
       // $dataProvider = $searchModel->search($id_secteur);
      

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single Secteur_economique model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Secteur_economique model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Secteur_economique();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['#']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Secteur_economique model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_secteur_eco]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Secteur_economique model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Secteur_economique model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Secteur_economique the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Secteur::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSecteureco($id){
        $count = Secteur_economique::find()
                        ->where(['id_secteur'=>$id,])
                        ->count();
     
        $secteur_ecos = Secteur_economique::find()
                        ->where(['id_secteur'=>$id])
                        ->orderBy('id_secteur_eco DESC')
                        ->all();
        
        if($count > 0){
            $searchModel = new Secteur_economiqueSearch();
            $dataProvider = $searchModel->search($id);
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
     
    }

    
    public function actionHave($id_secteur)
    {
        $secteur_ecos = Secteur_economique::find()
                        ->where(['id_secteur'=>$id_secteur])
                        ->orderBy('id_secteur_eco DESC')
                        ->all();
        return $this->render('index', ['model' => $secteur_ecos]);
    }

}

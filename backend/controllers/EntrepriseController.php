<?php

namespace backend\controllers;

use Yii;
use common\models\Entreprise;
use common\models\EntrepriseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Secteur_economique;
use common\models\Secteur;
/**
 * EntrepriseController implements the CRUD actions for Entreprise model.
 */
class EntrepriseController extends Controller
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
     * Lists all Entreprise models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntrepriseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entreprise model.
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
     * Creates a new Entreprise model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Entreprise();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_entreprise]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Entreprise model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_entreprise]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Entreprise model.
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
     * Finds the Entreprise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entreprise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entreprise::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionValider($id){

        $model=$this->findModel($id);
        if( $model->valide=='0')
        $model->valide=1;
        else
        $model->valide=0;
        $model->save();
            $searchModel = new EntrepriseSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        

    }



   /* public function actionSecteureco($id){
        $count = Secteur_economique::find()
                        ->where(['id_secteur'=>$id,])
                        ->count();
     
        $secteur_ecos = Secteur_economique::find()
                        ->where(['id_secteur'=>$id])
                        ->orderBy('id_secteur_eco DESC')
                        ->all();
        
        if($count > 0){
            foreach($secteur_ecos as $secteur_eco){
                echo "<option value='".$secteur_eco->id_secteur_eco."'>".$secteur_eco->libelli."</option>";
            }
        }else{
            echo "<option>-</option>";
        }
     
    }*/
}

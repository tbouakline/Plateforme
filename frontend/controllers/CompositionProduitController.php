<?php

namespace frontend\controllers;

use Yii;
use common\models\CompositionProduit;
use common\models\CompositionProduitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CompositionProduitController implements the CRUD actions for CompositionProduit model.
 */
class CompositionProduitController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete',],
                'rules' => [
                        [
                            'allow' => false,
                        ],
                    ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CompositionProduit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompositionProduitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompositionProduit model.
     * @param integer $id_prod
     * @param integer $id_matiere
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_prod, $id_matiere)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_prod, $id_matiere),
        ]);
    }

    /**
     * Creates a new CompositionProduit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompositionProduit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_prod' => $model->id_prod, 'id_matiere' => $model->id_matiere]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompositionProduit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_prod
     * @param integer $id_matiere
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_prod, $id_matiere)
    {
        $model = $this->findModel($id_prod, $id_matiere);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_prod' => $model->id_prod, 'id_matiere' => $model->id_matiere]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CompositionProduit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_prod
     * @param integer $id_matiere
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_prod, $id_matiere)
    {
        $this->findModel($id_prod, $id_matiere)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompositionProduit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_prod
     * @param integer $id_matiere
     * @return CompositionProduit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_prod, $id_matiere)
    {
        if (($model = CompositionProduit::findOne(['id_prod' => $id_prod, 'id_matiere' => $id_matiere])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

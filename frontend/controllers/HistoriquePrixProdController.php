<?php

namespace frontend\controllers;

use Yii;
use common\models\HistoriquePrixProd;
use common\models\HistoriquePrixProdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * HistoriquePrixProdController implements the CRUD actions for HistoriquePrixProd model.
 */
class HistoriquePrixProdController extends Controller
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
     * Lists all HistoriquePrixProd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HistoriquePrixProdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HistoriquePrixProd model.
     * @param integer $id_prod
     * @param string $date_debut
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_prod, $date_debut)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_prod, $date_debut),
        ]);
    }

    /**
     * Creates a new HistoriquePrixProd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HistoriquePrixProd();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_prod' => $model->id_prod, 'date_debut' => $model->date_debut]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing HistoriquePrixProd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_prod
     * @param string $date_debut
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_prod, $date_debut)
    {
        $model = $this->findModel($id_prod, $date_debut);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_prod' => $model->id_prod, 'date_debut' => $model->date_debut]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HistoriquePrixProd model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_prod
     * @param string $date_debut
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_prod, $date_debut)
    {
        $this->findModel($id_prod, $date_debut)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HistoriquePrixProd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_prod
     * @param string $date_debut
     * @return HistoriquePrixProd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_prod, $date_debut)
    {
        if (($model = HistoriquePrixProd::findOne(['id_prod' => $id_prod, 'date_debut' => $date_debut])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

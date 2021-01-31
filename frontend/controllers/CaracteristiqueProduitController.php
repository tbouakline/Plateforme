<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\Helpers\ArrayHelper;

use common\models\CaracteristiqueProduit;
use common\models\CaracteristiqueProduitSearch;
use common\models\TypeCaracteristiqueProduit;

use common\models\Produit;

/**
 * CaracteristiqueProduitController implements the CRUD actions for CaracteristiqueProduit model.
 */
class CaracteristiqueProduitController extends Controller
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
                            'actions' => ['index', 'view', 'create', 'delete',],
                            'allow' => false,
                        ],
                        [
                            'actions' => ['update',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $carac=CaracteristiqueProduit::findOne($_GET['id']);
                                                    $produit=($carac!=null)?Produit::findOne($carac->id_prod):null;
                                                    $id_ent=($produit!=null)?$produit->id_ent:null;
                                                    return (
                                                    (Yii::$app->user->identity->id_ent == $id_ent)
                                                    );
                                                }
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
     * Lists all CaracteristiqueProduit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CaracteristiqueProduitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CaracteristiqueProduit model.
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
     * Creates a new CaracteristiqueProduit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CaracteristiqueProduit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_caracteristique]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CaracteristiqueProduit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $type = TypeCaracteristiqueProduit::findOne(['id_type'=>$model->id_type])->designation;

        $listeTypeCaracteristique=ArrayHelper::map(TypeCaracteristiqueProduit::find()->all(),'id_type','designation');

        if ($model->load(Yii::$app->request->post())) 
        {
            if($model->validate())
            {
                $model->save();

                Yii::$app->session->setFlash('succes', "Caractéristique mise à jour avec succès.");
                return $this->redirect(['produit/view', 'id'=>$model->id_prod]);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }

            return $this->redirect(['view', 'id' => $model->id_caracteristique]);
        }

        return $this->render('update', [
            'model' => $model,
            'type' => $type,
            'listeTypeCaracteristique' => $listeTypeCaracteristique,
        ]);
    }

    /**
     * Deletes an existing CaracteristiqueProduit model.
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
     * Finds the CaracteristiqueProduit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CaracteristiqueProduit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaracteristiqueProduit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

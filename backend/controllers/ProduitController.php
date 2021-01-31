<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\Helpers\ArrayHelper;
use yii\web\UploadedFile;

use common\models\Entreprise;

use common\models\Produit;
use common\models\ProduitSearch;
use common\models\CategorieProduit;
use common\models\SousCategorieProduit;
use common\models\TypeProduit;

use common\models\CaracteristiqueProduit;
use common\models\TypeCaracteristiqueProduit;
use common\models\ImageProduit;
use common\models\CompositionProduit;

use common\models\HistoriquePrixProd;

/**
 * ProduitController implements the CRUD actions for Produit model.
 */
class ProduitController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'delete-image', 'sous-categorie', 'type', 'validation-produit-matiere', 'valider-produit-matiere', 'validation-image', 'valider-image',],
                'rules' => [
                        [
                            'actions' => ['create', 'delete',],
                            'allow' => false,
                        ],
                        [
                            'actions' => ['index', 'sous-categorie', 'type', 'validation-produit-matiere', 'validation-image',],
                            'roles' => ['@'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['update', 'view',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $produit=Produit::findOne($_GET['id']);
                                                    return (
                                                    ($produit != null)
                                                    );
                                                }
                        ],
                        [
                            'actions' => ['delete-image',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $image=ImageProduit::findOne($_GET['id']);
                                                    return (
                                                    ($image != null)
                                                    );
                                                }
                        ],
                        [
                            'actions' => ['valider-produit-matiere',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $produit=Produit::findOne($_GET['id']);
                                                    return (
                                                    ($produit != null)&&(($_GET['status']==10)||($_GET['status']==12))
                                                    );
                                                }
                        ],
                        [
                            'actions' => ['valider-image',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $image=ImageProduit::findOne($_GET['id']);
                                                    return (
                                                    ($image != null)&&(($_GET['status']==10)||($_GET['status']==12))
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
     * Lists all Produit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProduitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionValidationProduitMatiere()
    {
        $requete="Select".
        " id_prod,".
        " designation,".
        " description,".
        " marque,".
        " reference,".
        " fini_matiere".
        " From produit".
        " Where status=0";

        $listeProduits=Yii::$app->db->createCommand($requete)->queryAll();

        return $this->render('validation-produit-matiere', [
            'listeProduits' => $listeProduits,
        ]);
    }

    public function actionValiderProduitMatiere($id, $status)
    {
        $produit= $this->findModel($id);

        $produit->status=$status;
        $produit->date_validation=date('Y-m-d H:i:s');
        $produit->id_user_validation=Yii::$app->user->identity->id;

        $produit->save();

        return $this->redirect(['validation-produit-matiere',]);
    }

    public function actionValidationImage()
    {
        $requete="Select".
        " id_prod,".
        " designation,".
        " description,".
        " marque,".
        " reference,".
        " fini_matiere".
        " From produit".
        " Where id_prod in (Select Distinct id_prod From image_produit Where status=0)";

        $listeProduits=Yii::$app->db->createCommand($requete)->queryAll();

        return $this->render('validation-image', [
            'listeProduits' => $listeProduits,
        ]);
    }

    public function actionValiderImage($id, $status)
    {
        $image=ImageProduit::findOne($id);

        $image->status=$status;
        $image->date_validation=date('Y-m-d H:i:s');
        $image->id_user_validation=Yii::$app->user->identity->id;

        $image->save();

        return $this->redirect(['validation-image',]);
    }

    /**
     * Displays a single Produit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $produit= $this->findModel($id);

        $listeCaracteristiques=CaracteristiqueProduit::find()->where(['id_prod'=>$produit->id_prod])->all();
        $listeImages=ImageProduit::find()->where(['id_prod'=>$produit->id_prod])->all();
        $listeMatieres=CompositionProduit::find()->where(['id_prod'=>$produit->id_prod])->all();

        return $this->render('view', [
            'produit' => $produit,
            'listeCaracteristiques' => $listeCaracteristiques,
            'listeImages' => $listeImages,
            'listeMatieres' => $listeMatieres,
        ]);
    }

    /**
     * Creates a new Produit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_prod]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $old_prix=$model->prix_unitaire;

        if($model->fini_matiere=='MATIERE PREMIERE')
        {
            $composition=CompositionProduit::find()->where(['id_matiere'=>$model->id_prod])->one();
        }
        else
        {
            $composition=null;
        }

        $listeCategorie=ArrayHelper::map(CategorieProduit::find()->all(),'id_categorie','designation');
        $listeSousCategorie=ArrayHelper::map(SousCategorieProduit::find()->where(['id_categorie'=>$model->id_categorie])->all(),'id_sous_categorie','designation');
        $listeType=ArrayHelper::map(TypeProduit::find()->where(['id_sous_categorie'=>$model->id_sous_categorie])->all(),'id_type','designation');

        if ($model->load(Yii::$app->request->post()))
        {            
            if($model->validate())
            {
                $model->save();

                if($model->fini_matiere=='MATIERE PREMIERE')
                {
                    if($composition->load(Yii::$app->request->post()))
                    {
                        $composition->save();
                    }                    
                }
                else
                {
                    if($model->prix_unitaire!=$old_prix)
                    {
                        //Ancien prix
                        $oldHistPrix=HistoriquePrixProd::find()->where(['id_prod'=>$model->id_prod,'date_fin'=>null])->one();
                        $oldHistPrix->date_fin=date('Y-m-d H:i:s');
                        $oldHistPrix->save();

                        //Nouveau prix
                        $newHistPrix=new HistoriquePrixProd();
                        $newHistPrix->id_prod=$model->id_prod;
                        $newHistPrix->date_debut=date('Y-m-d H:i:s');
                        $newHistPrix->prix_unitaire=$model->prix_unitaire;
                        $newHistPrix->save();
                    }  
                }                

                Yii::$app->session->setFlash('succes', "Produit modifié avec succès.");
                if($model->fini_matiere=='PRODUIT FINI')
                {
                    return $this->redirect(['index']);
                }
                else
                {
                    return $this->redirect(['view', 'id' => $composition->id_prod]);
                }                
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }            
        }

        return $this->render('update', [
            'model' => $model,
            'composition' => $composition,
            'listeCategorie' => $listeCategorie,
            'listeSousCategorie' => $listeSousCategorie,
            'listeType' => $listeType,
        ]);
    }

    /**
     * Deletes an existing Produit model.
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

    public function actionDeleteImage($id)
    {
        $image=ImageProduit::findOne($id);
        $id_prod=$image->id_prod;
        unlink('../../frontend/web/'.$image->chemin);
        $image->delete();

        return $this->redirect(['view', 'id' => $id_prod]);
    }

    /**
     * Finds the Produit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produit::findOne($id)) !== null) {
            return $model;
        } 

        throw new NotFoundHttpException('Produit non trouvé.');
    }

    public function actionSousCategorie() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id_categorie = empty($parents[0])?null:$parents[0];
                $sousCategories = SousCategorieProduit::find()
                ->where(['id_categorie'=>$id_categorie])
                ->all();
                $i=0;
                $first=-1;
                foreach($sousCategories as $sousCategorie){
                    if($i==0) $first=$sousCategorie->id_sous_categorie;
                    $out[$i]=['id'=>$sousCategorie->id_sous_categorie, 'name'=>$sousCategorie->designation,];
                   $i=$i+1;
                }
                return ['output'=>$out, 'selected'=>$first];
            }
        }
        
        return ['output'=>$out, 'selected'=>''];
    }

    public function actionType() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id_categorie = empty($parents[0])?null:$parents[0];
                $id_sous_categorie = empty($parents[1])?null:$parents[1];
                $types = TypeProduit::find()
                ->where(['id_sous_categorie'=>$id_sous_categorie])
                ->all();
                $i=0;
                $first=-1;
                foreach($types as $type){
                    if($i==0) $first=$type->id_type;
                    $out[$i]=['id'=>$type->id_type, 'name'=>$type->designation];
                   $i=$i+1;
                }
                return ['output'=>$out, 'selected'=>$first];
            }
        }
        
        return ['output'=>$out, 'selected'=>''];
    }
}

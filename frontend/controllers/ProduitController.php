<?php

namespace frontend\controllers;

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
                'only' => ['index', 'view', 'view-visit', 'create', 'update', 'delete', 'delete-image', 'sous-categorie', 'type',],
                'rules' => [
                        [
                            'actions' => ['create', 'delete',],
                            'allow' => false,
                        ],
                        [
                            'actions' => ['view-visit',],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $produit=Produit::findOne($_GET['id']);
                                                    return (
                                                        ($produit != null)
                                                    );
                                                }
                        ],
                        [
                            'actions' => ['index', 'sous-categorie', 'type',],
                            'roles' => ['@'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['update', 'view',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $produit=Produit::findOne($_GET['id']);
                                                    $id_ent=($produit!=null)?$produit->id_ent:null;
                                                    return (
                                                    (Yii::$app->user->identity->id_ent == $id_ent)
                                                    );
                                                }
                        ],
                        [
                            'actions' => ['delete-image',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $image=ImageProduit::findOne($_GET['id']);
                                                    $produit=($image!=null)?Produit::findOne($image->id_prod):null;
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
     * Lists all Produit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProduitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $newProduit=new Produit();
        
        $listeCategorie=ArrayHelper::map(CategorieProduit::find()->all(),'id_categorie','designation');

        if ($newProduit->load(Yii::$app->request->post()))
        {
            $newProduit->id_ent=Yii::$app->user->identity->id_ent;
            $newProduit->fini_matiere='PRODUIT FINI';
            $newProduit->status=0;
            $newProduit->date_insertion=date('Y-m-d H:i:s');

            if($newProduit->validate())
            {
                $newProduit->save();

                if(!empty($newProduit->prix_unitaire))
                {
                    $histPrix=new HistoriquePrixProd();
                    $histPrix->id_prod=$newProduit->id_prod;
                    $histPrix->date_debut=$newProduit->date_insertion;
                    $histPrix->prix_unitaire=$newProduit->prix_unitaire;
                    $histPrix->save();
                }

                Yii::$app->session->setFlash('succes', "Produit ajouté avec succès.");
                return $this->redirect(['index']);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'newProduit' => $newProduit,
            'listeCategorie' => $listeCategorie,
        ]);
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

        $newCaracteristique=new CaracteristiqueProduit();
        $newImage=new ImageProduit();
        $newMatiere=new Produit();
        $newComposition=new CompositionProduit();

        $listeCaracteristiques=CaracteristiqueProduit::find()->where(['id_prod'=>$produit->id_prod])->all();
        $listeImages=ImageProduit::find()->where(['id_prod'=>$produit->id_prod])->all();
        $listeMatieres=CompositionProduit::find()->where(['id_prod'=>$produit->id_prod])->all();

        $listeTypeCaracteristique=ArrayHelper::map(TypeCaracteristiqueProduit::find()->all(),'id_type','designation');
        $listeCategorie=ArrayHelper::map(CategorieProduit::find()->all(),'id_categorie','designation');

        //Nouvelle caractéristique
        if ($newCaracteristique->load(Yii::$app->request->post()))
        {
            $newCaracteristique->id_prod=$produit->id_prod;
            $newCaracteristique->status=0;
            $newCaracteristique->date_insertion=date('Y-m-d H:i:s');

            if($newCaracteristique->validate())
            {
                $newCaracteristique->save();

                Yii::$app->session->setFlash('succes', "Caractéristique ajoutée avec succès.");
                return $this->redirect(['view','id'=>$id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }
        }

        //Nouvelle image
        if ($newImage->load(Yii::$app->request->post()))
        {
            if ($image = Uploadedfile::getInstance($newImage,'chemin'))
            { 
                $nomFichier='uploads/produit/img_'.$produit->id_prod.'_tmp.'.$image->extension;                
                $newImage->chemin=$nomFichier;

                $newImage->id_prod=$produit->id_prod;
                $newImage->status=0;
                $newImage->date_insertion=date('Y-m-d H:i:s');
            }

            if($newImage->validate())
            {
                $newImage->save();

                $nomFichier='uploads/produit/img_'.$newImage->id_image.'.'.$image->extension; 
                $image->saveAs($nomFichier);
                $newImage->chemin=$nomFichier;

                $newImage->save();

                Yii::$app->session->setFlash('succes', "Image ajoutée avec succès.");
                return $this->redirect(['view','id'=>$id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }
        }

        //Nouvelle matière première
        if (($newMatiere->load(Yii::$app->request->post()))&&($newComposition->load(Yii::$app->request->post())))
        {
            $newMatiere->id_ent=Yii::$app->user->identity->id_ent;
            $newMatiere->fini_matiere='MATIERE PREMIERE';
            $newMatiere->status=0;
            $newMatiere->date_insertion=date('Y-m-d H:i:s');

            if($newMatiere->validate())
            {
                $newMatiere->save();

                $newComposition->id_prod=$produit->id_prod;
                $newComposition->id_matiere=$newMatiere->id_prod;
                $newComposition->save();

                Yii::$app->session->setFlash('succes', "Matière première ajoutée avec succès.");
                return $this->redirect(['view','id'=>$id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }
        }

        return $this->render('view', [
            'produit' => $produit,
            'newCaracteristique' => $newCaracteristique,
            'newImage' => $newImage,
            'newMatiere' => $newMatiere,
            'newComposition' => $newComposition,
            'listeCaracteristiques' => $listeCaracteristiques,
            'listeImages' => $listeImages,
            'listeMatieres' => $listeMatieres,
            'listeTypeCaracteristique' => $listeTypeCaracteristique,
            'listeCategorie' => $listeCategorie,
        ]);
    }

    public function actionViewVisit($id)
    {
        $produit= $this->findModel($id);
        $entreprise=Entreprise::findOne($produit->id_ent)->nom_rs;
        $categorie=CategorieProduit::findOne($produit->id_categorie)->designation;
        $sousCategorie=SousCategorieProduit::findOne($produit->id_sous_categorie)->designation;
        $type=TypeProduit::findOne($produit->id_type)->designation;

        $listeCaracteristiques=CaracteristiqueProduit::find()->where(['id_prod'=>$produit->id_prod])->all();
        $listeImages=ImageProduit::find()->where(['id_prod'=>$produit->id_prod])->all();
        $listeMatieres=CompositionProduit::find()->where(['id_prod'=>$produit->id_prod])->all();

        return $this->render('view-visit', [
            'produit' => $produit,
            'entreprise' => $entreprise,
            'categorie' => $categorie,
            'sousCategorie' => $sousCategorie,
            'type' => $type,
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
        unlink($image->chemin);
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

<?php

namespace backend\controllers;

use Yii;
use common\models\Entreprise;
use common\models\EntrepriseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\Helpers\ArrayHelper;
use yii\web\UploadedFile;

use common\models\CategorieEntreprise;
use common\models\SecteurActivite;
use common\models\SousSecteurActivite;
use common\models\Activite;
use common\models\FormeJuridique;

use common\models\Wilaya;
use common\models\Commune;

use common\models\User;

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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'validation-compte', 'valider-compte',],
                'rules' => [
                        [
                            'actions' => ['create', 'delete',],
                            'allow' => false,
                        ],
                        [
                            'actions' => ['view', 'update',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $entreprise=Entreprise::findOne($_GET['id']);
                                                    return (
                                                    ($entreprise != null)
                                                    );
                                                }
                        ],
                        [
                            'actions' => ['index', 'validation-compte',],
                            'roles' => ['@'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['valider-compte',],
                            'roles' => ['@'],
                            'allow' => true,
                            'matchCallback' => function() {
                                                    $user=User::findOne($_GET['id']);
                                                    return (
                                                    ($user != null)&&(($_GET['status']==10)||($_GET['status']==12))
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
     * Lists all Entreprise models.
     * @return mixed
     */
    public function actionIndex()
    {
        $requete="Select".
        " u.id_ent,".
        " u.username,".
        " e.nom_rs,".
        " u.nom,".
        " u.prenom".
        " From entreprise e".
        " Inner Join user u".
        " On e.id_ent=u.id_ent";

        $listeEntreprises=Yii::$app->db->createCommand($requete)->queryAll();

        return $this->render('index', [
            'listeEntreprises' => $listeEntreprises,
        ]);
    }

    public function actionValidationCompte()
    {
        $requete="Select".
        " u.id_ent,".
        " u.username,".
        " e.nom_rs,".
        " u.nom,".
        " u.prenom".
        " From entreprise e".
        " Inner Join user u".
        " On e.id_ent=u.id_ent".
        " Where u.status=9";

        $listeEntreprises=Yii::$app->db->createCommand($requete)->queryAll();

        return $this->render('validation-compte', [
            'listeEntreprises' => $listeEntreprises,
        ]);
    }

    public function actionValiderCompte($id, $status)
    {
        $user=User::findOne($id);

        $user->status=$status;
        $user->date_validation=date('Y-m-d H:i:s');
        $user->id_user_validation=Yii::$app->user->identity->id;

        $user->save();

        return $this->redirect(['validation-compte',]);
    }

    /**
     * Displays a single Entreprise model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $user=User::find()->where(['id_ent' => $id])->one();

        return $this->render('view', [
            'model' => $model,
            'user' => $user,
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
            return $this->redirect(['view', 'id' => $model->id_ent]);
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
        $user=User::find()->where(['id_ent' => $id])->one();

        $listeCategorie=ArrayHelper::map(CategorieEntreprise::find()->all(),'id_categorie','designation_courte');
        $listeSecteur=ArrayHelper::map(SecteurActivite::find()->all(),'id_secteur','designation');
        $listeSousSecteur=ArrayHelper::map(SousSecteurActivite::find()->where(['id_secteur'=>$model->id_secteur])->all(),'id_sous_secteur','designation');
        $listeActivite=ArrayHelper::map(Activite::find()->where(['id_sous_secteur'=>$model->id_sous_secteur])->all(),'id_act','designation');
        $listeFormeJuridique=ArrayHelper::map(FormeJuridique::find()->all(),'id_forme','designation_courte');

        $listeWilaya=ArrayHelper::map(Wilaya::find()->all(),'id_wilaya','nom');
        $listeCommune=ArrayHelper::map(Commune::find()->where(['id_wilaya'=>$model->id_wilaya])->all(),'id_commune','nom');

        $ancienLogo=$model->logo;
        $anciennePhoto=$user->photo;

        $success=0;

        if ($model->load(Yii::$app->request->post()))
        {
            if ($logo = Uploadedfile::getInstance($model,'logo'))
            { 
                $nomFichier='uploads/logo/logo_'.$model->id_ent.'.'.$logo->extension; 
                $logo->saveAs('../../frontend/web/'.$nomFichier);                              
                $model->logo=$nomFichier;
            }
            else
            {
                $model->logo=$ancienLogo;
            }

            if($model->validate())
            {
                $model->save();

                $success=1;
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }
        }

        if ($user->load(Yii::$app->request->post()))
        {
            if ($photo = Uploadedfile::getInstance($user,'photo'))
            { 
                $nomFichier='uploads/photo/photo_'.$user->id.'.'.$photo->extension; 
                $photo->saveAs('../../frontend/web/'.$nomFichier);                              
                $user->photo=$nomFichier;
            }
            else
            {
                $user->photo=$anciennePhoto;
            }

            if($user->validate())
            {
                $user->save();

                $success=1;
            }
            else
            {
                Yii::$app->session->setFlash('error', "Erreur de saisie.");
            }
        }

        if($success==1)
        {
            Yii::$app->session->setFlash('succes', "Informations modifiées avec succès.");
            return $this->redirect(['view', 'id' => $model->id_ent]); 
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'listeCategorie' => $listeCategorie,
            'listeSecteur' => $listeSecteur,
            'listeSousSecteur' => $listeSousSecteur,
            'listeActivite' => $listeActivite,
            'listeFormeJuridique' => $listeFormeJuridique,
            'listeWilaya' => $listeWilaya,
            'listeCommune' => $listeCommune,
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
}

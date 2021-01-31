<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\LoginForm;
use backend\models\SignupForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\ChangePasswordForm;

use common\models\SousSecteurActivite;
use common\models\Activite;

use common\models\SousCategorieProduit;
use common\models\TypeProduit;

use common\models\Commune;

use common\models\User;
use common\models\Produit;
use common\models\ImageProduit;
use common\models\CaracteristiqueProduit;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'signup', 'login', 'logout', 'reset-password-request', 'reset-password', 'change-password', 'profile', 'sous-secteur', 'activite', 'sous-categorie', 'type', 'commune',],
                'rules' => [
                    [
                        'actions' => ['profile',],
                        'allow' => false,
                    ],
                    [
                        'actions' => ['index', 'logout', 'change-password', 'sous-secteur', 'activite', 'sous-categorie', 'type', 'commune',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'reset-password-request', 'reset-password', 'signup',],
                        'allow' => true,
                        'roles' => ['?'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users=User::find()->where(["status"=>9])->count();
        $produits=Produit::find()->where(["status"=>0])->count();
        $images=ImageProduit::find()->where(["status"=>0])->count();
        $caracteristiques=CaracteristiqueProduit::find()->where(["status"=>0])->count();

        return $this->render('index', [
            "users" => $users,
            "produits" => $produits,
            "images" => $images,
            "caracteristiques" => $caracteristiques,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionResetPasswordRequest()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->sendEmail()) {
            Yii::$app->session->setFlash('success', 'Lien de réinitialisation du mot de passe envoyé avec succès.');
            return $this->goHome();
        }
        
        return $this->render('requestPasswordResetToken', ['model' => $model,]);
    }

    public function actionResetPassword($token)
    {
        try 
        {
            $model = new ResetPasswordForm($token);
        } 
        catch (\Exception $e) 
        { 
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['reset-password-request']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Mot de passe réinitialisé avec succès.');
            return $this->goHome();
        }
        
        return $this->render('resetPassword', ['model' => $model,]);
    }

    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();
        $model->username=Yii::$app->user->identity->username;
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
            Yii::$app->session->setFlash('success', 'Mot de passe changé avec succès.');
            return $this->goHome();
        }
        
        return $this->render('changePassword', ['model' => $model,]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }
        
        return $this->render('signup', ['model' => $model,]);
    }
    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionSousSecteur() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id_secteur = empty($parents[0])?null:$parents[0];
                $sousSecteurs = SousSecteurActivite::find()
                ->where(['id_secteur'=>$id_secteur])
                ->all();
                $i=0;
                $first=-1;
                foreach($sousSecteurs as $sousSecteur){
                    if($i==0) $first=$sousSecteur->id_sous_secteur;
                    $out[$i]=['id'=>$sousSecteur->id_sous_secteur, 'name'=>$sousSecteur->designation,];
                   $i=$i+1;
                }
                return ['output'=>$out, 'selected'=>$first];
            }
        }
        
        return ['output'=>$out, 'selected'=>''];
    }

    public function actionActivite() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id_secteur = empty($parents[0])?null:$parents[0];
                $id_sous_secteur = empty($parents[1])?null:$parents[1];
                $activites = Activite::find()
                ->where(['id_sous_secteur'=>$id_sous_secteur])
                ->all();
                $i=0;
                $first=-1;
                foreach($activites as $activite){
                    if($i==0) $first=$activite->id_act;
                    $out[$i]=['id'=>$activite->id_act, 'name'=>$activite->designation];
                   $i=$i+1;
                }
                return ['output'=>$out, 'selected'=>$first];
            }
        }
        
        return ['output'=>$out, 'selected'=>''];
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

    public function actionCommune() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id_wilaya = empty($parents[0])?null:$parents[0];
                $communes = Commune::find()
                ->where(['id_wilaya'=>$id_wilaya])
                ->all();
                $i=0;
                $first=-1;
                foreach($communes as $commune){
                    if($i==0) $first=$commune->id_commune;
                    $out[$i]=['id'=>$commune->id_commune, 'name'=>$commune->nom,];
                   $i=$i+1;
                }
                return ['output'=>$out, 'selected'=>$first];
            }
        }
        
        return ['output'=>$out, 'selected'=>''];
    }
}

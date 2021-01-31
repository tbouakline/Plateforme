<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\Helpers\ArrayHelper;
use yii\helpers\Html;

use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\ChangePasswordForm;

use common\models\CategorieEntreprise;
use common\models\SecteurActivite;
use common\models\SousSecteurActivite;
use common\models\Activite;
use common\models\FormeJuridique;

use common\models\Produit;
use common\models\ProduitEntreprise;
use common\models\ImageProduit;

use common\models\CategorieProduit;
use common\models\SousCategorieProduit;
use common\models\TypeProduit;

use common\models\Wilaya;
use common\models\Commune;

use common\models\User;
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
                'only' => ['index', 'result', 'signup', 'confirm', 'login', 'logout', 'reset-password-request', 'reset-password', 'change-password', 'profile', 'sous-secteur', 'activite', 'sous-categorie', 'type', 'commune', 'charger-donnees', 'auto-complete', 'captcha', 'error',],
                'rules' => [
                    [
                        'actions' => ['profile',],
                        'allow' => false,
                    ],
                    [
                        'actions' => ['index', 'result', 'sous-secteur', 'activite', 'sous-categorie', 'type', 'commune', 'charger-donnees', 'auto-complete', 'captcha', 'error',],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'reset-password-request', 'reset-password', 'signup', 'confirm',],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'change-password',],
                        'allow' => true,
                        'roles' => ['@'],
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

            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => null,
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
        $secteurs=ArrayHelper::map(SecteurActivite::find()->all(),'id_secteur','designation');
        $categories=ArrayHelper::map(CategorieProduit::find()->all(),'id_categorie','designation');
        $wilayas=ArrayHelper::map(Wilaya::find()->all(),'id_wilaya','nom');

        return $this->render('index',[
                                        'secteurs'=>$secteurs,
                                        'categories'=>$categories,
                                        'wilayas'=>$wilayas,
                                        'source'=>'index',
                                        'filtres'=>null,
                            ]);
    }

    public function actionResult()
    {
        $secteurs=ArrayHelper::map(SecteurActivite::find()->all(),'id_secteur','designation');
        $categories=ArrayHelper::map(CategorieProduit::find()->all(),'id_categorie','designation');
        $wilayas=ArrayHelper::map(Wilaya::find()->all(),'id_wilaya','nom');

        return $this->render('result',[
                                        'secteurs'=>$secteurs,
                                        'categories'=>$categories,
                                        'wilayas'=>$wilayas,
                                        'source'=>'result',
                                        'filtres'=>$_POST,
                            ]);
    }    

    public function actionSignup()
    {
        $model = new SignupForm();
        if (($model->load(Yii::$app->request->post())) && ($user=$model->signup())) {
            
            //Envoi email de confirmation
            $email = \Yii::$app->mailer->compose()
            ->setTo($user->email)
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Plateforme Entreprise'])
            ->setSubject('Confirmation de l\'inscription')
            ->setTextBody('Cliquez sur le lien :  '.Yii::$app->urlManager->createAbsoluteUrl(['site/confirm','id'=>$user->id,'key'=>$user->auth_key]))
            ->send();
            /*if($email){
            Yii::$app->getSession()->setFlash('success','Check Your email!');
            }
            else{
            Yii::$app->getSession()->setFlash('warning','Failed, contact Admin!');
            }*/

            Yii::$app->session->setFlash('success', 'Merci pour votre inscription. Veuillez vérifier votre boîte de réception pour l\'Email de vérification.');
            return $this->goHome();
        }

        $listeCategorie=ArrayHelper::map(CategorieEntreprise::find()->all(),'id_categorie','designation_courte');
        $listeSecteur=ArrayHelper::map(SecteurActivite::find()->all(),'id_secteur','designation');
        $listeFormeJuridique=ArrayHelper::map(FormeJuridique::find()->all(),'id_forme','designation_courte');
        
        return $this->render('signup', ['model' => $model, 'listeCategorie'=>$listeCategorie, 'listeSecteur' => $listeSecteur, 'listeFormeJuridique'=>$listeFormeJuridique]);
    }

    public function actionConfirm($id, $key)
    {
        $user = \common\models\User::find()->where(['id'=>$id,'auth_key'=>$key,'status'=>0,])->one();
        if(!empty($user))
        {
            $user->status=9;
            $user->save();
            Yii::$app->getSession()->setFlash('success','Success!');
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning','Failed!');
        }

        return $this->goHome();
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

    public function actionChargerDonnees()
    {
        if(isset($_POST['num_page']))
        {
            $filtres=[["designation", "designation", "like"], ["entreprise","nom_rs","like"], ["secteur","id_secteur","="], ["sous_secteur","id_sous_secteur","="], ["activite","id_activite","="], ["categorie","id_categorie_prod","="], ["sous_categorie","id_sous_categorie","="], ["type","id_type","="], ["wilaya","id_wilaya","="], ["commune","id_commune","="], ["prix_min","prix_unitaire",">="], ["prix_max","prix_unitaire","<="]];

            $nbre_show=2;
            $nbre_side=3;

            $nbre_produits=ProduitEntreprise::find();
            $listeProduits=ProduitEntreprise::find();

            $firstFiltre=0;
            
            for($i=0; $i<COUNT($filtres); $i++)
            {
                $oneFiltre=$filtres[$i];

                if((isset($_POST[$oneFiltre[0]]))&&(!(empty($_POST[$oneFiltre[0]]))))
                {
                    if($firstFiltre==0)
                    {
                        $nbre_produits=$nbre_produits->where([$oneFiltre[2], $oneFiltre[1], $_POST[$oneFiltre[0]]]);
                        $listeProduits=$nbre_produits->where([$oneFiltre[2], $oneFiltre[1], $_POST[$oneFiltre[0]]]);

                        $firstFiltre++;
                    }
                    else
                    {
                        $nbre_produits=$nbre_produits->andWhere([$oneFiltre[2], $oneFiltre[1], $_POST[$oneFiltre[0]]]);
                        $listeProduits=$nbre_produits->andWhere([$oneFiltre[2], $oneFiltre[1], $_POST[$oneFiltre[0]]]);
                    }
                }
            }

            if($firstFiltre==0)
            {
                $order_by=['rand()' => SORT_DESC];
            }
            else
            {
                $order_by=['id_prod' => SORT_ASC];
            }

            $current_page=$_POST["num_page"];

            $start=(($current_page-1)*$nbre_show);

            $nbre_produits=$nbre_produits->count();
            $listeProduits=$listeProduits->orderby($order_by)->limit($nbre_show)->offset($start)->all();

            if($firstFiltre==0)
            {
                $nbre_page=1;
            }
            else
            {
                $nbre_page=ceil($nbre_produits/$nbre_show);
            }

            //Liste des produits
            $output='<div class="card">'.
            '<div class="card-header">'.
            '<h6 class="text-uppercase mb-0">Résultat de la recherche</h6>'.
            '</div>'.
            '<div class="card-body">'.
            '<div class="row">';

            foreach ($listeProduits as $produit) 
            {
                $image_prod=ImageProduit::find()->where(['id_prod'=>$produit->id_prod])->one();

                $output.='<div class="col-md-4">'.
                '<div class="card mb-2 border">';

                if(empty($image_prod))
                {
                    $output.='<img class="card-img-top" src="uploads/produit/no_image.png">';
                }
                else
                {
                    $output.='<img class="card-img-top" src="'.$image_prod->chemin.'" alt="Image produit">';
                }

                $output.='<div class="card-body">'.
                '<h4 class="card-title">'.Html::encode($produit->designation).'</h4>'.                
                '<p class="card-text">'.Html::encode((strlen($produit->description)<=100)?$produit->description:(substr($produit->description,1,100).' ...')).'</p>'.
                '<a href="index.php?r=produit/view-visit&id='.$produit->id_prod.'" class="btn btn-primary shadow px-5'.((Yii::$app->user->isGuest)?' disabled':'').'">Détails</a>'.
                '</div>'.

                '<div class="card-footer">'.
                '<h6 class="card-title">'.Html::encode($produit->nom_rs).'</h6>'.
                '</div>'.

                '</div>'.
                '</div>';
            }

            $output.='</div>'.
            '</div>'.
            '</div>';

            //Pagination
            $output.='<nav class="mb-4" aria-label="Page navigation sample">'.

            '<ul class="pagination justify-content-center" style="margin:20px 0">'.
            
            '<li class="page-item '.(($current_page==1)?'disabled':'').'"><a class="page-link" href="javascript:void(0)" data-num_page="'.($current_page-1).'">Précédent</a></li>';
            
            for($i=1;$i<=$nbre_page;$i++) 
            { 
                $output.='<li class="page-item '.(($current_page==$i)?'active':'').'"><a class="page-link" href="javascript:void(0)" data-num_page="'.$i.'">'.$i.'</a></li>';
            
                //Afficher "..." début et/ou fin dans le cas où le nombre des pages > ((2*nbre_side)+5) sinon afficher toutes les pages sans "..."
                if($nbre_page>((2*$nbre_side)+5))
                {
                    if($i==$nbre_side)
                    {                       
                        //Ne pas affiche "..." si la page actuelle est ($nbre_side+1) ou ($nbre_side+2)
                        if((($nbre_side+1)!=$current_page)&&(($nbre_side+2)!=$current_page))
                        {
                            $output.='<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                        }                                                                           

                        //Passer au numéro de la page actuelle ou aux dernières pages si la page actuelle n'est pas au début
                        if(($current_page>$nbre_side)&&($current_page<=($nbre_page-$nbre_side+1)))
                        {
                            if(($nbre_side+1)!=$current_page)
                            {
                                $i=$current_page-2;
                            }
                            else
                            {
                                $i=$current_page-1;
                            }                               
                        }
                        else
                        {
                            $i=$nbre_page-$nbre_side;
                        }
                    }

                    //Passer aux dernières pages si la page actuelle n'est pas à la fin
                    if(($i==($current_page+1))&&($current_page>$nbre_side)&&($nbre_page>(($current_page+1)+$nbre_side)))
                    {
                        $output.='<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                        $i=$nbre_page-$nbre_side;
                    }
                }
            
            }
            
            $output.='<li class="page-item '.(($current_page==$nbre_page)?'disabled':'').'"><a class="page-link" href="javascript:void(0)" data-num_page="'.($current_page+1).'">Suivant</a></li>'.

            '</ul>'.

            '</nav>';

            echo $output;
        }
        else
        {
            echo "Aucune donnée.";
        }
    }

    public function actionAutoComplete()
    {
        if(isset($_POST['designation']))
        {
            $designation=$_POST['designation'];

            $listeProduits=ProduitEntreprise::find()->where(['like','designation',$designation])->orderby(['designation'=>SORT_ASC])->limit(10)->all();

            $output='';

            foreach($listeProduits as $produit)
            {
                $output.='<option value="'.$produit->designation.'">';
            }

            echo $output;
        }
        else
        {
            echo '';
        }        
    }
}

<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Entreprise;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $passwordconf;
    public $nom;
    public $prenom;
    public $nom_rs;
    public $id_categorie;
    public $id_secteur;
    public $id_sous_secteur;
    public $id_activite;
    public $id_forme_juridique;
    public $captcha;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Le nom d\'utilisateur est déja utilisé '],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Cette adresse Email a déjà été enregistrée.'],
           
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['passwordconf', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Confirmation érronée"],

            ['nom', 'required'],

            ['prenom', 'required'],

            ['nom_rs', 'required'],

            ['id_categorie', 'required'],

            ['id_secteur', 'required'],

            ['id_sous_secteur', 'required'],

            ['id_activite', 'required'],

            ['id_forme_juridique', 'required'],

            ['captcha', 'captcha', 'captchaAction' => 'site/captcha'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Nom d\'utilisateur',
            'email' => 'Email',
            'password' => 'Mot de passe',
            'passwordconf' => 'Confirmation du mot de passe',
            'nom' => 'Nom',
            'prenom' => 'Prénom',
            'nom_rs' => 'Nom / Raison sociale',
            'id_categorie' => 'Catégorie',
            'id_secteur' => 'Secteur d\'activité',
            'id_sous_secteur' => 'Sous secteur d\'activité',
            'id_activite' => 'Activité',
            'id_forme_juridique' => 'Forme juridique',

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        
        $user->nom=$this->nom;
        $user->prenom=$this->prenom;
        $user->email = $this->email;
        $user->status=0;
        $user->type_user="ENTREPRISE";
        $user->date_inscription=date('Y-m-d H:i:s');
        
        $user->save(); //&& $this->sendEmail($user);

        $entreprise = new Entreprise();
        $entreprise->nom_rs=$this->nom_rs;
        $entreprise->id_categorie=$this->id_categorie;
        $entreprise->id_secteur=$this->id_secteur;
        $entreprise->id_sous_secteur=$this->id_sous_secteur;
        $entreprise->id_activite=$this->id_activite;
        $entreprise->id_forme_juridique=$this->id_forme_juridique;
        $entreprise->save();

        $user->id_ent=$entreprise->id_ent;
        $user->save();

        return $user;

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}

<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class ChangePasswordForm extends Model
{
    public $username;
    public $old_password;
    public $new_password;
    public $confirm_new_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'old_password', 'new_password', 'confirm_new_password',], 'required'],
            
            ['username', 'exist',
                'targetClass' => '\common\models\User',
                'targetAttribute' => 'username',
                'filter' => ['type_user' => 'ADMINISTRATEUR', 'status' => User::STATUS_ACTIVE],
                'message' => 'Nom d\'utilisateur inexistant ou invalide.'
            ],

            ['old_password', 'validationPassword',],

            ['confirm_new_password', 'compare', 'compareAttribute'=>'new_password', 'skipOnEmpty' => false, 'message'=>"Confirmation érronée.",],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nom d\'utilisateur',
            'old_password' => 'Ancien mot de passe',
            'new_password' => 'Nouveau mot de passe',
            'confirm_new_password' => 'Confirmation du nouveau mot de passe',
        ];
    }

    public function validationPassword($attribute)
    {
        $user=User::findOne(['username' => $this->username,]);

        if((empty($user))||(!$user->validatePassword($this->old_password)))
        {
            $this->addError($attribute, 'Mot de passe erroné.');
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function changePassword()
    {
        /* @var $user User */
        $user = User::findOne([
            'username' => $this->username,
            'status' => User::STATUS_ACTIVE,            
            'type_user' => 'ADMINISTRATEUR',
        ]);

        if (empty($user)) {
            return false;
        }
        
        $user->setPassword($this->new_password);

        return $user->save(false);
    }
}
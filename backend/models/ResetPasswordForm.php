<?php
namespace backend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $confirm_password;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Le jeton de réinitialisation du mot de passe ne peut pas être vide.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (empty($this->_user)) {
            throw new InvalidArgumentException('Jeton de réinitialisation de mot de passe incorrect.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['confirm_password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Confirmation érronée",],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Nouveau mot de passe',
            'confirm_password' => 'Confirmation du nouveau mot de passe',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}

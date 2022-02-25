<?php

namespace common\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use backend\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $re_password;
    
    /**
     * @var \backend\models\User
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
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        else if (!$this->_user = User::findByPasswordResetToken($token)) {
            throw new InvalidArgumentException('Wrong password reset token.');
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
            ['password', 'match', 'pattern' => '/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'],

            ['re_password', 'required'],
            ['re_password', 'compare', 'compareAttribute' => 'password', 'type' => 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('app', 'Password'),
            're_password' => Yii::t('app', 'Retry Password'),
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();
        $user->status = $user::STATUS_ACTIVE;

        return $user->save(false);
    }
}
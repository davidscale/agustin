<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    // public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'trim'],
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            // ['rememberMe', 'boolean'],

            // acept email OR DNI arg format
            ['username', 'match', 'pattern' => '/^([a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4})|([0-9]{8})$/'],

            ['password', 'string', 'min' => 8, 'max' => 12],
            ['password', 'match', 'pattern' => '/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @return bool if password is correct or not
     */
    public function validatePassword()
    {
        $flag = false;

        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user && $user->validatePassword($this->password)) {
                $flag = true;
            } else {
                $this->addError('password', 'Incorrect username or password.');
            }
        }
        return $flag;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 3600 * 12);
            // return Yii::$app->user->login($this->getUser(), $this->rememberMe ?  3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]] or [[email]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->username) {
            $this->_user = User::findByUsername($this->username);
        }

        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->username);
        }

        return $this->_user;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
        ];
    }
}

<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Register form
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $re_password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'string', 'max' => '8'],
            [['username', 'email'], 'trim'],
            [['username', 'email', 'password', 're_password'], 'required'],
            [['username', 'password', 're_password'], 'string', 'min' => '8'],
            [['username', 'password', 're_password'], 'string', 'max' => '12'],

            [['email'], 'match', 'pattern' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/'],
            // [['password', 're_password'], 'match', 'pattern' => '((?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{8,12})'],

            ['re_password', 'compare', 'compareAttribute' => 'password'],

            // (?=.*\d)         must contains one digit from 0-9
            // (?=.*[a-z])      must contains one lowercase characters
            // (?=.*[A-Z])      must contains one uppercase characters
            // (?=.*[@#$%])     must contains one special symbols in the list "@#$%"
            //             .    match anything with previous condition checking
            // {6,20}           length at least 6 characters and maximum of 20

            /* https://regex101.com/r/S7cd5A/1 */
        ];
    }

    /**
     * Register in a user using the provided username, email and password.
     *
     * @return bool whether the user is register in successfully
     */
    public function register()
    {
        if ($this->validate() && !$this->getUserByUsername() && !$this->getUserByEmail()) {
            //  NEW VIEW:: email sended to EMAIL@GMAIL.COM BLA 
            return true;
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUserByUsername()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username); // Cambiar por modelo de User creado
        }
        return $this->_user;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getUserByEmail()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email); // Cambiar por modelo de User creado
        }

        return $this->_user;
    }
}

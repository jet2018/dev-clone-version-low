<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\VarDumper;

class RegisterForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $name;


    public function rules()
    {
        return [
            [['email', 'password', 'name', 'password_repeat', 'username'],'required'],
            [['email'], 'email'],
            ['password', 'string', 'min' => 8],
            [['password_repeat'], 'compare', 'compareAttribute'=>'password'],
        ];
    }


    public function register(){
        $user = new User();

        $user->username = $this->username;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->auth_key = \Yii::$app->security->generateRandomString();

        if($user->save()){
            return true;
        }
        else{
            \Yii::error("An error occurred. This was probably caused by: ".VarDumper::dumpAsString($user->errors));
            return false;
        }
    }
}
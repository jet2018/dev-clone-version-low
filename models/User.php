<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string $username
 * @property string|null $auth_key
 * @property string $access_token
 * @property string $password
 * @property string|null $email
 * @property int|null $is_logged_in
 * @property string|null $last_login_date
 * @property string|null $created_at
 * @property int|null $is_super_user
 * @property int|null $is_active
 * @property string|null $photo
 *
 * @property ArticleLikes[] $articleLikes
 * @property Article[] $articles
 * @property CommentLikes[] $commentLikes
 * @property-read null|string $authKey
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * {@inheritdoc}
     */

    public static function tableName(){
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'access_token', 'password'], 'required'],
            [['is_logged_in', 'is_super_user', 'is_active'], 'integer'],
            [['last_login_date', 'created_at'], 'safe'],
            [['name', 'auth_key', 'access_token', 'photo'], 'string', 'max' => 100],
            [['username', 'email'], 'string', 'max' => 45],
            ['password', 'string', 'max' => 200],
            ['username', 'unique'],
            ['email', 'unique'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'password' => 'Password',
            'email' => 'Email',
            'is_logged_in' => 'Is Logged In',
            'last_login_date' => 'Last Login Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_super_user' => 'Is Super User',
            'is_active' => 'Is Active',
            'photo' => 'Photo',
        ];
    }

    /**
     * Gets query for [[ArticleLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleLikes()
    {
        return $this->hasMany(ArticleLikes::className(), ['user_id' => 'id']);
    }

    public function getPhoto(){
        return $this->photo? $this->photo : 'uploads/default-image.jpg';
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CommentLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentLikes()
    {
        return $this->hasMany(CommentLikes::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        return self::findOne(['access_token'=>$token]);
    }

    public function findByUsername($username){
        return self::find()
            ->orFilterWhere(['email'=>$username])
            ->orFilterWhere(['username'=>$username])
            ->one();
    }


    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return self::findOne($id);
    }
}

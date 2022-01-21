<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string|null $created_at
 * @property int|null $views
 * @property string|null $article_image
 * @property int $created_by
 *
 * @property ArticleLikes[] $articleLikes
 * @property CommentLikes[] $commentLikes
 * @property Comment[] $comments
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $image;
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors(){
        return array(
            [
                'class'=>TimestampBehavior::class,
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],

                ]
            ],
            [
                'class'=>BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['views'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['image', 'file', "extensions"=>'png, jpg, jpeg', 'maxSize' => 20000],
            [['article_image'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_at' => 'Created At',
            'views' => 'Views',
            'article_image' => 'Article Image',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[ArticleLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleLikes()
    {
        return $this->hasMany(ArticleLikes::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[CommentLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentLikes()
    {
        return $this->hasMany(CommentLikes::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
}

<?php
namespace app\models;

use Yii;

class Comment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'comment';
    }

    public function rules()
    {
        return [
            [['content', 'post_id'], 'required'],
            [['content'], 'string'],
            [['post_id', 'parent_id'], 'integer'],
            [['created_at'], 'safe'],
            ['parent_id', 'integer'],
        ];
    }

    public function beforeSave($insert)
{
    if ($this->isNewRecord) {
        $this->created_at = new \yii\db\Expression('NOW()');
    }

    return parent::beforeSave($insert);
}

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    public function getParentComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_comment_id']);
    }
}
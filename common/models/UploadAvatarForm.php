<?php

namespace common\models;
use yii\base\Model;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;
use Yii;

class UploadAvatarForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        // ["jpg", "jpeg", "gif", "png", "gif", "webp"]
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,jpeg,gif'],
        ];
    }

    /**
     * @param $name
     * @return string
     * @throws \yii\base\Exception
     */
    public function generateFileName($name)
    {
       return Yii::$app->security->generateRandomString(12).StringHelper::truncate(md5($name),6,'');
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function upload()
    {
        if ($this->validate()) {
            $file_name=$this->generateFileName($this->imageFile->baseName) .'.'. $this->imageFile->extension;
            $file=Yii::getAlias('@uploadAvatar') .'/'.$file_name ;
            $this->imageFile->saveAs($file);
            return Yii::$app->params['avatarUploadPath'].'/'.$file_name;
        } else {
            return null;
        }
    }
}
<?php

namespace common\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadImgForm extends Model
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

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(\Yii::getAlias('uploadEditor') . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
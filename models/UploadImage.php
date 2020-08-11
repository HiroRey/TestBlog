<?php


namespace app\models;


use yii\web\UploadedFile;

class UploadImage extends \yii\base\Model
{

    public $image;


    public function rules()
    {
        return [
            [['image'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($file)
    {
        $this->image = $file;

        if ($this->validate()) {
           md5($this->image->saveAs('/web/'  . 'uploads/' . $this->image->baseName . '.' . $this->image->extension));

           return $this->image;
        }

    }

}
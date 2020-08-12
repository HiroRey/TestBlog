<?php


namespace app\models;


use Yii;
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

    public function upload(UploadedFile $file, $currentImage)
    {
        $this->image = $file;
        $filename = md5(uniqid($file->basename)) . '.' . $file->extension;

        $this->deleteImage($currentImage);

        $this->image->saveAs(Yii::getAlias('@web')  . 'uploads/' . $filename);

        return $filename;

    }

    public function deleteImage($currentImage)
    {

        if(file_exists(Yii::getAlias('@web')  . '/uploads/'  . $currentImage))
        {
            unlink(Yii::getAlias('@web')  . 'uploads/' . $currentImage);
        }
    }


}
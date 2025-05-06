<?php
 namespace common\models;

 use yii\base\Model;
 use yii\web\UploadedFile;
//  use yii\db\ActiveRecord;

 class UploadForm extends Model
 {
    public $imageFile;

    // public static function tableName(){
    //     return ('uploadform');
    // }

    public function rules(){
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],                      
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $this->imageFile->saveAs('uploads/'.$this->imageFile->baseName.'.'.$this->imageFile->extension);
            return true;
        }
        else{
            return false;
        }
    }
 }
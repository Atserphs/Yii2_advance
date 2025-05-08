<?php
 namespace common\models;
 use yii\db\ActiveRecord;

 class Contact extends ActiveRecord{
    public $profileImage;
    public static function tableName(){
        return ('contact');
    }

    public function rules()
    {
        return [
            [['user_id', 'user_name', 'phone_number', 'address', 'email'], 'required'],
            ['email', 'email'],
            [['user_id', 'phone_number'], 'string', 'max' => 10],
            [['user_name'], 'string', 'max' => 50],
            [['address', 'email'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
            [['email'], 'unique'],
            [['user_pp_path'], 'string', 'max' => 255], 
            [['profileImage'],'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg']
        ];
    }

    public function uploadAndSave()
    {
        if($this->validate()){
            $fileName = uniqid() . '.' . $this->profileImage->extension;
            $path = 'Profile_Images/' . $fileName;

            if(!is_dir('Profile_Images')){
                mkdir('Profile_Images', 0777, true);
            }

            $this->profileImage->saveAs($path);

            return $path;
            // return $this->save(false); //skipping 
        }

        //Error in file saving
        return false;
    }

 }
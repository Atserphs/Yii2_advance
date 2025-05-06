<?php
 namespace common\models;
 use yii\db\ActiveRecord;

 class Contact extends ActiveRecord{
    public static function tableName(){
        return ('contact');
    }

    public function rules()
    {
        return [
            // [['user_id', 'user_name', 'phone_number', 'address', 'email'], 'required'],

            // ['user_id', 'string', 'max' => 10],

            // ['user_name', 'string', 'max' => 50],

            // ['phone_number', 'string', 'max' => 10],
            // ['phone_number'],

            // ['address', 'string', 'max' => 100],

            // ['email', 'string', 'max' => 100],
            // ['email', 'email'],
            // ['email'],

            [['user_id', 'user_name', 'phone_number', 'address', 'email'], 'required'],
            ['email', 'email'],
            [['user_id', 'phone_number'], 'string', 'max' => 10],
            [['user_name'], 'string', 'max' => 50],
            [['address', 'email'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
            ['email', 'unique']
        ];
    }

 }
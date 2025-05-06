<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property string $user_id
 * @property string $user_name
 * @property string $phone_number
 * @property string $address
 * @property string $email
 */
class Contact extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user_name', 'phone_number', 'address', 'email'], 'required'],
            [['user_id', 'phone_number'], 'string', 'max' => 10],
            [['user_name'], 'string', 'max' => 50],
            [['address', 'email'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'email' => 'Email',
        ];
    }

}

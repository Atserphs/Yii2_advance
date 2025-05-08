<?php
 namespace backend\controllers;
 use Yii;
 use yii\web\Controller;
 use yii\db\ActiveRecord;
 use common\models\Contact;
 use yii\web\UploadedFile;
 

 class ContactController extends Controller{

    //Action for index page with table
    public function actionIndex()
    {

        $query = "SELECT * FROM ".Contact::tableName();
        $contacts_fetch = Yii::$app->db->createCommand($query)->queryAll();

       if($contacts_fetch !== NUll){
        return $this->render('index', [
            'contact_re' =>  $contacts_fetch
        ]); 
       }
       else{
        return ("data is not fetch");
       }

    }

    //Action for Contact adding form
    public function actionAddContact(){
        return $this->render('createform');
    }
    
    //Action for adding contact form
    public function actionAddContactRecord(){
        $contact = new Contact();
        if((Yii::$app->request->isPost) ){
            // getting data from post request
            $contact->user_id = $this->generateUserId(Yii::$app->request->post('phone_number'));
            $contact->user_name = Yii::$app->request->post('user_name');
            $contact->phone_number = Yii::$app->request->post('phone_number');
            $contact->address = Yii::$app->request->post('address');
            $contact->email = Yii::$app->request->post('email');    
            
            //instance for file
            //method1
            $imageFile = UploadedFile::getInstanceByName('image');
            $contact->profileImage = $imageFile;

            if($imageFile){
                $receive_path = $contact->uploadAndSave();
                echo($receive_path);
                $contact->user_pp_path = $receive_path;
            }

            if($contact->save(false)){
                Yii::$app->session->setFlash('success', 'Form submitted');
                return $this->redirect(['contact/index']);    
            }

           throw new \yii\web\BadRequestHttpException('Something error in this process');

            // // method 2 $contact->profileImage = UploadedFile::getInstance($model,'profileImage');
        
            // if($model->uploadAndSave()){
            //     Yii::$app->session->setFlash('success', 'Image Uploaded successfully');
            //     return $this->redirect('index');
            // }


            // $query = "INSERT INTO ".Contact::tableName()." (user_id, user_name, phone_number, address, emaiL) VALUES (:user_id,:user_name,:phone_number, :address, :emaiL)";
            // $param =[
            //     ':user_id' => $contact->user_id,
            //     ':user_name' => $contact->user_name,
            //     ':phone_number' => $contact->phone_number,
            //     ':address' => $contact->address,
            //     ':emaiL' => $contact->email
            // ];

            // $contact_add = Yii::$app->db->createCommand($query,$param)->queryAll();

            // if($contact_add !== NULL){
            //     return $this->redirect(['contact/index']);
            // }
            // else{
            //     echo ('Error to save record');
            // }



        }

      

 
    }

    //user_id generator
    public function generateUserId($phone_number){
        //last two digit of user's phone number
        $lastTwoDigit = substr($phone_number,-2);
        $yearLastTwoDigit = substr(date('y'), -2);
        $currentMonth = date('m');

        return ('U'.$currentMonth.$lastTwoDigit.$yearLastTwoDigit);
    }

    //Action for deleting contact
    public function actionDelete(){
        
        if(Yii::$app->request->isPost){
            $query = "DELETE FROM ".Contact::tableName(). " WHERE user_id = :user_id";
            $param = [
                'user_id' => Yii::$app->request->post('user_id')
            ];

            $delete_record = Yii::$app->db->createCommand($query,$param)->queryAll();

            if($delete_record !== NULL){
                return $this->redirect(['contact/index']);
            }
            else{
                echo ('Error occured during delete.');
            }
        }
        else {
            echo('Post request is not made.');
        }
    }

    //Action for deleting contact
    public function actionEdit(){

        if(Yii::$app->request->isPost)
        {
            $user_id = Yii::$app->request->post('user_id');
            $query = "SELECT * FROM ".Contact::tableName()." WHERE user_id = :user_id LIMIT 1";
            $param = [
                ':user_id' => $user_id
            ];

            $edit_request = Yii::$app->db->createCommand($query,$param)->queryOne();

            
            if($edit_request !== NULL)
            {
                return $this->render('editform',[
                    'contact_info' => $edit_request
                ]);
            }
            else{
                echo ("Error in edit.");
            }   
        }
        else{
            echo ("Invalid Request");
        }
    }

    //Action for updating contact
    public function actionEditContact(){

        if(Yii::$app->request->isPost)
        {   
            $contact = new Contact();
            if((Yii::$app->request->isPost) ){
                $user_id = Yii::$app->request->post('user_id');
                $contact = Contact::findOne($user_id);
                $oldPath = $contact->user_pp_path;
                
                
                // getting data from post request
                $contact->user_id = Yii::$app->request->post('user_id');
                $contact->user_name = Yii::$app->request->post('user_name');
                $contact->phone_number = Yii::$app->request->post('phone_number');
                $contact->address = Yii::$app->request->post('address');
                $contact->email = Yii::$app->request->post('email');    
                
                $oldFilePath = Yii::getAlias("@webroot/".$oldPath);
                //instance for file
                //method1
                $imageFile = UploadedFile::getInstanceByName('profileImage');
                $contact->profileImage = $imageFile;
    
                if($imageFile){
                    if($oldPath !== null){
                        @unlink($oldFilePath);
                        
                    }
                    $receive_path = $contact->uploadAndSave();
                    //echo($receive_path."-----");
                    $contact->user_pp_path = $receive_path;
                }

                if($contact->save(false)){
                    Yii::$app->session->setFlash('success', 'Form submitted');
                    return $this->redirect(['contact/index']);    
                }
    
               throw new \yii\web\BadRequestHttpException('Something error in this process');
    
        //     $user_id = Yii::$app->request->post('user_id');
            
        //     $query = "UPDATE ".Contact::tableName()." SET user_name = :user_name, phone_number = :phone_number, address = :address, email = :email  WHERE user_id = :user_id";
        //     $param = [
        //         ':user_name' => Yii::$app->request->post('user_name'),
        //         ':phone_number' => Yii::$app->request->post('phone_number'),
        //         ':email' => Yii::$app->request->post('email'),
        //         ':address' => Yii::$app->request->post('address'),
        //         ':user_id' => Yii::$app->request->post('user_id')
        //     ];

        //     $edit_request = Yii::$app->db->createCommand($query,$param)->execute();

            
        //     if($edit_request !== NULL)
        //     {
        //         return $this->redirect(['contact/index']);
        //     }
        //     else{
        //         echo ("Error in edit.");
        //     }   
        // }
        // else{
        //     echo ("Invalid Request");
         }
    }
    }
    //Action for updating contact
 }
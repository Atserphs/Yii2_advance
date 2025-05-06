<?php
 namespace backend\controllers;
 use Yii;
 use yii\web\Controller;
 use common\models\Contact;
 

 class ContactController extends Controller{
    public function actionIndex()
    {
        // Build the query
        $query = Contact::find()
            ->select('*') // Select all columns
            ->from(Contact::tableName()) // Specify the table name dynamically
            ->orderBy('user_id') // Add ordering
            ->limit(10); // Limit to 10 results

        // Execute the query to fetch data
        $contacts_fetch = $query->all();

        // Render the view and pass the data
        return $this->render('index', [
            'contact_re' => $contacts_fetch,
        ]);
    }

    public function actionAddContact(){
        return $this->render('createform');
    }
    
    public function actionAddContactRecord(){
        $contact = new Contact();
        if((Yii::$app->request->isPost) ){
            // $user_name = Yii::$app->request->post('user_name');
            // $phone_number = Yii::$app->request->post('phone_number');
            // $address = Yii::$app->request->post('address');
            // $email = Yii::$app->request->post('email');
            // $user_id = $this->generateUserId($phone_number);

            $contact->user_id = $this->generateUserId(Yii::$app->request->post('phone_number'));
            $contact->user_name = Yii::$app->request->post('user_name');
            $contact->phone_number = Yii::$app->request->post('phone_number');
            $contact->address = Yii::$app->request->post('address');
            $contact->email = Yii::$app->request->post('email');

 
        
            
            echo '<pre>';
            print_r($contact->attributes);
            echo '</pre>';

            $contact->save();
    
            
            // if($contact->save()){
            //    return $this->render('index', ['message' => "added succussfully"]);
            // }
            // else{
            //    return $this->render('index', ['message' => "Error occured"]);
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

    public function actionDelete(){
        
        if(Yii::$app->request->isPost){
        $contact = Contact::findOne(Yii::$app->request->post('user_id'));

        if($contact !== null){
            $contact->delete();
            return $this->redirect('index');
        }
            return "failed";

        }


    }

    // public function actionEdit(){
    //     if(Yii::$app->request->isPost){
    //         $fetch_contact = Contact::findOne(Yii::$app->requst->post('user_id'));

    //         if($fetch_contact !== null)
    //         {
    //             return->$this->render('create');
    //         }
    //     }
    // }
 }
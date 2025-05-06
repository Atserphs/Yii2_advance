<?php
 namespace backend\controllers;
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
    //     $new_contact = new Contact();

    //     $new_contact->contact_id = '4';
    //     $new_contact->user_id = '44';
    //     $new_contact->phone_number = '1234567890';
    //     $new_contact->address = 'bkt';
    //     $new_contact->email = 'user4@gmail.com';

    //    if( $new_contact->save() ) {
    //         echo('Record created successfully!');
    //     }
    //     else{
    //        echo('Record creating is failed');
    //     }
        
    }



 }
<?php
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<table class="table caption-top">
  <caption>Contact List</caption>
  <thead>
    <tr>
      <th scope="col">User Id</th>
      <th scope="col">Username</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Address</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($contact_re as $contact): ?>
            <tr class="border-bottom-[1px]">
                <td><?= $contact->user_id; ?></td>
                <td><?= $contact->user_name; ?></td>
                <td><?= $contact->phone_number; ?></td>
                <td><?= $contact->address; ?></td>
                <td><?= $contact->email; ?></td>

                <!-- buttons -->
                <td>
                  <div style="display:flex; gap:.5rem; ">
                    <div>
                      <form method="post" action="<?= \yii\helpers\Url::to(['contact/delete']) ?>">
                      <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>"> 
                
                        <input type="hidden" name="user_id" value="<?= $contact->user_id; ?>">
                        <button type="submit" class="btn btn-sm" style="background-color:#3cb043; color:white;">
                        <i class="fa-solid fa-pencil"></i> Edit
                        </button>
                      </form> 
                    </div>

                    <div>
                    <form method="post" action="<?= \yii\helpers\Url::to(['contact/delete']) ?>">
                    <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>"> 
                
                          <input type="hidden" name="user_id" value="<?= $contact->user_id; ?>">
                          <button type="submit" class="btn btn-sm" style="background-color:red; color:white;">
                          <i class="fa-solid fa-trash"></i> Delete
                          </button>
                      </form>  
                    </div>
                  </div>
                </td>
            </tr>
  <?php endforeach; ?>
  </tbody>
</table>

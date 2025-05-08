<?php
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<head>
  <style>
    .alert_box{
      background-color: #fff;
      box-shadow: 2px 2px 10px 2px rgba(0, 0, 0, 0.1);  
      padding: 1rem ;
      border-radius:10px;
      top:50%;
      left:50%;
      transform:translate(-50%,-50%);
      display:none;
      /* border:1px solid; */
    }

    #delete_alert{
      display:none;
    }

    .button_div{
      margin:20px 0px 20px 0px; 
      float:right;
      display:flex;
    }
  
    .outer_container{
      height:100%;
    
    }
  </style>
</head>


<script>
function open_alert(id) {
  document.getElementById('alert_box').style.display = "block";
  document.getElementById('delete_alert').style.display = "block";
  document.getElementById('upper_id').value = id;
}

function close_alert() {
  document.getElementById('alert_box').style.display = "none";
  document.getElementById('delete_alert').style.display = "none";
  document.getElementById('upper_id').value = "";
}
</script>

<div class="position-relative outer_container">
  <div class="alert_box  position-absolute" id="alert_box">
    <!-- Alert for delete -->
    <div id="delete_alert">
      <div>Are you sure want to delete?</div>
      <div class="button_div">

        <form method="post" action="<?= \yii\helpers\Url::to(['contact/delete']) ?>">
          <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
          <input type="hidden" id="upper_id" name="user_id" value="">
          <button type="submit"  class="btn btn-danger" >Delete</button>
        </form>
        
        <button onclick="close_alert()" style="margin-left:8px;" class="btn btn-secondary">Cancel</button>
      </div>
    </div>
  </div>

  <div style="display:flex;">
        <div><caption>Contact List</caption></div>
        <div style="display:flex; flex:1; justify-content:right;  align-item:center; float:right;">
          <a href="add-contact">
            <button type="button" class="btn btn-success"> + Add Contact</button>
          </a>
        </div>
  </div>

  <div>
    <table class="table caption-top">
 
      
      <thead>
        <tr>
          <th scope="col"></th>
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
                    <td><img style="height:40px; aspect-ratio:1/1; border-radius:50%;" src="<?= Yii::$app->request->baseUrl . "/" . $contact['user_pp_path']?>"  alt="<?= $contact['user_name'] . "_img" ?>"></td>
                    <td><?= $contact['user_id']; ?></td>
                    <td><?= $contact['user_name']; ?></td>
                    <td><?= $contact['phone_number']; ?></td>
                    <td><?= $contact['address']; ?></td>
                    <td><?= $contact['email']; ?></td>


                    <!-- buttons -->
                    <td>
                      <div style="display:flex; gap:.5rem; ">
                        <div>
                          <form method="post" action="<?= \yii\helpers\Url::to(['contact/edit']) ?>">
                          <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>"> 
                    
                            <input type="hidden" name="user_id" value="<?= $contact['user_id']; ?>">
                            <button type="submit" class="btn btn-sm" style="background-color:#3cb043; color:white;">
                            <i class="fa-solid fa-pencil"></i> Edit
                            </button>
                          </form> 
                        </div>

                        <div>

                          <button type="button" onclick="open_alert('<?php echo ($contact['user_id']); ?>')" class="btn btn-sm" style="background-color:red; color:white;">
                          <i class="fa-solid fa-trash"></i> Delete
                          </button>
                        </div>
                      </div>
                    </td>
                </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

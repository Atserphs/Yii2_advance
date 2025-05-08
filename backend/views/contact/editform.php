<?php

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<body>
    <div class="container">
        <div class="form-container">
            <h3>Edit Contact:</h3>
            <div class="header-gradient"></div>

            <form method="post" enctype="multipart/form-data" action="<?= \yii\helpers\Url::to(['contact/edit-contact']) ?>">
            <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>"> 
            <input type="hidden" name="user_id" value="<?= $contact_info['user_id']; ?>">  
            
                <div class="mb-3" style="display:flex; justify-content:center; align-items:center; flex-direction:column; ">
                    <div>
                    <label for="profileImage" class="form-label">
                        <img id="preview" style="height:8rem; cursor:pointer; aspect-ratio:1/1; border-radius:50%;" src="<?= Yii::$app->request->baseUrl . "/" . $contact_info['user_pp_path'] ?>" alt="<?= $contact_info['user_pp_path'] . "_img" ?>">
                    </label>
                    </div>

                    <div>
      
                        <button type="button" class="btn btn-primary" style="font-size:.8rem;" onclick="document.getElementById('profileImage').click();" ><i class="fa-solid fa-pencil"></i>  Change Photo</button>
      
                    </div>
                    <input type="file" class="form-control" id="profileImage" name="profileImage" style="display:none;"  >
                
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="user_name" placeholder="Enter your username" value="<?= $contact_info['user_name'] ?>" >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= $contact_info['email'] ?>">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="Enter your phone number" value="<?= $contact_info['phone_number'] ?>">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" rows="3" name="address" placeholder="Enter your complete address"><?= $contact_info['address'] ?></textarea>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary py-2">Save & Continue</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('profileImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const preview = document.getElementById('preview');
                preview.src = URL.createObjectURL(file);
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

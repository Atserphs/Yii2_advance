<?php

?>
<body>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <div class="container">
        <div class="form-container">
        <h3 className="text-3xl font-bold underline text-red-800">Add Contact:</h3>
            <div class="header-gradient"></div>

            <form method="post" action="<?= \yii\helpers\Url::to(['contact/add-contact-record']) ?>" enctype="multipart/form-data">
            <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>"> 

                <div class="mb-3">
                    <label for="image" class="form-label">Profile Image(Optional)</label>
                    <input type="file" class="form-control" name="image" placeholder="Enter your username">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="user_name" placeholder="Enter your username">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="Enter your phone number">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" rows="3" name="address" placeholder="Enter your complete address"></textarea>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary py-2">Save & Continue</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

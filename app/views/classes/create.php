<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Create a New Class</h2>
    <form id="createClass" method="POST" action="<?= URLROOT ?>/classesController/create">

        <!-- Add a hidden input field to store the selected school ID -->
        <input type="hidden" name="teacherId" value="<?= $data['teacherId'] ?>">

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="className">Class Name*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="className" id="className" required="true" maxlength="150">
            </div>
        </div>

        <!-- You may add more fields as needed for your education creation form -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
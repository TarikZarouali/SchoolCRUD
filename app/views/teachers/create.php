<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Create a New Teacher</h2>
    <form id="createTeacher" method="POST" action="<?= URLROOT ?>/subjectscontroller/createTeacher">

        <!-- Add a hidden input field to store the selected school ID -->
        <input type="hidden" name="educationId" value="<?= $data['educationId'] ?>">
        <input type="hidden" name="educationId" value="<?= $data['educationId'] ?>">

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="teacherFirstName">Teacher firstname*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="teacherFirstName" id="teacherFirstName" required="true"
                    maxlength="150">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="teacherLastName">Teacher lastname*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="teacherLastName" id="teacherLastName" required="true"
                    maxlength="150">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="teacherAdres">teacher adres*</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="teacherAdres" id="teacherAdres" required="true" rows="5"
                    style="resize: vertical;"></textarea>
            </div>
        </div>

        <!-- You may add more fields as needed for your education creation form -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
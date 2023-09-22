<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Create a New attendancy</h2>
    <form id="createGrade" method="POST" action="<?= URLROOT ?>/gradesController/createAttendancy">

        <!-- Add a hidden input field to store the selected school ID -->
        <input type="hidden" name="studentId" value="<?= $data['studentId'] ?>">

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="attendancyReason">attendancy reason*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="attendancyReason" id="attendancyReason" required="true" maxlength="150">
            </div>
        </div>

        <!-- You may add more fields as needed for your education creation form -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
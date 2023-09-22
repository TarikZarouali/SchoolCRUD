<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Create a New Subject</h2>
    <form id="createEducation" method="POST" action="<?= URLROOT ?>/subjectscontroller/create">

        <!-- Add a hidden input field to store the selected school ID -->
        <input type="hidden" name="educationId" value="<?= $data['educationId'] ?>">
        <input type="hidden" name="educationId" value="<?= $data['educationId'] ?>">

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="subjectName">Subject Name*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="subjectName" id="subjectName" required="true" maxlength="150">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="subjectDescription">Subject Description*</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="subjectDescription" id="subjectDescription" required="true" rows="5" style="resize: vertical;"></textarea>
            </div>
        </div>

        <!-- You may add more fields as needed for your education creation form -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
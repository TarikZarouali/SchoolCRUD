<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Create a New student</h2>
    <form id="createEducation" method="POST" action="<?= URLROOT ?>/studentsController/create">

        <!-- Add a hidden input field to store the selected school ID -->
        <input type="hidden" name="classId" value="<?= $data['classId'] ?>">

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="studentFirstName">student firstname*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="studentFirstName" id="studentFirstName" required="true" maxlength="150">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="studentLastName">Education Lastname*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="studentLastName" id="studentLastName" required="true">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="studentAdres">student address*</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="studentAdres" id="studentAdres" required="true" rows="5" style="resize: vertical;"></textarea>
            </div>
        </div>

        <!-- You may add more fields as needed for your education creation form -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
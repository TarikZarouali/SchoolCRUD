<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container ">
    <h2>Maak een nieuwe school aan</h2>
    <form id="createSchool" method="POST" action="<?= URLROOT ?>/schoolsController/create">

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="schoolName">School Name*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="schoolName" id="schoolName" required="true"
                    maxlength="150">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="schoolAdres">School Address*</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="schoolAdres" id="schoolAdres" required="true"
                    maxlength="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 col-form-label" for="schoolDescription">School Description*</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="schoolDescription" id="schoolDescription" required="true" rows="5"
                    style="resize: vertical;"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
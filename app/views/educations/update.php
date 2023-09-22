<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update Education</h2>
    <form action="<?= URLROOT; ?>/educationsController/update/<?= $data['education']->educationId ?>" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" id="educationId" name="educationId"
                value="<?= $data['education']->educationId ?>">
        </div>

        <div class="form-group">
            <label for="educationName">Education Name:</label>
            <input type="text" class="form-control" id="educationName" name="educationName"
                value="<?= $data['education']->educationName ?>">
        </div>

        <div class="form-group">
            <label for="educationDuration">Education Duration:</label>
            <input type="text" class="form-control" id="educationDuration" name="educationDuration"
                value="<?= $data['education']->educationDuration ?>">
        </div>

        <div class="form-group">
            <label for="educationDescription">Education Description:</label>
            <textarea class="form-control" id="educationDescription" name="educationDescription"
                rows="5"><?= $data['education']->educationDescription ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Education</button>
    </form>
</div>
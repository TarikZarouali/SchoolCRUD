<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update School</h2>
    <form action="<?= URLROOT; ?>/schoolsController/update/<?= $data['school']->schoolId ?>" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" id="schoolId" name="schoolId"
                value="<?= $data['school']->schoolId ?>">
        </div>

        <div class="form-group">
            <label for="schoolName">School Name:</label>
            <input type="text" class="form-control" id="schoolName" name="schoolName"
                value="<?= $data['school']->schoolName ?>">
        </div>
        <div class="form-group">
            <label for="schoolAdres">School Address:</label>
            <input type="text" class="form-control" id="schoolAdres" name="schoolAdres"
                value="<?= $data['school']->schoolAdres ?>">
        </div>

        <div class="form-group">
            <label for="schoolDescription">School Description:</label>
            <textarea class="form-control" id="schoolDescription" name="schoolDescription"
                rows="5"><?= $data['school']->schoolDescription ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update School</button>
    </form>
</div>
<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update subject</h2>
    <form action="<?= URLROOT; ?>/subjectsController/update/<?= $data['subject']->subjectId ?>" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" id="subjectId" name="subjectId"
                value="<?= $data['subject']->subjectId ?>">
        </div>

        <div class="form-group">
            <label for="subjectName">subject Name:</label>
            <input type="text" class="form-control" id="subjectName" name="subjectName"
                value="<?= $data['subject']->subjectName ?>">
        </div>



        <div class="form-group">
            <label for="subjectDescription">subject Description:</label>
            <textarea class="form-control" id="subjectDescription" name="subjectDescription"
                rows="5"><?= $data['subject']->subjectDescription ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update subject</button>
    </form>
</div>
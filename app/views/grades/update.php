<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update grade</h2>
    <form action="<?= URLROOT; ?>/gradesController/update/<?= $data['grade']->gradeId ?>" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" id="gradeId" name="gradeId"
                value="<?= $data['grade']->gradeId ?>">
        </div>

        <div class="form-group">
            <label for="studentFirstName">grade name:</label>
            <input type="text" class="form-control" id="gradeName" name="gradeName"
                value="<?= $data['grade']->gradeName ?>">
        </div>

        <div class="form-group">
            <label for="gradeGrade">grade:</label>
            <input type="text" class="form-control" id="gradeGrade" name="gradeGrade"
                value="<?= $data['grade']->gradeGrade ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update grade</button>
    </form>
</div>
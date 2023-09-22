<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update Class</h2>
    <form action="<?= URLROOT; ?>/classesController/update/<?= $data['class']->classId ?>" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" id="classId" name="classId" value="<?= $data['class']->classId ?>">
        </div>

        <div class="form-group">
            <label for="className">Class Name:</label>
            <input type="text" class="form-control" id="className" name="className" value="<?= $data['class']->className ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update Class</button>
    </form>
</div>
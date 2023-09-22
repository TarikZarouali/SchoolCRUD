<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update Class</h2>
    <form action="<?= URLROOT; ?>/classesController/update/<?= $data['classId'] . '+' . $data['teacherId'] ?>"
        method="POST">
        <div class="form-group">
            <input type="hidden" name="classId" value="<?= $data['class']->classId ?>">
        </div>

        <div class="form-group">
            <label for="className">Class Name:</label>
            <input type="text" id="className" name="className" class="form-control"
                value="<?= $data['class']->className ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update Class</button>
    </form>
</div>
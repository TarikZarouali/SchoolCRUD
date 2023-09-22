<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update Teacher</h2>
    <form
        action="<?= URLROOT; ?>/subjectsController/updateTeacher/<?= $data['teacherId'] . '+' . $data['educationId'] ?>"
        method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" id="teacherId" name="teacherId"
                value="<?= $data['Teacher']->teacherId ?>">
        </div>

        <div class="form-group">
            <label for="teacherFirstName">teacher first name:</label>
            <input type="text" class="form-control" id="teacherFirstName" name="teacherFirstName"
                value="<?= $data['Teacher']->teacherFirstName ?>">
        </div>



        <div class="form-group">
            <label for="teacherLastName">Teacher Last Name:</label>
            <textarea class="form-control" id="teacherLastName" name="teacherLastName"
                rows="5"><?= $data['Teacher']->teacherLastName ?></textarea>
        </div>

        <div class="form-group">
            <label for="teacherAdres">Teacher Adres:</label>
            <textarea class="form-control" id="teacherAdres" name="teacherAdres"
                rows="5"><?= $data['Teacher']->teacherAdres ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update subject</button>
    </form>
</div>
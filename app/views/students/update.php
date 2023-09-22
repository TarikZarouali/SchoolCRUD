<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update student</h2>
    <form action="<?= URLROOT; ?>/studentsController/update/<?= $data['studentId'] . '+' . $data['classId'] ?>" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" id="studentId" name="studentId" value="<?= $data['Student']->studentId ?>">
        </div>

        <div class="form-group">
            <label for="studentFirstName">Student firstname:</label>
            <input type="text" class="form-control" id="studentFirstName" name="studentFirstName" value="<?= $data['student']->studentFirstName ?>">
        </div>

        <div class="form-group">
            <label for="studentLastName">Student lastname:</label>
            <input type="text" class="form-control" id="studentLastName" name="studentLastName" value="<?= $data['student']->studentLastName ?>">
        </div>

        <div class="form-group">
            <label for="studentAdres">Student adres:</label>
            <input type="text" class="form-control" id="studentAdres" name="studentAdres" value="<?= $data['student']->studentAdres ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update student</button>
    </form>
</div>
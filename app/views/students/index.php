<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div style="display: flex; flex-direction: column; align-items: center; padding-top: 20px;">
    <div style="width: 50%; text-align: center;">
        <table class="table table-hover" style="margin: 0 auto;">
            <thead>
                <tr>
                    <th>Class Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['Class']->className ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="float-right" style="margin-top: 20px; margin-bottom: 2rem;">
    <a class="btn btn-success" href="<?= URLROOT; ?>studentsController/create/<?= $data['Class']->classId ?>">Create
        new student</a>
    <a class="btn btn-info" href="<?= URLROOT; ?>classesController/update/<?= $data['Class']->classId ?>">update
        class</a>
    <a class="btn btn-danger" href="<?= URLROOT; ?>classesController/delete/<?= $data['Class']->classId ?>">
        delete class</a>
</div>

<div style=" margin-top:100px;display: flex; justify-content: center;">
    <table class="table table-hover" style="width: 80%;">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Class ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Adres</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['Student'] as $student) { ?>
            <tr>
                <td><a href="<?= URLROOT; ?>gradesController/index/<?= $student->studentId ?>"
                        style="text-decoration:none; color:black;"><?= $student->studentId ?></td>
                <td><?= $student->studentClassId ?></td>
                <td><?= $student->studentFirstName ?></td>
                <td><?= $student->studentLastName ?></td>
                <td><?= $student->studentAdres ?></td>
                <td style="text-align: center;">
                    <div style="display: flex; justify-content: center;">
                        <a class="btn btn-danger"
                            href="<?= URLROOT; ?>/studentsController/delete/<?= $student->studentId . '+' . $data['Class']->classId ?>"
                            onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                        <a class="btn btn-info"
                            href="<?= URLROOT; ?>/studentsController/update/<?= $student->studentId . '+' . $data['Class']->classId  ?>">Update</a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>


</div>
<div style="display: flex; justify-content: center; margin-top: 20px;">
    <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
        </li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</div>
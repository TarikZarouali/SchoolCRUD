<?php require_once APPROOT . '/Views/Includes/head.php'; ?>
<table class="table table-hover">
    <thead>
        <th style="text-align: center;">teacher Name</th>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center; margin-bottom: 2rem;">
                <?= $data['Teacher']->teacherFirstName . ' ' . $data['Teacher']->teacherLastName ?>
            </td>
        </tr>
    </tbody>
</table>



<div class="float-right" style="margin-bottom: 2rem;">
    <a class="btn btn-success" href="<?= URLROOT; ?>/classesController/create/<?= $data['Teacher']->teacherId ?>">Create
        new Class</a>
    <a class="btn btn-danger" href="<?= URLROOT; ?>/subjectsController/deleteTeacher/<?= $data['Teacher']->teacherId . '+' . $data['teacherId']->teacherId  ?>">Delete
        teacher</a>
    <a class="btn btn-info" href="<?= URLROOT; ?>/subjectsController/updateTeacher/<?= $data['Teacher']->teacherId ?>">edit
        Teacher</a>

</div>


<table class="table table-hover">
    <thead>
        <th>class Id</th>
        <th>TeacherId</th>
        <th>class Name</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach ($data["Class"] as $class) { ?>
            <tr>

                <td><a href="<?= URLROOT; ?>studentsController/index/<?= $class->classId ?>" style="text-decoration:none; color:black;"><?= $class->classId ?></a></td>
                <td><?= $class->classTeacherId ?></td>
                <td><?= $class->className ?></td>
                <td style="align-items: center;">
                    <a class=" btn btn-danger" href="<?= URLROOT; ?>/classesController/delete/<?= $class->classId . '+' . $data['Teacher']->teacherId  ?>" onclick="return confirm('Are you sure you want to delete this school?')">Delete</a>
                    <a class="btn btn-info" href="<?= URLROOT; ?>/classesController/update/<?= $class->classId . '+' . $data['Teacher']->teacherId ?>">Update</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
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
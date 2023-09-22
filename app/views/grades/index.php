<?php require_once APPROOT . '/Views/Includes/head.php'; ?>
<!-- Add these lines to include Bootstrap CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<div style="display: flex; flex-direction: column; align-items: center; padding-top: 20px;">
    <div style="width: 50%; text-align: center;">
        <table class="table table-hover" style="margin: 0 auto;">
            <thead>
                <tr>
                    <th><?= $data['Student']->studentFirstName . ' ' . $data['Student']->studentLastName ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Woont op de <?= $data['Student']->studentAdres ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
            role="tab" aria-controls="nav-home" aria-selected="true">Grades</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
            role="tab" aria-controls="nav-profile" aria-selected="false">Attendances</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <!-- Content for the Grades tab goes here -->
        <div class="float-right" style="margin-top: 20px;">
            <a class="btn btn-success"
                href="<?= URLROOT; ?>/gradesController/create/<?= $data['Student']->studentId ?>">Create new grade</a>
        </div>
        <table class="table table-hover" style="width: 80%;">
            <thead>
                <tr>
                    <th>Grade ID</th>
                    <th>Grade Student ID</th>
                    <th>Grade name</th>
                    <th>Student Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['Grade'] as $grade) { ?>
                <tr>
                    <td><?= $grade->gradeId ?></td>
                    <td><?= $grade->gradeStudentId ?></td>
                    <td><?= $grade->gradeName ?></td>
                    <td><?= $grade->gradeGrade ?></td>
                    <td style="text-align: center;">
                        <div style="display: flex; justify-content: center;">
                            <a class="btn btn-danger"
                                href="<?= URLROOT; ?>/gradesController/delete/<?= $grade->gradeId ?>"
                                onclick="return confirm('Are you sure you want to delete this grade?')">Delete</a>
                            <a class="btn btn-info"
                                href="<?= URLROOT; ?>/gradesController/update/<?= $grade->gradeId ?>">Update</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <!-- Content for the Attendances tab goes here -->
        <div class="float-right" style="margin-top: 20px;">
            <a class="btn btn-success"
                href="<?= URLROOT; ?>/gradesController/createAttendancy/<?= $data['Student']->studentId ?>">Create
                new attendance</a>
        </div>
        <table class="table table-hover" style="width: 80%;">
            <thead>
                <tr>
                    <th>Attendance ID</th>
                    <th>Attendance Student ID</th>
                    <th>Attendance Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['Attendancy'] as $attendancy) { ?>
                <tr>
                    <td><?= $attendancy->attendancyId ?></td>
                    <td><?= $attendancy->attendancyStudentId ?></td>
                    <td><?= $attendancy->attendancyReason ?></td>
                    <td style="text-align: center;">
                        <div style="display: flex; justify-content: center;">
                            <a class="btn btn-danger"
                                href="<?= URLROOT; ?>/gradesController/deleteAttendancy/<?= $attendancy->attendancyId ?>"
                                onclick="return confirm('Are you sure you want to delete this attendance?')">Delete</a>
                            <a class="btn btn-info"
                                href="<?= URLROOT; ?>/gradesController/updateAttendancy/<?= $attendancy->attendancyId ?>">Update</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <div style="display: flex; flex-direction: column; align-items: center; padding-top: 20px;">
        <div style="width: 50%;">
            <table class="table table-hover" style="text-align: center; border: 10px solid black;">
                <thead></thead>
                <tbody>
                    <tr>
                        <td style="font-size: 30px;"><?= $data['Education']->educationName ?></td>
                    </tr>
                    <tr>
                        <td><?= $data['Education']->educationDescription ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="subjects-tab" data-bs-toggle="tab" href="#subjects-tab-pane" role="tab"
                aria-controls="subjects-tab-pane" aria-selected="true">Subjects</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile-tab-pane" role="tab"
                aria-controls="profile-tab-pane" aria-selected="false">Teachers</a>
        </li>
        <!-- Add more tabs as needed -->
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="subjects-tab-pane" role="tabpanel" aria-labelledby="subjects-tab">
            <div class="float-right" style="margin-top: 20px;">
                <a class="btn btn-success"
                    href="<?= URLROOT; ?>/subjectscontroller/create/<?= $data['Education']->educationId ?>">Create new
                    subject</a>


            </div>
            <!-- Content for Subjects tab -->
            <div style="display: flex; justify-content: center;">
                <table class="table table-hover" style="width: 80%;">
                    <thead>
                        <tr>
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                            <th>Action</th> <!-- Adding an Action header for potential actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['Subject'] as $subject) { ?>
                        <tr>
                            <td><?= $subject->subjectId ?></td>
                            <td><?= $subject->subjectName ?></td>
                            <td style="align-items: center;">
                                <!-- Align buttons to the right -->
                                <!-- Add your action buttons here -->
                                <a class="btn btn-danger"
                                    href="<?= URLROOT; ?>/subjectsController/delete/<?= $subject->subjectId . '+' .  $data['Education']->educationId ?>"
                                    onclick="return confirm('Are you sure you want to delete this subject?')">Delete</a>
                                <a class="btn btn-info"
                                    href="<?= URLROOT; ?>/subjectsController/update/<?= $subject->subjectId ?>">Update</a>
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
        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab">
            <!-- Content for Profile tab -->
            <div class="float-right" style="margin-top: 20px;">
                <a class="btn btn-success"
                    href="<?= URLROOT; ?>/subjectsController/createTeacher/<?= $data['Education']->educationId ?>">Create
                    new
                    teacher</a>
            </div>
            <div style="display: flex; justify-content: center;">
                <table class="table table-hover" style="width: 80%;">
                    <thead>
                        <tr>
                            <th>Teacher ID</th>
                            <th>Teacher Firstname</th>
                            <th>Teacher Lastname</th>
                            <th>Action</th> <!-- Adding an Action header for potential actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['Teacher'] as $teacher) { ?>
                        <tr>
                            <td><a href="<?= URLROOT; ?>classesController/index/<?= $teacher->teacherId ?>"
                                    style="text-decoration:none; color:black;"><?= $teacher->teacherId ?></td>
                            <td><?= $teacher->teacherFirstName ?></td>
                            <td><?= $teacher->teacherLastName ?></td>
                            <td style="align-items: center;">
                                <!-- Align buttons to the right -->
                                <!-- Add your action buttons here -->
                                <a class="btn btn-danger"
                                    href="<?= URLROOT; ?>/subjectsController/deleteTeacher/<?= $teacher->teacherId . '+' . $data['Education']->educationId ?>"
                                    onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</a>
                                <a class="btn btn-info"
                                    href="<?= URLROOT; ?>/subjectsController/updateTeacher/<?= $teacher->teacherId . '+' . $data['Education']->educationId ?>">Update</a>
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
        </div>
        <!-- Add content for other tabs as needed -->
    </div>
</div>

<!-- Include Bootstrap JS at the end of the body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div style="display: flex; flex-direction: column; align-items: center; padding-top: 20px;">
    <div style="width: 50%;">
        <table class="table table-hover" style="text-align: center; border: 10px solid black;">
            <thead></thead>
            <tbody>
                <tr>
                    <td style="font-size: 30px;"><?= $data['School']->schoolName ?></td>
                </tr>
                <tr>
                    <td><?= $data['School']->schoolDescription ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="float-right" style="margin-top: 20px;">
        <a class="btn btn-success"
            href="<?= URLROOT; ?>educationsController/create/<?= $data['School']->schoolId ?>">Create new education</a>
    </div>
</div>

<div style="display: flex; justify-content: center;">
    <table class="table table-hover" style="width: 80%;">
        <thead>
            <tr>
                <th>School ID</th>
                <th>Education ID</th>
                <th>Education Name</th>
                <th>Education Duration</th>
                <th>Action</th> <!-- Adding an Action header for potential actions -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['Education'] as $education) { ?>
            <tr>
                <td><a href="<?= URLROOT; ?>SubjectsController/index/<?= $education->educationId ?>"
                        style="text-decoration:none; color:black;"><?= $education->schoolId ?></td>
                <td><?= $education->educationId ?></td>
                <td><?= $education->educationName ?></td>
                <td><?= $education->educationDuration ?></td>
                <td style="align-items: center;">
                    <!-- Align buttons to the right -->
                    <!-- Add your action buttons here -->
                    <a class="btn btn-danger"
                        href="<?= URLROOT; ?>/educationsController/delete/<?= $education->educationId . '+' . $data['School']->schoolId ?>"
                        onclick="return confirm('Are you sure you want to delete this education?')">Delete</a>
                    <a class="btn btn-info"
                        href="<?= URLROOT; ?>/educationsController/update/<?= $education->educationId ?>">Update</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
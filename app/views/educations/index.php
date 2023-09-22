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
        <a class="btn btn-success" href="<?= URLROOT; ?>educationsController/create/<?= $data['School']->schoolId ?>">Create new education</a>
        <a class=" btn btn-danger" href="<?= URLROOT; ?>/schoolsController/delete/<?= $data['School']->schoolId ?>" onclick="return confirm('Are you sure you want to delete this school?')">Delete</a>
        <a class="btn btn-info" href="<?= URLROOT; ?>/schoolsController/update/<?= $data['School']->schoolId  ?>">Update</a>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['Education'] as $education) { ?>
                <tr>
                    <td><a href="<?= URLROOT; ?>SubjectsController/index/<?= $education->educationId ?>" style="text-decoration:none; color:black;"><?= $education->schoolId ?></td>
                    <td><?= $education->educationId ?></td>
                    <td><?= $education->educationName ?></td>
                    <td><?= $education->educationDuration ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
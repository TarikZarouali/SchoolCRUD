<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="float-right">
    <a class="btn btn-success" href="<?= URLROOT; ?>schoolsController/create" style="margin: 2rem;">Create new
        school</a>
</div>

<table class="table table-hover">
    <thead>
        <th>school name</th>
        <th>school addresss</th>
        <th>Action</th> <!-- Added a header for the action column -->
    </thead>
    <tbody>
        <?php foreach ($data["Schools"] as $school) { ?>
            <tr>

                <td><a href="<?= URLROOT; ?>EducationsController/index/<?= $school->schoolId ?>" style="text-decoration:none; color:black;"><?= $school->schoolName ?></a></td>
                <td><?= $school->schoolAdres ?></td>
                <td style="align-items: center;">
                    <a class=" btn btn-danger" href="<?= URLROOT; ?>/schoolsController/delete/<?= $school->schoolId ?>" onclick="return confirm('Are you sure you want to delete this school?')">Delete</a>
                    <a class="btn btn-info" href="<?= URLROOT; ?>/schoolsController/update/<?= $school->schoolId ?>">Update</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
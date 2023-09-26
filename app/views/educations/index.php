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

</div>
<div class="float-right" style="margin-top: 20px; margin-bottom:20px;">
    <a class="btn btn-success" href="<?= URLROOT; ?>educationsController/create/<?= $data['School']->schoolId ?>">Create
        new education</a>
    <a class=" btn btn-danger" href="<?= URLROOT; ?>/schoolsController/delete/<?= $data['School']->schoolId ?>"
        onclick="return confirm('Are you sure you want to delete this school?')">Delete</a>
    <a class="btn btn-info" href="<?= URLROOT; ?>/schoolsController/update/<?= $data['School']->schoolId  ?>">Update</a>
</div>

<div style=" margin-top: 100px;display: flex; justify-content: center;">
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
                <td><a href="<?= URLROOT; ?>SubjectsController/index/<?= $education->educationId ?>"
                        style="text-decoration:none; color:black;"><?= $education->schoolId ?></td>
                <td><?= $education->educationId ?></td>
                <td><?= $education->educationName ?></td>
                <td><?= $education->educationDuration ?></td>
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
<?php require_once APPROOT . '/Views/Includes/footer.php'; ?>
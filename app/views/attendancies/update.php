<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <h2>Update Attendancy</h2>
    <form
        action="<?= URLROOT; ?>/gradesController/updateAttendancy/<?= $data['attendancyId'] . '+' . $data['studentId'] ?>"
        method="POST">
        <div class="form-group">
            <label for="attendancyReason">Attendancy Reason</label>
            <input type="text" class="form-control" id="attendancyReason" name="attendancyReason"
                value="<?= $data['attendancy']->attendancyReason ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update Attendancy</button>
    </form>
</div>
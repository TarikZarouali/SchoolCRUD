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
            <a class="nav-link active" id="subjects-tab" data-bs-toggle="tab" href="#subjects-tab-pane" role="tab" aria-controls="subjects-tab-pane" aria-selected="true">Subjects</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile-tab-pane" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Teachers</a>
        </li>
        <!-- Add more tabs as needed -->
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="subjects-tab-pane" role="tabpanel" aria-labelledby="subjects-tab">
            <div class="float-right" style="margin-top: 20px;">
                <a class="btn btn-success" href="<?= URLROOT; ?>/subjectscontroller/create/<?= $data['Education']->educationId ?>">Create new
                    subject</a>
            </div>
            <!-- Content for Subjects tab -->
            <div style="display: flex; justify-content: center;">
                <!-- Table headers for Subjects tab -->
                <table class=" table table-hover" style="width: 80%;" id="subjectsTable">
                    <thead>
                        <tr>
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['Subject'] as $subject) { ?>
                            <tr>
                                <td><?= $subject->subjectId ?></td>
                                <td><?= $subject->subjectName ?></td>
                                <td style="align-items: center;">
                                    <a class="btn btn-danger" href="<?= URLROOT; ?>/subjectsController/delete/<?= $subject->subjectId . '+' . $data['Education']->educationId ?>" onclick="return confirm('Are you sure you want to delete this subject?')">Delete</a>
                                    <a class="btn btn-info" href="<?= URLROOT; ?>/subjectsController/update/<?= $subject->subjectId ?>">Update</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <ul class="pagination" id="subjects-pagination">
                    <li class="page-item" id="subjects-previousPage">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <!-- Page links with numbers will be dynamically populated here -->
                    <li class="page-item" id="subjects-nextPage">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab">
            <!-- Content for Teachers tab -->
            <div class="float-right" style="margin-top: 20px;">
                <a class="btn btn-success" href="<?= URLROOT; ?>/subjectsController/createTeacher/<?= $data['Education']->educationId ?>">Create
                    new
                    teacher</a>
            </div>
            <div style="display: flex; justify-content: center;">
                <!-- Duplicate the table headers for the Teachers tab -->
                <table class="table table-hover" style="width: 80%;" id="teachersTable">
                    <thead>
                        <tr>
                            <th>Teacher ID</th>
                            <th>Teacher Firstname</th>
                            <th>Teacher Lastname</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['Teacher'] as $teacher) { ?>
                            <tr>
                                <td><a href="<?= URLROOT; ?>classesController/index/<?= $teacher->teacherId . '+' .  $data['Education']->educationId ?>" style="text-decoration:none; color:black;"><?= $teacher->teacherId ?></a></td>
                                <td><?= $teacher->teacherFirstName ?></td>
                                <td><?= $teacher->teacherLastName ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <ul class="pagination" id="teachers-pagination">
                    <li class="page-item" id="teachers-previousPage">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <!-- Page links with numbers will be dynamically populated here -->
                    <li class="page-item" id="teachers-nextPage">
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
<script>
    const subjectsTable = document.getElementById('subjectsTable');
    const subjectsPagination = document.getElementById('subjects-pagination');

    let subjectsCurrentPage = 1;
    const subjectsItemsPerPage = 4;
    const subjectsData = <?= json_encode($data['Subject']); ?>;

    function updateSubjectsTable() {
        const startIndex = (subjectsCurrentPage - 1) * subjectsItemsPerPage;
        const endIndex = startIndex + subjectsItemsPerPage;
        const subjectsSlice = subjectsData.slice(startIndex, endIndex);

        let tableHTML = '';
        for (const subject of subjectsSlice) {
            tableHTML += `
            <tr>
                <td>${subject.subjectId}</td>
                <td>${subject.subjectName}</td>
                <td style="align-items: center;">
                     <td style="align-items: center;">
                    <a class="btn btn-danger" href="<?= URLROOT; ?>/subjectsController/delete/${subject.subjectId}" onclick="return confirm('Are you sure you want to delete this school?')">Delete</a>
                    <a class="btn btn-info" href="<?= URLROOT; ?>/subjectsController/update/${subject.subjectId}">Update</a>
                </td>
            </tr>
        `;
        }

        subjectsTable.innerHTML = tableHTML;
    }

    function updateSubjectsPagination() {
        const subjectsTotalPages = Math.ceil(subjectsData.length / subjectsItemsPerPage);

        let paginationHTML = '';
        for (let i = 1; i <= subjectsTotalPages; i++) {
            paginationHTML += `
            <li class="page-item ${i === subjectsCurrentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>
        `;
        }

        subjectsPagination.innerHTML = `
        <li class="page-item" id="subjects-previousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" onclick="previousPage()">Previous</a>
        </li>
        ${paginationHTML}
        <li class="page-item" id="subjects-nextPage">
            <a class="page-link" href="#" onclick="nextPage()">Next</a>
        </li>
    `;
    }

    function changePage(page) {
        subjectsCurrentPage = page;
        updateSubjectsTable();
        updateSubjectsPagination();
    }

    function previousPage() {
        if (subjectsCurrentPage > 1) {
            subjectsCurrentPage--;
            updateSubjectsTable();
            updateSubjectsPagination();
        }
    }

    function nextPage() {
        const subjectsTotalPages = Math.ceil(subjectsData.length / subjectsItemsPerPage);
        if (subjectsCurrentPage < subjectsTotalPages) {
            subjectsCurrentPage++;
            updateSubjectsTable();
            updateSubjectsPagination();
        }
    }

    // Initial table and pagination update
    updateSubjectsTable();
    updateSubjectsPagination();
</script>
<script>
    const teachersTable = document.getElementById('teachersTable');
    const teachersPagination = document.getElementById('teachers-pagination'); // Make sure to give it this ID

    let teachersCurrentPage = 1;
    const teachersItemsPerPage = 4;
    const teachersData = <?= json_encode($data['Teacher']); ?>;

    function updateTeachersTable() {
        const startIndex = (teachersCurrentPage - 1) * teachersItemsPerPage;
        const endIndex = Math.min(startIndex + teachersItemsPerPage, teachersData.length);

        let tableHTML = '';
        for (let i = startIndex; i < endIndex; i++) {
            const teacher = teachersData[i];
            tableHTML += `
                <tr>
                    <td><a href="<?= URLROOT; ?>classesController/index/${teacher.teacherId}+${teacher.educationId}"
                            style="text-decoration:none; color:black;">${teacher.teacherId}</a></td>
                    <td>${teacher.teacherFirstName}</td>
                    <td>${teacher.teacherLastName}</td>
                </tr>
            `;
        }

        teachersTable.innerHTML = tableHTML;
    }

    function updateTeachersPagination() {
        const teachersTotalPages = Math.ceil(teachersData.length / teachersItemsPerPage);

        let paginationHTML = '';
        for (let i = 1; i <= teachersTotalPages; i++) {
            paginationHTML += `
                <li class="page-item ${i === teachersCurrentPage ? 'active' : ''}">
                    <a class="page-link" href="#">${i}</a>
                </li>
            `;
        }

        teachersPagination.innerHTML = `
            <li class="page-item" id="teachers-previousPage">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            ${paginationHTML}
            <li class="page-item" id="teachers-nextPage">
                <a class="page-link" href="#">Next</a>
            </li>
        `;

        const pageNumberLinks = teachersPagination.querySelectorAll('.page-link');
        pageNumberLinks.forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();
                const page = parseInt(link.textContent);
                if (!isNaN(page)) {
                    teachersCurrentPage = page;
                    updateTeachersTable();
                    updateTeachersPagination();
                }
            });
        });

        const teachersNextPage = document.getElementById('teachers-nextPage');
        teachersNextPage.addEventListener('click', () => {
            if (teachersCurrentPage < teachersTotalPages) {
                teachersCurrentPage++;
                updateTeachersTable();
                updateTeachersPagination();
            }
        });

        const teachersPreviousPage = document.getElementById('teachers-previousPage');
        teachersPreviousPage.addEventListener('click', () => {
            if (teachersCurrentPage > 1) {
                teachersCurrentPage--;
                updateTeachersTable();
                updateTeachersPagination();
            }
        });
    }

    updateTeachersTable();
    updateTeachersPagination();
</script>
</body>

</html>
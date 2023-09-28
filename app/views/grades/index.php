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

<nav style="margin-top: 100px;">
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
        <table class="table table-hover" style="width: 80%;" id="gradesTable">
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
                <!-- Grade table rows will be dynamically populated here -->
            </tbody>
        </table>
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <ul class="pagination" id="grades-pagination">
                <li class="page-item" id="grades-previousPage">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <!-- Page links with numbers will be dynamically populated here -->
                <li class="page-item" id="grades-nextPage">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <!-- Content for the Attendances tab goes here -->
        <div class="float-right" style="margin-top: 20px;">
            <a class="btn btn-success"
                href="<?= URLROOT; ?>/gradesController/createAttendancy/<?= $data['Student']->studentId ?>">Create
                new attendance</a>
        </div>
        <table class="table table-hover" style="width: 80%;" id="attendancesTable">
            <thead>
                <tr>
                    <th>Attendance ID</th>
                    <th>Attendance Student ID</th>
                    <th>Attendance Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Attendance table rows will be dynamically populated here -->
            </tbody>
        </table>
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <ul class="pagination" id="attendances-pagination">
                <li class="page-item" id="attendances-previousPage">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <!-- Page links with numbers will be dynamically populated here -->
                <li class="page-item" id="attendances-nextPage">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
// JavaScript code for grades pagination

const gradesTable = document.getElementById('gradesTable');
const gradesPagination = document.getElementById('grades-pagination');

let gradesCurrentPage = 1;
const gradesItemsPerPage = 4; // Display 4 records per page
const gradesData = <?= json_encode($data['Grade']); ?>;

function updateGradesTable() {
    const startIndex = (gradesCurrentPage - 1) * gradesItemsPerPage;
    const endIndex = Math.min(startIndex + gradesItemsPerPage, gradesData.length);

    let tableHTML = '';
    for (let i = startIndex; i < endIndex; i++) {
        const grade = gradesData[i];
        tableHTML += `
            <tr>
                <td>${grade.gradeId}</td>
                <td>${grade.gradeStudentId}</td>
                <td>${grade.gradeName}</td>
                <td>${grade.gradeGrade}</td>
                <td style="align-items: center;">
                    <a class="btn btn-danger"
                        href="#" 
                        onclick="deleteGrade(${grade.gradeId})">Delete</a>
                    <a class="btn btn-info"
                        href="#" 
                        onclick="updateGrade(${grade.gradeId})">Update</a>
                </td>
            </tr>
        `;
    }

    gradesTable.querySelector('tbody').innerHTML = tableHTML;
}

function updateGradesPagination() {
    const gradesTotalPages = Math.ceil(gradesData.length / gradesItemsPerPage);

    let paginationHTML = '';
    for (let i = 1; i <= gradesTotalPages; i++) {
        paginationHTML += `
            <li class="page-item ${i === gradesCurrentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changeGradesPage(${i})">${i}</a>
            </li>
        `;
    }

    gradesPagination.innerHTML = `
        <li class="page-item" id="grades-previousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" onclick="previousGradesPage()">Previous</a>
        </li>
        ${paginationHTML}
        <li class="page-item" id="grades-nextPage">
            <a class="page-link" href="#" onclick="nextGradesPage()">Next</a>
        </li>
    `;
}

function changeGradesPage(page) {
    gradesCurrentPage = page;
    updateGradesTable();
    updateGradesPagination();
}

function previousGradesPage() {
    if (gradesCurrentPage > 1) {
        gradesCurrentPage--;
        updateGradesTable();
        updateGradesPagination();
    }
}

function nextGradesPage() {
    const gradesTotalPages = Math.ceil(gradesData.length / gradesItemsPerPage);
    if (gradesCurrentPage < gradesTotalPages) {
        gradesCurrentPage++;
        updateGradesTable();
        updateGradesPagination();
    }
}

// Initial table and pagination update
updateGradesTable();
updateGradesPagination();
</script>

<script>
// JavaScript code for attendances pagination

const attendancesTable = document.getElementById('attendancesTable');
const attendancesPagination = document.getElementById('attendances-pagination');

let attendancesCurrentPage = 1;
const attendancesItemsPerPage = 4; // Display 4 records per page
const attendancesData = <?= json_encode($data['Attendancy']); ?>;

function updateAttendancesTable() {
    const startIndex = (attendancesCurrentPage - 1) * attendancesItemsPerPage;
    const endIndex = Math.min(startIndex + attendancesItemsPerPage, attendancesData.length);

    let tableHTML = '';
    for (let i = startIndex; i < endIndex; i++) {
        const attendancy = attendancesData[i];
        tableHTML += `
            <tr>
                <td>${attendancy.attendancyId}</td>
                <td>${attendancy.attendancyStudentId}</td>
                <td>${attendancy.attendancyReason}</td>
                <td style="align-items: center;">
                    <a class="btn btn-danger"
                        href="#" 
                        onclick="deleteAttendancy(${attendancy.attendancyId})">Delete</a>
                    <a class="btn btn-info"
                        href="#" 
                        onclick="updateAttendancy(${attendancy.attendancyId})">Update</a>
                </td>
            </tr>
        `;
    }

    attendancesTable.querySelector('tbody').innerHTML = tableHTML;
}

function updateAttendancesPagination() {
    const attendancesTotalPages = Math.ceil(attendancesData.length / attendancesItemsPerPage);

    let paginationHTML = '';
    for (let i = 1; i <= attendancesTotalPages; i++) {
        paginationHTML += `
            <li class="page-item ${i === attendancesCurrentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changeAttendancesPage(${i})">${i}</a>
            </li>
        `;
    }

    attendancesPagination.innerHTML = `
        <li class="page-item" id="attendances-previousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" onclick="previousAttendancesPage()">Previous</a>
        </li>
        ${paginationHTML}
        <li class="page-item" id="attendances-nextPage">
            <a class="page-link" href="#" onclick="nextAttendancesPage()">Next</a>
        </li>
    `;
}

function changeAttendancesPage(page) {
    attendancesCurrentPage = page;
    updateAttendancesTable();
    updateAttendancesPagination();
}

function previousAttendancesPage() {
    if (attendancesCurrentPage > 1) {
        attendancesCurrentPage--;
        updateAttendancesTable();
        updateAttendancesPagination();
    }
}

function nextAttendancesPage() {
    const attendancesTotalPages = Math.ceil(attendancesData.length / attendancesItemsPerPage);
    if (attendancesCurrentPage < attendancesTotalPages) {
        attendancesCurrentPage++;
        updateAttendancesTable();
        updateAttendancesPagination();
    }
}

// Initial table and pagination update
updateAttendancesTable();
updateAttendancesPagination();
</script>
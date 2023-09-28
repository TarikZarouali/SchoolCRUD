<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div style="display: flex; flex-direction: column; align-items: center; padding-top: 20px;">
    <div style="width: 50%; text-align: center;">
        <table class="table table-hover" style="margin: 0 auto;">
            <thead>
                <tr>
                    <th>Class Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['Class']->className ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="float-right" style="margin-top: 20px; margin-bottom: 2rem;">
    <a class="btn btn-success" href="<?= URLROOT; ?>studentsController/create/<?= $data['Class']->classId ?>">Create new
        student</a>
    <a class="btn btn-info" href="<?= URLROOT; ?>classesController/update/<?= $data['Class']->classId ?>">Update
        class</a>
    <a class="btn btn-danger" href="<?= URLROOT; ?>classesController/delete/<?= $data['Class']->classId ?>">Delete class</a>
</div>

<div style=" margin-top:100px;display: flex; justify-content: center;">
    <table class="table table-hover" style="width: 80%;">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Class ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="studentTable">
            <!-- Table rows for students will be dynamically populated here -->
        </tbody>
    </table>
</div>

<div style="display: flex; justify-content: center; margin-top: 20px;">
    <ul class="pagination" id="studentPagination">
        <li class="page-item" id="studentPreviousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <!-- Page links with numbers will be dynamically populated here -->
        <li class="page-item" id="studentNextPage">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</div>

<?php require_once APPROOT . '/Views/Includes/footer.php'; ?>

<script>
    // JavaScript code for student pagination

    // Get references to student pagination elements
    const studentPreviousPage = document.getElementById('studentPreviousPage');
    const studentNextPage = document.getElementById('studentNextPage');
    const studentTable = document.getElementById('studentTable');
    const studentPagination = document.getElementById('studentPagination');

    // Initialize current page for students
    let currentStudentPage = 1;
    const studentsPerPage = 4; // Display 4 records per page

    const studentData = <?= json_encode($data['Student']); ?>;
    const classId = "<?= $data['Class']->classId ?>"; // Add the class ID here

    // Function to update the student table content based on the current student page
    function updateStudentTable() {
        // Calculate the start and end indices for the current student page
        const startIndex = (currentStudentPage - 1) * studentsPerPage;
        const endIndex = Math.min(startIndex + studentsPerPage, studentData.length);

        // Generate HTML for the student table rows
        let studentTableHTML = '';
        for (let i = startIndex; i < endIndex; i++) {
            const studentItem = studentData[i];
            studentTableHTML += `
            <tr>
                <td><a href="<?= URLROOT; ?>gradesController/index/${studentItem.studentId}" style="text-decoration:none; color:black;">${studentItem.studentId}</a></td>
                <td>${studentItem.studentClassId}</td>
                <td>${studentItem.studentFirstName}</td>
                <td>${studentItem.studentLastName}</td>
                <td>${studentItem.studentAdres}</td>
                <td style="text-align: center;">
                    <div style="display: flex; justify-content: center;">
                         <a class="btn btn-danger" href="<?= URLROOT; ?>/studentsController/delete/${studentItem.studentId + '+' + classId }" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                        <a class="btn btn-info" href="<?= URLROOT; ?>/studentsController/update/${studentItem.studentId + '+' + classId}">Update</a>
                    </div>
                </td>
            </tr>
        `;
        }

        // Update the student table with the generated HTML
        studentTable.innerHTML = studentTableHTML;
    }

    // Function to update the student pagination buttons and page numbers
    function updateStudentPagination() {
        const totalStudentPages = Math.ceil(studentData.length / studentsPerPage);

        // Generate HTML for student page numbers
        let studentPaginationHTML = '';
        for (let i = 1; i <= totalStudentPages; i++) {
            studentPaginationHTML += `
            <li class="page-item ${i === currentStudentPage ? 'active' : ''}">
                <a class="page-link" href="#">${i}</a>
            </li>
        `;
        }

        // Update student pagination
        studentPagination.innerHTML = `
        <li class="page-item" id="studentPreviousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        ${studentPaginationHTML}
        <li class="page-item" id="studentNextPage">
            <a class="page-link" href="#">Next</a>
        </li>
    `;

        // Add event listeners to the new student page number links
        const studentPageNumberLinks = studentPagination.querySelectorAll('.page-link');
        studentPageNumberLinks.forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();
                const page = parseInt(link.textContent);
                if (!isNaN(page)) {
                    currentStudentPage = page;
                    updateStudentTable();
                    updateStudentPagination();
                }
            });
        });

        // Event listener for "Next" button for students
        studentNextPage.addEventListener('click', () => {
            if (currentStudentPage < totalStudentPages) {
                currentStudentPage++;
                updateStudentTable();
                updateStudentPagination();
            }
        });

        // Event listener for "Previous" button for students
        studentPreviousPage.addEventListener('click', () => {
            if (currentStudentPage > 1) {
                currentStudentPage--;
                updateStudentTable();
                updateStudentPagination();
            }
        });
    }

    // Initial student table update
    updateStudentTable();
    updateStudentPagination();
</script>
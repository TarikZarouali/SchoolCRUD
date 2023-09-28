<?php require_once APPROOT . '/Views/Includes/head.php'; ?>

<div class="container">
    <!-- Teacher Information -->
    <table class="table table-hover">
        <thead>
            <th style="text-align: center;">Teacher Name</th>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center; margin-bottom: 2rem;">
                    <?= $data['Teacher']->teacherFirstName . ' ' . $data['Teacher']->teacherLastName ?>
                    <br>
                    <?= "Woont op de " . $data['Teacher']->teacherAdres ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="float-right" style="margin-bottom: 2rem;">
        <a class="btn btn-success" href="<?= URLROOT; ?>/classesController/create/<?= $data['Teacher']->teacherId ?>">Create new Class</a>
        <a class="btn btn-danger" href="<?= URLROOT; ?>/subjectsController/deleteTeacher/<?= $data['Teacher']->teacherId . "+" . $data['EducationId']; ?>" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete teacher</a>
        <a class="btn btn-info" href="<?= URLROOT; ?>/subjectsController/updateTeacher/<?= $data['Teacher']->teacherId ?>">Edit Teacher</a>
    </div>

    <!-- Class Table -->
    <table class="table table-hover">
        <thead>
            <th>Class ID</th>
            <th>Teacher ID</th>
            <th>Class Name</th>
            <th>Action</th>
        </thead>
        <tbody id="classTable">
            <!-- Table rows for classes will be dynamically populated here -->
        </tbody>
    </table>

    <!-- Class Pagination -->
    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <ul class="pagination" id="classPagination">
            <li class="page-item" id="previousPage">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <!-- Page links with numbers will be dynamically populated here -->
            <li class="page-item" id="nextPage">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </div>
</div>

<?php require_once APPROOT . '/Views/Includes/footer.php'; ?>

<script>
    // JavaScript code for class pagination (similar to education pagination)

    // Get references to class pagination elements
    const classPreviousPage = document.getElementById('previousPage');
    const classNextPage = document.getElementById('nextPage');
    const classTable = document.getElementById('classTable');
    const classPagination = document.getElementById('classPagination');

    // Initialize current page for classes
    let currentClassPage = 1;
    const itemsPerPage = 4; // Corrected variable name

    const classData = <?= json_encode($data['Class']); ?>;
    const teacherId = "<?= $data['Teacher']->teacherId ?>"; // Add the teacher ID here

    // Function to update the table content based on the current class page
    function updateClassTable() {
        // Calculate the start and end indices for the current class page
        const startIndex = (currentClassPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, classData.length);

        // Generate HTML for the class table rows
        let classTableHTML = '';
        for (let i = startIndex; i < endIndex; i++) {
            const classItem = classData[i];
            classTableHTML += `
            <tr>
                <td><a href="<?= URLROOT; ?>studentsController/index/${classItem.classId}" style="text-decoration:none; color:black;">${classItem.classId}</a></td>
                <td>${classItem.classTeacherId}</td>
                <td>${classItem.className}</td>
                <td style="align-items: center;">
                    <a class="btn btn-danger" href="<?= URLROOT; ?>/classesController/delete/${classItem.classId + '+' + teacherId}" onclick="return confirm('Are you sure you want to delete this school?')">Delete</a>
                    <a class="btn btn-info" href="<?= URLROOT; ?>/classesController/update/${classItem.classId + '+' + teacherId}">Update</a>
                </td>
            </tr>
        `;
        }

        // Update the class table with the generated HTML
        classTable.innerHTML = classTableHTML;
    }

    // Function to update the class pagination buttons and page numbers
    function updateClassPagination() {
        const totalClassPages = Math.ceil(classData.length / itemsPerPage);

        // Generate HTML for class page numbers
        let classPaginationHTML = '';
        for (let i = 1; i <= totalClassPages; i++) {
            classPaginationHTML += `
            <li class="page-item ${i === currentClassPage ? 'active' : ''}">
                <a class="page-link" href="#">${i}</a>
            </li>
        `;
        }

        // Update class pagination
        classPagination.innerHTML = `
        <li class="page-item" id="classPreviousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        ${classPaginationHTML}
        <li class="page-item" id="classNextPage">
            <a class="page-link" href="#">Next</a>
        </li>
    `;

        // Add event listeners to the new class page number links
        const classPageNumberLinks = classPagination.querySelectorAll('.page-link');
        classPageNumberLinks.forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();
                const page = parseInt(link.textContent);
                if (!isNaN(page)) {
                    currentClassPage = page;
                    updateClassTable();
                    updateClassPagination();
                }
            });
        });

        // Event listener for "Next" button for classes
        classNextPage.addEventListener('click', () => {
            if (currentClassPage < totalClassPages) {
                currentClassPage++;
                updateClassTable();
                updateClassPagination();
            }
        });

        // Event listener for "Previous" button for classes
        classPreviousPage.addEventListener('click', () => {
            if (currentClassPage > 1) {
                currentClassPage--;
                updateClassTable();
                updateClassPagination();
            }
        });
    }

    // Initial class table update
    updateClassTable();
    updateClassPagination();
</script>
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
    <a class="btn btn-info" href="<?= URLROOT; ?>/schoolsController/update/<?= $data['School']->schoolId ?>">Update</a>
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
        <tbody id="educationTable">
            <!-- Table rows will be dynamically populated here -->
        </tbody>
    </table>
</div>

<div style="display: flex; justify-content: center; margin-top: 20px;">
    <ul class="pagination" id="pagination">
        <li class="page-item" id="previousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <!-- Page links with numbers will be dynamically populated here -->
        <li class="page-item" id="nextPage">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</div>

<?php require_once APPROOT . '/Views/Includes/footer.php'; ?>

<script>
// Get references to pagination elements
const previousPage = document.getElementById('previousPage');
const nextPage = document.getElementById('nextPage');
const educationTable = document.getElementById('educationTable');
const pagination = document.getElementById('pagination');

// Initialize current page
let currentPage = 1;
const itemsPerPage = 4; // Number of records to display per page (adjust as needed)

// Sample data (replace with your data)
const educationData = <?= json_encode($data['Education']); ?>;

// Function to update the table content based on the current page
function updateTable() {
    // Calculate the start and end indices for the current page
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, educationData.length);

    // Generate HTML for the table rows
    let tableHTML = '';
    for (let i = startIndex; i < endIndex; i++) {
        const education = educationData[i];
        tableHTML += `
            <tr>
                <td><a href="<?= URLROOT; ?>SubjectsController/index/${education.educationId}" style="text-decoration:none; color:black;">${education.schoolId}</a></td>
                <td>${education.educationId}</td>
                <td>${education.educationName}</td>
                <td>${education.educationDuration}</td>
            </tr>
        `;
    }

    // Update the table with the generated HTML
    educationTable.innerHTML = tableHTML;
}

// Function to update the pagination buttons and page numbers
function updatePagination() {
    const totalPages = Math.ceil(educationData.length / itemsPerPage);

    // Generate HTML for page numbers
    let paginationHTML = '';
    for (let i = 1; i <= totalPages; i++) {
        paginationHTML += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#">${i}</a>
            </li>
        `;
    }

    // Update pagination
    pagination.innerHTML = `
        <li class="page-item" id="previousPage">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        ${paginationHTML}
        <li class="page-item" id="nextPage">
            <a class="page-link" href="#">Next</a>
        </li>
    `;

    // Add event listeners to the new page number links
    const pageNumberLinks = pagination.querySelectorAll('.page-link');
    pageNumberLinks.forEach(link => {
        link.addEventListener('click', event => {
            event.preventDefault();
            const page = parseInt(link.textContent);
            if (!isNaN(page)) {
                currentPage = page;
                updateTable();
                updatePagination();
            }
        });
    });

    // Event listener for "Next" button
    nextPage.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            updateTable();
            updatePagination();
        }
    });

    // Event listener for "Previous" button
    previousPage.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
            updatePagination();
        }
    });
}

// Initial table update
updateTable();
updatePagination();
</script>
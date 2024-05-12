const patients = document.querySelectorAll('.patient');
const pageSize = 6; // Number of patients per page
let currentPage = 1; // Current page number

// Function to show patients for the current page
function showPatients(page) {
    const startIndex = (page - 1) * pageSize;
    const endIndex = startIndex + pageSize;

    patients.forEach((patient, index) => {
        if (index >= startIndex && index < endIndex) {
            patient.style.display = 'block';
        } else {
            patient.style.display = 'none';
        }
    });
}

// Update page number display
function updatePageNumber() {
    pageNumber.textContent = `${currentPage}`;
}

// Show patients for the initial page
showPatients(currentPage);
updatePageNumber();

// Next button event listener
document.getElementById('nextBtn').addEventListener('click', function() {
    const totalPages = Math.ceil(patients.length / pageSize);
    currentPage = Math.min(currentPage + 1, totalPages);
    showPatients(currentPage);
    updatePageNumber();
});

// Previous button event listener
document.getElementById('prevBtn').addEventListener('click', function() {
    currentPage = Math.max(currentPage - 1, 1);
    showPatients(currentPage);
    updatePageNumber();
});

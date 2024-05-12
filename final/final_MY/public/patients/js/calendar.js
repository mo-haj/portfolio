document.querySelectorAll('.btn-gray').forEach(btn => {
    btn.addEventListener('click', function() {
        document.body.style.backgroundColor = 'gray';
    });
});
document.querySelectorAll('.btn-lightblue').forEach(btn => {
    btn.addEventListener('click', function() {
        document.body.style.backgroundColor = '#add8e6';
    });
});
document.querySelectorAll('.btn-white').forEach(btn => {
    btn.addEventListener('click', function() {
        document.body.style.backgroundColor = 'white';
    });
});
const settingsModal = new bootstrap.Modal(document.getElementById('settingsModal'));

document.querySelector('.dropdown-item[href="#"]').addEventListener('click', function() {
    
    settingsModal.show();
});

const editappointments = new bootstrap.Modal(document.getElementById('Edit-appointment'));

document.addEventListener('DOMContentLoaded', function () {

    const editButtons = document.querySelectorAll('.edit-appointment');

    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var appointmentId = this.getAttribute('data-appointment-id');
            const appointment= JSON.parse(appointmentId);
            var id1 = appointment.id ;
            document.getElementById('input-id').value = appointment.id;
            document.getElementById('patients').value = appointment.patient_name; // Assuming patient_name is the doctor's name
            document.getElementById('input-date').value = appointment.appointment_date;
            document.getElementById('input-time').value = appointment.appointment_time;
            editappointments.show();

        });
    });
   

});
document.addEventListener('DOMContentLoaded', function () {
const submitButton = document.querySelector('.modal-body .button[type="submit"]');

submitButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Get form data
    const formData = new FormData(document.getElementById('edit-appointment-form'));
    var appointment = {
    id: document.getElementById('input-id').value,
    patient_name: document.getElementById('patients').value,
    appointment_date: document.getElementById('input-date').value,
    appointment_time: document.getElementById('input-time').value
};

    debugger
    // Send form data via AJAX
    fetch('/appointments/update', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if you're using Blade template
    },
    body: JSON.stringify(appointment) // Convert object to JSON string
})
    .then(response => {
        if (response.ok) {
            // Handle success
            console.log('Appointment updated successfully');
        } else {
            // Handle error
            console.error('Failed to update appointment');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});








});



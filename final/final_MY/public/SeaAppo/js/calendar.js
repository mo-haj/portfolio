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
            document.getElementById('input_id').value = appointment.id;
            document.getElementById('patients').value = appointment.patient_name; // Assuming patient_name is the doctor's name
            document.getElementById('input_date').value = appointment.appointment_date;
            document.getElementById('input_time').value = appointment.appointment_time;
           document.getElementById('Note').value = appointment.Note;

            editappointments.show();

        });
    });
   

});

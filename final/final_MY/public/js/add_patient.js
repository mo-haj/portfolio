// document.addEventListener('DOMContentLoaded', function () {
//     const submitButton = document.querySelector('.button[type="submit"]');

//     submitButton.addEventListener('click', function(event) {
//         event.preventDefault(); // Prevent default form submission
        
//         // Get form data
//         const formData = new FormData(document.getElementById('Add_Patient_form'));
//         const patient = {
//             img: formData.get('img'),
//             name: formData.get('patient_name'),
//             email: formData.get('email'),
//             number: formData.get('number'),
//             disc: formData.get('disc')
//         };
    
//         // Send form data via AJAX
//         fetch('/patient/add', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if you're using Blade template
//             },
//             body: JSON.stringify(patient) // Convert object to JSON string
//         })
//         .then(response => {
//             if (response.ok) {
//                 // Handle success
//                 console.log('Patient added successfully');
//             } else {
//                 // Handle error
//                 console.error('Failed to add patient');
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
//     });
// });

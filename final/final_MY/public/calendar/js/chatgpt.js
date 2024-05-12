// /*Calender dashborad */
// document.addEventListener('DOMContentLoaded', function() {
//     var calendarEl = document.getElementById('calendar');
//     var calendar = new FullCalendar.Calendar(calendarEl, {
//       initialView: 'dayGridMonth'
//     });
//     calendar.render();
//   });


//   /*month slider Calendar*/
//   document.addEventListener('DOMContentLoaded', function() {
//     const slider = document.querySelector('.slider');
//     const slides = document.querySelectorAll('.slide');
//     const prevBtn = document.querySelector('.prev-btn');
//     const nextBtn = document.querySelector('.next-btn');
    
//     let currentIndex = 0;
//     const slideWidth = slides[0].offsetWidth;
//     const totalSlides = slides.length;
  
//     function updateSlider() {
//       slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
//     }
  
//     prevBtn.addEventListener('click', function() {
//       if (currentIndex > 0) {
//         currentIndex--;
//       } else {
//         currentIndex = totalSlides - 1; // Loop to the last slide if at the first slide
//       }
//       updateSlider();
//     });
  
//     nextBtn.addEventListener('click', function() {
//       if (currentIndex < totalSlides - 1) {
//         currentIndex++;
//       } else {
//         currentIndex = 0; // Loop to the first slide if at the last slide
//       }
//       updateSlider();
//     });
//   });

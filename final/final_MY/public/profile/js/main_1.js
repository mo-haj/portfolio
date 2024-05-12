/*                Calender dashborad                          */
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth'
    });
    calendar.render();
  });


  /*month slider Calendar*/
  document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    let currentIndex = 0;
    const slideWidth = slides[0].offsetWidth;
    const totalSlides = slides.length;
  
    function updateSlider() {
      slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }
  
    prevBtn.addEventListener('click', function() {
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        currentIndex = totalSlides - 1; // Loop to the last slide if at the first slide
      }
      updateSlider();
    });
  
    nextBtn.addEventListener('click', function() {
      if (currentIndex < totalSlides - 1) {
        currentIndex++;
      } else {
        currentIndex = 0; // Loop to the first slide if at the last slide
      }
      updateSlider();
    });
  });


//                      clock                 //
function showTime() {
  var date = new Date();
  var utc = date.getTime() + (date.getTimezoneOffset() * 60000); // Get UTC time
  var newDate = new Date(utc + (3600000 * 2.0)); // Adjust for your time zone offset (e.g., 2.0 for GMT+2:00)
  
  var h = newDate.getHours(); // 0 - 23
  var m = newDate.getMinutes(); // 0 - 59
  var s = newDate.getSeconds(); // 0 - 59
  var session = "AM";
  
  if (h == 0) {
      h = 12;
  }
  
  if (h > 12) {
      h = h - 12;
      session = "PM";
  }
  
  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;
  
  var time = h + ":" + m + ":" + s + " " + session;
  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;
  
  setTimeout(showTime, 1000);
}

showTime();



 
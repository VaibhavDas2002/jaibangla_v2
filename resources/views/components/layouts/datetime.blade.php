<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <i class="fa fa-clock-o"></i> Date:
    </li>
    <li class="breadcrumb-item">
    <span class="fw-bold" style="font-size: 12px;">
      <span class="date-part"></span>&nbsp;&nbsp;<span class="time-part"></span>
    </span>
    </li>
  </ol>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      function updateDateTime() {
        const now = new Date();

        const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
        const datePart = now.toLocaleDateString('en-US', optionsDate);

        const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        const timePart = now.toLocaleTimeString('en-US', optionsTime);

        document.querySelector('.date-part').textContent = datePart;
        document.querySelector('.time-part').textContent = timePart;
      }

      updateDateTime(); // Initial call to set the date and time immediately
      setInterval(updateDateTime, 1000); // Update every second
    });
  </script>
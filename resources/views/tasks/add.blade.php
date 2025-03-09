@extends("layouts.default2")

@section("content")

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<style>
  body{
    background: linear-gradient(-45deg, #ff9a9e, #ffc8b9, #ffdde1, #fc6076);
  }
  @media (max-width: 768px) {
    .container {
      max-width: 90%;
    }

    .form-floating label {
      font-size: 14px; 
    }

    .form-control {
      font-size: 16px; 
    }
  }

  /* Date-Time Picker Styles */
  .flatpickr-calendar {
    z-index: 9999 !important; 
    transform: scale(1);
    width: 300px !important; 
  }

  .flatpickr-time {
    font-size: 16px !important; 
  }

  .flatpickr-day {
    height: 33px !important;
    width: 33px !important; 
    line-height: 33px !important;
  }

  .flatpickr-monthDropdown-months, .flatpickr-current-month input {
    font-size: 16px !important; 
  }

  #confirm-btn {
    font-size: 14px;
    padding: 5px 10px;
  }

  .submit-btn {
    transition: background 0.4s ease, transform 0.3s ease;
    background: linear-gradient(45deg, #28a745, #218838);
    color: white;
    font-size: 18px;
  }

  .submit-btn:hover {
    background: linear-gradient(45deg, #218838, #28a745);
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
  }
</style>

<div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
  <div class="container card shadow-lg animate_animated animate_fadeInUp" style="max-width: 500px;">
    <div class="fs-3 fw-bold text-center text-success mt-3">Add New Task</div>

    <form method="POST" action="{{ route('task.add.post') }}" class="p-4">
      @csrf

      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="title" placeholder="Enter Task" required>
        <label for="title">Task Title</label>
      </div>

      <div class="form-floating mb-3">
        <input type="datetime-local" id="datetime-picker" name="deadline" class="form-control" placeholder="Select Deadline" required>
        <label for="datetime-picker">Deadline</label>
      </div>     

      <div class="form-floating mb-3">
        <select class="form-select" name="priority" required>
          <option value="high">High</option>
          <option value="medium" selected>Medium</option>
          <option value="low">Low</option>
        </select>
        <label for="priority">Task Priority</label>
      </div>

      <div class="form-floating mb-3">
        <textarea class="form-control" name="description" placeholder="Enter description" rows="3" required></textarea>
        <label for="description">Task Description</label>
      </div>
      <!-- Success/Error Messages -->
      @if(session()->has('success'))
      <div class="alert alert-success fade-in">{{ session()->get('success') }}</div>
      @endif
      @if(Session("error"))
      <div class="alert alert-danger fade-in">{{ session("error") }}</div>
      @endif
      <button type="submit" class="btn btn-success rounded-pill w-100 submit-btn">Add Task</button>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
 
    const picker = flatpickr("#datetime-picker", {
      enableTime: true,
      dateFormat: "Y-m-d H:i",
      minDate: "today",
      time_24hr: true,
      defaultHour: 12,
      defaultMinute: 0,
      disableMobile:true,
      clickOpens: false, 
      onOpen: function (selectedDates, dateStr, instance) {
        setTimeout(() => {
          let confirmBtn = document.getElementById("confirm-btn");
          if (!confirmBtn) {
            confirmBtn = document.createElement("button");
            confirmBtn.innerText = "Confirm";
            confirmBtn.id = "confirm-btn";
            confirmBtn.classList.add("btn", "btn-success", "w20");

            confirmBtn.addEventListener("click", function () {
              instance.close(); 
            });

            instance.calendarContainer.appendChild(confirmBtn);
          }
        }, 10);
      }
    });
    document.getElementById("datetime-picker").addEventListener("click", function () {
      this._flatpickr.open();
    });

  });
</script>
@endsection 
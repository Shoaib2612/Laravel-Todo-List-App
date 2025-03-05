@extends("layouts.default")

@section("content")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
  /* Fix Task List Position Below Navbar */
  main {
    margin-top: 85px;
  }

  /* Task Card Animation */
  .task-card {
    animation: fadeIn 0.8s ease-in-out;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-top: 15px;
    padding: 15px;
    border-radius: 8px;
    background: #f9f9f9;
  
  }

  .task-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
  }

  .task-description{
    max-width: 400px;
    max-height: 60px;
    overflow: auto;
    white-space: pre-wrap;
    word-break: break-word;
    flex-grow: 1;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Priority Label */
  .priority {
    font-size: 12px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 4px;
    color: white;
  }

  .priority-high { background: #dc3545; }  
  .priority-medium { background: #ffc107; } 
  .priority-low { background: #28a745; }    

  /* Action Buttons */
  .task-action {
    border: none;
    padding: 8px;
    border-radius: 50%;
    font-size: 16px;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
    display: inline-block;
  }
 
  /* edit button */
  .btn-edit {
    color: #007bff;
    background-color: #e7f0ff;
  }

  .btn-edit:hover {
      background-color: #007bff;
      color: white;
  }

  /* Complete Task Button */
  .btn-complete {
      background: #28a745; 
      color: white;
  }

  .btn-complete:hover {
      background: #1e7e34; 
      transform: scale(1.15);
  }


  /* Delete Button */
  .btn-delete {
    background: #dc3545;
    color: white;
  }

  .btn-delete:hover {
    background: #b71c1c;
    transform: scale(1.1);
  }
  /* Flash Messages*/
.custom-alert {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  padding: 12px 20px;
  font-size: 16px;
  font-weight: bold;
  border-radius: 8px;
  color: white;
  text-align: center;
  min-width: 250px;
  max-width: 90%;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
  z-index: 9999;
  animation: fadeInOut 2.5s ease-in-out;
}

/* Different Colors for Messages */
.custom-alert-success { background: #28a745; }
.custom-alert-error { background: #dc3545; }
.custom-alert-delete { background: #ff5252; } 

/* Fade In and Out Animation */
@keyframes fadeInOut {
  0% { opacity: 0; transform: translate(-50%, -10px); }
  20% { opacity: 1; transform: translate(-50%, 0); }
  80% { opacity: 1; transform: translate(-50%, 0); }
  100% { opacity: 0; transform: translate(-50%, -10px);}
}

/* Search Bar Styles */
.search-container {
    position: absolute;
    top: 100px;
    right: 20px; 
    width: 250px;
}

.search-input {
    border-radius: 20px;
    padding: 8px 15px;
    border: 1px solid #ccc;
    outline: none;
}

.search-input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.search-icon {
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    padding: 5px 10px;
    cursor: pointer;
}

/* Mobile Responsiveness for Search Bar and Filters */
@media (max-width: 768px) {
  /* Stack the search bar above the filters */
  .container.text-center.my-3 form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
  }
  .task-description{
    max-width: 290px;
  }

  /* Move the search bar to the top */
  .search-container {
    position: static; 
    width: 100%;
    margin-bottom: 10px; 
  }

  /* Adjust the width of filter and sort dropdowns */
  .form-select.w-auto {
    width: 100% !important; 
  }

  /* Align the "Show Completed Tasks" checkbox */
  .form-check {
    width: 100%;
    text-align: left;
    margin-top: 10px;
  }
}
</style>

<!-- Flash Messages -->
@if(session()->has('success'))
  <div class="custom-alert custom-alert-success" id="successMessage">
    <i class="fas fa-check-circle"></i> {{ session()->get('success') }}
  </div>
@endif

@if(session('error'))
  <div class="custom-alert custom-alert-error" id="errorMessage">
    <i class="fas fa-times-circle"></i> {{ session('error') }}
  </div>
@endif

@if(session('delete'))
  <div class="custom-alert custom-alert-delete" id="deleteMessage">
    <i class="fas fa-trash"></i> {{ session('delete') }}
  </div>
@endif

<!-- Task List Section -->
<main>
  <div class="container" style="max-width:600px">


   <!-- Filtering & Sorting Options -->
<div class="container text-center my-3">
  <form method="GET" action="{{ route('home') }}" class="d-flex justify-content-center gap-2">
    <!-- Priority Filter -->
    <select name="priority" class="form-select w-auto" onchange="this.form.submit()">
      <option value="">Filter by Priority</option>
      <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
      <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
      <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
    </select>

    <!-- Sorting Option -->
    <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
      <option value="">Sort by</option>
      <option value="deadline" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Deadline</option>
      <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Priority</option>
    </select>

    <!-- Show Completed Tasks Checkbox -->
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="showCompleted" name="showCompleted"
             onchange="this.form.submit()" value="1"{{ request('showCompleted') ? 'checked' : '' }}>
      <label class="form-check-label" for="showCompleted">Show Completed Tasks</label>
    </div>

     <!-- Live Search Bar -->
<div class="input-group search-container">
  <input type="text" class="form-control search-input" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Search tasks..." autocomplete="off">
  <span class="input-group-text search-icon"><i class="fas fa-search"></i></span>
</div>
  </form>
</div>

<div class="my-3 p-3 bg-body rounded shadow-sm">
  <h5 class="border-bottom pb-2 mb-3">
    {{ request('showCompleted') ? 'Completed Tasks' : 'Your Tasks' }}
  </h5>

  @if($tasks->isEmpty())
  <div class="text-center text-muted">
      <i class="fas fa-clipboard-list fa-2x"></i>
      <h4>No Tasks Available</h4>
      <p>Add new tasks to get started!</p>
  </div>
  @else
      @foreach($tasks as $task)
      <div class="d-flex justify-content-between align-items-center task-card {{ request('showCompleted') ? 'bg-light' : '' }}" id="task-{{$task->id}}">
          <div>
              <strong class="text-dark task-title">{{ $task->title }}</strong>  
              <small class="text-muted d-block">{{ $task->deadline }}</small>
              <p class="mb-1 task-description">{{ $task->description }} </p>
            
              <span class="priority 
                  @if(strtolower($task->priority) == 'high') priority-high 
                  @elseif(strtolower($task->priority) == 'medium') priority-medium 
                  @else priority-low 
                  @endif">
                  {{ ucfirst($task->priority) }}
              </span>
          </div>
          <div class="task-actions">
              @if(request('showCompleted'))
              <!-- Undo Button for Completed Tasks -->
              <a href="{{ route('task.status.undo', $task->id) }}" class="task-action btn btn-warning text-white" title="Undo Task">
                  <i class="fas fa-undo"></i>
              </a>
              @else

              <!-- Edit, Complete, and Delete Buttons -->
              <a href="{{ route('task.edit', $task->id) }}" class="task-action btn-edit" title="Edit Task">
                <i class="fas fa-edit"></i>
              </a>
              <a href="{{ route('task.status.update', $task->id) }}" class="task-action btn-complete" title="Mark as Completed">
                <i class="fas fa-check"></i>
              </a>

              <a href="{{ route('task.delete', $task->id) }}" class="task-action btn-delete" title="Delete Task">
                  <i class="fas fa-trash"></i>
              </a>
              
              @endif
          </div>
      </div>
      @endforeach

      <small class="d-block text-end mt-3">{{ $tasks->appends(request()->query())->links() }}</small>
  @endif
</div>
  </div>

</main>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  // Auto-hide flash messages
  setTimeout(() => {
    document.querySelectorAll(".custom-alert").forEach(alert => {
      alert.style.opacity = "0";
      setTimeout(() => alert.remove(), 500);
    });
  }, 2000);

  document.getElementById("searchInput").addEventListener("input", function() {
    let searchValue = this.value;
    let showCompleted = document.getElementById("showCompleted").checked ? 1 : 0; // Get checkbox value

    fetch("{{ route('home') }}?search=" + encodeURIComponent(searchValue) + 
        "&priority={{ request('priority') }}" + 
        "&sort={{ request('sort') }}" + 
        "&showCompleted=" + showCompleted, {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
    .then(response => response.text())
    .then(html => {
        let parser = new DOMParser();
        let doc = parser.parseFromString(html, "text/html");
        let newTaskList = doc.querySelector(".my-3.p-3.bg-body.rounded.shadow-sm");
        document.querySelector(".my-3.p-3.bg-body.rounded.shadow-sm").innerHTML = newTaskList.innerHTML;
    });
});

// Update results when the checkbox is toggled
document.getElementById("showCompletedCheckbox").addEventListener("change", function() {
    document.getElementById("searchInput").dispatchEvent(new Event("input")); // Trigger search update
});

</script>

@endsection
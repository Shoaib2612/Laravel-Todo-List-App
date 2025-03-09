<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top custom-navbar">
    <div class="container-fluid">
      <a class="navbar-brand custom-name" href="#">Todo-App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link custom-link" href="{{route('home')}}" data-link="home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link custom-link" href="{{route('task.add')}}" data-link="add-task">Add Task</a>
          </li>
          <li class="nav-item">
            <a class="nav-link custom-link" href="{{route('logout')}}" onclick="confirmLogout(event)">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <script>
    function confirmLogout(event) {
        event.preventDefault(); 
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = event.target.href;
        }
    }
    </script>
</header>

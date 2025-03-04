   
{{-- <header> --}}
  {{-- <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Fixed navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
          </li>
        </ul>
        <a class="btn btn-outline-success" href="{{route('task.add')}}">Add Task</a> --}}
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      {{-- </div>
    </div>
  </nav>
</header> --}}

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
            <a class="nav-link custom-link" href="{{route('logout')}}">Logout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link custom-link" href="{{route('task.add')}}" data-link="add-task">Add Task</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

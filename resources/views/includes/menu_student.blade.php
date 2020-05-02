<nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-sm  mb-2">
    <div class="container">
        <a class="navbar-brand" href="#">ERMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('student.courses')}}"><i class="fas fa-university"></i> Courses</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-graduation-cap"></i> Examinations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-book"></i> Assessments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="{{route('student.attendances')}}">
                  <i class="fas fa-calendar-alt"></i>   Attendances
                </a>
            </li>
          </ul>
          <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->firstname}}
                    @foreach(Auth::user()->roles as $role)
                  <span class="badge badge-light">{{$role->name}}</span>
                  @endforeach
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#"></a>
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="{{ route('logout') }}" >Signout</a>
                </div>
            </li>
          </ul>
        </div>
    </div>
</nav>

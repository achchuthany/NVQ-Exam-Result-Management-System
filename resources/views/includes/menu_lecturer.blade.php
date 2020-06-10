<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm  mb-2">
    <div class="container">
        <a class="navbar-brand" href="{{route('lecturer')}}">ERMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{route('lecturer')}}"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('lecturer.modules')}}"><i class="fas fa-university"></i>
                  Enrolled Modules
              </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('student.tvecexams')}}">
                  <i class="fas fa-graduation-cap"></i> Examinations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-book"></i> Assessments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="{{route('lecturer.attendances')}}">
                  <i class="fas fa-calendar-alt"></i>   Attendances
                </a>
            </li>
          </ul>
          <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                        {{Auth::user()->firstname}}
                        {{Auth::user()->lastname}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Login as
                      @foreach(Auth::user()->roles as $role)
                          <span class="text-muted">{{$role->name}}</span>
                      @endforeach
                  </a>
                    <a class="dropdown-item" href="{{ route('ChangePassword') }}">Change Password</a>
                  <a class="dropdown-item" href="{{route('student.profile')}}">Profile</a>
                  <a class="dropdown-item" href="{{ route('logout') }}" >Signout</a>
                </div>
            </li>
          </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-gradient-light shadow-sm  mb-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ERMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-university"></i> Academics
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('nvqs')}}">NVQ Levels</a>
                        <a class="dropdown-item" href="{{route('departments')}}">Departments</a>
                        <a class="dropdown-item" href="{{route('courses')}}">Courses</a>
                        <a class="dropdown-item" href="{{route('modules')}}">Modules</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('academics')}}">Academic Years</a>
                        <a class="dropdown-item" href="{{route('batches')}}">Batches</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('students')}}"><i class="fas fa-user-graduate"></i> Students</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-tie"></i> Staffs
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('employees')}}">Employees</a>
                        <a class="dropdown-item" href="{{route('employees.enroll')}}">Enrolled Modules</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-graduation-cap"></i> Examinations
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('tvec.exams')}}">TVEC Examinations</a>
                        <a class="dropdown-item" href="{{route('tvec.results')}}">TVEC Results</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book"></i> Assessments
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Assessments</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('attendances')}}"><i class="fas fa-calendar-day"></i> Attendances</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users')}}"><i class="fas fa-user"></i> Users</a>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->firstname}}
                        @foreach(Auth::user()->roles as $role)
                            <span class="badge badge-light">{{$role->name}}</span>
                        @endforeach
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('ChangePassword') }}">Change Password</a>
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Signout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

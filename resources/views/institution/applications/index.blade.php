<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Dashboard</title>
    <!-- Link to external CSS -->
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet"> <!-- External CSS File -->
</head>
<body>
    
      <!-- Header Navigation -->
      <header class="header-nav">
    <nav class="container d-flex justify-content-between align-items-center">
        <div class="nav-left">
        </div>
        <div class="nav-links d-flex align-items-center">
            <a href="{{ route('institution.home') }}">Home</a>
            <a href="{{route('institution.qualifications.create')}}">Add Prospectus</a>
          
            <li id="nav-p" class="dropdown">
    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    <li id="nav-p">courses</li>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('institution.courses.create', ['institution' => $institution->id]) }}">Add Course</a>
        <div class="dropdown-submenu">
            <a class="dropdown-item" href="#" id="view-courses">View Courses</a>
            <!-- Faculties dropdown -->
            <div id="faculties-dropdown" class="dropdown-menu" style="display: none;">
                <p1 class="d" >Choose a Faculty to View Its Courses:</p1>
                @foreach($faculties as $faculty)
                    <a class="dropdown-item" href="{{ route('institution.courses.show', ['institutionId' => $institution->id, 'facultyId' => $faculty->id]) }}">
                        {{ $faculty->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</li>
 <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
     
            <li id="nav-p">Faculties</li>  
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('institution.faculties.create', ['institution' => $institution->id]) }}">Add Faculty</a></li>
                    <li><a class="dropdown-item" href="{{ route('institution.faculties.show',$institution->id) }}">View Faculties</a></li>
                </ul>
            </div>
            
           
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  

            <li id="nav-p">Upload and Publish Admissions</li>  
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('institution.upload.admission', ['institution' => $institution->id]) }}">Upload Admissions</a></li>
                    <li><a class="dropdown-item" href="{{ route('view-admissions',$institution->id) }}">Publish Amissions</a></li>
                </ul>
            </div>
            <a href="{{ route('institution.applications', ['institutionId' => $institution->id]) }}">View Applications</a>
          

            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                   <img src="{{ asset('storage/' . $institution->profile_photo) }}" alt="Institution Photo" class="rounded-circle" style="width: 40px; height: 40px;">
                
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('institution.profile', $institution->id) }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('institution.logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

    <script>
      function confirmAction(action, school) {
    if (action === 'accepted') {
        const acceptedFromSchool = document.querySelectorAll(`[data-school="${school}"].status-accepted`).length;

        if (acceptedFromSchool >= 2) {
            alert('Cannot accept more than 2 students from the same school.');
            return false;
        }
    }

    let message = action === 'accepted'
        ? "Are you sure you want to accept this application?"
        : "Are you sure you want to reject this application?";
    return confirm(message);
}

    </script>
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>
    <div class="container">
        
        <div class="content">
            <h1>Applications for {{ $institution->name }}</h1>

            @if($applications->isEmpty())
                <p class="no-applications">No applications have been submitted for your institution.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Candidate Number</th>
                            <th>Student Name</th>
                            <th>Surname</th>
                            <th>Former School</th>
                            <th>Grades</th>
                            <th>Course</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $application->candidate_number }}</td>
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->surname }}</td>
                                <td>{{ $application->former_school }}</td>
                                <td>
                                    @php
                                        $grades = json_decode($application->grades, true);
                                    @endphp
                                    @if(is_array($grades))
                                        @foreach($grades as $qualificationId => $grade)
                                            @php
                                                $qualification = \App\Models\Qualification::find($qualificationId);
                                            @endphp
                                            <p>{{ $qualification ? $qualification->subject_name : 'Unknown Subject' }}: {{ $grade }}</p>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $application->course ? $application->course->name : 'N/A' }}</td>
                                <td>{{ $application->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('applications.updateStatus', $application->id) }}" onsubmit="return confirmAction(this.querySelector('[name=status]').value)">
                                        @csrf
                                        @method('PUT')
                                        @if($application->status === 'accepted')
                                            <span class="badge badge-success">Accepted</span>
                                        @elseif($application->status === 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <button type="submit" name="status" value="accepted" class="btn btn-success btn-sm">Accept</button>
                                            <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">Reject</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <script>
    // Wait for the DOM to fully load before attaching event listeners
    document.addEventListener('DOMContentLoaded', function () {
    // Get the "View Courses" link and faculties dropdown
    const viewCoursesLink = document.getElementById('view-courses');
    const facultiesDropdown = document.getElementById('faculties-dropdown');

    // Show dropdown on hover
    viewCoursesLink.addEventListener('mouseenter', function () {
        facultiesDropdown.style.display = 'block'; // Show the dropdown
    });

    // Hide dropdown when mouse leaves both the link and dropdown
    const hideDropdown = function () {
        facultiesDropdown.style.display = 'none'; // Hide the dropdown
    };

    // Attach event listeners to hide dropdown
    viewCoursesLink.addEventListener('mouseleave', hideDropdown);
    facultiesDropdown.addEventListener('mouseleave', hideDropdown);

    // Keep dropdown visible if hovering over it
    facultiesDropdown.addEventListener('mouseenter', function () {
        facultiesDropdown.style.display = 'block'; // Ensure dropdown remains visible
    });
});

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

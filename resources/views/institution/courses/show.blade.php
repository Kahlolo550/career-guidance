<!-- resources/views/institution/faculties/courses.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses for {{ $faculty->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/institutionhome.css') }}" rel="stylesheet">
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


    <h2>Courses for Faculty: {{ $faculty->name }}</h2>

    @if($courses->isEmpty())  <!-- Check if there are no courses -->
        <p>No courses available for this faculty.</p>
    @else
        <ul>
            @foreach ($courses as $course)
                <li>{{ $course->name }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('institution.faculties.show', ['institution' => $institution->id]) }}">Back to Faculties</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <h5>About Us</h5>
                <p>We provide career guidance and education management services.</p>
            </div>
            <div class="col-12 col-md-4">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Admissions</a></li>
                    <li><a href="#">Courses</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4">
                <h5>Contact Us</h5>
                <p>Email: kahlolotlanya11@gmail.com</p>
                <p>Phone: +266 57 354 839</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Career Platform. All Rights Reserved.</p>
    </div>
</footer>
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
</body>
</html>

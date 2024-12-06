<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Qualifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/institutionhome.css') }}" rel="stylesheet"> <!-- External CSS File -->
    <script>
    
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

<div class="container mt-5">
    <h2>Add Qualifications</h2>

    <form id="qualification-form" action="{{ route('qualifications.store') }}" method="POST">
        @csrf

        <!-- Faculty Selection -->
        <div class="mb-3">
            <label for="faculty_id" class="form-label">Faculty</label>
            <select name="faculty_id" id="faculty_id" class="form-select" required onchange="filterCourses()">
                <option value="">Select Faculty</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- No Courses Message -->
        <div id="no-courses-message" class="alert alert-warning" style="display: none;">
            This faculty has no courses available.
        </div>

        <!-- Course Selection -->
        <div class="mb-3" id="course-container" style="display:none;">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                <option value="">Select Course</option>
                <!-- Courses will be populated based on the selected faculty -->
            </select>
        </div>

        <!-- Subject and Grades Fields -->
        <div id="subjects-container">
            <div class="subject-group mb-3">
                <label for="subject_name_1" class="form-label">Subject Name</label>
                <input type="text" name="subject_name[]" id="subject_name_1" class="form-control" required>

                <label for="needed_grades_1" class="form-label">Needed Grades</label>
                <input type="text" name="needed_grades[]" id="needed_grades_1" class="form-control" required placeholder="e.g. A,B,C">
            </div>
        </div>

        <!-- Add Another Subject Button -->
        <button type="button" id="add-subject" class="btn btn-secondary mb-3">Add Another Subject</button>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let subjectCount = 1; // This will keep track of the number of subject fields

    // Add event listener for adding another subject field
    document.getElementById('add-subject').addEventListener('click', function () {
        subjectCount++;
        const newSubjectGroup = document.createElement('div');
        newSubjectGroup.classList.add('subject-group', 'mb-3');
        newSubjectGroup.innerHTML = `
            <label for="subject_name_${subjectCount}" class="form-label">Subject Name</label>
            <input type="text" name="subject_name[]" id="subject_name_${subjectCount}" class="form-control" required>

            <label for="needed_grades_${subjectCount}" class="form-label">Needed Grades</label>
            <input type="text" name="needed_grades[]" id="needed_grades_${subjectCount}" class="form-control" required placeholder="e.g. A,B,C">
        `;
        document.getElementById('subjects-container').appendChild(newSubjectGroup);
    });

    function filterCourses() {
        const facultyId = document.getElementById('faculty_id').value;

        if (facultyId) {
            // Show the course container
            document.getElementById('course-container').style.display = 'block';

            // Filter the courses for the selected faculty
            const courses = @json($courses); // All courses passed from the controller
            const filteredCourses = courses.filter(course => course.faculty_id == facultyId);

            const courseSelect = document.getElementById('course_id');
            courseSelect.innerHTML = '<option value="">Select Course</option>';

            if (filteredCourses.length > 0) {
                // Populate the courses dropdown
                filteredCourses.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.id;
                    option.textContent = course.name;
                    courseSelect.appendChild(option);
                });

                // Hide the 'no courses' message if courses are available
                document.getElementById('no-courses-message').style.display = 'none';
            } else {
                // Show 'no courses' message if no courses are available
                document.getElementById('no-courses-message').style.display = 'block';
            }
        } else {
            // Hide the course container if no faculty is selected
            document.getElementById('course-container').style.display = 'none';
            document.getElementById('no-courses-message').style.display = 'none';
        }
    }
</script>

</body>
</html>

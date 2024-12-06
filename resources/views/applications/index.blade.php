<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Guidance</title>
    <link rel="stylesheet" href="{{ asset('/css/stuheader.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/prospectus.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<header>
    <nav>
        <!-- Dropdown for View Admissions -->
         
        <a href="{{ ('/dashboard') }}"><i class="fas fa-home"></i>Home</a>
        <div class="dropdown">
            <a href="#" class="dropdown-trigger"><i class="fas fa-university"></i> View Admissions</a>
            <div class="dropdown-menu">
                @foreach($institutions as $institution)
                    <a href="{{ route('admissions.published', ['institutionId' => $institution->id]) }}">
                        <i class="fas fa-school"></i> {{ $institution->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropdown-trigger"><i class="fas fa-file-alt"></i> Apply</a>
            <div class="dropdown-menu">
                @foreach($institutions as $institution)
                    <a href="{{ route('applications.index', ['institutionId' => $institution->id]) }}">
                        <i class="fas fa-folder-open"></i> {{ $institution->name }}
                    </a>
                @endforeach
            </div>
        </div>
        
        <a href="{{ route('student.about') }}"><i class="fas fa-info-circle"></i> About Us</a>
        <a href="{{ route('student.contact') }}"><i class="fas fa-envelope"></i> Contact Us</a>
        <a href="{{ route('student.logout') }}" class="logout-button"><i class="fas fa-sign-out-alt"></i> Log out</a>
        <a href="{{ route('profile.edit') }}" class="logout-button"><i class="fas fa-user-edit"></i> Edit Profile</a>
    </nav>
</header>

<!-- Instructions Section -->
<div class="instructions">
    <h2><i class="fas fa-info-circle"></i> Instructions</h2>
    <p>Welcome to the Career Guidance Portal. Please follow the instructions below to successfully apply for your desired course:</p>
    <ul>
        <li>Choose the institution you are interested in.</li>
        <li>Fill out the required personal information in the application form.</li>
        <li>Ensure to provide accurate grades for the courses you are applying to.</li>
        <li>If you need any assistance, contact us via the 'Contact Us' section.</li>
    </ul>
</div>

<!-- Advertisements Section -->


<!-- Displaying success and error messages -->
@if(session('success'))
    <script>
        alert("Success: {{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("Error: {{ session('error') }}");
    </script>
@endif

@if($errors->any())
    <script>
        alert("Error: {{ $errors->first() }}");
    </script>
@endif

@foreach ($institutions as $institution)
    @php
        $hasGrades = false;
    @endphp

    @foreach ($institution->faculties as $faculty)
        @foreach ($faculty->courses as $course)
            @if ($course->qualifications->isNotEmpty())
                @php
                    $hasGrades = true;
                @endphp
            @endif
        @endforeach
    @endforeach

    @if ($hasGrades)
        <div class="institution-section">
            <h1><i class="fas fa-school"></i> {{ $institution->name }} Prospectus</h1>

            @foreach ($institution->faculties as $faculty)
                @php
                    $facultyHasCourses = $faculty->courses->filter(function ($course) {
                        return $course->qualifications->isNotEmpty();
                    });
                @endphp

                @if ($facultyHasCourses->isNotEmpty())
                    <div class="faculty-section">
                        <h2><i class="fas fa-users"></i> {{ $faculty->name }}</h2>
                        @foreach ($facultyHasCourses as $course)
                            <div class="course">
                                <h4><i class="fas fa-book"></i> {{ $course->name }}</h4>
                                <p><i class="fas fa-clipboard-list"></i> Needed Grades:</p>
                                <ul>
                                    @foreach ($course->qualifications as $qualification)
                                        <li><i class="fas fa-check"></i> {{ $qualification->subject_name }}:
                                            @php
                                                $grades = is_array($qualification->needed_grades) ? $qualification->needed_grades : json_decode($qualification->needed_grades, true);
                                            @endphp
                                            {{ is_array($grades) ? implode(', ', $grades) : 'N/A' }}
                                        </li>
                                    @endforeach
                                </ul>
                                <button class="show-form-button" onclick="openModal('gradesForm_{{ $course->id }}')">
                                    <i class="fas fa-edit"></i> Show Application Form
                                </button>
                            </div>

                            <div id="gradesForm_{{ $course->id }}" class="grades-modal" style="display: none;">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('gradesForm_{{ $course->id }}')">&times;</span>
                                    <h2><i class="fas fa-file-alt"></i> Fill Out Your Grades for {{ $course->name }}</h2>
                                    <form method="POST" action="{{ route('applications.store') }}" onsubmit="submitGrades(event, this, @json($course->qualifications))">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name"><i class="fas fa-user"></i> Name:</label>
                                            <input type="text" name="name" id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname"><i class="fas fa-user"></i> Surname:</label>
                                            <input type="text" name="surname" id="surname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="former_school"><i class="fas fa-school"></i> Former School:</label>
                                            <input type="text" name="former_school" id="former_school" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="candidate_number"><i class="fas fa-id-card"></i> Candidate Number:</label>
                                            <input type="text" name="candidate_number" id="candidate_number" required>
                                        </div>
                                        @foreach ($course->qualifications as $qualification)
                                            <div class="form-group">
                                                <label for="grade_{{ $qualification->id }}"><i class="fas fa-graduation-cap"></i> {{ $qualification->subject_name }} grade:</label>
                                                <input type="text" name="grades[{{ $qualification->id }}]" id="grade_{{ $qualification->id }}" required>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <input type="hidden" name="institution_id" value="{{ $institution->id }}">
                                        <button type="submit" class="submit-button"><i class="fas fa-paper-plane"></i> Submit Grades</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endforeach

<!-- Overlay for Modal -->
<div id="overlay" class="overlay" style="display: none;"></div>

<!-- Alert Message -->
<div id="alert-message" class="alert" style="display: none;">
    <span id="alert-text"></span>
    <button onclick="closeAlert()">OK</button>
</div>
@include('layouts.footer')
<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
        document.getElementById('overlay').style.display = "block"; 
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
        document.getElementById('overlay').style.display = "none"; 
    }

    // Function to check if the grade entered is valid for a subject
    function validateGrades(event, qualifications) {
        let valid = true;
        let invalidFields = [];

        // Iterate through each qualification and its grade input field
        qualifications.forEach(function(qualification) {
            const gradeInput = document.getElementById(`grade_${qualification.id}`);
            const grade = gradeInput.value.trim().toUpperCase();

            // Parse the needed grades from the qualification
            const neededGrades = qualification.needed_grades; // assuming this is an array of valid grades
            const validGrades = neededGrades.split(',').map(grade => grade.trim().toUpperCase()); 

            // Check if the entered grade is in the list of valid grades
            if (!validGrades.includes(grade)) {
                valid = false;
                invalidFields.push(qualification.subject_name);
            }
        });

        if (!valid) {
            event.preventDefault(); // Prevent form submission
            showAlert(`You don't qualify for this course. Invalid grades for: ${invalidFields.join(', ')}`);
        }
    }

    // Show the alert message
    function showAlert(message) {
        const alertBox = document.getElementById('alert-message');
        const alertText = document.getElementById('alert-text');
        alertText.innerText = message;
        alertBox.style.display = 'block';
    }

    // Close the alert message
    function closeAlert() {
        document.getElementById('alert-message').style.display = 'none';
    }

    // Submit the grades form
    function submitGrades(event, form, qualifications) {
        validateGrades(event, qualifications);
    }
</script>

</body>
</html>

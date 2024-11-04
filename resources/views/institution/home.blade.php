<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF8zX2p5vnXJ6Fw5f5zZ1IQybdhG1Fz/bxZoR" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('/images/institution/institution.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    width: 100%;
    backdrop-filter: blur(10px);
    color: #e0e0e0;
}

.container {
    margin: 50px auto;
    max-width: 900px;
    padding: 40px;
    background-color: rgba(0, 0, 0, 0.75);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
}

h1, h2 {
    color: #ff7e7e;
    margin-bottom: 20px;
    text-align: center;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    margin: 15px 10px;
    text-decoration: none;
    border-radius: 10px;
    border: none;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    background-color: #ff7e7e;
    box-shadow: 0 5px 10px rgba(255, 126, 126, 0.3);
    transition: all 0.3s ease-in-out;
}

.btn-primary {
    background-color: #ff7e7e;
}

.btn:hover {
    background-color: #ff9f9f;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(255, 159, 159, 0.4);
}

.notice, .success-message {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 500;
}

.notice {
    background-color: #ffebee;
    color: #b71c1c;
    border: 1px solid #f5c6cb;
    box-shadow: 0 3px 6px rgba(255, 71, 71, 0.3);
}

.success-message {
    background-color: #d4edda;
    color: #2e7d32;
    border: 1px solid #c3e6cb;
    box-shadow: 0 3px 6px rgba(76, 175, 80, 0.3);
}

ul {
    list-style: none;
    padding: 0;
}

ul li {
    padding: 15px;
    background-color: rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid #555;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 5px;
    transition: background-color 0.3s;
}

ul li:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.form-container {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.form-box {
    flex: 1;
    margin: 0 15px;
    padding: 25px;
    display: none;
    background-color: rgba(50, 50, 50, 0.9);
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease-in-out;
}

input[type="text"], select, input[type="file"], textarea {
    width: 100%;
    padding: 12px;
    margin: 15px 0;
    border: 2px solid #ff7e7e;
    border-radius: 8px;
    background-color: #222;
    color: #fff;
    outline: none;
    transition: all 0.3s;
}

input[type="text"]:focus, select:focus, input[type="file"]:focus, textarea:focus {
    border-color: #ff9f9f;
    box-shadow: 0 0 10px rgba(255, 126, 126, 0.5);
}

.btn-delete {
    background-color: #e53935;
    padding: 8px 12px;
    border-radius: 8px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-delete:hover {
    background-color: #d32f2f;
}

.btn i {
    margin-right: 8px;
}

    </style>
</head>

    <div class="btn btn-primary">

        <li><a href="{{route('institution.logout')}}">log out</a></li>
    </div>
    <div class="con">
        <div class="btn btn-primary"><a href="{{route('#')}}">Edit Profile</a></div>
        <div  class="btn btn-primary"><a href="{{route('view-admissions', $institution->id)}}">View uploaded admissions</a></div>
        <button class="btn btn-primary" onclick="toggleFacultyForm()"><i class="fas fa-plus"></i>Add Faculty</button>
        <button class="btn btn-primary" onclick="toggleCourseForm()"><i class="fas fa-plus"></i>Add Course</button>
        <button class="btn btn-primary" onclick="toggleAdmissionForm()"><i class="fas fa-plus"></i>Upload
            Admission</button>
        <button class="btn btn-primary" onclick="toggleFacultyList()"><i class="fas fa-eye"></i>View Faculties</button>
        <button class="btn btn-primary" onclick="toggleCourseList()"><i class="fas fa-eye"></i>View Courses</button>
        <div class="notice"><a href="{{route('institution.applications', $institution->id)}}">View Applications</a>
        </div>

    </div>
    <div class="background-image">
        <div class="container">
            <h1>Welcome, {{ $institution->name }}</h1>

            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <div class="notice">Note: A course cannot be added without at least one faculty.</div>


            <div class="form-container">
                <div id="facultyForm" class="form-box">
                    <h2>Add a New Faculty</h2>
                    <form action="{{ route('institution.faculties.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Faculty Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-plus"></i>Create
                            Faculty</button>
                    </form>
                </div>

                <div id="courseForm" class="form-box">
                    <h2>Add a New Course</h2>
                    <form action="{{ route('institution.courses.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="course_name">Course Name:</label>
                            <input type="text" name="name" id="course_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="faculty_id">Select Faculty:</label>
                            <select name="faculty_id" id="faculty_id" class="form-control" required>
                                @foreach($institution->faculties as $faculty)
                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-plus"></i>Create
                            Course</button>
                    </form>
                </div>

                <div id="admissionForm" class="form-box">
                    <h2>Upload Admission</h2>

                    <form action="{{ route('admissions.store', $institution) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="institution_id" value="{{ $institution->id }}">
                        <div class="form-group">
                            <label for="title">Admission Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="details">Details:</label>
                            <textarea name="details" id="details" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="document">Upload Document:</label>
                            <input type="file" name="document" id="document" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-upload"></i>Upload
                            Admission</button>
                    </form>
                </div>

                <div id="facultyList" class="form-box">
                    <h2>List of Faculties</h2>
                    <ul>
                        @foreach($institution->faculties as $faculty)
                            <li>
                                <div class="faculty-info">{{ $faculty->name }}</div>
                                <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <i class="fas fa-trash"></i> DELETE
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div id="courseList" class="form-box" style="display: none;">
                    <h2>List of Courses</h2>
                    @foreach($institution->faculties as $faculty)
                        <h3>{{ $faculty->name }}</h3>
                        <ul>
                            @foreach($faculty->courses as $course)
                                <li class="course-item">
                                    <div class="course-info">{{ $course->name }}</div>
                                    <div style="display: flex; align-items: center;">
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash"></i> DELETE
                                            </button>

                                        </form>
                                        <button class="btn btn-primary" onclick="toggleQualificationForm({{ $course->id }})">
                                            <i class="fas fa-plus"></i>Add Qualification
                                        </button>

                                        <!-- Qualification Form for this Course -->
                                        <div id="qualificationForm-{{ $course->id }}" class="qualification-form">
                                            <h4>Add Qualification for {{ $course->name }}</h4>
                                            <form action="{{ route('qualifications.store', $course) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <div class="form-group">
                                                    <label for="subject_name">Subject Name:</label>
                                                    <input type="text" name="subject_name[]" id="subject_name"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group needed-grades">
                                                    <label for="needed_grades">Needed Grades (comma-separated):</label>
                                                    <input type="text" name="needed_grades[]" class="form-control" required
                                                        placeholder="e.g., D, C, B, A, A+">
                                                </div>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="addQualificationField({{ $course->id }})"><i
                                                        class="fas fa-plus"></i> Add Another Qualification</button>
                                                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-plus"></i>
                                                    Add Qualification</button>

                                            </form>


                                        </div>


                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </body>


    <script>
        function toggleFacultyForm() {
            document.getElementById('facultyForm').style.display =
                document.getElementById('facultyForm').style.display === 'none' ? 'block' : 'none';
        }

        function toggleCourseForm() {
            document.getElementById('courseForm').style.display =
                document.getElementById('courseForm').style.display === 'none' ? 'block' : 'none';
        }

        function toggleAdmissionForm() {
            document.getElementById('admissionForm').style.display =
                document.getElementById('admissionForm').style.display === 'none' ? 'block' : 'none';
        }

        function toggleFacultyList() {
            document.getElementById('facultyList').style.display =
                document.getElementById('facultyList').style.display === 'none' ? 'block' : 'none';
        }

        function toggleCourseList() {
            document.getElementById('courseList').style.display =
                document.getElementById('courseList').style.display === 'none' ? 'block' : 'none';
        }

        function toggleQualificationForm(courseId) {
            var form = document.getElementById('qualificationForm-' + courseId);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function addQualificationField(courseId) {
            var qualificationForm = document.getElementById('qualificationForm-' + courseId).querySelector('form');


            var subjectInput = document.createElement('div');
            subjectInput.className = 'form-group';
            subjectInput.innerHTML = `
            <label for="subject_name">Subject Name:</label>
            <input type="text" name="subject_name[]" class="form-control" required>
        `;


            var gradesInput = document.createElement('div');
            gradesInput.className = 'form-group needed-grades';
            gradesInput.innerHTML = `
            <label for="needed_grades">Needed Grades (comma-separated):</label>
            <input type="text" name="needed_grades[]" class="form-control" required placeholder="e.g., D, C, B, A, A+">
        `;


            qualificationForm.appendChild(subjectInput);
            qualificationForm.appendChild(gradesInput);
        }
    </script>
    </body>

</html>
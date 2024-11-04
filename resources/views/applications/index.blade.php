@php
    $hasAvailableCourses = false;
@endphp

@foreach ($institutions as $institution)
    @foreach ($institution->faculties as $faculty)
        @foreach ($faculty->courses as $course)
            @if ($course->qualifications->isNotEmpty())
                @php
                    $hasAvailableCourses = true;
                @endphp
            @endif
        @endforeach
    @endforeach
@endforeach

@if ($hasAvailableCourses)
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
                <h1>Courses and their needed grades under {{ $institution->name }}, a higher learning institution</h1>

                @foreach ($institution->faculties as $faculty)
                    @foreach ($faculty->courses as $course)
                        @if ($course->qualifications->isNotEmpty())
                            <div class="course">
                                <h4>{{ $course->name }}</h4>
                                <p>Needed Grades:</p>
                                <ul>
                                    @foreach ($course->qualifications as $qualification)
                                        <li>{{ $qualification->subject_name }}:
                                            @php
                                                $grades = is_array($qualification->needed_grades) ? $qualification->needed_grades : json_decode($qualification->needed_grades, true);
                                            @endphp
                                            {{ is_array($grades) ? implode(', ', $grades) : 'N/A' }}
                                        </li>
                                    @endforeach
                                </ul>
                                <button class="show-form-button" onclick="openModal('gradesForm_{{ $course->id }}')">Show Application Form</button>
                            </div>

                            <div id="gradesForm_{{ $course->id }}" class="grades-modal" style="display: none;">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('gradesForm_{{ $course->id }}')">&times;</span>
                                    <h2>Fill Out Your Grades for {{ $course->name }}</h2>
                                    <form method="POST" action="{{ route('applications.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" name="name" id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Surname:</label>
                                            <input type="text" name="surname" id="surname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="former_school">Former School:</label>
                                            <input type="text" name="former_school" id="former_school" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="candidate_number">Candidate Number:</label>
                                            <input type="text" name="candidate_number" id="candidate_number" required>
                                        </div>
                                        @foreach ($course->qualifications as $qualification)
                                            <div class="form-group">
                                                <label for="grade_{{ $qualification->id }}">{{ $qualification->subject_name }} grade:</label>
                                                <input type="text" name="grades[{{ $qualification->id }}]" id="grade_{{ $qualification->id }}" required>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <input type="hidden" name="institution_id" value="{{ $institution->id }}">
                                        <button type="submit" class="submit-button">Submit Grades</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endif
    @endforeach
@else
    <p class="no-courses-message">No institutions currently have courses requiring grades.</p>
@endif

<div id="overlay" class="overlay" style="display: none;"></div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
        document.getElementById('overlay').style.display = "block"; 
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
        document.getElementById('overlay').style.display = "none"; 
    }
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
    }

    .institution-section {
        margin: 20px auto;
        max-width: 800px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #007bff;
    }

    .course {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        padding: 15px;
        background-color: #f1f1f1;
        transition: background-color 0.3s;
    }

    .course:hover {
        background-color: #e9ecef;
    }

    h4 {
        margin-top: 0;
        color: #333;
    }

    .show-form-button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .show-form-button:hover {
        background-color: #0056b3;
    }

    .grades-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 600px;
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-content {
        padding: 20px;
    }

    .close {
        cursor: pointer;
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 24px;
    }

    .submit-button {
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-button:hover {
        background-color: #218838;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .no-courses-message {
        text-align: center;
        font-size: 18px;
        color: #dc3545;
        margin: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-group input:focus {
        border-color: #007bff;
        outline: none;
    }
</style>

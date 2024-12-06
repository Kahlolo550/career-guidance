<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/adminbar.css')}}">
    <title>Add Course</title>
   
    <!-- jQuery (for handling the dynamic faculty dropdown) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
@include('admin.layouts.header')
@if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
    <div class="form-container">
        <h1>Add Course</h1>
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <label for="institution_id">Select Institution</label>
            <select name="institution_id" id="institution_id" required>
                <option value="">Select an institution</option>
                @foreach($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                @endforeach
            </select>

            <label for="faculty_id">Select Faculty</label>
            <select name="faculty_id" id="faculty_id" required>
                <option value="">Select a faculty</option>
            </select>
            <div class="message" id="no-faculties-message" style="display: none;">
                No faculties available for this institution.
            </div>

            <label for="course_name">Course Name</label>
            <input type="text" name="course_name" id="course_name" placeholder="Enter course name" required>

            <button type="submit">Add Course</button>
        </form>
    </div>

    <script>
        // When the institution is selected, fetch the faculties for that institution
        $(document).ready(function() {
            $('#institution_id').on('change', function() {
                var institution_id = $(this).val();

                if (institution_id) {
                    // AJAX request to get faculties for the selected institution
                    $.ajax({
                        url: '/admin/faculties/' + institution_id + '/get', // Adjust this route in your routes file
                        type: 'GET',
                        success: function(data) {
                            // Empty the faculty dropdown
                            $('#faculty_id').empty();
                            $('#faculty_id').append('<option value="">Select a faculty</option>');

                            // Check if there are any faculties
                            if (data.faculties.length > 0) {
                                // Append the new faculties to the dropdown
                                data.faculties.forEach(function(faculty) {
                                    $('#faculty_id').append('<option value="' + faculty.id + '">' + faculty.name + '</option>');
                                });
                                // Hide the "no faculties" message
                                $('#no-faculties-message').hide();
                            } else {
                                // Display message if no faculties are found
                                $('#no-faculties-message').show();
                            }
                        }
                    });
                } else {
                    // Clear the faculty dropdown and hide the message if no institution is selected
                    $('#faculty_id').empty();
                    $('#faculty_id').append('<option value="">Select a faculty</option>');
                    $('#no-faculties-message').hide();
                }
            });
        });
    </script>
</body>
</html>

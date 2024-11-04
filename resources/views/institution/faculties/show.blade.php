<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Details</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container Styling */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 25px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(128, 0, 0, 0.2);
            position: relative;
        }

        h1 {
            font-size: 28px;
            color: #dc3545;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0px 1px 3px rgba(128, 0, 0, 0.3);
        }

        h2 {
            font-size: 22px;
            color: #333;
            margin-top: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        /* Back Button Styling */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
            box-shadow: 0px 4px 8px rgba(220, 53, 69, 0.3);
        }

        .back-button:hover {
            background-color: #c82333;
        }

        .back-button svg {
            margin-right: 8px;
        }

        /* Form Styling */
        form {
            margin-top: 15px;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 2px 4px rgba(128, 0, 0, 0.1);
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0px 4px 8px rgba(220, 53, 69, 0.3);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #c82333;
            transform: translateY(-1px);
            box-shadow: 0px 6px 12px rgba(220, 53, 69, 0.4);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            box-shadow: 0px 3px 8px rgba(128, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #dc3545;
            color: #fff;
            font-weight: 600;
            box-shadow: inset 0px -2px 4px rgba(100, 0, 0, 0.2);
        }

        tr:nth-child(even) {
            background-color: #f9f1f1;
        }

        tr:hover {
            background-color: #f1d4d4;
        }

        /* Link Styling */
        a {
            color: #dc3545;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Delete Button Styling */
        .delete-button {
            background-color: #dc3545;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        /* Error Message Styling */
        .error {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                alert("{{ session('success') }}");
            @endif
        });
    </script>
</head>
<body>

<div class="container">
    <!-- Back Button -->
    <a href="javascript:history.back()" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        Back
    </a>

    <h1>Courses for {{ $faculty->name }}</h1>

    <div class="courses">
        <h2>Add New Course</h2>
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <label for="course_name">Course Name</label>
            <input type="text" name="name" id="course_name" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            <input type="hidden" name="faculty_id" value="{{ $faculty->id }}">
            <input type="hidden" name="institution_id" value="{{ $faculty->institution_id }}">
            <button type="submit">Add Course</button>
        </form>

        <h2>Existing Courses</h2>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faculty->courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

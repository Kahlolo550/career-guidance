<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Details</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: red; /* Adjusted background color */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex; /* Flexbox for sidebar layout */
        }

        /* Container Styling */
        .container {
            flex: 1; /* Take remaining space */
            max-width: 800px;
            margin: 40px auto;
            padding: 25px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 128, 0, 0.2);
            position: relative;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px; /* Fixed width for sidebar */
            background-color: #28a745; /* Sidebar color */
            padding: 20px;
            border-radius: 10px;
            margin-right: 20px; /* Space between sidebar and main content */
            box-shadow: 0 4px 8px rgba(0, 128, 0, 0.2);
            height: auto; /* Auto height to fit content */
        }

        .sidebar h2 {
            color: #fff; /* Title color */
            font-size: 20px; /* Title font size */
            margin-bottom: 15px; /* Spacing below title */
        }

        .sidebar a {
            display: block; /* Block display for links */
            color: #fff; /* Link color */
            text-decoration: none; /* No underline */
            padding: 10px; /* Padding around links */
            border-radius: 5px; /* Rounded corners */
            margin-bottom: 10px; /* Space between links */
            transition: background-color 0.3s; /* Transition effect */
        }

        .sidebar a:hover {
            background-color: #218838; /* Darker green on hover */
        }

        h1 {
            font-size: 28px;
            color: #28a745;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0px 1px 3px rgba(0, 128, 0, 0.3);
        }

        /* Back Button Styling */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
            box-shadow: 0px 4px 8px rgba(40, 167, 69, 0.3);
        }

        .back-button:hover {
            background-color: #218838;
        }

        .back-button svg {
            margin-right: 8px;
        }

        /* Section Titles */
        h2 {
            font-size: 22px;
            color: #333;
            margin-top: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        /* Button Styling */
        button, .add-faculty-form button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            box-shadow: 0px 4px 8px rgba(40, 167, 69, 0.3);
        }

        button:hover {
            background-color: #218838;
            transform: translateY(-1px);
            box-shadow: 0px 6px 12px rgba(40, 167, 69, 0.4);
        }

        .add-faculty-form {
            display: none;
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 3px 10px rgba(0, 128, 0, 0.1);
        }

        .add-faculty-form label {
            font-size: 16px;
            color: #333;
        }

        .add-faculty-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 2px 4px rgba(0, 128, 0, 0.1);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            box-shadow: 0px 3px 8px rgba(0, 128, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #28a745;
            color: #fff;
            font-weight: 600;
            box-shadow: inset 0px -2px 4px rgba(0, 100, 0, 0.2);
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e9f5eb;
        }

        /* Link Styling */
        a {
            color: #28a745;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function toggleFacultyForm() {
            var form = document.getElementById('add-faculty-form');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>

<div class="sidebar">
    <h2>Sidebar</h2>
    <a href="#">Home</a>
    <a href="#">About Us</a>
    <a href="#">Contact</a>
    <a href="#">Settings</a>
</div>

<div class="container">
    <!-- Back Button -->
    <a href="javascript:history.back()" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        Back
    </a>

    @foreach ($institutions as $institution)
        <h1>{{ $institution->name }}</h1>
    @endforeach
    
    <div class="faculties">
        <h2>Faculties</h2>
        <button onclick="toggleFacultyForm()">Add Faculty</button>
        
        <!-- Add Faculty Form -->
        <form id="add-faculty-form" class="add-faculty-form" action="{{ route('faculties.store') }}" method="POST">
            @csrf
            <label for="faculty_name">Faculty Name</label>
            <input type="text" name="name" id="faculty_name" required>
            <input type="hidden" name="institution_id" value="{{ $institution->id }}">
            <button type="submit">Save</button>
        </form>

        <!-- Faculties Table -->
        <table>
            <thead>
                <tr>
                    <th>Faculty Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($institution->faculties as $faculty)
                <tr>
                    <td>
                        <a href="{{ route('faculties.show', $faculty->id) }}">{{ $faculty->name }}</a>
                    </td>
                    <td>
                        <!-- View Courses Button -->
                        <a href="{{ route('faculties.show', $faculty->id) }}" style="background-color: #17a2b8; color: #fff; padding: 8px 12px; border-radius: 5px; text-decoration: none; display: inline-block; margin-right: 8px;">
                            View Courses
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #dc3545; color: #fff; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer;">
                                Delete
                            </button>
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

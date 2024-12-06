<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        .back-button {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            margin-bottom: 20px;
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .back-button svg {
            margin-right: 5px;
        }

        .faculties {
            margin-top: 20px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #218838;
        }

        .add-faculty-form {
            display: none;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .add-faculty-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .add-faculty-form button {
            background-color: #007bff;
            margin-top: 10px;
            width: 100%;
            padding: 10px;
        }

        .add-faculty-form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table td a {
            background-color: #17a2b8;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-right: 8px;
        }

        table td a:hover {
            background-color: #138496;
        }

        table td button {
            background-color: #dc3545;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table td button:hover {
            background-color: #c82333;
        }

        /* Success message styling */
        .success-message {
            background-color: #28a745; /* Green background */
            color: white; /* White text */
            padding: 15px;
            border-radius: 5px;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

    </style>

    <script>
        // Toggle the faculty form visibility
        function toggleFacultyForm() {
            var form = document.getElementById('add-faculty-form');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>
@include('admin.layouts.header')

<div class="container">
    <!-- Back Button -->
    

    <h1>{{ $institution->name }}</h1>

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
                        <a href="{{ route('faculties.show', $faculty->id) }}">
                            View Courses
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
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

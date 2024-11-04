<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculties</title>
    <style>
        /* General Styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #333;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
        }

        /* Sidebar Links */
        .sidebar a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 15px 20px;
            width: 100%;
            text-align: center;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #444;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        /* Institutions List */
        .institutions {
            margin-top: 20px;
            width: 100%;
            text-align: left;
        }

        .institutions a {
            font-size: 16px;
            padding: 10px 15px;
            display: block;
            color: #fff;
            transition: background-color 0.3s;
        }

        .institutions a:hover {
            background-color: #555;
        }

        /* Main Content Area */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Main Title Styling */
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Add Button Styling */
        .add {
            display: inline-block;
            float: right;
            margin: 10px 0 20px 0;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            box-shadow: 0px 4px 6px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
        }

        .add:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0px 6px 10px rgba(0, 86, 179, 0.4);
        }

        /* Delete Button Styling */
        button {
            padding: 8px 15px;
            font-size: 14px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0px 4px 8px rgba(220, 53, 69, 0.3);
        }
    </style>
</head>
<body>

    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('admin.dashboard') }}">Home</a>
        <a href="{{ route('faculties.index') }}">Faculties</a>
        <a href="{{ route('faculties.create') }}">Add Faculty</a>
        <a href="{{ route('courses.index') }}">Courses</a>
        <a href="{{ route('courses.create') }}">Add Course</a>
        
        <!-- Institutions List -->
        <div class="institutions">
            <h2>Institutions</h2>
            @foreach($institutions as $institution)
                <a href="{{ route('institutions.show', $institution->id) }}">{{ $institution->name }}</a>
            @endforeach
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <h1>Faculties</h1>
        <a href="{{ route('faculties.create') }}" class="add">Add Faculty</a>

        <!-- Faculties Table -->
        <table>
            <thead>
                <tr>
                    <th>Faculty Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faculties as $faculty)
                <tr>
                    <td><a href="{{ route('faculties.show', $faculty->id) }}">{{ $faculty->name }}</a></td>
                    <td>
                        <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if (session('success'))
            <div style="color: green; text-align: center; margin-top: 20px;">
                {{ session('success') }}
            </div>
        @endif
    </div>

</body>
</html>

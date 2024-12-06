<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #ff4500;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
            box-shadow: 2px 0px 10px rgba(255, 69, 0, 0.3);
        }

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
            background-color: #ff6347;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 30px;
            text-shadow: 0px 2px 4px rgba(255, 69, 0, 0.2);
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            background-color: #ffffff;
            min-height: 100vh;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ff4500;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: 600;
        }

        .add {
            display: inline-block;
            float: right;
            margin: 10px 0 20px 0;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #ff4500;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            box-shadow: 0px 4px 6px rgba(255, 69, 0, 0.3);
            transition: all 0.3s ease;
        }

        .add:hover {
            background-color: #ff6347;
            transform: translateY(-2px);
            box-shadow: 0px 6px 10px rgba(255, 69, 0, 0.4);
        }

        #add-institution-form {
            display: none;
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(255, 69, 0, 0.1);
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #ff4500;
            outline: none;
        }

        button, .view-details-btn {
            padding: 8px 15px;
            font-size: 14px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-details-btn {
            background-color: #ff4500;
            margin-right: 5px;
        }

        button {
            background-color: #dc3545;
        }

        button:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0px 4px 8px rgba(220, 53, 69, 0.3);
        }

        .view-details-btn:hover {
            background-color: #ff6347;
            transform: translateY(-2px);
            box-shadow: 0px 4px 8px rgba(255, 69, 0, 0.3);
        }

        .delete-btn {
            background-color: #dc3545;
            margin-left: 5px;
        }

        .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0px 4px 8px rgba(220, 53, 69, 0.3);
        }

        .success-message {
            color: #28a745;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .succ {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .note {
            color: #ff4500;
            font-weight: bold;
            margin: 15px 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0px 3px 8px rgba(255, 69, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #ff4500;
            color: #fff;
            font-weight: 600;
            box-shadow: inset 0px -2px 4px rgba(255, 69, 0, 0.2);
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e9f5eb;
        }
    </style>
    <script>
          <script>
     
        function confirmDelete(event) {
            var isConfirmed = window.alert("Are you sure you want to delete this faculty?");
            if (!isConfirmed) {
                event.preventDefault(); // Prevent the form submission if the user cancels

            }
            function toggleInstitutionForm() {
            var form = document.getElementById('add-institution-form');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
        }
    </script>
     
  
</head>
<body>

@include('admin.layouts.header')
    <div class="content">
        <h1>Institutions</h1>
        @if(session('success'))
            <div class="succ">{{ session('success') }}</div>
        @endif
        <a href="#" class="add" onclick="toggleInstitutionForm();">Add Institution</a>

        <form id="add-institution-form" action="{{ route('institutions.store') }}" method="POST">
            @csrf
            <label for="name">Institution Name</label>
            <input type="text" name="name" id="name" required>
            <button type="submit">Save</button>
        </form>

        <div class="note">When you hit "View Details," you can add faculty to the course afterward.</div>

        <table>
            <thead>
                <tr>
                    <th>Institution Name</th>
                    <th>Institution ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($institutions as $institution)
                <tr>
                    <td><a href="{{ route('institutions.show', $institution->id) }}">{{ $institution->name }}</a></td>
                    <td>{{ $institution->id }}</td>
                    <td>
                        <a href="{{ route('institutions.show', $institution->id) }}" class="view-details-btn">View Details</a>
                        <a href="{{ route('admissions.index', $institution->id) }}" class="view-details-btn">View Admissions</a>

                        <form action="{{ route('institutions.destroy', $institution->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" title="Delete Institution">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <script>
        // Function to confirm deletion
function confirmDelete(event) {
    if (!confirm("Are you sure you want to delete this faculty?")) {
        event.preventDefault(); // Prevent the form submission if the user cancels
    }
}

    </script>

</body>
</html>

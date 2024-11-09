<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Institution Profile</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px; 
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
        }
        .sidebar h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .sidebar .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
        }
        .sidebar .btn:hover {
            background-color: #0056b3;
        }
        .container {
            margin-left: 270px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: calc(100% - 270px);
        }
        h1 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Navigation</h2>
        <a href="{{ route('institution.logout') }}" class="btn">Log out</a>
        <a href="{{ url('/institution/home') }}" class="btn"><i class="fas fa-home"></i> Home</a>
    </div>

    <div class="container">
        <h1>Edit Institution Profile</h1>

        <form action="{{ route('institution.profile.update', $institution->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Institution Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $institution->name) }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $institution->email) }}" required>
            </div>
            <button type="submit" class="btn">Save Changes</button>
        </form>

        <a class="btn" href="{{ route('institution.profile', $institution->id) }}">Cancel</a>
    </div>
</body>
</html>

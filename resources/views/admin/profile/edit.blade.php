<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #fff3e0;
            color: #333;
            display: flex;
            flex-direction: row;
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
        }

        .form-container {
            margin-left: 270px;
            padding: 30px;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            color: #ff4500;
            margin-bottom: 20px;
        }

        form div {
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #ff4500;
            outline: none;
        }

        .error-messages {
            background-color: #ffcccc;
            color: #a00;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            gap: 15px;
        }

        button {
            padding: 12px 25px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"] {
            background-color: #ff4500;
            color: #fff;
        }

        button[type="submit"]:hover {
            background-color: #ff6347;
        }

        .back-button {
            background-color: #ccc;
            color: #333;
        }

        .back-button:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('admin.profile.show') }}">Profile</a>
        <a href="{{ route('admin.dashboard') }}">Home</a>
        <a href="{{ route('institutions.index') }}">Institutions</a>
        <a href="{{ route('admin.logout') }}">Log out</a>
    </div>

    <div class="form-container">
        <h1>Edit Admin Profile</h1>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $admin->name }}" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $admin->email }}" required>
            </div>

            <div>
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>

            <div>
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="button-group">
                <button type="submit">Update Profile</button>
                
            </div>
        </form>
    </div>
</body>
</html>

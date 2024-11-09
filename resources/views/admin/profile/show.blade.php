<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
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

        .profile-container {
            margin-left: 270px;
            padding: 30px;
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            color: #ff4500;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ff4500;
            margin-bottom: 20px;
        }

        .profile-info {
            font-size: 18px;
            margin-bottom: 15px;
        }

        strong {
            color: #333;
        }

        .edit-button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #ff4500;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: #ff6347;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 15px;
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

    <div class="profile-container">
        <h1>Admin Profile</h1>

        @if ($admin->profile_picture)
            <img src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Profile Picture" class="profile-picture">
        @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-picture">
        @endif

        <div class="profile-info">
            <p><strong>Name:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Phone:</strong> {{ $admin->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $admin->address ?? 'N/A' }}</p>
        </div>

        <div class="button-group">
            <a href="{{ route('admin.profile.edit', $admin->id) }}" class="edit-button">Edit Profile</a>
         
        </div>
    </div>
</body>
</html>

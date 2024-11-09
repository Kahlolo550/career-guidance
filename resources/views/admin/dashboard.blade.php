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
            background-color: #fff3e0;
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

        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #ffffff;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            color: #ff4500;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .dashboard-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .content p {
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 1rem;
            color: #555;
            padding: 10px;
            border-left: 4px solid #ff4500;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="{{route('admin.profile.show')}}">Profile</a>
        <a href="{{ route('admin.dashboard') }}">Home</a>
        <a href="{{ route('institutions.index') }}">Institutions</a>
        <a href="{{route('admin.logout')}}">Log out</a>
    </div>

    <div class="content">
        <h1>Admin Dashboard</h1>
        <img src="{{ asset('images/admin/dashboard.jpg') }}" class="dashboard-image" />

        <p>Welcome to the Admin Dashboard! This platform serves as the control center for managing various aspects of our educational institution's operations. Here, you can oversee institutions, faculties, courses, and student applications, ensuring that everything runs smoothly and efficiently. Utilize the tools provided to manage admissions, publish updates, and maintain a comprehensive overview of institutional performance.</p>

        <p>As an administrator, you play a vital role in shaping the educational journey of countless students. The user-friendly interface allows you to monitor application statuses, update course offerings, and manage faculty assignments—all from a single platform. Thank you for your commitment to fostering a supportive learning environment and creating a brighter future for our students!</p>
    </div>
</body>
</html>

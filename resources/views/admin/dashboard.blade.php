<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        
    </style>
</head>
<body>
@include('admin.layouts.header')

    <div class="content">
        <h1>Admin Dashboard</h1>
        <img src="{{ asset('images/admin/dashboard.jpg') }}" class="dashboard-image" />

        <p>Welcome to the Admin Dashboard! This platform serves as the control center for managing various aspects of our educational institution's operations. Here, you can oversee institutions, faculties, courses, and student applications, ensuring that everything runs smoothly and efficiently. Utilize the tools provided to manage admissions, publish updates, and maintain a comprehensive overview of institutional performance.</p>

        <p>As an administrator, you play a vital role in shaping the educational journey of countless students. The user-friendly interface allows you to monitor application statuses, update course offerings, and manage faculty assignments—all from a single platform. Thank you for your commitment to fostering a supportive learning environment and creating a brighter future for our students!</p>
    </div>
</body>
</html>

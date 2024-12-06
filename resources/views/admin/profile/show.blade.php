<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

</head>
<body>
@include('admin.layouts.header')
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

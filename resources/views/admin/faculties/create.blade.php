<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/adminbar.css')}}">
    <title>Add Faculty</title>
</head>
<body>
@include('admin.layouts.header')
@if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
<div class="form-container">
    <h1>Add Faculty</h1>
    <form action="{{ route('faculties.store') }}" method="POST">
        @csrf
        <label for="institution_id">Select Institution</label>
        <select name="institution_id" id="institution_id" required>
            <option value="">Select an institution</option>
            @foreach($institutions as $institution)
                <option value="{{ $institution->id }}">{{ $institution->name }}</option>
            @endforeach
        </select>

        <label for="faculty_name">Faculty Name</label>
        <input type="text" name="name" id="faculty_name" placeholder="Enter faculty name" required>

        <button type="submit">Add Faculty</button>
    </form>
</div>
</body>
</html>

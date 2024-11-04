<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications for {{ $institution->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    <style>body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    margin: 0;
    padding: 0;
    position: relative;
    color: #333;
}

.background {
    background-image: url('/images/institution/institution.jpg');
    background-size: cover;
    background-position: center;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    filter: blur(8px);
    z-index: 0;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 1;
}

.container {
    display: flex;
    position: relative;
    z-index: 2;
}

.sidebar {
    width: 250px; 
    background-color: rgba(255, 255, 255, 0.85);
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}

.content {
    flex: 1;
    margin-left: 20px; 
    padding: 20px;
}

h1 {
    color: #007bff;
    font-size: 32px;
    margin-bottom: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 16px;
}

th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
}

tr:hover {
    background-color: rgba(0, 123, 255, 0.2);
}

p {
    margin: 0;
}

.no-applications {
    margin-top: 20px;
    font-style: italic;
    color: #666;
    text-align: center;
}

.btn {
    display: block;
    padding: 12px;
    margin: 10px 0;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.2s;
    text-align: center;
}

.btn:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.notice {
    margin-top: 15px;
    font-size: 12px;
    color: #333;
    text-align: center;
}


    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications for {{ $institution->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="sidebar">
            <h2>Navigation</h2>
            <a href="{{route('institution.logout')}}" class="btn">log out</a>
            <a href="{{url('/institution/home')}}" class="btn"><i class="fas fa-plus"></i>Home</a>
        </div>
        <div class="content">
            <h1>Applications for {{ $institution->name }}</h1>

            @if($applications->isEmpty())
                <p class="no-applications">No applications have been submitted for your institution.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Candidate Number</th>
                            <th>Student Name</th>
                            <th>Surname</th>
                            <th>Former School</th>
                            <th>Grades</th>
                            <th>Course</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $application->candidate_number }}</td>
                                <td>{{ $application->name }}</td> 
                                <td>{{ $application->surname }}</td> 
                                <td>{{ $application->former_school }}</td> 
                                <td>
                                    @php
                                        $grades = json_decode($application->grades, true);
                                    @endphp
                                    @if(is_array($grades))
                                        @foreach($grades as $qualificationId => $grade)
                                            @php
                                                $qualification = \App\Models\Qualification::find($qualificationId); 
                                            @endphp
                                            <p>{{ $qualification ? $qualification->subject_name : 'Unknown Subject' }}: {{ $grade }}</p>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $application->course ? $application->course->name : 'N/A' }}</td>
                                <td>{{ $application->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>

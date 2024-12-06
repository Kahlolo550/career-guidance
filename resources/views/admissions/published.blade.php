<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Published Admissions</title>
    <link rel="stylesheet" href="{{ asset('/css/published.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/dashboard') }}"><i class="fas fa-home"></i> Home</a>
            <a href="{{ route('student.about') }}"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="{{ route('student.contact') }}"><i class="fas fa-envelope"></i> Contact Us</a>
            <a href="{{ route('student.logout') }}" class="logout-button"><i class="fas fa-sign-out-alt"></i> Log out</a>
            <a href="{{ route('profile.edit') }}" class="logout-button"><i class="fas fa-user-edit"></i> Edit Profile</a>
            
            <!-- View Admissions Dropdown -->
            <div class="dropdown">
                <a href="#" class="dropdown-trigger"><i class="fas fa-university"></i> View Admissions</a>
                <div class="dropdown-menu">
                    @foreach($institutions as $inst)
                        <a href="{{ route('admissions.published', ['institutionId' => $inst->id]) }}">
                            {{ $inst->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1>Published Admissions for {{ $institution->name }}</h1>

        @if ($admissions->isEmpty())
            <div class="no-admissions-message">
                <p><i class="fas fa-exclamation-circle"></i> No admissions found for this institution.</p>
            </div>
        @else
            <ul>
                @foreach ($admissions as $admission)
                    <li>
                        <div class="admission-title">
                            <i class="fas fa-university"></i> {{ $admission->title }}
                        </div>
                        <a href="{{ Storage::url($admission->document) }}" class="download-btn" target="_blank">
                            <i class="fas fa-download"></i> Download PDF
                        </a>
                        <a href="{{ Storage::url($admission->document) }}" class="view-link" target="_blank">
                            <i class="fas fa-eye"></i> View Document
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    
@include('layouts.footer')
</body>
</html>

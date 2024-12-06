<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}">
</head>
<body>
<header>
    <nav>
        <a href="{{url('/dashboard')}}"><i class="fas fa-home"></i>Home</a>
        <div class="dropdown">
            <a href="#" class="dropdown-trigger"><i class="fas fa-university"></i> View Admissions</a>
            <div class="dropdown-menu">
                @foreach($institutions as $institution)
                <a href="{{ route('admissions.published', ['institutionId' => $institution->id]) }}">
                        {{ $institution->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropdown-trigger"><i class="fas fa-file-alt"></i> Apply</a>
            <div class="dropdown-menu">
                @foreach($institutions as $institution)
                <a href="{{ route('applications.index', ['institutionId' => $institution->id]) }}">
                    {{ $institution->name }}
                </a>
                @endforeach
            </div>
        </div>
        <a href="{{ route('student.about') }}"><i class="fas fa-info-circle"></i> About Us</a>
        <a href="{{ route('student.contact') }}"><i class="fas fa-envelope"></i> Contact Us</a>
        <a href="{{ route('student.logout') }}" class="logout-button"><i class="fas fa-sign-out-alt"></i> Log out</a>
        <a href="{{ route('profile.edit') }}" class="logout-button"><i class="fas fa-user-edit"></i> Edit Profile</a>
    </nav>
</header>

@if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
<div class="container">
    <header>
        <h2>Edit Profile</h2>
    </header>

    <div class="form-section">
        <h3>Update Profile Information</h3>
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="form-section">
        <h3>Update Password</h3>
        @include('profile.partials.update-password-form')
    </div>

    <div class="form-section">
        <h3>Delete User</h3>
        @include('profile.partials.delete-user-form')
    </div>
</div>

@include("layouts.footer")

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleButton = document.getElementById("toggle-institutions");
        const institutionsSection = document.getElementById("institutions-section");

        institutionsSection.style.display = "none";

        toggleButton.addEventListener("click", () => {
            const isVisible = institutionsSection.style.display === "block";
            institutionsSection.style.display = isVisible ? "none" : "block";
            toggleButton.innerHTML = isVisible 
                ? '<i class="fas fa-building"></i> Explore Institutions' 
                : '<i class="fas fa-times"></i> Hide Institutions';
        });
    });

    function searchInstitutions() {
        const searchInput = document.getElementById('institution-search').value.toLowerCase();
        const institutionElements = document.querySelectorAll('.institution');
        const suggestionsBox = document.getElementById('search-suggestions');
        
        suggestionsBox.innerHTML = '';
        
        institutionElements.forEach((institution) => {
            const institutionName = institution.querySelector('h3').textContent.toLowerCase();
            const institutionId = institution.getAttribute('data-id');
            
            if (institutionName.includes(searchInput) && searchInput.length > 0) {
                const suggestionItem = document.createElement('div');
                suggestionItem.classList.add('suggestion');
                suggestionItem.textContent = institution.querySelector('h3').textContent;
                suggestionsBox.appendChild(suggestionItem);

                suggestionItem.addEventListener('click', () => {
                    window.location.href = `{{route('applications.index', $institutionId)}}`;
                });
            }
        });

        if (searchInput === '') {
            suggestionsBox.style.display = 'none';
        } else {
            suggestionsBox.style.display = 'block';
        }
    }
</script>

</body>
</html>

<link rel="stylesheet" href="{{ asset('/css/adminbar.css') }}">
<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script>
    // jQuery to hide the success message after 5 seconds
$(document).ready(function() {
    if ($('.success-message').length) {
        setTimeout(function() {
            $('.success-message').fadeOut(500);  // Fade out effect
        }, 3000); // 3 seconds delay before it fades out
    }
});



</script>
<header>
    <div class="bar"></div>
    @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('admin.profile.edit') }}"><i class="fas fa-user"></i> Profile</a>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a>
        <a href="{{ route('institutions.index') }}"><i class="fas fa-university"></i> Institutions</a>
        <a href="{{ route('admin.courses.create') }}"><i class="fas fa-plus-circle"></i> Add Courses</a>
        <a href="{{ route('admin.faculties.create') }}"><i class="fas fa-chalkboard-teacher"></i> Add Faculties</a>
        
        <!-- Admissions Menu with Dropdown -->
        <div class="admissions-menu">
            <a href="#" class="admissions-link"><i class="fas fa-graduation-cap"></i> Admissions</a>
            <div class="dropdown">
                <select id="institution-select" name="institution_id" onchange="location = this.value;">
                    <option value="">Select an institution</option>
                    @foreach($institutions as $institution)
                        <option value="{{ route('admissions.index', ['institutionId' => $institution->id]) }}">{{ $institution->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <a href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt"></i> Log out</a>
    </div>

</header>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    
    <link rel="stylesheet" href="{{ asset('/css/stuheader.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style1.css') }}">  <!-- External CSS -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<header>
    <nav>
        <!-- Dropdown for View Admissions -->
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
<div class="main-con">
    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Welcome to Career Guidance</h1>
            <p>Explore institutions, manage your applications, and stay updated on the latest admissions.</p>
        </div>

        <!-- Search Bar for Institutions -->
        <div class="search-bar">
    <input type="text" id="institution-search" placeholder="Search prospectus for a specific institution  by institution name..." onkeyup="searchInstitutions()">
    <div id="search-suggestions" class="suggestions"></div>
</div>



        <!-- Button to toggle institutions -->
        <button id="toggle-institutions" class="toggle-button"><i class="fas fa-building"></i> Explore Institutions</button>

        <!-- Institutions Section -->
        <div class="institutions" id="institutions-section">
            <h2>Registered Higher Learning Institutions</h2>

            @foreach($institutions as $institution)
                <div class="institution">
                    <div class="institution-header" onclick="toggleInstitution({{ $institution->id }})">
                        <div class="institution-profile">
                            @if($institution->profile_photo)
                                <img src="{{ asset('storage/' . $institution->profile_photo) }}" alt="{{ $institution->name }} Profile Photo" class="institution-photo">
                            @else
                                <i class="fas fa-user institution-icon"></i>
                            @endif
                        </div>
                        <h3>{{ $institution->name }}</h3>
                        <p>{{ $institution->description }}</p>
                    </div>

                    <div id="institution-{{ $institution->id }}" class="institution-details">
                        <h4>Explore {{ $institution->name }}</h4>
                        <p>{{ $institution->details }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container2">
        <!-- Advertisement Section -->
        <div class="advertisement">
            <h3>Sponsored</h3>
            <p>Check out this amazing offer on educational resources!</p>
            <a href="https://example.com" target="_blank">Learn More</a>
        </div>

        <!-- Notifications Section -->
        <div class="notifications">
            <ul>
                @foreach ($institutions as $institution)
                    @foreach ($institution->qualifications as $qualification)
                        @if ($qualification) <!-- Check if admissions are open -->
                            <li>
                                <a href="{{ route('admissions.published', $institution->id) }}">
                                    <strong>{{ $institution->name }} </strong> is now accepting applications! 
                                    <span class="apply-now">Apply Now</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>

        <!-- Dynamic Admission Updates -->
        <div class="new-admissions">
            <h2>Latest Admissions</h2>
            @foreach($institutions as $institution)
                @foreach ($institution->admissions as $admission)
                    @if ($admission->published == 1)
                        <div class="admission">
                            <h4>{{ $institution->name }} - {{ $admission->program }}</h4>
                            <p>{{ $admission->description }}</p>
                            <a href="{{ route('admissions.view', $admission->id) }}">View Admission Details</a>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>

    <!-- Student's Application Status Section -->
    <div class="applications-status">
        <h2>Your Application Status</h2>

        @foreach($applications as $application)
            <div class="application-status">
                <h3>{{ $application->institution->name }} - {{ $application->course->name }}</h3>
                <p>Status: 
                    @if($application->status == 'accepted')
                        <span class="status-accepted">Accepted</span>
                    @elseif($application->status == 'rejected')
                        <span class="status-rejected">Rejected</span>
                    @else
                        <span class="status-pending">Pending</span>
                    @endif
                </p>
                <p>{{ $application->status == 'accepted' ? 'Congratulations on your acceptance!' : '' }}</p>
            </div>
        @endforeach
    </div>

    <!-- Scholarships Section: Lesotho Scholarships -->
    <div class="scholarships-section">
        <h2>Available Scholarships in Lesotho</h2>
        <ul>
            <li>
                <a href="https://www.gov.ls" target="_blank">
                    <strong>Lesotho Government Scholarship</strong>: Fully-funded scholarships for Basotho students to study locally or abroad.
                </a>
            </li>
            <li>
                <a href="https://www.ul.ac.ls" target="_blank">
                    <strong>University of Lesotho Scholarships</strong>: Various merit-based and need-based scholarships available for both undergraduate and postgraduate students.
                </a>
            </li>
            <li>
                <a href="https://www.acu.ac.uk" target="_blank">
                    <strong>Commonwealth Scholarships</strong>: Scholarships for Basotho students to pursue postgraduate degrees within the Commonwealth countries.
                </a>
            </li>
            <li>
                <a href="https://www.unesco.org/en/scholarships" target="_blank">
                    <strong>UNESCO Scholarships</strong>: Scholarships provided by UNESCO for various fields of study including education, sciences, and culture.
                </a>
            </li>
            <li>
                <a href="https://au.int/en/scholarships" target="_blank">
                    <strong>African Union Scholarships</strong>: Scholarships for African students, including those from Lesotho, for higher education and vocational training.
                </a>
            </li>
        </ul>
    </div>

    <!-- Live Chat Feature -->
    <div class="live-chat">
        <h2>Need Help? Chat with Us</h2>
        <button class="btn" onclick="startLiveChat()">Start Live Chat</button>
    </div>

    <!-- Filter Institutions by Location and Program -->
    <div class="institution-filters">
        <h3>Filter Institutions</h3>
        <form id="filter-form">
            <select name="location" id="location-filter">
                <option value="">Select Location</option>
                <option value="city">City</option>
                <option value="country">Country</option>
            </select>

            <select name="program" id="program-filter">
                <option value="">Select Program</option>
                <option value="engineering">Engineering</option>
                <option value="medicine">Medicine</option>
                <option value="arts">Arts</option>
            </select>

            <button type="submit" class="btn">Apply Filters</button>
        </form>
    </div>

    <!-- Notifications Center -->
    <div class="notifications-center">
        <h2>Latest Updates</h2>
        <ul>
            <li>New admissions open for top institutions!</li>
            <li>Scholarships are now available for engineering programs.</li>
            <li>Check out our new featured courses in medical sciences.</li>
        </ul>
    </div>
</div>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <p>&copy; 2024 Career Guidance. All rights reserved.</p>
        </div>
        <div class="footer-middle">
            <h3>Contact Us</h3>
            <ul>
                <li><i class="fas fa-envelope"></i> <strong>Email:</strong> <a href="mailto:kahlolotlanya11@gmail.com">kahlolotlanya11@gmail.com</a></li>
                <li><i class="fas fa-phone"></i> <strong>Phone:</strong> <a href="tel:+26657354839">+266 57354839</a></li>
                <li><i class="fab fa-whatsapp"></i> <strong>WhatsApp:</strong> <a href="https://wa.me/+26657354839" target="_blank">Chat on WhatsApp</a></li>
            </ul>
        </div>
        <div class="footer-right">
            <h3>Follow Us</h3>
            <ul>
                <li><i class="fab fa-facebook"></i> <a href="https://www.facebook.com/CareerGuidance" target="_blank">Facebook</a></li>
                <li><i class="fab fa-twitter"></i> <a href="https://twitter.com/CareerGuidance" target="_blank">Twitter</a></li>
                <li><i class="fab fa-instagram"></i> <a href="https://www.instagram.com/CareerGuidance" target="_blank">Instagram</a></li>
            </ul>
        </div>
    </div>
</footer>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleButton = document.getElementById("toggle-institutions");
        const institutionsSection = document.getElementById("institutions-section");

        // Initially hide the institutions section
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
    
    // Clear previous suggestions
    suggestionsBox.innerHTML = '';
    
    institutionElements.forEach((institution) => {
        const institutionName = institution.querySelector('h3').textContent.toLowerCase();
        const institutionId = institution.getAttribute('data-id'); // Assuming each institution div has a 'data-id' attribute
        
        // Show matching institutions
        if (institutionName.includes(searchInput) && searchInput.length > 0) {
            const suggestionItem = document.createElement('div');
            suggestionItem.classList.add('suggestion');
            suggestionItem.textContent = institution.querySelector('h3').textContent;
            suggestionsBox.appendChild(suggestionItem);

            // Redirect to the qualifications page when the suggestion is clicked
            suggestionItem.addEventListener('click', () => {
                window.location.href = `{{route('applications.index', $institutionId)}}`;  // Redirect to qualifications page
            });
        }
    });

    // Hide suggestions when the search input is cleared
    if (searchInput === '') {
        suggestionsBox.style.display = 'none';
    } else {
        suggestionsBox.style.display = 'block'; // Show suggestions when there is search input
    }
}


</script>

</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/css/student.css')}}">
    
    <link rel="stylesheet" href="{{asset('/css/style1.css')}}">
    <title>Laravel Career Guidance</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                @else
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Join Us Now</a>
                    <a href="{{route('student.about')}}"><i class="fas fa-info-circle"></i> About Us</a>
                    <a href="{{route('student.contact')}}"><i class="fas fa-envelope"></i> Contact Us</a>
                @endauth
            @endif
        </nav>
    </header>

    <main class="main-content">
        <section class="why-choose-us">
            <h2><i class="fas fa-check-circle"></i> Why Choose Us?</h2>
            <p>We offer personalized career guidance, expert advice, and a vast network of professionals in various fields. With our platform, you'll have the resources and support needed to achieve your career goals. Here's why you should choose us:</p>
            <ul>
                <li><strong><i class="fas fa-chalkboard-teacher"></i> Expert Guidance:</strong> Receive guidance from industry professionals and career coaches.</li>
                <li><strong><i class="fas fa-cogs"></i> Tailored Resources:</strong> Access resources tailored to your career goals and learning style.</li>
                <li><strong><i class="fas fa-users"></i> Networking Opportunities:</strong> Connect with experts, peers, and mentors in your field.</li>
                <li><strong><i class="fas fa-book"></i> Career-Focused Courses:</strong> Take courses designed to develop skills that employers are looking for.</li>
            </ul>
        </section>

        <section class="carousel">
            <div class="carousel-container">
                <!-- Carousel Items (same as before) -->
                <div class="carousel-item active">
                    <img src="{{ asset('images/business.jpg') }}" alt="Business">
                    <div class="image-content">
                        <h3 class="image-title"><i class="fas fa-briefcase"></i> Business</h3>
                        <p class="image-description">Become a leader in the business world. Explore courses and resources that can guide you towards starting your own enterprise or climbing the corporate ladder!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/doctor.jpg') }}" alt="Doctor">
                    <div class="image-content">
                        <h3 class="image-title"><i class="fas fa-user-md"></i> Doctor</h3>
                        <p class="image-description">Embark on a rewarding journey to become a doctor. Learn about the medical field, training programs, and the impact you can have on people's lives.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/tourism.jpg') }}" alt="Tourism">
                    <div class="image-content">
                        <h3 class="image-title"><i class="fas fa-suitcase-rolling"></i> Tourism</h3>
                        <p class="image-description">Pursue a career in tourism and hospitality. Discover opportunities to travel and engage with diverse cultures while building a fulfilling career.</p>
                    </div>
                </div>
                
                <!-- Non-Active Image 4 -->
                <div class="carousel-item">
                    <img src="{{ asset('images/design.jpg') }}" alt="Design">
                    <div class="image-content">
                        <h3 class="image-title"><i class="fas fa-paint-brush"></i> Design</h3>
                        <p class="image-description">Unleash your creativity in the field of design. Learn how to create visually stunning and impactful designs that captivate audiences.</p>
                    </div>
                </div>

                <!-- Non-Active Image 5 -->
                <div class="carousel-item">
                    <img src="{{ asset('images/engineer.jpg') }}" alt="Engineer">
                    <div class="image-content">
                        <h3 class="image-title"><i class="fas fa-cogs"></i> Engineer</h3>
                        <p class="image-description">Join the ranks of innovators as an engineer. Explore various engineering disciplines and how you can contribute to solving real-world problems.</p>
                    </div>
                </div>

                <!-- Non-Active Image 6 -->
                <div class="carousel-item">
                    <img src="{{ asset('images/software-eg.jpg') }}" alt="Software Development">
                    <div class="image-content">
                        <h3 class="image-title"><i class="fas fa-laptop-code"></i> Software Development</h3>
                        <p class="image-description">Dive into the world of technology as a software developer. Learn coding skills and how to create software that changes the way we live and work.</p>
                    </div>
                </div>

                <!-- More carousel items as before -->
            </div>
        </section>

        <!-- Join Us Now Section -->
        <section class="join-us-now">
            <h2><i class="fas fa-arrow-right"></i> Ready to Take the Next Step?</h2>
            <p>Join our platform today to get the guidance, resources, and support you need to succeed in your chosen career path. Don't wait any longer — start your journey with us now!</p>
            <div class="btn-join-us"><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Join Us Now</a></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Career Guidance Application | All Rights Reserved</p>
    </footer>

    <script>
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');

        function showNextItem() {
            items[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % items.length;
            items[currentIndex].classList.add('active');
        }

        setInterval(showNextItem, 3000); // Change item every 3 seconds
    </script>
</body>
</html>

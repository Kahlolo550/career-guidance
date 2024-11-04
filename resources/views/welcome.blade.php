<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Career Guidance</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .background {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            filter: blur(8px);
            z-index: 1;
        }

        header {
            background-color: transparent; /* No background color */
            padding: 1rem;
            color: white;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        header a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 500;
            transition: color 0.3s;
        }

        header a:hover {
            color: #FF2D20; /* Change color on hover */
        }

        .main-content {
            text-align: center;
            position: relative;
            z-index: 2;
            overflow: hidden;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-item {
            display: none;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            text-align: center;
        }

        .carousel-item.active {
            display: block;
            opacity: 1;
        }

        .image-box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 300px;
            transition: transform 0.3s;
        }

        .image-box img {
            width: 100%;
            height: auto;
            border-bottom: 2px solid #FF2D20;
            border-radius: 8px 8px 0 0;
        }

        .image-title {
            font-size: 1.2em;
            margin: 10px 0 5px;
            color: #333;
        }

        .image-description {
            font-size: 0.9em;
            color: #666;
            padding: 0 10px 10px;
            text-align: justify;
        }

        .link-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            color: white;
            background-color: #FF2D20;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .link-button:hover {
            background-color: #c72a17;
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <header>
        <h1>Welcome to Our Career Guidance Application</h1>
        <div>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2">Login</a>
                        <a href="{{ route('register') }}" class="rounded-md px-3 py-2">Register</a>
                        <a href="{{ route('admin.login') }}" class="rounded-md px-3 py-2">Admin Login</a>
                        <a href="{{ route('admin.register') }}" class="rounded-md px-3 py-2">Admin Register</a>
                        <a href="{{ route('institution.register') }}" class="rounded-md px-3 py-2">Institution Register</a>
                        <a href="{{ route('institution.login') }}" class="rounded-md px-3 py-2">Institution Login</a>
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <main class="main-content">
        <div class="carousel-item active">
            <div class="image-box">
                <img src="{{ asset('images/business.jpg') }}" alt="Business">
                <h3 class="image-title">Business</h3>
                <p class="image-description">Become a leader in the business world. Explore courses and resources that can guide you towards starting your own enterprise or climbing the corporate ladder!</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-box">
                <img src="{{ asset('images/doctor.jpg') }}" alt="Doctor">
                <h3 class="image-title">Doctor</h3>
                <p class="image-description">Embark on a rewarding journey to become a doctor. Learn about the medical field, training programs, and the impact you can have on people's lives.</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-box">
                <img src="{{ asset('images/tourism.jpg') }}" alt="Tourism">
                <h3 class="image-title">Tourism</h3>
                <p class="image-description">Pursue a career in tourism and hospitality. Discover opportunities to travel and engage with diverse cultures while building a fulfilling career.</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-box">
                <img src="{{ asset('images/design.jpg') }}" alt="Design">
                <h3 class="image-title">Design</h3>
                <p class="image-description">Unleash your creativity in the field of design. Learn how to create visually stunning and impactful designs that captivate audiences.</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-box">
                <img src="{{ asset('images/engineer.jpg') }}" alt="Engineer">
                <h3 class="image-title">Engineer</h3>
                <p class="image-description">Join the ranks of innovators as an engineer. Explore various engineering disciplines and how you can contribute to solving real-world problems.</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-box">
                <img src="{{ asset('images/software-eg.jpg') }}" alt="Software">
                <h3 class="image-title">Software Development</h3>
                <p class="image-description">Dive into the world of technology as a software developer. Learn coding skills and how to create software that changes the way we live and work.</p>
            </div>
        </div>
    </main>

    <script>
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');

        function showNextItem() {
            items[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % items.length;
            items[currentIndex].classList.add('active');
        }

        setInterval(showNextItem, 3000); // Increased speed: 3 seconds for each item
    </script>
</body>
</html>

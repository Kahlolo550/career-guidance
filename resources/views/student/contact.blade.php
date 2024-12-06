<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Guidance - Contact Us</title>
    <link rel="stylesheet" href="{{asset('/css/stuheader.css')}}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
    <h1>Contact Us</h1>
        <nav>
            @if (Route::has('login'))
            @auth
                   
            <a href="{{route('dashboard')}}"><i class="fas fa-home"></i>Home </a>
            @else
            <a href="{{url('/')}}"><i class="fas fa-home"></i>Home</a>
            @endauth
            
            @endif
           
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Join Us Now</a>
                    <a href="{{ route('student.about') }}"><i class="fas fa-info-circle"></i> About Us</a>
                    
                    
             
        </nav>
    </header>

    <main>
    <img class="background-image" src="{{asset('/images/contact.jpg')}}">
        <section class="contact-us">
           
            <p>We'd love to hear from you! Reach out to us and we'll get back to you as soon as possible.</p>

            <div class="contact-form">
                <form action="/submit-contact" method="POST">
                    @csrf
                    <label for="name"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message"><i class="fas fa-comment"></i> Your Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit"><i class="fas fa-paper-plane"></i> Submit</button>
                </form>
            </div>

            <div class="contact-details">
                <h2>Our Contact Information</h2>
                <ul>
                    <li><i class="fas fa-phone-alt"></i> Phone: (266) 5735-4839</li>
                    <li><i class="fas fa-map-marker-alt"></i> Address: 123 Main Street, Maseru, Lesoth0</li>
                    <li><i class="fas fa-clock"></i> Business Hours: Mon - Fri, 9:00 AM - 6:00 PM</li>
                </ul>
            </div>

            <div class="social-media">
                <h2>Follow Us</h2>
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            </div>

            <div class="map">
                <h2>Our Location</h2>
                <!-- Google Maps Embed -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24356.234561235!2d-0.1278!3d51.5074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b9d1c585ea3%3A0x423123b4d23d5b1a!2sLondon!5e0!3m2!1sen!2suk!4v1632919912025" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </main>
    
</body>
</html>

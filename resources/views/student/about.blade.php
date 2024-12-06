<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/about.css')}}">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>About Us</title>
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav>
            <a href="/"><i class="fas fa-home"></i> Home</a>
            <a href="/login"><i class="fas fa-sign-in-alt"></i> Login</a>
            <a href="/register"><i class="fas fa-user-plus"></i> Join Us Now</a>
            <a href="/about"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="/contact"><i class="fas fa-phone-alt"></i> Contact Us</a>
        </nav>
    </header>

    <!-- Main Content Section -->
    <main>
        <div class="background">
            <img class="background-image" src="{{asset('/images/about.jpg')}}">
            <!-- Introduction Section -->
            <section id="intro">
                <h1>Welcome to Our About Us Page</h1>
                <p>We are a dedicated team focused on providing excellent educational resources and support for students. Our platform aims to guide students in their academic and career journeys by offering valuable tools, guidance, and a strong community.</p>
            </section>

            <!-- Company History Section -->
            <section id="history">
                <h2><i class="fas fa-history"></i> Our Story</h2>
                <p>Our journey began in 2015 when a group of passionate educators and tech enthusiasts came together with a single vision: to create a platform that empowers students to make informed decisions about their education and future career paths.</p>
                <p>Over the years, we have evolved from a small start-up into a leading platform serving thousands of students. Today, we continue to innovate and expand our services, ensuring that students receive the support they need at every stage of their academic journey.</p>
            </section>

            <!-- Our Mission Section -->
            <section id="mission">
                <h2><i class="fas fa-bullseye"></i> Our Mission</h2>
                <p>Our mission is to bridge the gap between students and their academic potential by providing an intuitive, supportive environment. We aim to empower students to achieve their goals, whether it be entering higher education or pursuing a specific career path.</p>
                <p>We strive to create a world where every student has access to the resources they need to succeed, and where learning is both an opportunity and a journey of personal growth.</p>
            </section>

            <!-- Core Values Section -->
            <section id="values">
                <h2><i class="fas fa-handshake"></i> Our Core Values</h2>
                <ul>
                    <li><strong>Empowerment:</strong> We believe in giving students the tools and knowledge they need to take control of their educational journey.</li>
                    <li><strong>Integrity:</strong> We operate with transparency and honesty, building trust with every interaction.</li>
                    <li><strong>Innovation:</strong> We continuously seek innovative solutions that enhance learning and provide students with the best experiences.</li>
                    <li><strong>Support:</strong> We offer continuous support to students, ensuring they have guidance when they need it most.</li>
                    <li><strong>Community:</strong> We believe in creating a supportive, inclusive community where students, educators, and partners can collaborate and grow together.</li>
                </ul>
            </section>

            <!-- Our Services Section -->
            <section id="services">
                <h2><i class="fas fa-cogs"></i> Our Services</h2>
                <p>We offer a range of services designed to support students throughout their educational journey. Our services include:</p>
                <ul>
                    <li><i class="fas fa-graduation-cap"></i> <strong>Admissions Guidance:</strong> We provide expert advice and support to help students navigate the admissions process at various institutions.</li>
                    <li><i class="fas fa-book-reader"></i> <strong>Course Recommendations:</strong> Using a combination of data and expert insights, we recommend courses that match students' interests and qualifications.</li>
                    <li><i class="fas fa-briefcase"></i> <strong>Career Counseling:</strong> Our team of career counselors helps students explore career paths, prepare for job interviews, and build resumes.</li>
                    <li><i class="fas fa-laptop-code"></i> <strong>Online Learning Resources:</strong> We offer access to a variety of online learning materials, workshops, and tutorials to help students improve their skills.</li>
                    <li><i class="fas fa-piggy-bank"></i> <strong>Scholarship Opportunities:</strong> We assist students in finding and applying for scholarships to make education more accessible.</li>
                </ul>
            </section>

            <!-- Our Team Section -->
            <section id="team">
                <h2><i class="fas fa-users"></i> Meet Our Team</h2>
                <div class="team-members">
                    <div class="team-member">
                        <img src="https://via.placeholder.com/150" alt="Team Member 1">
                        <h3><i class="fas fa-user"></i> Makara Tau</h3>
                        <p>Founder & CEO</p>
                        <p>Makara is passionate about education and technology, leading the team with a vision to create a platform that makes a difference in students' lives. With over 15 years of experience in the education sector, he is dedicated to providing high-quality, accessible resources for students everywhere.</p>
                    </div>
                    <div class="team-member">
                        <img src="https://via.placeholder.com/150" alt="Team Member 2">
                        <h3><i class="fas fa-user"></i> Makara Khotso</h3>
                        <p>Lead Developer</p>
                        <p>Makara is the technical brain behind our platform, ensuring everything runs smoothly and efficiently while implementing new features. Her passion for coding and problem-solving has helped shape the platform into what it is today.</p>
                    </div>
                    <div class="team-member">
                        <img src="https://via.placeholder.com/150" alt="Team Member 3">
                        <h3><i class="fas fa-user"></i> Kahlolo Tlanya</h3>
                        <p>Head of Operations</p>
                        <p>Kahlolo manages the daily operations, ensuring our platform runs seamlessly and students receive the best service possible. She works closely with the team to improve workflows and deliver a top-notch experience for all users.</p>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact">
                <h2><i class="fas fa-envelope"></i> Get in Touch</h2>
                <p>If you have any questions or want to know more about our platform, feel free to reach out to us:</p>
                <ul>
                    <li><i class="fas fa-at"></i> <strong>Email:</strong> contact@ourplatform.com</li>
                    <li><i class="fas fa-phone-alt"></i> <strong>Phone:</strong> +123 456 7890</li>
                    <li><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> 123 Education St, Learning City</li>
                </ul>
            </section>
        </div>
    </main>

    <!-- Footer Section -->
   
@include('layouts.footer')
</body>
</html>

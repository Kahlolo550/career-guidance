<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Include Font Awesome -->
</head>
<body>
    <header>
        <nav>
            @if (Route::has('login'))
                @auth
                   
                    <a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                @else
                     <a href="{{url('/')}}"><i class="fas fa-home" ></i> Home</a>
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Join Us Now</a>
                    <a href="{{ route('student.about') }}"><i class="fas fa-info-circle"></i> About Us</a>
                    <a href="{{ route('student.contact') }}"><i class="fas fa-envelope"></i> Contact Us</a>
                @endauth
            @endif
        </nav>
    </header>

    <main>
        <div class="form-container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h2><i class="fas fa-user-plus"></i> Create Your Account</h2>

                <label for="name"><i class="fas fa-user"></i> Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                
                <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" required>
                
                <label for="password_confirmation"><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                
                <button type="submit"><i class="fas fa-check"></i> Register</button>

                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Already have an account? Login</a>

                @if ($errors->any())
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Career Guidance Application | All Rights Reserved</p>
    </footer>
</body>
</html>

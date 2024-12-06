<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Guidance - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="{{asset('/css/student.css')}}">
</head>
<body>
    <header>
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                @else
                   <a href="{{url('/')}}"><i class="fas fa-home"></i>Home </a>
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Join Us Now</a>
                    <a href="{{route('student.about')}}"><i class="fas fa-info-circle"></i> About Us</a>
                    <a href="{{route('student.contact')}}"><i class="fas fa-phone-alt"></i> Contact Us</a>
                @endauth
            @endif
        </nav>
    </header>

    <main>
        <div class="login-container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2>Login to Your Account</h2>
                
                <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif

                <a href="{{ route('register') }}">Don't have an account? Join Us Now</a>

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

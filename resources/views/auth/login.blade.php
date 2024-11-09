<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #444;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            transition: border-color 0.3s, box-shadow 0.3s;
            box-sizing: border-box;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
        }

        .input-error {
            color: #d9534f; /* Bootstrap danger color */
            font-size: 14px;
            margin-top: 5px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .checkbox-container input {
            margin-right: 10px;
        }

        .checkbox-container span {
            font-size: 14px;
            color: #333;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .forgot-password {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #0056b3;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            width: 100%;
            margin-top: 10px;
            font-size: 16px; /* Larger button text */
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(1px);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 20px;  }

            .login-container h2 {
                font-size: 24px; 
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <div class="status-message"> </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" required autofocus autocomplete="username" />
                <div class="input-error">  </div>
            </div>
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
                <div class="input-error">  </div>
            </div>
            <div class="checkbox-container">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </div>
            <div class="form-footer">
                <a class="forgot-password" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
            <button type="submit">
                {{ __('Log in') }}
            </button>
        </form>
    </div>
</body>
</html>

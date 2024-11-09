<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .text-sm {
            font-size: 14px;
            line-height: 1.5;
            color: #6b7280;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            margin-bottom: 12px;
            transition: border-color 0.3s;
        }

        .input-field:focus {
            border-color: #007bff;
            outline: none;
        }

        .input-error {
            color: #f44336;
            font-size: 12px;
            margin-top: 6px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .back-btn {
            text-align: center;
            margin-top: 20px;
        }

        .back-btn a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .back-btn a:hover {
            text-decoration: underline;
        }

        .session-status {
            margin-bottom: 20px;
            font-size: 14px;
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ __('Forgot your password?') }}</h1>

        <div class="text-sm text-gray-600">
            {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="input-label">{{ __('Email') }}</label>
                <input id="email" class="input-field" type="email" name="email" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                {{ __('Email Password Reset Link') }}
            </button>
        </form>

        <div class="back-btn">
            <a href="{{ route('login') }}">{{ __('Back to Login') }}</a>
        </div>
    </div>
</body>
</html>

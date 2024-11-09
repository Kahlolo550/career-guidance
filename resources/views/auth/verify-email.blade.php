<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .text-sm {
            font-size: 14px;
            line-height: 1.5;
            color: #6b7280;
        }
        .text-gray-600 {
            color: #4b5563;
        }
        .text-green-600 {
            color: #16a34a;
        }
        .mt-4 {
            margin-top: 20px;
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-logout {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            margin-top: 10px;
            text-decoration: none;
        }
        .btn-logout:hover {
            background-color: #d32f2f;
        }
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .underline {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Verification</h1>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('institution.logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</body>
</html>

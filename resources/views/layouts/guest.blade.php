<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Internal CSS Styling -->
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc; /* Light background color */
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
            transition: background-color 0.3s ease;
        }

        /* Main container */
        .container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            background-color: #ffffff; /* White background for the form */
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Softer shadow */
            text-align: center;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: translateY(-3px);
        }

        /* Logo styling */
        .logo a {
            font-size: 2.5rem; /* Increased font size for prominence */
            font-weight: 700; /* Bold weight for the logo */
            color: #1d4ed8; /* Primary color */
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }
        .logo a:hover {
            color: #2563eb; /* Darker shade on hover */
        }

        /* Content styling */
        .content {
            margin-top: 1rem;
            font-size: 1rem;
            color: #4b5563;
            line-height: 1.6;
        }

        /* Button styles */
        .button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            margin-top: 1.5rem;
            font-size: 1rem;
            color: #ffffff;
            background-color: #3b82f6; /* Primary button color */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .button:hover {
            background-color: #2563eb; /* Darker shade on hover */
            transform: translateY(-2px); /* Lift effect on hover */
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .container {
                padding: 1.5rem; /* Less padding on smaller screens */
            }
            .logo a {
                font-size: 2rem; /* Smaller logo size */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo">
            <a href="/">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <!-- Main Content -->
        <div class="content">
            {{ $slot }}
        </div>

        <!-- Example Button (optional) -->
        <a href="{{ url('register') }}" class="button">Get Started</a>
    </div>
</body>
</html>

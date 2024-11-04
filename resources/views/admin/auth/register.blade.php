<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF8zX2p5vnXJ6Fw5f5zZ1IQybdhG1Fz/bxZoR" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-size: 1.8rem;
            color: #1f2937;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .block {
            display: block;
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 0.75rem;
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .w-full {
            width: 100%;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .underline {
            text-decoration: underline;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .hover\:text-gray-900:hover {
            color: #1f2937;
        }

        .ms-4 {
            margin-left: 1rem;
        }

        .rounded-md {
            border-radius: 5px;
        }

        .focus\:outline-none:focus {
            outline: none;
        }

        .focus\:ring-2:focus {
            box-shadow: 0 0 0 2px #4f46e5;
        }

        .focus\:ring-indigo-500:focus {
            border-color: #4f46e5;
        }

        .dark\:hover\:text-gray-100:hover {
            color: #f9fafb;
        }

        .x-primary-button {
            background-color: #4f46e5;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .x-primary-button:hover {
            background-color: #6366f1;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <h1>Admin Register</h1>
        <div>
            <label for="name">Name</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name">
        </div>
        <div class="mt-4">
            <label for="email">Email</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username">
        </div>
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password">
        </div>
        <div class="mt-4">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" href="{{ route('admin.login') }}">
                Already registered?
            </a>
            <button type="submit" class="x-primary-button ms-4">
                Register
            </button>
        </div>
    </form>
</body>
</html>

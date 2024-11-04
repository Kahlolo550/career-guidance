<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Registration</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #ff3d3d; /* Red background */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }

        /* Main container */
        .container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background-color: #ffffff; /* White background for the form */
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Heading */
        h1 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        /* Input styles */
        .input-group {
            margin-bottom: 1.5rem;
            text-align: left; /* Align labels to the left */
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Button styles */
        .primary-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            margin-top: 1rem;
            font-size: 1rem;
            color: #ffffff;
            background-color: #28a745; /* Green button */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .primary-button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Link styles */
        .link {
            display: inline-block;
            margin-top: 1rem;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .link:hover {
            color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('institution.register') }}">
            @csrf
            <h1>Institution Registration</h1>

            <!-- Name -->
            <div class="input-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="link" href="{{ route('login') }}">
                    Already registered?
                </a>

                <button type="submit" class="primary-button">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Navbar styling without container */
        .navbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .navbar a, .navbar span, .navbar button {
            margin-left: 1rem;
            font-size: 1rem;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar a:hover, .navbar button:hover {
            color: #1f2937;
        }

        /* Username styling */
        .username {
            font-size: 1.1rem;
            font-weight: bold;
            color: #1f2937;
        }

        /* Button reset */
        .navbar button {
            background: none;
            border: none;
            cursor: pointer;
            font: inherit;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <!-- User Name -->
    <span class="username">{{ Auth::user()->name }}</span>

    <!-- Profile Link -->
    <a href="{{ route('profile.edit') }}">Profile</a>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</nav>

</body>
</html>

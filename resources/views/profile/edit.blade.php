<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9fb;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #1f2937;
            padding: 1rem;
            text-align: center;
            color: #ffffff;
            font-size: 2rem;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #1f2937;
        }

        .button {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .button:hover {
            background-color: #1e3a8a;
        }

        .back-button {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 10;
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            color: #2563eb;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #f3f4f6;
            transform: scale(1.05);
        }

        .form-section {
            margin-top: 1.5rem;
            padding: 1.5rem;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background-color: #f4f6f9;
        }

        .form-section h3 {
            font-size: 1.5rem;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            margin-bottom: 1rem;
            font-size: 1rem;
            color: #333;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #2563eb;
            outline: none;
        }

        .submit-button {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 0.8rem 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #1e3a8a;
        }
    </style>
</head>
<body>

<a href="javascript:void(0);" class="back-button" onclick="history.back();">Back</a>

<div class="container">
    <header>
        <h2>Edit Profile</h2>
    </header>

    <div class="form-section">
        <h3>Update Profile Information</h3>
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="form-section">
        <h3>Update Password</h3>
        @include('profile.partials.update-password-form')
    </div>

    <div class="form-section">
        <h3>Delete User</h3>
        @include('profile.partials.delete-user-form')
    </div>
</div>

</body>
</html>

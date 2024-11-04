<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            background-color: #fff5f0; /* Light orange background */
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
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #c74a00; /* Dark orange for the header */
            text-align: center;
            margin-bottom: 20px;
        }

        .x-input-label {
            color: #c74a00; /* Dark orange for labels */
            font-weight: bold;
        }

        .x-text-input {
            border: 1px solid #f6b493; /* Light orange border */
            padding: 10px;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .x-text-input:focus {
            border-color: #ff7f50; /* Coral color for focus */
            box-shadow: 0 0 5px rgba(255, 127, 80, 0.5);
            outline: none;
        }

        .x-input-error {
            color: #d9534f; /* Bootstrap danger color */
            font-size: 14px;
            margin-top: 5px;
        }

        .remember-me-label {
            color: #333; /* Darker gray for text */
        }

        .underline {
            color: #ff7f50; /* Coral color for the link */
            transition: color 0.3s;
        }

        .underline:hover {
            color: #c74a00; /* Dark orange on hover */
        }

        .x-primary-button {
            background-color: #ff4500; /* OrangeRed for the button */
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        .x-primary-button:hover {
            background-color: #ff6347; /* Tomato on hover */
            transform: translateY(-2px);
        }

        .x-primary-button:active {
            transform: translateY(1px);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 20px; /* Adjust padding for smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin</h1>
        <!-- Session Status -->
        <div class="mb-4">
            <!-- Placeholder for session status messages -->
            <?php if (session('status')): ?>
                <div class="text-green-600 mb-4">
                    <?= session('status'); ?>
                </div>
            <?php endif; ?>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <label for="email" class="x-input-label">{{ __('Email') }}</label>
                <input id="email" class="x-text-input block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <div class="x-input-error">
                    <!-- Placeholder for email error messages -->
                    <?= $errors->has('email') ? $errors->first('email') : ''; ?>
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="x-input-label">{{ __('Password') }}</label>
                <input id="password" class="x-text-input block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <div class="x-input-error">
                    <!-- Placeholder for password error messages -->
                    <?= $errors->has('password') ? $errors->first('password') : ''; ?>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center remember-me-label">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <?php if (Route::has('password.request')): ?>
                    <a class="underline text-sm hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                <?php endif; ?>

                <button type="submit" class="x-primary-button ms-3">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>

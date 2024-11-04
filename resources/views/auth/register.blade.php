<!-- Styles for the Registration Form -->
<style>
    body {
        background-color: #f7f8fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .register-container {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 450px;
        width: 100%;
    }
    .register-container h2 {
        margin-bottom: 20px;
        font-size: 26px;
        color: #333;
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
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
        transition: border-color 0.3s;
        box-sizing: border-box;
        font-size: 14px;
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
    }
    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
    .login-link {
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s;
    }
    .login-link:hover {
        color: #0056b3;
    }
    button {
        background-color: #007bff;
        color: #ffffff;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        width: 100%;
        margin-top: 20px;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>

<!-- Registration Form -->
<div class="register-container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="form-footer">
            <a class="login-link" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        </div>

        <button type="submit">{{ __('Register') }}</button>
    </form>
</div>

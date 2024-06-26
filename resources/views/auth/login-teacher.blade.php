<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .login-form {
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .login-form .title {
            border-radius: 5px;
            padding: 15px 10px;
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            color: black;
            background-color: #ffffff;
        }

        .login-form .content {
            padding: 15px;
            background-color: #ffffff;
        }
        .btn-navy{
            border-radius: 5px;
            background-color: #00598F;
            font-weight: bold;
            width: 240px;
            height: 36px;
            -ms-transform: translateX(-50%);
            transform: translateX(25%);
        }

        .forgot-pass{
            -ms-transform: translateX(-50%);
            transform: translateX(28%);
            text-decoration: none; 
            color: #00598F;
        }
    </style>
</head>
<body>
<img src="assets-image\crop800-500_School_Building1.jpg" style="width:1519px; height:725px" alt="bg-ccs">

    <div class="login-form">
        <div class="title">
        <img src="assets-image\ccs-logo.jpg" style="width:130px; height:75px" alt="logo-ccs">
            <br>
            Teacher's Portal
        </div>

        <div class="content">

            <!-- <?=isset($msg) ? '<div class="alert alert-danger">'.$msg.'</div>' : ''?> -->

            

            <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class='mb-4'>
            <label class='form-label'>Email</label>
            <input class='form-control'id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class='form-label'>Password</label>

            <input class='form-control' id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="btn-navy">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

        </div>
    </div>
    
</body>
</html>
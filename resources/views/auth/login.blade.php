<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Improved Design">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/icon/Harapan.png')}}">

    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #008080, #70a0a0);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-content {
            width: 50%;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            background: white;
            display: flex;
            overflow: hidden;
            max-width: 900px;
            min-width: 320px;
        }

        .company__info {
            background-color: #008080;
            color: #fff;
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo {
            width: 120px;
        }

        .company__logo {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .company_title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .login_form {
            flex: 2;
            padding: 30px;
        }

        .login_form h2 {
            color: #008080;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form__input {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 12px 7px;
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        .form__input:focus {
            border-color: #008080;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 128, 128, 0.2);
        }

        .btn {
            background: #008080;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #006666;
        }

        .row label {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .row:last-of-type {
            text-align: center;
        }

        .row:last-of-type a {
            color: #008080;
            text-decoration: none;
            font-weight: bold;
        }

        .row:last-of-type a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 768px) {
            .main-content {
                flex-direction: column;
                width: 90%;
            }

            .company__info {
                padding: 15px;
                text-align: center;
            }

            .login_form {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Company Info Section -->
        <div class="company__info">
            <div class="company__logo">
                <span class="fa fa-android"><img class="logo" src="{{asset('assets/images/icon/Harapan.png')}}" alt=""></span>
            </div>
            <h4 class="company_title">Klinik Harapan Jaya</h4>
        </div>
        <!-- Login Form Section -->
        <div class="login_form">
            <h2>Log In</h2>

            <form class="form-group" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <input type="text" name="email" id="email" class="form__input" placeholder="Username">
                </div>
                <div class="row">
                    <input type="password" name="password" id="password" class="form__input" placeholder="Password">
                    @error('password')
                    <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror


                </div>
                <div class="row">
                    <label>
                        <input type="checkbox" name="remember_me" id="remember_me">
                        Remember Me!
                    </label>
                </div>
                <div class="row">
                    <input type="submit" value="Submit" class="btn">
                </div>
            </form>
            <div class="row">
                <p>Don't have an account? <a href="#">Contact Admin</a></p>
            </div>
        </div>
    </div>
</body>

</html>
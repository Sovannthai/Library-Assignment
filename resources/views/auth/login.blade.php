<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1027%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='%230e2a47'%3e%3c/rect%3e%3cpath d='M173 304L172 -56' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M910 328L909 634' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1283 210L1282 522' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1197 18L1196 -347' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M854 535L853 678' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1023 472L1022 244' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M728 516L727 731' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M701 80L700 309' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M869 91L868 254' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M255 501L254 816' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M568 290L567 61' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M244 463L243 739' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M416 311L415 598' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M531 248L530 -4' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M407 311L406 537' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M657 92L656 -169' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M417 222L416 371' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M465 431L464 576' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M920 542L919 686' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M586 466L585 850' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1338 47L1337 -256' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M662 519L661 366' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M888 262L887 -73' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M724 428L723 830' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M178 15L177 411' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M261 114L260 -264' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M41 505L40 253' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M666 379L665 148' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M362 402L361 745' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1033 538L1032 839' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M944 391L943 70' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1090 442L1089 87' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M349 521L348 368' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1028%26quot%3b)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M512 7L511 307' stroke-width='10' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M325 186L324 -142' stroke-width='6' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1272 36L1271 241' stroke-width='8' stroke='url(%26quot%3b%23SvgjsLinearGradient1029%26quot%3b)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1027'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3clinearGradient x1='0%25' y1='100%25' x2='0%25' y2='0%25' id='SvgjsLinearGradient1028'%3e%3cstop stop-color='rgba(28%2c 83%2c 142%2c 0)' offset='0'%3e%3c/stop%3e%3cstop stop-color='%231c538e' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3clinearGradient x1='0%25' y1='0%25' x2='0%25' y2='100%25' id='SvgjsLinearGradient1029'%3e%3cstop stop-color='rgba(28%2c 83%2c 142%2c 0)' offset='0'%3e%3c/stop%3e%3cstop stop-color='%231c538e' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e");
            background-position: center;
            background-size: cover;
            padding: 0 10px;
        }

        .wrapper {
            width: 90%;
            max-width: 400px;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.763);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background: rgba(57, 54, 54, 0.15);
            margin: auto;
            transition: 0.5s;
        }

        .wrapper:hover {
            transform: 5s;
            transform: translateY(-15px);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .input-field {
            position: relative;
            margin: 15px 0;
        }

        .input-field input {
            width: 100%;
            height: 40px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
            color: #fff;
            border-bottom: 2px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .input-field input:focus {
            border-bottom-color: #fff;
        }

        .input-field label {
            position: absolute;
            top: 10px;
            left: 0;
            color: #fff;
            font-size: 16px;
            pointer-events: none;
            transition: 0.15s ease;
        }

        .input-field input:focus~label,
        .input-field input:valid~label {
            top: -10px;
            font-size: 12px;
        }

        .forget {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 25px 0 35px 0;
            color: #fff;
        }

        .forget a {
            color: #fff;
            text-decoration: none;
        }

        .forget a:hover {
            text-decoration: underline;
        }

        button {
            background: #fff;
            color: #000;
            font-weight: 600;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
            border: 2px solid transparent;
            transition: 0.3s ease;
            margin-top: 15px;
        }

        button:hover {
            color: #fff;
            border-color: #fff;
            background: rgba(255, 255, 255, 0.15);
        }

        .register {
            text-align: center;
            margin-top: 30px;
            color: #fff;
        }

        .register a {
            color: #fff;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <div class="row">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Login</h2>
                <div class="input-field">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                    <label for="email">Enter your email</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong style="color: rgb(255, 98, 98);">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-field">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                    <label for="password">Enter your password</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong style="color: rgb(255, 98, 98);">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="forget">
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                    {{-- <a href="#">Forgot password?</a> --}}
                </div>
                <button type="submit">Log In</button>
                <div class="register">
                    {{-- <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p> --}}
                </div>
            </form>
        </div>
    </div>

</body>

</html>

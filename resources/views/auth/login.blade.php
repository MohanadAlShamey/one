<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>One2One | LogIn</title>


    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">
    <style>
        /* cairo-regular - latin */
        @font-face {
            font-family: 'ciro';
            font-style: normal;
            font-weight: 400;
            src: url('{{asset('fonts/cairo/Cairo-Regular.ttf')}}'), /* IE9 Compat Modes */ /* src: local('Cairo Regular'), local('Cairo-Regular'),*/ url('{{asset('fonts/cairo/cairo-v8-latin-regular.eot?#iefix')}}') format('embedded-opentype'), /* IE6-IE8 */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff2')}}') format('woff2'), /* Super Modern Browsers */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.woff')}}') format('woff'), /* Modern Browsers */ url('{{asset('fontsfonts/cairo/cairo-v8-latin-regular.ttf')}}') format('truetype'), /* Safari, Android, iOS */ url('{{asset('fonts/cairo/cairo-v8-latin-regular.svg#Cairo')}}') format('svg'); /* Legacy iOS */
        }

        * {
            font-family: 'ciro', 'sans-serif';
        }
    </style>
</head>
<body  style="background-position: center; background-size: cover;background-image: url('{{asset('public/img/bg.jpg')}}')">

<div class="container" >
    <div class="row justify-content-center my-5">
        <div class="col-md-6 my-5 py-5 text-center" >
            <h4 class="text-center p-2" style="display: inline-block;border-bottom: 1px solid orange; ">تسجيل الدخول</h4>
            <div class="card my-5">

                <div class="card-body">
                    <form method="POST"  action="{{ route('login') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email" class="text-md-right ">البريد الإلكتروني</label>
                                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror




                        </div>

                        <div class="form-group ">
                            <label for="password" class="text-md-right">كلمة المرور</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="d-flex justify-content-end ">

                               {{-- <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        تذكرني
                                    </label>
                                </div>--}}
                            <button type="submit" class="btn btn-primary">
                                دخول
                            </button>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">


                               {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
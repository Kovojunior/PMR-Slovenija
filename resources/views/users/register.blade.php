{{--<x-layout>--}}

{{--    --}}{{-- Tu smo prej imeli <div ...>, ampak mi smo že naredili nek layout za to kartico v x-card, lahko to uporabimo in dodamo še ostale še neobstoječe classe iz zdaj preimenovanga diva --}}
{{--    <x-card class="p-10 max-w-lg mx-auto mt-24">--}}
{{--        <header class="text-center">--}}
{{--            <h2 class="text-2xl font-bold uppercase mb-1">Register</h2>--}}
{{--            <p class="mb-4">Create an account to post radio contacts</p>--}}
{{--        </header>--}}

{{--        <form method="POST" action="/users">--}}
{{--            @csrf--}}
{{--            <div class="mb-6">--}}
{{--                <label for="name" class="inline-block text-lg mb-2">Username - nickname or callsign</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old("name")}}"/>--}}

{{--                @error("name")--}}
{{--                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="email" class="inline-block text-lg mb-2">Email</label>--}}
{{--                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old("email")}}"/>--}}

{{--                @error("email")--}}
{{--                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="password" class="inline-block text-lg mb-2">Password</label>--}}
{{--                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" value="{{old("password")}}"/>--}}

{{--                @error("password")--}}
{{--                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="password2" class="inline-block text-lg mb-2">Confirm Password</label>--}}
{{--                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" value="{{old("password_confirmation")}}"/>--}}

{{--                @error("password_confirmation")--}}
{{--                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Sign Up</button>--}}
{{--            </div>--}}

{{--            <div class="mt-8">--}}
{{--                <p> Already have an account? <a href="/login" class="text-laravel">Login</a></p>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-card>--}}

{{--</x-layout>--}}

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
{{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>--}}
    <body>
        <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(https://images.unsplash.com/photo-1477346611705-65d1883cee1e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1920&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=c0d43804e2c7c93143fe8ff65398c8e9);">
            <div class="container-fluid">
                <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
                    <div class="col-12 col-md-4 col-lg-3   h-50 ">
                        <div class="card shadow">
                            <div class="card-body mx-auto">
                                <h4 class="card-title mt-3 text-center">Create Account</h4>
                                <p class="text-center">Get started with your free account</p>
                                <p>
                                    <a href="" class="btn btn-block btn-info">
                                        <i class="fab fa-twitter mr-2"></i>Login via Twitter</a>
                                    <a href="" class="btn btn-block btn-primary">
                                        <i class="fab fa-facebook-f mr-2"></i>Login via facebook</a>
                                </p>
                                <p class="text-muted font-weight-bold ">
                                    <span>OR</span>
                                </p>

                                {{-- SUBMIT REGISTER SUBMIT FORM --}}
                                <form method="POST" action="/users">
                                    @csrf
                                    {{-- USERNAME FIELD --}}
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                        </div>
                                        <input type="text" name="name" class="form-control" placeholder="Username/callsign" value="{{old("name")}}">
                                        {{-- NAME ERROR DISPLAY --}}
                                        <div class="input-group">
                                            @error("name")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- EMAIL ADDRESS FIELD --}}
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                        </div>
                                        <input type="email" name="email" class="form-control" placeholder="Email address" value="{{old("email")}}">
                                        {{-- EMAIL ERROR DISPLAY --}}
                                        <div class="input-group">
                                            @error("email")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- PASSWORD FIELD --}}
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="Create password" value="{{old("password")}}">
                                        {{-- PASSWORD ERROR DISPLAY --}}
                                        <div class="input-group">
                                            @error("password")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- REPEAT_PASSWORD FIELD --}}
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" value="{{old("password_confirmation")}}">
                                        {{-- PASSWORD CONFIRMATION ERROR DISPLAY --}}
                                        <div class="input-group">
                                            @error("password_confirmation")
                                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- CREATE BUTTON --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                                    </div>

                                    {{-- SIGN UP LINK --}}
                                    <p class="text-center">Already have an account?
                                        <a href="/login">Sign In</a>
                                    </p>
                                </form>
                                {{-- END OF REGISTER SUBMIT FORM --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

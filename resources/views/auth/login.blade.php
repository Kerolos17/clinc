<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg_color_2">
        <div class="container margin_60_35">
            <div id="login-2">
                <h1>Please login to Findoctor!</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="box_form clearfix">
                        <div class="box_login">
                            <a href="#0" class="social_bt facebook">Login with Facebook</a>
                            <a href="#0" class="social_bt google">Login with Google</a>
                            <a href="#0" class="social_bt linkedin">Login with Linkedin</a>
                        </div>
                        <div class="box_login last">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your email address" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your password" required autocomplete="current-password">
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot"><small>Forgot password?</small></a>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="btn_1" type="submit" value="Login">
                            </div>
                        </div>
                    </div>
                </form>
                <p class="text-center link_bright">Do not have an account yet? <a href="{{ route('register') }}"><strong>Register now!</strong></a></p>
            </div>
            <!-- /login -->
        </div>
    </div>
</x-guest-layout>
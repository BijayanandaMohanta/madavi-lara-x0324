@extends('layouts.login')

@section('content')
    @php
        $site_settings = \App\Models\Setting::where('id', 1)->first();
    @endphp

    <div class="p-4 card">

        <div class="text-center authentication-logo mb-4">
            <a href="{{ url('/') }}" class="logo-dark">
                <span><img
                        src="@if ($site_settings != '') {{ asset('site_settings') }}/{{ $site_settings->logo }} @endif"
                        alt="" width="200"></span>
            </a>
            <a href="{{ url('/') }}" class="logo-light">
                <span><img
                        src="@if ($site_settings != '') {{ asset('site_settings') }}/{{ $site_settings->logo }} @endif"
                        alt="" width="200"></span>
            </a>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="">
            @csrf

            <div class="form-group mb-3">

                <label for="email">Email address * :</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    id="email" value="{{ old('email') }}" autocomplete="off" placeholder="Enter your Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>


            <div class="form-group mb-3">
                <label for="password">Password</label>

                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    id="password" value="{{ old('password') }}" autocomplete="off" placeholder="Enter your password">
                <i class="fa fa-eye-slash" id="togglePassword"
                    style="position: relative; right: -94%; z-index: 999; top: -26px; cursor: pointer;"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- <div class="form-group mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                    <a href="#" class="text-muted float-right">Forgot your password?</a>
                </div>
            </div> -->

            <div class="form-group text-center mb-1">
                <button class="btn btn-primary btn-lg width-lg btn-rounded" type="submit"> Sign In</button>
            </div>

        </form>

    </div>

    </div>
@endsection

@section('jscode')
    <script type="text/javascript">
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // Toggle the password field type
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye icon
            this.classList.toggle('fa-eye-slash'); // Remove or add fa-eye-slash
            this.classList.toggle('fa-eye'); // Remove or add fa-eye
        });
    </script>
@endsection

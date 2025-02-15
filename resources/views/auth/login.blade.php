<link href="{{ asset('auth/auth.css') }}" rel="stylesheet">

<div class="center-wrapper">
    <div class="form-container">
        <p class="title">Login</p>
        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
            <!-- Email -->
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
            </div>

            <button type="submit" class="sign">Sign in</button>
        </form>

        <p class="switch-form">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
</div>

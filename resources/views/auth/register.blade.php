<link href="{{ asset('auth/auth.css') }}" rel="stylesheet">

<div class="center-wrapper">
    <div class="form-container">
        <p class="title">Register</p>
        <form method="POST" action="{{ route('register') }}" class="form">
            @csrf
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="Enter your password">
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
            </div>

            <button type="submit" class="sign">Register</button>
        </form>

        <p class="switch-form">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary text-decoration-none hover-underline">Login</a>
        </p>
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Street & Ink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link href="{{ asset('css/signup.css') }}" rel="stylesheet">
    <script src="{{ asset('js/signup.js') }}" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <style>
        :root {
            --accent: #FF5E5B;
            --text-light: #f0f0f0;
            --text-dark: #333;
            --background: #f9f9f9;
            --border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="split-layout">
        <!-- Left Side - Art Background -->
        <div class="art-side">
            <div>
               <a href="{{ route('home') }}" class="logo" style="color: white;">
                <i class="fas fa-spray-can"></i>Street & <span>Ink</span></a>
            </div>
            <div class="art-content">
                <h2 style="font-family: 'Space Grotesk', sans-serif; margin-bottom: 20px; font-size: 1.8rem;">Join our community of art explorers</h2>
                <p>Share your discoveries, connect with fellow street art enthusiasts, and help map urban creativity worldwide.</p>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="form-side">
            <div class="form-container">
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="form-header">
                    <h1>Create Your Account</h1>
                    <p>Join Street & Ink to start your journey through the world's urban art scene.</p>
                </div>
@if ($errors->any())
    <div style="color: red; margin-bottom: 1rem;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div style="color: green; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="name-fields">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first_name" class="form-control" placeholder="John" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last_name" class="form-control" placeholder="Doe" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                        <small style="color: var(--text-light); font-size: 0.8rem; display: block; margin-top: 5px;">At least 8 characters</small>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="password_confirmation"   class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="checkbox-group" style="margin: 15px 0;">
                        <input type="checkbox" id="newsletter" name="newsletter" checked>
                        <label for="newsletter">Receive updates about new street art discoveries</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Account</button>

                    <div class="divider">or</div>

                    <button type="button" class="btn btn-secondary">
                        <i class="fab fa-google" style="margin-right: 8px;"></i> Sign up with Google
                    </button>

                    <div class="terms">
                        By creating an account, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                    </div>

                    <div class="form-footer">
                        <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                        <p style="margin-top: 30px; color: var(--text-light); font-size: 0.9rem;">
                            "Every wall is a blank canvas. Every street has a story. Let's document it together."
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

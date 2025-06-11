<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Street & Ink</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <script src="{{ asset('js/signin.js') }}" defer></script>
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
                <a href="" class="logo large-logo" style="color: white;">
                    <img src="img/SI.png" alt="Street & Ink Logo" style="width: 40px; height: 40px; margin-right: 10px;">
                    Street & <span>Ink</span>
                </a>
            </div>
            <div class="art-content">
                <h2 style="font-family: 'Space Grotesk', sans-serif; margin-bottom: 20px; font-size: 1.8rem;">Your guide to hidden street art</h2>
                <p>Discover the most vibrant urban artworks from around the world. Join our community of art explorers.</p>
            </div>
        </div>


        <!-- Right Side - Form -->
        <div class="form-side">
            <div class="form-container">
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="form-header">
                    <h1>Welcome Back!</h1>
                    <p>Sign in to explore, pin, and discover the best street art around the world.</p>
                </div>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="email"
                               placeholder="Enter Email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="color: var(--accent); font-size: 0.8rem;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                   <div class="form-group">
                        <label for="password">Password</label>

                        <div style="position: relative;">
                            <input type="password" id="password" name="password" autocapitalize="none" autocomplete="current-password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter Password" required
                                style="padding-right: 2.5rem;"> <!-- space for the icon -->

                            <!-- Eye toggle button inside the input -->
                            <button type="button" onclick="togglePassword()"
                                    style="position: absolute; top: 50%; right: 0.75rem; transform: translateY(-50%);
                                        background: none; border: none; padding: 0; cursor: pointer;">
                                <i id="toggleIcon" class="fas fa-eye" style="color: #6c757d;"></i>
                            </button>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert" style="color: var(--accent); font-size: 0.8rem;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <!-- Remember Me & Forgot Password -->
                    <div class="remember-forgot">
                        <div class="checkbox-group">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember me</label>
                        </div>
                        {{-- Password reset route not available --}}
                        <!-- <a href="#" class="forgot-link" style="pointer-events: none; color: var(--text-light);">
                            Reset password <i class="fas fa-arrow-right"></i>
                        </a> -->
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">
                        Sign In
                    </button>

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger" style="color: var(--accent); margin: 15px 0; padding: 10px; border-radius: var(--border-radius); background-color: rgba(255, 94, 91, 0.1);">
                            @foreach($errors->all() as $error)
                                <p style="margin: 5px 0;">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- Divider -->
                    <div class="divider">or</div>

                    <!-- Social Login -->
                    <button type="button" class="btn btn-secondary">
                        <i class="fab fa-google" style="margin-right: 8px;"></i> Sign in with Google
                    </button>

                    <!-- Footer Links -->
                    <div class="form-footer">
                        <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
                        <p style="margin-top: 30px; color: var(--text); font-size: 0.9rem;">
                            "Art belongs to the streets. So does the story. Let's explore together."
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Street & Ink</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <style>
        :root {
            --accent: #FF5E5B;
            --text-light: #f0f0f0;
            --text-dark: #333;
            --background: #f9f9f9;
            --border-radius: 8px;
        }

        .alert {
            color: var(--accent);
            margin: 15px 0;
            padding: 10px;
            border-radius: var(--border-radius);
            background-color: rgba(255, 94, 91, 0.1);
        }

        .alert-success {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }
    </style>
</head>
<body>
    <div class="split-layout">
        <!-- Left Side - Art Background -->
        <div class="art-side">
            <div>
                <a href="" class="logo large-logo" style="color: white;">
                    <img src="{{ asset('img/SI.png') }}" alt="Street & Ink Logo" style="width: 40px; height: 40px; margin-right: 10px;">
                    Street & <span>Ink</span>
                </a>
            </div>
            <div class="art-content">
                <h2 style="font-family: 'Space Grotesk', sans-serif; margin-bottom: 20px; font-size: 1.8rem;">Set a New Password</h2>
                <p>Create a new secure password to access your account.</p>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="form-side">
            <div class="form-container">
                <div class="form-header">
                    <h1>Reset Password</h1>
                    <p>Create a new password for your account.</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                               placeholder="Enter your email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div style="position: relative;">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="Enter new password" style="padding-right: 2.5rem;">
                            <button type="button" onclick="togglePassword('password', 'toggleIcon1')"
                                    style="position: absolute; top: 50%; right: 0.75rem; transform: translateY(-50%);
                                           background: none; border: none; padding: 0; cursor: pointer;">
                                <i id="toggleIcon1" class="fas fa-eye" style="color: #6c757d;"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <div style="position: relative;">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirm new password" style="padding-right: 2.5rem;">
                            <button type="button" onclick="togglePassword('password-confirm', 'toggleIcon2')"
                                    style="position: absolute; top: 50%; right: 0.75rem; transform: translateY(-50%);
                                           background: none; border: none; padding: 0; cursor: pointer;">
                                <i id="toggleIcon2" class="fas fa-eye" style="color: #6c757d;"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>


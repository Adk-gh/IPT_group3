<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Contact Us | Street & Ink</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Critical for AJAX -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/contact.css') }}" rel="stylesheet">
    <script src="{{ asset('js/contact.js') }}"></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header id="header">
          @include('header')
    </header>

    <!-- Contact Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1>Let's Connect</h1>
            <p>Got a question, suggestion, or idea? Whether it's a hidden mural, a bug, or a collaboration — we'd love to hear from you.</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="section">
        <div class="container">
            <div class="contact-container">
                <div class="contact-form-container">
                    <div class="success-message" id="successMessage">
                        <i class="fas fa-check-circle" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <h3>Thanks for reaching out!</h3>
                        <p>We'll get back to you soon.</p>
                    </div>

                        <form id="contactForm" class="contact-form" method="POST" action="{{ route('contact') }}">
                    @csrf
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" class="form-control" placeholder="John Doe" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" required>
                    </div>

                <div class="form-group">
    <label for="subject">Subject*</label>
    <select id="subject" name="subject" class="form-control" required>
        <option value="" disabled selected>Select a subject</option>
        <option value="general">General Inquiry</option>
        <option value="feature">Feature Request</option>
        <option value="issue">Report an Issue</option>
        <option value="partnership">Partnership / Collaboration</option>
        <option value="submission">Submit a Mural Tip</option>
    </select>
    <div class="error" id="subjectError"></div>
</div>

<div class="form-group">
    <label for="message">Message*</label>
    <textarea id="message" name="message" class="form-control" rows="5" placeholder="Your message..." required></textarea>
    <div class="error" id="messageError"></div>
</div>

<div class="checkbox-group">
    <input type="checkbox" id="agreeTerms" name="agreeTerms" value="1" required>
    <label for="agreeTerms">I agree to the <a href="#" style="color: var(--accent);">terms and privacy policy</a></label>
    <div class="error" id="termsError"></div>
</div>

                        <button type="submit" class="btn btn-primary form-submit">Send Message</button>
                    </form>
                </div>

                <div class="contact-info">
                    <h3>Other Ways to Reach Us</h3>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email Us Directly</h4>
                                <p><a href="mailto:suggest@streetandink.com">suggest@streetandink.com</a></p>
                                <p><a href="mailto:support@streetandink.com">support@streetandink.com</a></p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Our Office</h4>
                                <p>123 Art Street, Creative District</p>
                                <p>CA 90210, United States</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Call Us</h4>
                                <p><a href="tel:+15551234567">+1 (555) 123-4567</a></p>
                                <p>Mon-Fri, 9am-5pm PST</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-hashtag"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Social Media</h4>
                                <p>
                                    <a href="https://www.instagram.com/streetandink/" style="margin-right: 15px;"><i class="fab fa-instagram"></i> Instagram</a>
                                    <a href="https://x.com/streetandink" style="margin-right: 15px;"><i class="fab fa-twitter"></i> Twitter</a>
                                    <a href="https://www.facebook.com/profile.php?id=61577181927094"><i class="fab fa-facebook"></i> Facebook</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="collaboration-box">
                        <div class="contact-icon" style="margin: 0 auto 20px;">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Want to Collaborate?</h3>
                        <p>Are you a brand, event organizer, or artist collective looking to work with us?</p>
                        <a href="Partners.php" class="btn btn-secondary">Partner With Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    if (!form) return;  // Exit if form doesn't exist

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) throw new Error('Server error');
            const data = await response.json();
            
            if (data.success) {
                document.getElementById('successMessage').style.display = 'block';
                form.style.display = 'none';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Submission failed. Check console for details.');
        } finally {
            submitButton.disabled = false;
        }
    });
});
        </script>

    <!-- Footer -->
   <footer>
    @include('footer')
    </footer>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Street & Ink | Help Document Urban Art</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="resources/css/support.css" rel="stylesheet">
    <script src="resources/js/support.js" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header with Support Button -->
    <header id="header">
        @include('header')
    </header>

    <!-- Hero Section -->
    <section class="support-hero">
        <div class="support-hero-content">
            <h1>❤️ Help Keep the Streets Alive with Art</h1>
            <p>We're building a home for global street culture — and your support keeps it growing.</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="#support-options" class="btn btn-primary btn-large">Ways to Support</a>
                <a href="#patreon" class="btn btn-secondary btn-large">Become a Patron</a>
            </div>
        </div>
    </section>

    <!-- Support Options -->
    <section class="section" id="support-options">
        <div class="container">
            <h2 class="section-title">🙌 Ways to Support</h2>
            <p class="text-center">Choose the option that works best for you. Every contribution helps us document and celebrate street art worldwide.</p>

            <div class="support-options">
                <!-- Option 1: Tip Jar -->
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <h3>Buy Us a Coffee</h3>
                    <p>Make a one-time donation to help cover our operating costs and keep the platform free for everyone.</p>
                    <a href="#" class="support-btn"><i class="fas fa-mug-hot"></i> Tip Us</a>
                </div>

                <!-- Option 2: Patreon -->
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fab fa-patreon"></i>
                    </div>
                    <h3>Become a Patron</h3>
                    <p>Join our community of monthly supporters and get exclusive perks while helping sustain the project long-term.</p>
                    <a href="#patreon" class="support-btn"><i class="fab fa-patreon"></i> View Tiers</a>
                </div>

                <!-- Option 3: Merch -->
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3>Buy Merchandise</h3>
                    <p>Show your love for street art with our limited edition tees, prints, and accessories. All proceeds support our work.</p>
                    <a href="#" class="support-btn"><i class="fas fa-shopping-bag"></i> Shop Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Patreon Tiers -->
    <section class="patreon-tiers" id="patreon">
        <div class="container">
            <h2 class="section-title">🎨 Become a Patron</h2>
            <p class="text-center">Join our community of monthly supporters and help us preserve street art culture worldwide.</p>

            <div class="tier-grid">
                <!-- Tier 1 -->
                <div class="tier-card">
                    <h3 class="tier-name">Art Lover</h3>
                    <div class="tier-price">$3/month</div>
                    <ul class="tier-features">
                        <li><i class="fas fa-check"></i> Name on our supporter wall</li>
                        <li><i class="fas fa-check"></i> Behind-the-scenes updates</li>
                        <li><i class="fas fa-check"></i> Voting on new features</li>
                    </ul>
                    <div class="tier-button">
                        <a href="#" class="btn btn-primary">Choose This Tier</a>
                    </div>
                </div>

                <!-- Tier 2 -->
                <div class="tier-card">
                    <h3 class="tier-name">Art Collector</h3>
                    <div class="tier-price">$7/month</div>
                    <ul class="tier-features">
                        <li><i class="fas fa-check"></i> Everything in Art Lover</li>
                        <li><i class="fas fa-check"></i> Early access to new features</li>
                        <li><i class="fas fa-check"></i> Exclusive digital art drops</li>
                        <li><i class="fas fa-check"></i> Monthly desktop wallpapers</li>
                    </ul>
                    <div class="tier-button">
                        <a href="#" class="btn btn-primary">Choose This Tier</a>
                    </div>
                </div>

                <!-- Tier 3 -->
                <div class="tier-card">
                    <h3 class="tier-name">Wall Builder</h3>
                    <div class="tier-price">$12/month</div>
                    <ul class="tier-features">
                        <li><i class="fas fa-check"></i> Everything in Art Collector</li>
                        <li><i class="fas fa-check"></i> Annual surprise merch package</li>
                        <li><i class="fas fa-check"></i> VIP badge on your profile</li>
                        <li><i class="fas fa-check"></i> Input on future directions</li>
                        <li><i class="fas fa-check"></i> Your name in our credits</li>
                    </ul>
                    <div class="tier-button">
                        <a href="#" class="btn btn-primary">Choose This Tier</a>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 50px;">
                <a href="#" class="btn btn-secondary"><i class="fab fa-patreon"></i> View All Tiers on Patreon</a>
            </div>
        </div>
    </section>

    <!-- Merch Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">🛍️ Street & Ink Merch</h2>
            <p class="text-center">Wear your love for street art with our limited edition merchandise. All proceeds support our mission.</p>

            <div class="merch-grid">
                <!-- Item 1 -->
                <div class="merch-card">
                    <div class="merch-img">
                        <img src="https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Street Art T-Shirt">
                    </div>
                    <div class="merch-content">
                        <h3 class="merch-title">Urban Canvas Tee</h3>
                        <div class="merch-price">$29.99</div>
                        <a href="#" class="btn btn-secondary">Add to Cart</a>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="merch-card">
                    <div class="merch-img">
                        <img src="https://images.unsplash.com/photo-1583744946564-b52d01e2da64?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Street Art Hoodie">
                    </div>
                    <div class="merch-content">
                        <h3 class="merch-title">Graffiti Hoodie</h3>
                        <div class="merch-price">$49.99</div>
                        <a href="#" class="btn btn-secondary">Add to Cart</a>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="merch-card">
                    <div class="merch-img">
                        <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1364&q=80" alt="Street Art Print">
                    </div>
                    <div class="merch-content">
                        <h3 class="merch-title">Limited Edition Print</h3>
                        <div class="merch-price">$39.99</div>
                        <a href="#" class="btn btn-secondary">Add to Cart</a>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="merch-card">
                    <div class="merch-img">
                        <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" alt="Street Art Stickers">
                    </div>
                    <div class="merch-content">
                        <h3 class="merch-title">Sticker Pack</h3>
                        <div class="merch-price">$12.99</div>
                        <a href="#" class="btn btn-secondary">Add to Cart</a>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 50px;">
                <a href="#" class="btn btn-primary">View Full Store</a>
            </div>
        </div>
    </section>

    <!-- Other Ways to Support -->
    <section class="other-ways">
        <div class="container">
            <h2 class="section-title">💡 Other Ways to Support</h2>
            <p class="text-center">No money? No problem. There are plenty of ways to contribute to our community.</p>

            <div class="ways-grid">
                <!-- Way 1 -->
                <div class="way-card">
                    <div class="way-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="way-content">
                        <h3>Submit Street Art</h3>
                        <p>Help us grow the map by documenting street art in your area. Every submission makes our database richer.</p>
                    </div>
                </div>

                <!-- Way 2 -->
                <div class="way-card">
                    <div class="way-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="way-content">
                        <h3>Spread the Word</h3>
                        <p>Tell your friends about Street & Ink. Share our content on social media and help grow our community.</p>
                    </div>
                </div>

                <!-- Way 3 -->
                <div class="way-card">
                    <div class="way-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="way-content">
                        <h3>Contribute Code</h3>
                        <p>We're open source! If you're a developer, check out our GitHub and help improve the platform.</p>
                    </div>
                </div>

                <!-- Way 4 -->
                <div class="way-card">
                    <div class="way-icon">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                    <div class="way-content">
                        <h3>Write for Our Blog</h3>
                        <p>Share your street art knowledge by contributing articles, interviews, or city guides.</p>
                    </div>
                </div>

                <!-- Way 5 -->
                <div class="way-card">
                    <div class="way-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div class="way-content">
                        <h3>Volunteer</h3>
                        <p>We occasionally need help with events, translations, and community moderation.</p>
                    </div>
                </div>

                <!-- Way 6 -->
                <div class="way-card">
                    <div class="way-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="way-content">
                        <h3>Corporate Sponsorship</h3>
                        <p>Is your company aligned with our mission? Let's talk about partnership opportunities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section" style="padding-bottom: 80px;">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h2 class="section-title">Every Contribution Matters</h2>
                <p style="margin-bottom: 30px;">Street & Ink is a labor of love created by street art enthusiasts for street art enthusiasts. Your support helps us maintain the platform, add new features, and keep the community thriving.</p>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <a href="#" class="btn btn-primary btn-large"><i class="fas fa-heart"></i> Support Now</a>
                    <a href="Contact.php" class="btn btn-secondary btn-large"><i class="fas fa-envelope"></i> Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        @include('footer')
        </div>
    </footer>


<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

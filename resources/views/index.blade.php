<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Discover Street Art Near You</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="{{ asset('js/index.js') }}"></script>

</head>
<body>
    <!-- Header -->
    <header id="header">
       @include('header')

    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Explore the Streets, One Wall at a Time</h1>
            <p>Discover and share the most vibrant street art from around the world. Join our community of urban art enthusiasts and creators.</p>
            <div class="hero-btns">
                <a href="{{ route('register') }}" class="btn btn-primary btn-large" id="ajax-link">Get Started</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-large">Learn More</a>
            </div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search by city, neighborhood or artist...">
                <button class="search-btn">Search</button>
            </div>
            <a href="{{ route('register') }}" class="location-btn">
                <i class="fas fa-location-arrow"></i> Find Art Near Me
            </a>
        </div>
    </section>


    <!-- Map Preview Section -->
    <section class="section map-preview" id="map">
        <div class="container">
            <h2 class="section-title">Interactive Street Art Map</h2>
            <p class="text-center" style="margin-bottom: 2rem;">Explore thousands of street art locations around the world. Click on markers to discover new artworks.</p>
            <div class="map-container">
                <div id="streetArtMap"></div>
                <div class="map-overlay">
                    <h3>San Pablo City Street Art</h3>
                    <p>Discover over 1,200 documented street artworks in City Of Seven Lakes.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary">View Full Map</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Featured Street Art Section -->
    <section class="section" id="art">
        <div class="container">
            <h2 class="section-title">Featured Street Art</h2>
            <p class="text-center" style="margin-bottom: 3rem;">Discover the most popular and recent additions to our growing collection.</p>

            <div class="art-tabs">
                <div class="art-tab active">Most Liked</div>
                <div class="art-tab">Recently Added</div>
                <div class="art-tab">Hidden Gems</div>
            </div>

            <div class="art-grid">
                <!-- Artwork 1 -->
                <div class="art-card">
                    <div class="art-card-img">
                        <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Street Art">
                    </div>
                    <div class="art-card-content">
                        <h3 class="art-card-title">Urban Dreams</h3>
                        <div class="art-card-artist">
                            <i class="fas fa-user"></i> Banksy (unconfirmed)
                        </div>
                        <div class="art-card-location">
                            <i class="fas fa-map-marker-alt"></i> Shoreditch, London
                        </div>
                        <div class="art-card-tags">
                            <span class="art-card-tag">Stencil</span>
                            <span class="art-card-tag">Political</span>
                            <span class="art-card-tag">Iconic</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 2 -->
                <div class="art-card">
                    <div class="art-card-img">
                        <img src="img/pexels-conojeghuo-173301.jpg" alt="Street Art">
                    </div>
                    <div class="art-card-content">
                        <h3 class="art-card-title">Color Explosion</h3>
                        <div class="art-card-artist">
                            <i class="fas fa-user"></i> Maya Hayuk
                        </div>
                        <div class="art-card-location">
                            <i class="fas fa-map-marker-alt"></i> Williamsburg, NYC
                        </div>
                        <div class="art-card-tags">
                            <span class="art-card-tag">Mural</span>
                            <span class="art-card-tag">Abstract</span>
                            <span class="art-card-tag">Colorful</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 3 -->
                <div class="art-card">
                    <div class="art-card-img">
                        <img src="img/pexels-fernando-dos-santos-campos-1309016-2510245.jpg" alt="Street Art">
                    </div>
                    <div class="art-card-content">
                        <h3 class="art-card-title">The Thinker</h3>
                        <div class="art-card-artist">
                            <i class="fas fa-user"></i> Unknown Artist
                        </div>
                        <div class="art-card-location">
                            <i class="fas fa-map-marker-alt"></i> Berlin, Germany
                        </div>
                        <div class="art-card-tags">
                            <span class="art-card-tag">Portrait</span>
                            <span class="art-card-tag">Monochrome</span>
                            <span class="art-card-tag">Thought-provoking</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 4 -->
                <div class="art-card">
                    <div class="art-card-img">
                        <img src="/resources/views/img/pexels-heftiba-1194420.jpg" alt="Street Art">
                    </div>
                    <div class="art-card-content">
                        <h3 class="art-card-title">Neon Dreams</h3>
                        <div class="art-card-artist">
                            <i class="fas fa-user"></i> D*Face
                        </div>
                        <div class="art-card-location">
                            <i class="fas fa-map-marker-alt"></i> Downtown LA
                        </div>
                        <div class="art-card-tags">
                            <span class="art-card-tag">Pop Art</span>
                            <span class="art-card-tag">Neon</span>
                            <span class="art-card-tag">Night View</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 5 -->
                <div class="art-card">
                    <div class="art-card-img">
                        <img src="img/pexels-tobiasbjorkli-2119706.jpg" alt="Street Art">
                    </div>
                    <div class="art-card-content">
                        <h3 class="art-card-title">Abstract Flow</h3>
                        <div class="art-card-artist">
                            <i class="fas fa-user"></i> Felipe Pantone
                        </div>
                        <div class="art-card-location">
                            <i class="fas fa-map-marker-alt"></i> Wynwood, Miami
                        </div>
                        <div class="art-card-tags">
                            <span class="art-card-tag">Abstract</span>
                            <span class="art-card-tag">Geometric</span>
                            <span class="art-card-tag">Optical</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 6 -->
                <div class="art-card">
                    <div class="art-card-img">
                        <img src="img/pexels-arantxa-treva-351075-959314.jpg" alt="Street Art">
                    </div>
                    <div class="art-card-content">
                        <h3 class="art-card-title">Cultural Fusion</h3>
                        <div class="art-card-artist">
                            <i class="fas fa-user"></i> Shepard Fairey
                        </div>
                        <div class="art-card-location">
                            <i class="fas fa-map-marker-alt"></i> Little Tokyo, LA
                        </div>
                        <div class="art-card-tags">
                            <span class="art-card-tag">Cultural</span>
                            <span class="art-card-tag">Portrait</span>
                            <span class="art-card-tag">Social</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 50px;">
                <a href="{{ route('social_feed') }}" class="btn btn-primary">View All Artworks</a>
            </div>
        </div>
    </section>

    <!-- Artist Spotlight Section -->
    <section class="section artists" id="artists">
        <div class="container">
            <h2 class="section-title">Artist Spotlights</h2>
            <p class="text-center">Discover the talented individuals behind the urban masterpieces.</p>

            <div class="artist-grid">
                <!-- Artist 1 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1542103749-8ef59b94f47e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Banksy</h3>
                        <div class="artist-card-style">Stencil Art, Political</div>
                        <p class="artist-card-bio">Anonymous England-based street artist known for his satirical and subversive work.</p>
                        <div class="artist-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Artist 2 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Shepard Fairey</h3>
                        <div class="artist-card-style">Stencil, Screen Printing</div>
                        <p class="artist-card-bio">American street artist, graphic designer, and founder of OBEY Clothing.</p>
                        <div class="artist-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Artist 3 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Maya Hayuk</h3>
                        <div class="artist-card-style">Abstract, Colorful</div>
                        <p class="artist-card-bio">Known for her large-scale, symmetrical murals featuring vibrant colors and patterns.</p>
                        <div class="artist-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Artist 4 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Felipe Pantone</h3>
                        <div class="artist-card-style">Optical, Digital</div>
                        <p class="artist-card-bio">Argentinian-Spanish artist known for his vibrant, geometric works exploring digital themes.</p>
                        <div class="artist-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 50px;">
                <a href="{{ route('artist') }}" class="btn btn-primary">View All Artists</a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="section" id="categories">
        <div class="container">
            <h2 class="section-title">Explore by Categories</h2>
            <p class="text-center">Find street art that matches your interests and style preferences.</p>

            <div class="categories-grid">
                <!-- Category 1 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-paint-roller"></i>
                    </div>
                    <h3 class="category-title">Murals</h3>
                    <div class="category-count">1,240+ Artworks</div>
                </div>

                <!-- Category 2 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-spray-can"></i>
                    </div>
                    <h3 class="category-title">Graffiti</h3>
                    <div class="category-count">980+ Artworks</div>
                </div>

                <!-- Category 3 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <h3 class="category-title">Stickers</h3>
                    <div class="category-count">320+ Artworks</div>
                </div>

                <!-- Category 4 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h3 class="category-title">Stencils</h3>
                    <div class="category-count">450+ Artworks</div>
                </div>

                <!-- Category 5 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <h3 class="category-title">Installations</h3>
                    <div class="category-count">210+ Artworks</div>
                </div>

                <!-- Category 6 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-arrows-alt-h"></i>
                    </div>
                    <h3 class="category-title">Wheatpaste</h3>
                    <div class="category-count">180+ Artworks</div>
                </div>

                <!-- Category 7 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-marker"></i>
                    </div>
                    <h3 class="category-title">Tagging</h3>
                    <div class="category-count">670+ Artworks</div>
                </div>

                <!-- Category 8 -->
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="category-title">Light Art</h3>
                    <div class="category-count">90+ Artworks</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Submit Section -->
    <section class="section submit">
        <div class="container">
            <h2 class="section-title">Contribute to the Community</h2>
            <p>Help us document street art from around the world. Share your discoveries and connect with other urban art enthusiasts.</p>
            <div class="text-center" style="margin-top: 40px;">
                <a href="Artist.php" class="btn btn-primary btn-large" id="submitArtworkBtn">Submit Artwork</a>
            </div>
        </div>
    </section>

    <!-- App Section -->
    <section class="section">
        <div class="container">
            <div class="app-container">
                <div class="app-content">
                    <h2>Street & Ink Mobile App</h2>
                    <p>Take the street art discovery experience with you wherever you go. Our mobile app makes it easy to find, save, and share street art in real-time.</p>
                    <ul style="margin: 20px 0 30px; padding-left: 20px;">
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start;">
                            <i class="fas fa-check" style="color: var(--accent); margin-right: 10px; margin-top: 3px;"></i>
                            <span>Augmented Reality street art detection</span>
                        </li>
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start;">
                            <i class="fas fa-check" style="color: var(--accent); margin-right: 10px; margin-top: 3px;"></i>
                            <span>Offline access to saved locations</span>
                        </li>
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start;">
                            <i class="fas fa-check" style="color: var(--accent); margin-right: 10px; margin-top: 3px;"></i>
                            <span>Exclusive app-only artworks</span>
                        </li>
                        <li style="display: flex; align-items: flex-start;">
                            <i class="fas fa-check" style="color: var(--accent); margin-right: 10px; margin-top: 3px;"></i>
                            <span>Instant notifications for new art in your area</span>
                        </li>
                    </ul>
                    <div class="app-buttons">
                        <a href="#" class="app-btn">
                            <i class="fab fa-apple"></i>
                            <div class="app-btn-text">
                                <span>Download on the</span>
                                <span>App Store</span>
                            </div>
                        </a>
                        <a href="#" class="app-btn">
                            <i class="fab fa-google-play"></i>
                            <div class="app-btn-text">
                                <span>Get it on</span>
                                <span>Google Play</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="app-image">
                    <img src="https://images.unsplash.com/photo-1615774698-0b77e0d5fac6.jpg?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Health App">
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="section blog">
        <div class="container">
            <h2 class="section-title">Street Art Stories</h2>
            <p class="text-center">Read about the latest in street art culture, events, and artist interviews.</p>

            <div class="blog-grid">
                <!-- Blog Post 1 -->
                <div class="blog-card">
                    <div class="blog-card-img">
                        <img src="img/pexels-brett-sayles-1123894.jpg" alt="Blog Post">
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-date">January 15, 2024</div>
                        <h3 class="blog-card-title">The Rise of Political Street Art in 2024</h3>
                        <p class="blog-card-text">How artists are using urban spaces to comment on current events and social issues around the world.</p>
                        <a href="#" class="blog-card-link">Read More <span class="arrow-right"></span></a>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="blog-card">
                    <div class="blog-card-img">
                        <img src="img/pexels-brett-sayles-1123894.jpg" alt="Blog Post">
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-date">January 8, 2024</div>
                        <h3 class="blog-card-title">Interview: The Neon Artist in Downtown LA</h3>
                        <p class="blog-card-text">We sit down with the anonymous artist behind the glowing murals transforming the city.</p>
                        <a href="#" class="blog-card-link">Read More <span class="arrow-right"></span></a>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="blog-card">
                    <div class="blog-card-img">
                        <img src="img/pexels-brett-sayles-1123894.jpg" alt="Blog Post">
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-date">December 30, 2023</div>
                        <h3 class="blog-card-title">Street Art Festivals You Can't Miss This Summer</h3>
                        <p class="blog-card-text">From Berlin to Buenos Aires, here are the must-visit urban art events of the season.</p>
                        <a href="#" class="blog-card-link">Read More <span class="arrow-right"></span></a>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 50px;">
                <a href="#" class="btn btn-primary">View All Events</a>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section class="section community" id="community">
        <div class="container">
            <h2 class="section-title">Our Community</h2>
            <p class="text-center">Connect with street art enthusiasts, share your finds, and join our global community.</p>

            <div class="community-stats">
                <div class="stat-item">
                    <div class="stat-number">25K+</div>
                    <div class="stat-title">Artworks</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-title">Members</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">150+</div>
                    <div class="stat-title">Cities</div>
                </div>
            </div>

            <h3 style="text-align: center; margin-bottom: 20px;">Top Contributors</h3>
            <div class="community-grid">
                <div class="community-item">
                    <div class="community-item-img">
                        <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="User">
                    </div>
                    <div class="community-item-content">
                        <h3 class="user-name">Sophie L.</h3>
                        <p class="user-contributions">450 Contributions</p>
                    </div>
                </div>
                <div class="community-item">
                    <div class="community-item-img">
                        <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="User">
                    </div>
                    <div class="community-item-content">
                        <h3 class="user-name">James K.</h3>
                        <p class="user-contributions">400 Contributions</p>
                    </div>
                </div>
                <div class="community-item">
                    <div class="community-item-img">
                        <img src="https://randomuser.me/api/portraits/women/3.jpg" alt="User">
                    </div>
                    <div class="community-item-content">
                        <h3 class="user-name">Emma W.</h3>
                        <p class="user-contributions">380 Contributions</p>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 50px;">
                <a href="#" class="btn btn-primary btn-large">Join Now</a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <div class="container">
            <h2 class="section-title">Stay in Touch</h2>
            <p>Sign up for our newsletter to get the latest updates on street art and events.</p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Enter your email">
                <button type="submit" class="btn-primary">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Include Footer-->
    <footer>
    @include('footer')
    </footer>

    <script src="https://unpkg.com/leaflet.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Discover Street Artists</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link href="{{ asset('css/artist.css') }}" rel="stylesheet">
    <script src="{{ asset('js/artist.js') }}"></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header - Same as main page -->
    <header id="header">
          @include('header')
    </header>

    <!-- Hero Section -->
    <section class="hero-artists">
        <div class="hero-content">
            <h1>All Street Artists</h1>
            <p>From seasoned muralists to fresh urban artists, explore the creators who are redefining public spaces.</p>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="search-filter">
        <div class="container">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search artists by name, city, or style...">
                <button class="search-btn">Search</button>
            </div>

            <div class="filter-container">
                <div class="filter-group">
                    <div class="filter-title">Filter by Style</div>
                    <div class="filter-options">
                        <input type="checkbox" id="graffiti" class="filter-checkbox">
                        <label for="graffiti" class="filter-label">Graffiti</label>

                        <input type="checkbox" id="murals" class="filter-checkbox">
                        <label for="murals" class="filter-label">Murals</label>

                        <input type="checkbox" id="stencils" class="filter-checkbox">
                        <label for="stencils" class="filter-label">Stencils</label>

                        <input type="checkbox" id="stickers" class="filter-checkbox">
                        <label for="stickers" class="filter-label">Stickers</label>

                        <input type="checkbox" id="installations" class="filter-checkbox">
                        <label for="installations" class="filter-label">Installations</label>
                    </div>
                </div>

                <div class="filter-group">
                    <div class="filter-title">Filter by Location</div>
                    <select class="sort-dropdown">
                        <option>All Locations</option>
                        <option>North America</option>
                        <option>Europe</option>
                        <option>Asia</option>
                        <option>South America</option>
                        <option>Africa</option>
                        <option>Australia</option>
                    </select>
                </div>

                <div class="filter-group">
                    <div class="filter-title">Sort by</div>
                    <select class="sort-dropdown">
                        <option>Most Popular</option>
                        <option>Newest</option>
                        <option>Most Artworks</option>
                        <option>A-Z</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Artists Grid Section -->
    <section class="section">
        <div class="container">
            <div class="artists-grid">
                <!-- Artist 1 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1542103749-8ef59b94f47e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Artist">
                        <div class="artist-verified" title="Verified Artist"><i class="fas fa-check"></i></div>
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Banksy</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> Bristol, UK
                        </div>
                        <p class="artist-card-bio">Anonymous England-based street artist known for his satirical and subversive work.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 120+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 25K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Stencil</span>
                            <span class="artist-card-tag">Political</span>
                            <span class="artist-card-tag">Satire</span>
                        </div>
                    </div>
                </div>

                <!-- Artist 2 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                        <div class="artist-verified" title="Verified Artist"><i class="fas fa-check"></i></div>
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Shepard Fairey</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> Los Angeles, USA
                        </div>
                        <p class="artist-card-bio">American street artist, graphic designer, and founder of OBEY Clothing.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 85+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 18K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Stencil</span>
                            <span class="artist-card-tag">Screen Printing</span>
                            <span class="artist-card-tag">Propaganda</span>
                        </div>
                    </div>
                </div>

                <!-- Artist 3 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                        <div class="artist-verified" title="Verified Artist"><i class="fas fa-check"></i></div>
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Maya Hayuk</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> Brooklyn, USA
                        </div>
                        <p class="artist-card-bio">Known for her large-scale, symmetrical murals featuring vibrant colors and patterns.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 65+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 15K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Abstract</span>
                            <span class="artist-card-tag">Colorful</span>
                            <span class="artist-card-tag">Symmetrical</span>
                        </div>
                    </div>
                </div>

                <!-- Artist 4 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                        <div class="artist-verified" title="Verified Artist"><i class="fas fa-check"></i></div>
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Felipe Pantone</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> Valencia, Spain
                        </div>
                        <p class="artist-card-bio">Argentinian-Spanish artist known for his vibrant, geometric works exploring digital themes.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 42+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 12K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Optical</span>
                            <span class="artist-card-tag">Digital</span>
                            <span class="artist-card-tag">Geometric</span>
                        </div>
                    </div>
                </div>

                <!-- Artist 5 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">JR</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> Paris, France
                        </div>
                        <p class="artist-card-bio">French artist who uses photography and large-scale installations to make powerful statements.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 78+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 22K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Photography</span>
                            <span class="artist-card-tag">Installation</span>
                            <span class="artist-card-tag">Social</span>
                        </div>
                    </div>
                </div>

                <!-- Artist 6 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Swoon</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> New York, USA
                        </div>
                        <p class="artist-card-bio">American street artist known for her life-size wheatpaste prints and paper cutouts.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 55+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 14K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Wheatpaste</span>
                            <span class="artist-card-tag">Portrait</span>
                            <span class="artist-card-tag">Social</span>
                        </div>
                    </div>
                </div>

                <!-- Artist 7 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Vhils</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> Lisbon, Portugal
                        </div>
                        <p class="artist-card-bio">Portuguese street artist known for his unique carving technique that transforms walls into portraits.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 68+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 16K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Carving</span>
                            <span class="artist-card-tag">Portrait</span>
                            <span class="artist-card-tag">Urban</span>
                        </div>
                    </div>
                </div>

                <!-- Artist 8 -->
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artist">
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">Blu</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> Bologna, Italy
                        </div>
                        <p class="artist-card-bio">Italian street artist known for his politically charged murals and stop-motion animations.</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> 92+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> 28K Likes
                            </div>
                        </div>
                        <div class="artist-card-tags">
                            <span class="artist-card-tag">Mural</span>
                            <span class="artist-card-tag">Political</span>
                            <span class="artist-card-tag">Animation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pagination">
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">4</a>
                <a href="#" class="page-link">5</a>
                <a href="#" class="page-link"><i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </section>

    <!-- Featured Artist Section -->
    <section class="section">
        <div class="container">
            <div class="featured-artist">
                <div class="featured-artist-container">
                    <div class="featured-artist-content">
                        <span class="featured-artist-badge">Featured Artist</span>
                        <h2>Banksy: The Anonymous Revolutionary</h2>
                        <p>Explore the mysterious world of Banksy, the anonymous England-based street artist whose satirical and subversive works combine dark humor with graffiti executed in a distinctive stenciling technique.</p>
                        <a href="#" class="btn btn-primary">Explore Banksy's Art</a>
                    </div>
                    <div class="featured-artist-image">
                        <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Banksy Artwork">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artist Spotlights Section -->
    <section class="section artist-spotlights">
        <div class="container">
            <h2 class="section-title">Artist Spotlights</h2>
            <p class="text-center">Discover in-depth interviews and features with the artists shaping the street art world.</p>

            <div class="spotlight-grid">
                <!-- Spotlight 1 -->
                <div class="spotlight-card">
                    <div class="spotlight-card-img">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Spotlight">
                    </div>
                    <div class="spotlight-card-content">
                        <div class="spotlight-card-date">June 12, 2023</div>
                        <h3 class="spotlight-card-title">Interview: The Women Changing Street Art</h3>
                        <p class="spotlight-card-excerpt">We sit down with three female street artists who are breaking barriers in this male-dominated field.</p>
                        <a href="#" class="spotlight-card-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Spotlight 2 -->
                <div class="spotlight-card">
                    <div class="spotlight-card-img">
                        <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1480&q=80" alt="Spotlight">
                    </div>
                    <div class="spotlight-card-content">
                        <div class="spotlight-card-date">May 28, 2023</div>
                        <h3 class="spotlight-card-title">From Graffiti to Galleries: The Evolution of Street Art</h3>
                        <p class="spotlight-card-excerpt">How street artists are transitioning from illegal walls to prestigious art institutions.</p>
                        <a href="#" class="spotlight-card-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Spotlight 3 -->
                <div class="spotlight-card">
                    <div class="spotlight-card-img">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Spotlight">
                    </div>
                    <div class="spotlight-card-content">
                        <div class="spotlight-card-date">May 15, 2023</div>
                        <h3 class="spotlight-card-title">The Rise of Eco-Conscious Street Art</h3>
                        <p class="spotlight-card-excerpt">Meet the artists using sustainable materials and environmental themes in their urban works.</p>
                        <a href="#" class="spotlight-card-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artist Map Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Artists Around the World</h2>
            <p class="text-center">Explore where our featured artists are based and discover local talent in your area.</p>

            <div class="artist-map">
                <div id="artistWorldMap"></div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="section">
        <div class="container">
            <div class="artist-cta">
                <h2>Are You a Street Artist?</h2>
                <p>Join our growing community of urban artists. Showcase your work, connect with fans, and get featured on Street & Ink.</p>
                <a href="#" class="btn btn-primary btn-large">Submit Your Artwork</a>
            </div>
        </div>
    </section>

    <!-- Footer - Same as main page -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-about">
                    <a href="#" class="footer-logo">Street & <span>Ink</span></a>
                    <p>The world's most comprehensive street art discovery platform. Documenting urban creativity since 2018.</p>
                    <div style="display: flex; gap: 15px; margin-top: 20px;">
                        <a href="#" style="color: var(--white); font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color: var(--white); font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color: var(--white); font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                        <a href="#" style="color: var(--white); font-size: 1.2rem;"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="footer-title">Explore</h3>
                    <ul class="footer-links">
                        <li><a href="#">Map</a></li>
                        <li><a href="#">Street Art</a></li>
                        <li><a href="#">Artists</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Events</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer-title">Community</h3>
                    <ul class="footer-links">
                        <li><a href="#">Guidelines</a></li>
                        <li><a href="#">Submit Art</a></li>
                        <li><a href="#">Forums</a></li>
                        <li><a href="#">Meetups</a></li>
                        <li><a href="#">Wall of Fame</a></li>
                        <li><a href="#">Get Involved</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer-title">Company</h3>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Partners</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer-title">Contact Us</h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Art Street, Creative District, CA 90210</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>hello@streetandink.com</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2023 Street & Ink. All rights reserved. | <a href="#" style="color: var(--accent);">Privacy Policy</a> | <a href="#" style="color: var(--accent);">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

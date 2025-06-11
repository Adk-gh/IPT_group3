<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Street & Ink | Discover Street Art Near You</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="{{ asset('js/index.js') }}"></script>
    <!-- Add this to both files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>


        <header id="header">
            @include('header')
        </header>
</head>
<body>
    <!-- Header -->


    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Explore the Streets, One Wall at a Time</h1>
            <p>Discover and share the most vibrant street art from around the world. Join our community of urban art enthusiasts and creators.</p>
            <div class="hero-btns">
                <a href="{{ route('social_feed') }}" class="btn btn-primary btn-large" id="ajax-link">Get Started</a>
                <a href="{{ route('aboutus') }}" class="btn btn-secondary btn-large">Learn More</a>
            </div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search by city, neighborhood or artist...">
                <button class="search-btn">Search</button>
            </div>
            <a href="#map" class="location-btn">
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
               <div id="streetArtMap" style="height: 500px;"></div>
                <div class="map-overlay">
                    <h3>San Pablo City Street Art</h3>
                    <p>Discover over 1,200 documented street artworks in City Of Seven Lakes.</p>
                   <a href="#" class="btn btn-primary" id="viewFullMapBtn">View Full Map</a>
                </div>
            </div>
        </div>
    </section>

<!-- Artists Section -->
    <section class="section artists" id="artists">
        <div class="container">
            <h2 class="section-title">Featured Artists</h2>
            <p class="text-center">Meet the creative minds behind the art. Discover their styles, stories, and contributions to the street art scene.</p>
        </div>
    </section>
<div class="artist-grid">
    @forelse ($users as $user)
        <div class="artist-card">
            <div class="artist-card-img">
                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('img/default.jpg') }}" alt="User Avatar">
            </div>
            <div class="artist-card-content">
                <h3 class="artist-card-name">{{ $user->name }}</h3>
                <h4 class="artist-card-username">{{ $user->username }}</h4>
                <div class="artist-card-style">{{ $user->style ?? 'Unknown Style' }}</div>
                <p class="artist-card-bio">{{ $user->bio ?? 'No bio available.' }}</p>
                <div class="artist-social">
                    @if($user->instagram) <a href="{{ $user->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a> @endif
                    @if($user->twitter) <a href="{{ $user->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a> @endif
                    @if($user->website) <a href="{{ $user->website }}" target="_blank"><i class="fas fa-globe"></i></a> @endif
                </div>
            </div>
        </div>
    @empty
        <p>No artists found.</p>
    @endforelse
</div>
<!-- Post Modal -->
<div id="postModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
  <div id="modalContent" class="bg-white rounded-lg p-4 max-w-md w-full"></div>
</div>




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
<script>
    const postsWithLocation = [
        @foreach ($posts as $post)
            @if ($post->latitude && $post->longitude)
                {
                    id: {{ $post->id }},
                    title: @json($post->caption ?? 'Untitled'),
                    latitude: {{ $post->latitude }},
                    longitude: {{ $post->longitude }},
                    location_name: @json($post->location_name ?? ''),
                    image_url: @json($post->image_url ? asset('storage/' . $post->image_url) : null),
                },
            @endif
        @endforeach
    ];
</script>



    <script src="https://unpkg.com/leaflet.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

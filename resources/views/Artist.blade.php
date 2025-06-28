<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Street & Ink | Discover Street Artists</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

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

  <section class="section">
    <div class="container">
        <div class="artists-grid">
            @forelse($users as $user)
                @if($user->email !== 'admin@gmail.com')
                <div class="artist-card">
                    <div class="artist-card-img">
                        <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('img/default.jpg') }}" alt="User Avatar">


                        @if($user->is_verified)
                        <div class="artist-verified" title="Verified Artist"><i class="fas fa-check"></i></div>
                        @endif
                    </div>
                    <div class="artist-card-content">
                        <h3 class="artist-card-name">{{ $user->name }}</h3>
                        <div class="artist-card-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $user->location ?? 'Unknown Location' }}
                        </div>
                        <p class="artist-card-bio">{{ $user->bio ?? 'No bio available.' }}</p>
                        <div class="artist-card-stats">
                            <div class="artist-card-stat">
                                <i class="fas fa-paint-brush"></i> {{ $user->artworks_count ?? 0 }}+ Artworks
                            </div>
                            <div class="artist-card-stat">
                                <i class="fas fa-heart"></i> {{ $user->likes_count ?? 0 }} Likes
                            </div>
                        </div>

                        <div class="artist-card-tags">
                            @if(!empty($user->tags))
                                @foreach($user->tags as $tag)
                                    <span class="artist-card-tag">{{ $tag }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <p>No artists found.</p>
            @endforelse
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
    @include('footer')
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

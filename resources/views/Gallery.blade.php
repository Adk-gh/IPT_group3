<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Street & Ink</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
    <script src="{{ asset('js/gallery.js') }}"></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header id="header">
        @include('header')
    </header>

    <!-- Gallery Hero -->
    <section class="section gallery-hero">
        <div class="container">
            <h1 class="section-title">Street Art Gallery</h1>
            <p class="text-center">Explore thousands of street artworks from around the world. Filter by location, artist, or style to discover new urban masterpieces.</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section">
        <div class="container">
            <div class="gallery-options">
                <div class="gallery-filter">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">Murals</button>
                    <button class="filter-btn">Graffiti</button>
                    <button class="filter-btn">Stencils</button>
                    <button class="filter-btn">Installations</button>
                    <button class="filter-btn">Political</button>
                    <button class="filter-btn">Abstract</button>
                </div>

                <div class="view-options">
                    <div class="view-option active">
                        <i class="fas fa-th"></i>
                    </div>
                    <div class="view-option">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <div class="view-option">
                        <i class="fas fa-th-list"></i>
                    </div>
                    <div class="sort-options">
                        <div class="sort-toggle">
                            <span>Sort by</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="sort-dropdown">
                            <div class="sort-option">Most Recent</div>
                            <div class="sort-option">Most Popular</div>
                            <div class="sort-option">Artist Name</div>
                            <div class="sort-option">Location</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-grid">
                <!-- Artwork 1 -->
                <div class="gallery-item">
                    <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Urban Dreams">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Urban Dreams</h3>
                        <p class="gallery-item-artist">Banksy (unconfirmed)</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Shoreditch, London
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Stencil</span>
                            <span class="gallery-item-tag">Political</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 2 -->
                <div class="gallery-item">
                    <img src="img/pexels-conojeghuo-173301.jpg" alt="Color Explosion">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Color Explosion</h3>
                        <p class="gallery-item-artist">Maya Hayuk</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Williamsburg, NYC
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Mural</span>
                            <span class="gallery-item-tag">Abstract</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 3 -->
                <div class="gallery-item">
                    <img src="img/pexels-fernando-dos-santos-campos-1309016-2510245 (1).jpg" alt="The Thinker">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">The Thinker</h3>
                        <p class="gallery-item-artist">Unknown Artist</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Berlin, Germany
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Portrait</span>
                            <span class="gallery-item-tag">Monochrome</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 4 -->
                <div class="gallery-item">
                    <img src="img/pexels-heftiba-1194420.jpg" alt="Neon Dreams">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Neon Dreams</h3>
                        <p class="gallery-item-artist">D*Face</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Downtown LA
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Pop Art</span>
                            <span class="gallery-item-tag">Neon</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 5 -->
                <div class="gallery-item">
                    <img src="img/pexels-tobiasbjorkli-2119706 (1).jpg" alt="Abstract Flow">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Abstract Flow</h3>
                        <p class="gallery-item-artist">Felipe Pantone</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Wynwood, Miami
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Abstract</span>
                            <span class="gallery-item-tag">Geometric</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 6 -->
                <div class="gallery-item">
                    <img src="img/pexels-arantxa-treva-351075-959314 (1).jpg" alt="Cultural Fusion">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Cultural Fusion</h3>
                        <p class="gallery-item-artist">Shepard Fairey</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Little Tokyo, LA
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Cultural</span>
                            <span class="gallery-item-tag">Portrait</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 7 -->
                <div class="gallery-item">
                    <img src="img/pexels-brett-sayles-1121894.jpg" alt="Political Statement">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Political Statement</h3>
                        <p class="gallery-item-artist">Various Artists</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Berlin Wall, Germany
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Political</span>
                            <span class="gallery-item-tag">Historical</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 8 -->
                <div class="gallery-item">
                    <img src="img/pexels-ibrahim-hafeez-563364-1319828.jpg" alt="Ocean Waves">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Ocean Waves</h3>
                        <p class="gallery-item-artist">Carlos M.</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Lisbon, Portugal
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Mural</span>
                            <span class="gallery-item-tag">Nature</span>
                        </div>
                    </div>
                </div>

                <!-- Artwork 9 -->
                <div class="gallery-item">
                    <img src="img/pexels-khalidgarcia-1376092.jpg" alt="Geometric Patterns">
                    <div class="gallery-item-overlay">
                        <h3 class="gallery-item-title">Geometric Patterns</h3>
                        <p class="gallery-item-artist">Aisha M.</p>
                        <div class="gallery-item-location">
                            <i class="fas fa-map-marker-alt"></i> Barcelona, Spain
                        </div>
                        <div class="gallery-item-tags">
                            <span class="gallery-item-tag">Abstract</span>
                            <span class="gallery-item-tag">Geometric</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="load-more">
                <button class="btn btn-primary">Load More</button>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-content">
            <span class="lightbox-close">&times;</span>
            <img src="" alt="" class="lightbox-img">
            <div class="lightbox-nav">
                <button class="lightbox-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                <button class="lightbox-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="lightbox-info">
                <h3 id="lightbox-title">Artwork Title</h3>
                <p id="lightbox-artist">Artist Name</p>
                <p id="lightbox-location"><i class="fas fa-map-marker-alt"></i> Location</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        @include('footer')
    </footer>


<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

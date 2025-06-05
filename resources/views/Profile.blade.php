<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Auth::user()->name }} | Street & Ink Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <script src="{{ asset('js/profile.js') }}" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header id="header">
        @include('header')
    </header>

    <!-- Profile Banner -->
    <section class="profile-banner">
        <button class="cover-edit-btn" id="coverEditBtn">
            <i class="fas fa-camera"></i>
        </button>

        <div class="cover-edit-form" id="coverEditForm">
            <h4>Change Cover Photo</h4>
            <form id="coverPhotoForm" enctype="multipart/form-data">
                @csrf
                <input type="file" name="cover_photo" accept="image/*" style="margin-bottom: 10px;">
                <div class="bio-edit-buttons">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" id="cancelCoverEdit" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>

        <img src="{{ Auth::user()->cover_photo ?? 'https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80' }}"
             alt="Profile Banner" class="banner-image" id="bannerImage">
        <div class="banner-overlay">
            <div class="profile-header">
                <img src="{{ Auth::user()->avatar ?? 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80' }}"
                     alt="{{ Auth::user()->name }}" class="profile-avatar">
                <div class="profile-info">
                    <h1 class="profile-name">{{ Auth::user()->name }}</h1>
                    <div class="profile-username">
                        @if(Auth::user()->verified)
                            <i class="fas fa-check-circle verified-badge"></i>
                        @endif
                    </div>
                    <div class="profile-bio-container">
                        <p class="profile-bio" id="profileBio">{{ Auth::user()->bio ?? 'add bio' }}</p>
                       <button class="edit-bio-btn" id="editBioBtn">
    <i class="fas fa-pencil-alt"></i>
</button>
                        <div class="bio-edit-form" id="bioEditForm">
                            <form id="bioForm">
                                @csrf
                                <textarea id="bioTextarea" name="bio">{{ Auth::user()->bio ?? 'add bio' }}</textarea>
                                <div class="bio-edit-buttons">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" id="cancelBioEdit" class="btn btn-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="profile-location">
                        <i class="fas fa-map-marker-alt"></i> {{ Auth::user()->location ?? 'Manila, Philippines' }}
                    </div>
                    <div class="social-links">
                        @if(Auth::user()->instagram)
                            <a href="{{ Auth::user()->instagram }}" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(Auth::user()->tiktok)
                            <a href="{{ Auth::user()->tiktok }}" class="social-link" target="_blank"><i class="fab fa-tiktok"></i></a>
                        @endif
                        @if(Auth::user()->website)
                            <a href="{{ Auth::user()->website }}" class="social-link" target="_blank"><i class="fas fa-globe"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">27</div>
                    <div class="stat-label">Artworks Uploaded</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">1.4k</div>
                    <div class="stat-label">Likes Received</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">10.2k</div>
                    <div class="stat-label">Total Views</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Tagged Locations</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5</div>
                    <div class="stat-label">Collaborations</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Tabs -->
    <div class="container">
        <div class="profile-tabs">
            <div class="profile-tab active" data-tab="art"><i class="fas fa-paint-brush"></i> My Art</div>
            <div class="profile-tab" data-tab="map"><i class="fas fa-map-marked-alt"></i> Map View</div>
            <div class="profile-tab" data-tab="collections"><i class="fas fa-folder"></i> Collections</div>
            <div class="profile-tab" data-tab="liked"><i class="fas fa-heart"></i> Liked Art</div>
            <div class="profile-tab" data-tab="comments"><i class="fas fa-comment"></i> Comments</div>
        </div>
    </div>

    <!-- Art Gallery -->
    <section class="container" id="art-tab">
        <div class="gallery-grid">
            <!-- Artwork 1 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Urban Dreams">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 248</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 32</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Urban Dreams</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Cavite Skatepark, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> May 15, 2023</div>
                        <div class="art-card-stat">#Graffiti #Abstract</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 2 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Color Explosion">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 187</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 24</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Color Explosion</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Makati Backstreets, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> April 2, 2023</div>
                        <div class="art-card-stat">#Mural #Colorful</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 3 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Neon Nights">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 312</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 45</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Neon Nights</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Bonifacio Global City, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> March 18, 2023</div>
                        <div class="art-card-stat">#Neon #Urban</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 4 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Political Statement">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 421</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 67</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Political Statement</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Quezon City, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> February 5, 2023</div>
                        <div class="art-card-stat">#Political #Stencil</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 5 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Abstract Flow">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 156</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 18</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Abstract Flow</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Pasig River Wall, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> January 22, 2023</div>
                        <div class="art-card-stat">#Abstract #Geometric</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 6 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Cultural Fusion">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 203</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 29</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Cultural Fusion</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Intramuros, Manila
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> December 10, 2022</div>
                        <div class="art-card-stat">#Cultural #Traditional</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artist Spotlight -->
    <section class="artist-spotlight">
        <div class="container">
            <div class="spotlight-header">
                <h2>Artist Spotlight</h2>
                <p>Get to know the artist behind the artworks</p>
            </div>
            <div class="spotlight-content">
                <div class="spotlight-image">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Featured Artwork">
                </div>
                <div class="spotlight-info">
                    <h3>Featured Artwork: "Urban Dreams"</h3>
                    <p class="spotlight-statement">
                        "My work explores the intersection of urban decay and vibrant renewal. I see walls as blank canvases that tell the stories of our cities. Through bold colors and abstract forms, I aim to transform forgotten spaces into places of beauty and conversation."
                    </p>
                    <div class="spotlight-tools">
                        <div class="tools-title">Tools & Styles I Use:</div>
                        <div class="tools-list">
                            <span class="tool-tag">Spray Paint</span>
                            <span class="tool-tag">Acrylic</span>
                            <span class="tool-tag">Stencils</span>
                            <span class="tool-tag">Abstract</span>
                            <span class="tool-tag">Geometric</span>
                            <span class="tool-tag">Street Art</span>
                        </div>
                    </div>
                    <div style="margin-top: 30px;">
                        <a href="#" class="btn btn-primary"><i class="fas fa-play"></i> Watch Process Video</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-header">
                <h2>Collaborations & Testimonials</h2>
                <p>What others say about working with Juno Art</p>
            </div>
            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Juno transformed our dull warehouse wall into a vibrant masterpiece that has become a local landmark. Their attention to detail and unique style brought our vision to life beyond expectations."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Maria Santos" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Maria Santos <span class="collab-tag">Collaboration</span></div>
                            <div class="author-role">Owner, Santos Warehouse</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "We commissioned Juno for our street art festival and their piece was the talk of the event. Their ability to adapt their style while maintaining their unique voice is remarkable."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos Reyes" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Carlos Reyes</div>
                            <div class="author-role">Director, Manila Urban Arts Festival</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Working with Juno on our community mural project was a dream. They engaged with local youth and created something that truly represents our neighborhood's spirit."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Lena Cruz" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Lena Cruz <span class="collab-tag">Collaboration</span></div>
                            <div class="author-role">Community Leader, Barangay 143</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container contact-container">
            <h2 class="contact-title">Contact Juno Art</h2>
            <p class="contact-description">
                Interested in commissioning work or collaborating? Get in touch with Juno for project inquiries, exhibition opportunities, or just to say hello.
            </p>
            <div class="contact-buttons">
                <a href="#" class="btn btn-primary btn-large"><i class="fas fa-envelope"></i> Send Message</a>
                <a href="#" class="btn btn-outline btn-large"><i class="fas fa-calendar-check"></i> Book Commission</a>
            </div>
        </div>
    </section>

    <!-- Map View (Hidden by default) -->
    <section class="container" id="map-tab" style="display: none;">
        <div class="map-container">
            <div id="profileMap"></div>
        </div>
    </section>

    <!-- Collections (Hidden by default) -->
    <section class="container" id="collections-tab" style="display: none;">
        <h2>Collections</h2>
        <p>Organized galleries of Juno's artwork by theme or project</p>

        <div class="collections-grid">
            <!-- Collection 1 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Urban Series">
                    <span class="collection-count">8 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Urban Series</h3>
                    <p class="collection-description">Exploring the textures and rhythms of city life</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>

            <!-- Collection 2 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Political Works">
                    <span class="collection-count">5 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Political Works</h3>
                    <p class="collection-description">Commentary on social and political issues</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>

            <!-- Collection 3 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Neon Dreams">
                    <span class="collection-count">3 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Neon Dreams</h3>
                    <p class="collection-description">Vibrant night-inspired pieces</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>

            <!-- Collection 4 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Collaborations">
                    <span class="collection-count">5 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Collaborations</h3>
                    <p class="collection-description">Works created with other artists</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Liked Art (Hidden by default) -->
    <section class="container" id="liked-tab" style="display: none;">
        <h2>Liked Artworks</h2>
        <p>Artworks that Juno has liked and saved</p>

        <div class="liked-art-grid">
            <!-- Liked Art 1 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Abstract Flow">
                </div>
            </div>

            <!-- Liked Art 2 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Color Explosion">
                </div>
            </div>

            <!-- Liked Art 3 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Urban Dreams">
                </div>
            </div>

            <!-- Liked Art 4 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Neon Nights">
                </div>
            </div>

            <!-- Liked Art 5 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Political Statement">
                </div>
            </div>

            <!-- Liked Art 6 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Cultural Fusion">
                </div>
            </div>
        </div>
    </section>

    <!-- Comments (Hidden by default) -->
    <section class="container" id="comments-tab" style="display: none;">
        <h2>Recent Comments</h2>
        <p>Juno's recent activity on Street & Ink</p>

        <div class="comments-section">
            <!-- Comment 1 -->
            <div class="comment-card">
                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Juno Art" class="comment-avatar">
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Juno Art</span>
                        <span class="comment-time">2 hours ago</span>
                    </div>
                    <div class="comment-text">
                        This piece is incredible! The use of color gradients is exactly what I've been trying to master in my own work.
                    </div>
                    <div class="comment-artwork">
                        <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Artwork">
                        <span>Comment on "Abstract Flow" by Maya Hayuk</span>
                    </div>
                </div>
            </div>

            <!-- Comment 2 -->
            <div class="comment-card">
                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Juno Art" class="comment-avatar">
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Juno Art</span>
                        <span class="comment-time">1 day ago</span>
                    </div>
                    <div class="comment-text">
                        The stencil work here is so clean! What brand of spray paint do you use for such precise lines?
                    </div>
                    <div class="comment-artwork">
                        <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Artwork">
                        <span>Comment on "Political Statement" by Banksy</span>
                    </div>
                </div>
            </div>

            <!-- Comment 3 -->
            <div class="comment-card">
                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Juno Art" class="comment-avatar">
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Juno Art</span>
                        <span class="comment-time">3 days ago</span>
                    </div>
                    <div class="comment-text">
                        This location is perfect for your piece! The natural lighting really makes the colors pop at golden hour.
                    </div>
                    <div class="comment-artwork">
                        <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artwork">
                        <span>Comment on "Neon Dreams" by Felipe Pantone</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

            <div class="footer-support" style="margin-top: 40px; text-align: center;">
                <h3 style="color: var(--white); margin-bottom: 20px;">Support Street & Ink</h3>
                <p style="opacity: 0.8; margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Help us continue documenting and celebrating street art around the world. Your support keeps our community thriving.
                </p>
                <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 30px;">
                    <a href="#" class="btn btn-primary" style="padding: 10px 20px;">Support</a>
                    <a href="#" class="btn btn-secondary" style="padding: 10px 20px; background-color: transparent; border-color: var(--white); color: var(--white);">Become a Member</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2023 Street & Ink. All rights reserved. | <a href="#" style="color: var(--accent);">Privacy Policy</a> | <a href="#" style="color: var(--accent);">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
      // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const nav = document.getElementById('nav');

    mobileMenuBtn.addEventListener('click', () => {
        nav.classList.toggle('active');
        mobileMenuBtn.innerHTML = nav.classList.contains('active') ?
            '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
    });

        // Header Scroll Effect
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Bio Edit Functionality
    const editBioBtn = document.getElementById('editBioBtn');
    const bioEditForm = document.getElementById('bioEditForm');
    const bioForm = document.getElementById('bioForm');
    const cancelBioEdit = document.getElementById('cancelBioEdit');
    const profileBio = document.getElementById('profileBio');
    const bioTextarea = document.getElementById('bioTextarea');

    editBioBtn.addEventListener('click', () => {
        profileBio.style.display = 'none';
        editBioBtn.style.display = 'none';
        bioEditForm.style.display = 'block';
    });

    cancelBioEdit.addEventListener('click', () => {
        profileBio.style.display = 'block';
        editBioBtn.style.display = 'block';
        bioEditForm.style.display = 'none';
        bioTextarea.value = profileBio.textContent;
    });

    bioForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(bioForm);

        fetch('/profile/update-bio', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                profileBio.textContent = bioTextarea.value;
                profileBio.style.display = 'block';
                editBioBtn.style.display = 'block';
                bioEditForm.style.display = 'none';
            } else {
                alert('Failed to update bio. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the bio.');
        });
    });

       // Cover Photo Edit Functionality
    const coverEditBtn = document.getElementById('coverEditBtn');
    const coverEditForm = document.getElementById('coverEditForm');
    const coverPhotoForm = document.getElementById('coverPhotoForm');
    const cancelCoverEdit = document.getElementById('cancelCoverEdit');
    const bannerImage = document.getElementById('bannerImage');

    coverEditBtn.addEventListener('click', () => {
        coverEditForm.style.display = coverEditForm.style.display === 'block' ? 'none' : 'block';
    });

    cancelCoverEdit.addEventListener('click', () => {
        coverEditForm.style.display = 'none';
        coverPhotoForm.reset();
    });

    coverPhotoForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(coverPhotoForm);

        fetch('/profile/update-cover', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                bannerImage.src = data.cover_photo_url;
                coverEditForm.style.display = 'none';
                coverPhotoForm.reset();
            } else {
                alert('Failed to update cover photo. Please ensure the file is a valid image (jpeg, png, jpg, gif) and under 2MB.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the cover photo.');
        });
    });



    <!-- Profile Tabs -->
    <div class="container">
        <div class="profile-tabs">
            <div class="profile-tab active" data-tab="art"><i class="fas fa-paint-brush"></i> My Art</div>
            <div class="profile-tab" data-tab="map"><i class="fas fa-map-marked-alt"></i> Map View</div>
            <div class="profile-tab" data-tab="collections"><i class="fas fa-folder"></i> Collections</div>
            <div class="profile-tab" data-tab="liked"><i class="fas fa-heart"></i> Liked Art</div>
            <div class="profile-tab" data-tab="comments"><i class="fas fa-comment"></i> Comments</div>
        </div>
    </div>

    <!-- Art Gallery -->
    <section class="container" id="art-tab">
        <div class="gallery-grid">
            <!-- Artwork 1 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Urban Dreams">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 248</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 32</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Urban Dreams</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Cavite Skatepark, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> May 15, 2023</div>
                        <div class="art-card-stat">#Graffiti #Abstract</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 2 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Color Explosion">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 187</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 24</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Color Explosion</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Makati Backstreets, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> April 2, 2023</div>
                        <div class="art-card-stat">#Mural #Colorful</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 3 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Neon Nights">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 312</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 45</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Neon Nights</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Bonifacio Global City, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> March 18, 2023</div>
                        <div class="art-card-stat">#Neon #Urban</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 4 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Political Statement">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 421</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 67</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Political Statement</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Quezon City, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> February 5, 2023</div>
                        <div class="art-card-stat">#Political #Stencil</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 5 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Abstract Flow">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 156</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 18</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Abstract Flow</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Pasig River Wall, Philippines
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> January 22, 2023</div>
                        <div class="art-card-stat">#Abstract #Geometric</div>
                    </div>
                </div>
            </div>

            <!-- Artwork 6 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Cultural Fusion">
                    <div class="art-card-overlay">
                        <div class="art-card-stats">
                            <div class="art-card-stat"><i class="fas fa-heart"></i> 203</div>
                            <div class="art-card-stat"><i class="fas fa-comment"></i> 29</div>
                        </div>
                        <a href="#" class="btn btn-primary" style="margin-top: 10px;">View on Map</a>
                    </div>
                </div>
                <div class="art-card-content">
                    <h3 class="art-card-title">Cultural Fusion</h3>
                    <div class="art-card-location">
                        <i class="fas fa-map-marker-alt"></i> Intramuros, Manila
                    </div>
                    <div class="art-card-stats">
                        <div class="art-card-stat"><i class="fas fa-calendar-alt"></i> December 10, 2022</div>
                        <div class="art-card-stat">#Cultural #Traditional</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artist Spotlight -->
    <section class="artist-spotlight">
        <div class="container">
            <div class="spotlight-header">
                <h2>Artist Spotlight</h2>
                <p>Get to know the artist behind the artworks</p>
            </div>
            <div class="spotlight-content">
                <div class="spotlight-image">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Featured Artwork">
                </div>
                <div class="spotlight-info">
                    <h3>Featured Artwork: "Urban Dreams"</h3>
                    <p class="spotlight-statement">
                        "My work explores the intersection of urban decay and vibrant renewal. I see walls as blank canvases that tell the stories of our cities. Through bold colors and abstract forms, I aim to transform forgotten spaces into places of beauty and conversation."
                    </p>
                    <div class="spotlight-tools">
                        <div class="tools-title">Tools & Styles I Use:</div>
                        <div class="tools-list">
                            <span class="tool-tag">Spray Paint</span>
                            <span class="tool-tag">Acrylic</span>
                            <span class="tool-tag">Stencils</span>
                            <span class="tool-tag">Abstract</span>
                            <span class="tool-tag">Geometric</span>
                            <span class="tool-tag">Street Art</span>
                        </div>
                    </div>
                    <div style="margin-top: 30px;">
                        <a href="#" class="btn btn-primary"><i class="fas fa-play"></i> Watch Process Video</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-header">
                <h2>Collaborations & Testimonials</h2>
                <p>What others say about working with Juno Art</p>
            </div>
            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Juno transformed our dull warehouse wall into a vibrant masterpiece that has become a local landmark. Their attention to detail and unique style brought our vision to life beyond expectations."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Maria Santos" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Maria Santos <span class="collab-tag">Collaboration</span></div>
                            <div class="author-role">Owner, Santos Warehouse</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "We commissioned Juno for our street art festival and their piece was the talk of the event. Their ability to adapt their style while maintaining their unique voice is remarkable."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos Reyes" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Carlos Reyes</div>
                            <div class="author-role">Director, Manila Urban Arts Festival</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Working with Juno on our community mural project was a dream. They engaged with local youth and created something that truly represents our neighborhood's spirit."
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Lena Cruz" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Lena Cruz <span class="collab-tag">Collaboration</span></div>
                            <div class="author-role">Community Leader, Barangay 143</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container contact-container">
            <h2 class="contact-title">Contact Juno Art</h2>
            <p class="contact-description">
                Interested in commissioning work or collaborating? Get in touch with Juno for project inquiries, exhibition opportunities, or just to say hello.
            </p>
            <div class="contact-buttons">
                <a href="#" class="btn btn-primary btn-large"><i class="fas fa-envelope"></i> Send Message</a>
                <a href="#" class="btn btn-outline btn-large"><i class="fas fa-calendar-check"></i> Book Commission</a>
            </div>
        </div>
    </section>

    <!-- Map View (Hidden by default) -->
    <section class="container" id="map-tab" style="display: none;">
        <div class="map-container">
            <div id="profileMap"></div>
        </div>
    </section>

    <!-- Collections (Hidden by default) -->
    <section class="container" id="collections-tab" style="display: none;">
        <h2>Collections</h2>
        <p>Organized galleries of Juno's artwork by theme or project</p>

        <div class="collections-grid">
            <!-- Collection 1 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Urban Series">
                    <span class="collection-count">8 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Urban Series</h3>
                    <p class="collection-description">Exploring the textures and rhythms of city life</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>

            <!-- Collection 2 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Political Works">
                    <span class="collection-count">5 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Political Works</h3>
                    <p class="collection-description">Commentary on social and political issues</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>

            <!-- Collection 3 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Neon Dreams">
                    <span class="collection-count">3 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Neon Dreams</h3>
                    <p class="collection-description">Vibrant night-inspired pieces</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>

            <!-- Collection 4 -->
            <div class="collection-card">
                <div class="collection-cover">
                    <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Collaborations">
                    <span class="collection-count">5 artworks</span>
                </div>
                <div class="collection-info">
                    <h3 class="collection-title">Collaborations</h3>
                    <p class="collection-description">Works created with other artists</p>
                    <a href="#" class="btn btn-outline" style="padding: 8px 15px; font-size: 0.9rem;">View Collection</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Liked Art (Hidden by default) -->
    <section class="container" id="liked-tab" style="display: none;">
        <h2>Liked Artworks</h2>
        <p>Artworks that Juno has liked and saved</p>

        <div class="liked-art-grid">
            <!-- Liked Art 1 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Abstract Flow">
                </div>
            </div>

            <!-- Liked Art 2 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Color Explosion">
                </div>
            </div>

            <!-- Liked Art 3 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Urban Dreams">
                </div>
            </div>

            <!-- Liked Art 4 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Neon Nights">
                </div>
            </div>

            <!-- Liked Art 5 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Political Statement">
                </div>
            </div>

            <!-- Liked Art 6 -->
            <div class="art-card">
                <div class="art-card-img">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Cultural Fusion">
                </div>
            </div>
        </div>
    </section>

    <!-- Comments (Hidden by default) -->
    <section class="container" id="comments-tab" style="display: none;">
        <h2>Recent Comments</h2>
        <p>Juno's recent activity on Street & Ink</p>

        <div class="comments-section">
            <!-- Comment 1 -->
            <div class="comment-card">
                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Juno Art" class="comment-avatar">
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Juno Art</span>
                        <span class="comment-time">2 hours ago</span>
                    </div>
                    <div class="comment-text">
                        This piece is incredible! The use of color gradients is exactly what I've been trying to master in my own work.
                    </div>
                    <div class="comment-artwork">
                        <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Artwork">
                        <span>Comment on "Abstract Flow" by Maya Hayuk</span>
                    </div>
                </div>
            </div>

            <!-- Comment 2 -->
            <div class="comment-card">
                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Juno Art" class="comment-avatar">
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Juno Art</span>
                        <span class="comment-time">1 day ago</span>
                    </div>
                    <div class="comment-text">
                        The stencil work here is so clean! What brand of spray paint do you use for such precise lines?
                    </div>
                    <div class="comment-artwork">
                        <img src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80" alt="Artwork">
                        <span>Comment on "Political Statement" by Banksy</span>
                    </div>
                </div>
            </div>

            <!-- Comment 3 -->
            <div class="comment-card">
                <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Juno Art" class="comment-avatar">
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Juno Art</span>
                        <span class="comment-time">3 days ago</span>
                    </div>
                    <div class="comment-text">
                        This location is perfect for your piece! The natural lighting really makes the colors pop at golden hour.
                    </div>
                    <div class="comment-artwork">
                        <img src="https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Artwork">
                        <span>Comment on "Neon Dreams" by Felipe Pantone</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

            <div class="footer-support" style="margin-top: 40px; text-align: center;">
                <h3 style="color: var(--white); margin-bottom: 20px;">Support Street & Ink</h3>
                <p style="opacity: 0.8; margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Help us continue documenting and celebrating street art around the world. Your support keeps our community thriving.
                </p>
                <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 30px;">
                    <a href="#" class="btn btn-primary" style="padding: 10px 20px;">Support</a>
                    <a href="#" class="btn btn-secondary" style="padding: 10px 20px; background-color: transparent; border-color: var(--white); color: var(--white);">Become a Member</a>
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

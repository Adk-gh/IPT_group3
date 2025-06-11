<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>All Articles | Street & Ink</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/articles.css') }}" rel="stylesheet">
    <script src="{{ asset('js/articles.js') }}"></script>
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Fixed Header -->
    <header id="header">
         @include('header')
    </header>

    <!-- Hero Section -->
    <section class="articles-hero">
        <div class="container">
            <span class="articles-tagline">🎨 Stay inspired. Stay inked.</span>
            <h1>All Articles</h1>
            <p>Street stories, artist spotlights, and urban culture insights from around the globe.</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="articles-filter">
        <div class="container">
            <div class="filter-container">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search articles...">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>

                <div class="filter-group">
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            Categories <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-item">Artist Spotlight</div>
                            <div class="dropdown-item">City Guides</div>
                            <div class="dropdown-item">Graffiti Culture</div>
                            <div class="dropdown-item">Events</div>
                            <div class="dropdown-item">Interviews</div>
                            <div class="dropdown-item">Tips & Tutorials</div>
                        </div>
                    </div>

                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            Sort by: Newest <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-item">Newest</div>
                            <div class="dropdown-item">Most Popular</div>
                            <div class="dropdown-item">Recommended</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tag-filters">
                <div class="tag-filter active">All</div>
                <div class="tag-filter">#Graffiti</div>
                <div class="tag-filter">#Murals</div>
                <div class="tag-filter">#StreetArt</div>
                <div class="tag-filter">#UrbanCulture</div>
                <div class="tag-filter">#ArtistSpotlight</div>
                <div class="tag-filter">#NYC</div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="section">
        <div class="container">
            <div class="articles-main">
                <div class="articles-grid">
                    <!-- Featured Article -->
                    <div class="featured-article">
                        <div class="featured-image">
                            <img src="img/pexels-brett-sayles-1121894.jpg" alt="Featured Article">
                        </div>
                        <div class="featured-content">
                            <span class="featured-badge">Featured</span>
                            <h2>The Rise of Political Street Art in 2023</h2>
                            <p>How artists are using urban spaces to comment on current events and social issues around the world, with exclusive interviews from Berlin to Buenos Aires.</p>

                            <div class="article-meta">
                                <div class="author-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Author">
                                </div>
                                <div class="meta-text">
                                    <div class="author-name">Sarah Chen</div>
                                    <div class="article-date">June 15, 2023</div>
                                </div>
                                <div class="read-time">
                                    <i class="far fa-clock"></i> 8 min read
                                </div>
                            </div>

                            <div class="article-tags">
                                <span class="article-tag">#PoliticalArt</span>
                                <span class="article-tag">#Global</span>
                                <span class="article-tag">#Trending</span>
                            </div>

                            <a href="#" class="btn btn-primary" style="margin-top: 20px; align-self: flex-start;">Read Article</a>
                        </div>
                    </div>

                    <!-- Articles Grid -->
                    <div class="articles-container">
                        <!-- Article 1 -->
                        <div class="article-card">
                            <div class="article-image">
                                <img src="img/pexels-ibrahim-hafeez-563364-1319828.jpg" alt="Article Image">
                            </div>
                            <div class="article-content">
                                <h3>Interview: The Neon Artist Lighting Up Downtown LA</h3>
                                <p class="article-excerpt">We sit down with the anonymous artist behind the glowing murals transforming the city's nightscape.</p>

                                <div class="article-meta">
                                    <div class="author-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Author">
                                    </div>
                                    <div class="meta-text">
                                        <div class="author-name">Marcus Johnson</div>
                                        <div class="article-date">June 8, 2023</div>
                                    </div>
                                    <div class="read-time">
                                        <i class="far fa-clock"></i> 5 min read
                                    </div>
                                </div>

                                <div class="article-tags">
                                    <span class="article-tag">#Interview</span>
                                    <span class="article-tag">#LA</span>
                                </div>
                            </div>
                        </div>

                        <!-- Article 2 -->
                        <div class="article-card">
                            <div class="article-image">
                                <img src="img/pexels-khalidgarcia-1376092.jpg" alt="Article Image">
                            </div>
                            <div class="article-content">
                                <h3>Street Art Festivals You Can't Miss This Summer</h3>
                                <p class="article-excerpt">From Berlin to Buenos Aires, here are the must-visit urban art events of the season.</p>

                                <div class="article-meta">
                                    <div class="author-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Author">
                                    </div>
                                    <div class="meta-text">
                                        <div class="author-name">Lena Kowalski</div>
                                        <div class="article-date">May 30, 2023</div>
                                    </div>
                                    <div class="read-time">
                                        <i class="far fa-clock"></i> 4 min read
                                    </div>
                                </div>

                                <div class="article-tags">
                                    <span class="article-tag">#Events</span>
                                    <span class="article-tag">#Global</span>
                                </div>
                            </div>
                        </div>

                        <!-- Article 3 -->
                        <div class="article-card">
                            <div class="article-image">
                                <img src="img/pexels-arantxa-treva-351075-959314 (1).jpg" alt="Article Image">
                            </div>
                            <div class="article-content">
                                <h3>Tokyo's Underground Street Art Scene</h3>
                                <p class="article-excerpt">Exploring the hidden world of urban art in Japan's bustling capital city.</p>

                                <div class="article-meta">
                                    <div class="author-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Author">
                                    </div>
                                    <div class="meta-text">
                                        <div class="author-name">David Park</div>
                                        <div class="article-date">May 22, 2023</div>
                                    </div>
                                    <div class="read-time">
                                        <i class="far fa-clock"></i> 6 min read
                                    </div>
                                </div>

                                <div class="article-tags">
                                    <span class="article-tag">#Tokyo</span>
                                    <span class="article-tag">#CityGuide</span>
                                </div>
                            </div>
                        </div>

                        <!-- Article 4 -->
                        <div class="article-card">
                            <div class="article-image">
                                <img src="img/pexels-tobiasbjorkli-2119706 (1).jpg" alt="Article Image">
                            </div>
                            <div class="article-content">
                                <h3>How to Photograph Street Art Like a Pro</h3>
                                <p class="article-excerpt">Tips from professional photographers on capturing the perfect shot of urban artworks.</p>

                                <div class="article-meta">
                                    <div class="author-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Author">
                                    </div>
                                    <div class="meta-text">
                                        <div class="author-name">Priya Kumar</div>
                                        <div class="article-date">May 15, 2023</div>
                                    </div>
                                    <div class="read-time">
                                        <i class="far fa-clock"></i> 7 min read
                                    </div>
                                </div>

                                <div class="article-tags">
                                    <span class="article-tag">#Photography</span>
                                    <span class="article-tag">#Tips</span>
                                </div>
                            </div>
                        </div>

                        <!-- Article 5 -->
                        <div class="article-card">
                            <div class="article-image">
                                <img src="img/pexels-heftiba-1194420.jpg" alt="Article Image">
                            </div>
                            <div class="article-content">
                                <h3>The Evolution of Graffiti Lettering Styles</h3>
                                <p class="article-excerpt">Tracing the history and development of typography in urban art from the 1970s to today.</p>

                                <div class="article-meta">
                                    <div class="author-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Author">
                                    </div>
                                    <div class="meta-text">
                                        <div class="author-name">James Lopez</div>
                                        <div class="article-date">May 8, 2023</div>
                                    </div>
                                    <div class="read-time">
                                        <i class="far fa-clock"></i> 10 min read
                                    </div>
                                </div>

                                <div class="article-tags">
                                    <span class="article-tag">#Graffiti</span>
                                    <span class="article-tag">#History</span>
                                </div>
                            </div>
                        </div>

                        <!-- Article 6 -->
                        <div class="article-card">
                            <div class="article-image">
                                <img src="img/pexels-fernando-dos-santos-campos-1309016-2510245 (1).jpg" alt="Article Image">
                            </div>
                            <div class="article-content">
                                <h3>Street Art Conservation: Preserving Urban Masterpieces</h3>
                                <p class="article-excerpt">The challenges and techniques of protecting ephemeral street artworks from the elements.</p>

                                <div class="article-meta">
                                    <div class="author-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Author">
                                    </div>
                                    <div class="meta-text">
                                        <div class="author-name">Aisha Mohammed</div>
                                        <div class="article-date">April 30, 2023</div>
                                    </div>
                                    <div class="read-time">
                                        <i class="far fa-clock"></i> 8 min read
                                    </div>
                                </div>

                                <div class="article-tags">
                                    <span class="article-tag">#Conservation</span>
                                    <span class="article-tag">#UrbanArt</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <div class="page-btn disabled">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="page-btn active">1</div>
                        <div class="page-btn">2</div>
                        <div class="page-btn">3</div>
                        <div class="page-btn">4</div>
                        <div class="page-btn">5</div>
                        <div class="page-btn">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="articles-sidebar">
                    <div class="sidebar-widget">
                        <h3>Trending Now</h3>

                        <div class="trending-article">
                            <div class="trending-image">
                                <img src="img/pexels-conojeghuo-173301.jpg" alt="Trending Article">
                            </div>
                            <div class="trending-content">
                                <h4>Banksy's Latest Work Sparks Controversy</h4>
                                <div class="trending-meta">June 12, 2023 • 5 min read</div>
                            </div>
                        </div>

                        <div class="trending-article">
                            <div class="trending-image">
                                <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Trending Article">
                            </div>
                            <div class="trending-content">
                                <h4>Women in Street Art: Breaking Barriers</h4>
                                <div class="trending-meta">June 5, 2023 • 7 min read</div>
                            </div>
                        </div>

                        <div class="trending-article">
                            <div class="trending-image">
                                <img src="img/pexels-heftiba-1194420.jpg" alt="Trending Article">
                            </div>
                            <div class="trending-content">
                                <h4>How Augmented Reality is Changing Street Art</h4>
                                <div class="trending-meta">May 28, 2023 • 6 min read</div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h3>Popular Tags</h3>
                        <div class="tags-container">
                            <div class="tag">#Graffiti</div>
                            <div class="tag">#Murals</div>
                            <div class="tag">#Banksy</div>
                            <div class="tag">#NYC</div>
                            <div class="tag">#Berlin</div>
                            <div class="tag">#StreetArt</div>
                            <div class="tag">#UrbanArt</div>
                            <div class="tag">#Stencil</div>
                            <div class="tag">#Wheatpaste</div>
                            <div class="tag">#PoliticalArt</div>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h3>Newsletter</h3>
                        <p style="margin-bottom: 15px;">Get the latest articles delivered to your inbox.</p>
                        <input type="email" placeholder="Your email" style="width: 100%; padding: 12px; margin-bottom: 10px; border-radius: var(--border-radius); border: 1px solid #ddd;">
                        <button class="btn btn-primary" style="width: 100%;">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- CTA Section -->
    <section class="articles-cta">
        <div class="container">
            <h2>Got a story to tell?</h2>
            <p>Share your street art discoveries, artist interviews, or urban culture insights with our global community.</p>
            <a href="#" class="btn btn-primary btn-large">Submit Your Article</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
    @include('footer')
    </footer>


<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

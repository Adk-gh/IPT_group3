<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Feed | Street & Ink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <link href="{{ asset('css/socialfeed.css') }}" rel="stylesheet">
    <script src="{{ asset('js/socialfeed.js') }}" defer></script>
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">

</head>
<body>
    <header id="header">
        @include('header')
    </header>
@if(session('success'))
    <input type="hidden" id="postSuccessMessage" value="{{ session('success') }}">
@endif

    <section class="social-hero">
        <div class="container">
            <h1 class="section-title">Social Feed</h1>
            <p class="text-center">Real-time street art drops, user activity, and artist moments from around the world.</p>
        </div>
    </section>

    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="social-container">
                <div class="feed-content">
                    <div class="create-post">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="create-post-header">
                                <div class="user-avatar" style="display: flex; align-items: center; gap: 10px;">
                                    <img
                                        src="{{ Auth::user()->avatar_url ?? 'https://via.placeholder.com/50x50?text=User' }}"
                                        alt="{{ Auth::user()->name }}"
                                        style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;"
                                    >
                                    <span style="font-weight: bold;">{{ Auth::user()->name }}</span>
                                </div>


                                <input type="text" name="caption" class="post-input" placeholder="What street art did you discover today?" required>
                            </div>
                            <div id="photoPreviewContainer" style="margin-top: 10px; display: none;">
                                <img id="photoPreview" src="" alt="Selected Photo Preview" style="max-width: 100%; border-radius: 8px;">
                            </div>
                            <input type="file" name="image_url" id="photoInput" style="display: none;">
                            <div class="post-actions">
                                <div class="post-action" onclick="document.getElementById('photoInput').click();">
                                    <i class="fas fa-image"></i> Photo
                                </div>
                                <div class="post-action" id="locationToggle">
                                    <i class="fas fa-map-marker-alt"></i> Location
                                </div>
                                <div id="locationModal" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.6); z-index: 9999; justify-content: center; align-items: center;">
                                    <div style="background: white; padding: 20px; border-radius: 8px; width: 90%; max-width: 600px; position: relative;">
                                        <button id="closeModal" style="position: absolute; top: 10px; right: 15px; font-size: 1.5rem; border:none; background:none; cursor:pointer;">&times;</button>
                                        <h3>Select Location</h3>
                                        <div id="map" style="height: 400px; margin-bottom: 10px;"></div>
                                        <input type="text" name="location_name" id="location_name" placeholder="Location name" style="width: 100%; padding: 8px; margin-bottom: 10px;"/>
                                        <input type="hidden" name="latitude" id="latitude" placeholder="Latitude" />
                                        <input type="hidden" name="longitude" id="longitude" placeholder="Longitude" />
                                         <button id="clearLocation" class="btn btn-secondary" style="padding: 8px 16px;">Clear Location</button>
                                        <button id="saveLocation" class="btn btn-primary" style="float: right;">Save Location</button>
                                        <div style="clear: both;"></div>
                                    </div>
                                </div>
                                <div class="post-action tags-dropdown-container" id="tagsButton">
                                    <i class="fas fa-tag"></i> Tags
                                </div>
                                <div id="tagsDropdown" style="display:none; position: absolute; background: white; border: 1px solid #ddd; border-radius: 8px; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; margin-top: 8px; width: 200px; z-index: 10000;">
                                <!-- tags will be appended here -->
                                </div>
                                <input type="hidden" name="tags" id="selectedTagsInput">


                                <button type="submit" class="btn btn-primary" style="padding: 8px 20px;">Post</button>
                            </div>
                        </form>
                    </div>

                    <div class="feed-tabs">
                        <div class="feed-tab active">All</div>
                        <div class="feed-tab">Following</div>
                        <div class="feed-tab">Nearby</div>
                        <div class="feed-tab">Popular</div>
                    </div>
                    <div class="feed-posts">
                        <div class="loading-spinner" id="loadingSpinner" style="display: none;">
                            <div class="spinner"></div>
                        </div>
                        <div id="postSuccessMessageContainer" style="display: none; background: #dff0d8; color: #3c763d; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                            <p id="postSuccessMessageText"></p>
                        </div>
                        <div id="postsContainer">

@if($posts->isEmpty())
    <p>No posts found.</p>
@else
    @foreach($posts as $post)
        <div class="post-card">
            <div class="post-header">
                <div class="post-user">
                    <div class="post-user-avatar">
                        <img src="{{ $post->user->avatar ?? 'https://via.placeholder.com/50x50?text=User' }}" alt="User Avatar">
                        <div class="verified-badge">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="post-user-info">
                        <h4>{{ $post->user->name }}</h4>
                        <p>@{{ $post->user->username }}</p>
                    </div>
                </div>
                <div class="post-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{ $post->location_name ?? 'Unknown' }}</span>
                    <span><i class="far fa-clock"></i> {{ $post->created_at->diffForHumans() }}</span>
                </div>
                <div class="post-options">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
            </div>
            <div class="post-content">
                <div class="post-text">
                    {{ $post->caption }}
                </div>
                @if($post->image_url)
                    <div class="post-image">
                        <img src="{{ asset('storage/' . $post->image_url) }}" alt="Post Image">
                    </div>
                @endif
                <div class="post-tags">
                    @foreach($post->tags as $tag)
                        <a href="#" class="post-tag">#{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
            <div class="post-actions">
                <button class="post-action-btn like-btn">
                    <i class="far fa-heart"></i> <span class="like-count">{{ $post->likes_count ?? 0 }}</span>
                </button>
                <button class="post-action-btn comment-btn">
                    <i class="far fa-comment"></i> {{ $post->comments_count ?? 0 }}
                </button>
                <button class="post-action-btn share-btn">
                    <i class="fas fa-share"></i> Share
                </button>
                <button class="post-action-btn save-btn">
                    <i class="far fa-bookmark"></i> Save
                </button>
            </div>
            <!-- Comments could be rendered here similarly -->
        </div>
    @endforeach

    {{-- Pagination links --}}
    {{ $posts->links() }}
@endif



                </div>
            </div>
        </div>
    </section>

    <footer>
        @include('footer')
    </footer>

    <script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

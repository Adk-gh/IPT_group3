<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>About Us | Street & Ink</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/aboutus.css') }}" rel="stylesheet">
    <script src="{{ asset('js/aboutus.js') }}"></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header id="header">
        @include('header')
    </header>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>The Streets Tell Stories. We Help You Find Them.</h1>
            <p>Street and Ink is a movement — built to connect people with street art, culture, and creativity in every corner of the world.</p>
            <div style="margin-top: 40px;">
                <a href="#mission" class="btn btn-primary btn-large">Our Mission</a>
                <a href="#team" class="btn btn-secondary btn-large">Meet the Team</a>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="section mission" id="mission">
        <div class="container">
            <h2 class="section-title">Our Mission</h2>
            <p class="text-center">We believe street art is more than just color on a wall — it's culture, rebellion, beauty, and truth.</p>

            <div class="mission-container">
                <div class="mission-image">
                    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1528&q=80" alt="Our Mission">
                </div>
                <div class="mission-content">
                    <h3>Documenting Urban Creativity</h3>
                    <p>Our mission is to create a platform where anyone, anywhere can discover, appreciate, and share street art. We're building bridges between artists, enthusiasts, and the urban landscape that inspires us all.</p>
                    <p>Street art is ephemeral by nature — murals get painted over, stickers peel away, and installations disappear. We're here to preserve these creative moments and make them accessible to everyone.</p>
                </div>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="value-title">Connect Communities</h3>
                    <p>Bringing together street art lovers from around the world to share their discoveries and passion.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3 class="value-title">Preserve Art</h3>
                    <p>Creating a digital archive of urban art that might otherwise disappear from city walls.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="value-title">Promote Visibility</h3>
                    <p>Helping underground and local artists gain recognition for their public works.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="value-title">Easy Discovery</h3>
                    <p>Making finding street art as simple as dropping a pin on a map.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="section story" id="story">
        <div class="container">
            <h2 class="section-title">How It Started</h2>

            <div class="story-container">
                <p class="story-quote">It started with a single alley in Manila. A mural that spoke louder than words. We realized street art needs a home online — and so, Street and Ink was born.</p>

                <p>In 2018, our founder was traveling through Southeast Asia when they stumbled upon a breathtaking mural in a Manila backstreet. With no information about the artist or the artwork available, the experience sparked an idea: what if there was a way to document and share these urban masterpieces?</p>

                <p>The first version of Street & Ink was a simple map with a few dozen pins marking street art locations. Today, it's grown into a global community of thousands, documenting tens of thousands of artworks across six continents.</p>

                <div style="margin-top: 50px;">
                    <img src="https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="First Mural" style="border-radius: var(--border-radius); max-height: 500px; object-fit: cover; width: 100%;">
                    <p style="margin-top: 10px; font-size: 0.9rem; color: var(--text-light);">The alley in Manila that started it all (Photo from our archives)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section team" id="team">
        <div class="container">
            <h2 class="section-title">Meet the Team</h2>
            <p class="text-center">The passionate people behind Street & Ink</p>

            <div class="team-grid">
                <!-- Team Member 1 -->
                <div class="team-card">
                    <div class="team-card-img">
                        <img src="img/aderik.jpg" alt="Aderik Bermas">
                    </div>
                    <div class="team-card-content">
                        <h3 class="team-card-name">Bermas, Aderik P.</h3>
                        <div class="team-card-role">Team Leader, Project Manager, System Analyst and Full Stack Programmer</div>
                        <p class="team-card-bio">Oversees the entire project, manages team coordination, defines system requirements, and contributes to both front-end and back-end development.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-card">
                    <div class="team-card-img">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Jamie Chen">
                    </div>
                    <div class="team-card-content">
                        <h3 class="team-card-name">De Rama, John Cedrick</h3>
                        <div class="team-card-role">Quality Assurance (QA) Engineer</div>
                        <p class="team-card-bio">Ensures the final product meets quality standards through thorough testing and bug tracking, maintaining system reliability and performance.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-card">
                    <div class="team-card-img">
                        <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Marcus Johnson">
                    </div>
                    <div class="team-card-content">
                        <h3 class="team-card-name">Marabe, John Francis</h3>
                        <div class="team-card-role">UI/UX Designer and Back End Programmer</div>
                        <p class="team-card-bio">Designs intuitive user interfaces and experiences while also developing the server-side logic and APIs to support application functionality.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="team-card">
                    <div class="team-card-img">
                        <img src="https://images.unsplash.com/photo-1573497620053-ea5300f94f21?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Samira Khan">
                    </div>
                    <div class="team-card-content">
                        <h3 class="team-card-name">Mendoza, Lawrence Kier</h3>
                        <div class="team-card-role">Front End Programmer</div>
                        <p class="team-card-bio">Implements user-facing features using modern frameworks and ensures responsive, accessible, and seamless interaction across devices.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 5 -->
                <div class="team-card">
                    <div class="team-card-img">
                        <img src="https://images.unsplash.com/photo-1573497620053-ea5300f94f21?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Samira Khan">
                    </div>
                    <div class="team-card-content">
                        <h3 class="team-card-name">Oliveros, Amiel</h3>
                        <div class="team-card-role">User Researcher</div>
                        <p class="team-card-bio">Conducts research and gathers feedback to understand user needs, behavior, and preferences, guiding the design and development process.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 6 -->
                <div class="team-card">
                    <div class="team-card-img">
                        <img src="img/paul.jpg" alt="Paul Benedict E. Samsaman">
                    </div>
                    <div class="team-card-content">
                        <h3 class="team-card-name">Samsaman, Paul Benedict E.</h3>
                        <div class="team-card-role">Technical Writer and Database Administrator (DBA)</div>
                        <p class="team-card-bio">Documents technical processes and system architecture while managing database design, performance, and data integrity.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 7 -->
                <div class="team-card">
                    <div class="team-card-img">
                        <img src="img/anton.jpg" alt="Anton Joseph Tano">
                    </div>
                    <div class="team-card-content">
                        <h3 class="team-card-name">Tano, Anton Joseph</h3>
                        <div class="team-card-role">Test Engineer / QA Tester / Test Framer</div>
                        <p class="team-card-bio">Develops and executes test cases, automates testing processes, and ensures the software behaves as expected under various conditions.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="section vision" id="vision">
        <div class="container">
            <h2 class="section-title">Our Vision for the Future</h2>
            <p>We're building more than just a map — we're building a living archive of street culture. In the future, expect artist profiles, AR experiences, event coverage, and global art collaborations.</p>

            <div class="vision-features">
                <div class="vision-feature">
                    <i class="fas fa-user-astronaut"></i>
                    <h3>AR Experiences</h3>
                    <p>View art through your phone with augmented reality features</p>
                </div>

                <div class="vision-feature">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Event Coverage</h3>
                    <p>Live documentation of street art festivals worldwide</p>
                </div>

                <div class="vision-feature">
                    <i class="fas fa-hands-helping"></i>
                    <h3>Artist Collaborations</h3>
                    <p>Connecting artists with communities for new works</p>
                </div>

                <div class="vision-feature">
                    <i class="fas fa-book"></i>
                    <h3>Digital Archive</h3>
                    <p>Preserving street art history for future generations</p>
                </div>

                <div class="vision-feature">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Education</h3>
                    <p>Resources for learning about street art culture</p>
                </div>

                <div class="vision-feature">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>Global Coverage</h3>
                    <p>Expanding to document street art in every country</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="section partners">
        <div class="container">
            <h2 class="section-title">Our Partners</h2>
            <p class="text-center">Organizations that support our mission</p>

            <div class="partners-grid">
                <div class="partner-card">
                    <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" alt="Urban Arts Fund">
                    <h3>Urban Arts Fund</h3>
                </div>
                <div class="partner-card">
                    <img src="https://images.unsplash.com/photo-1513151233558-d860c5398176?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Street Art Cities">
                    <h3>Street Art Cities</h3>
                </div>
                <div class="partner-card">
                    <img src="https://images.unsplash.com/photo-1499781350541-7783f6c6a0c8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80" alt="Art Everywhere">
                    <h3>Art Everywhere</h3>
                </div>
                <div class="partner-card">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Creative Cities">
                    <h3>Creative Cities</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta">
        <div class="container">
            <h2 class="section-title">Join the Movement</h2>
            <p>Help us document street art from around the world and connect with a community of urban art enthusiasts.</p>

            <div class="cta-btns">
                <a href="#" class="btn btn-primary btn-large">Submit Street Art</a>
                <a href="index.php#community" class="btn btn-secondary btn-large">Join Our Community</a>
                <a href="Support.php" class="btn btn-secondary btn-large">Support the Project</a>
            </div>
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
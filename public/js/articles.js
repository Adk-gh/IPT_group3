// Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const nav = document.getElementById('nav');

        mobileMenuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
            mobileMenuBtn.innerHTML = nav.classList.contains('active') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });

        // Dropdown Toggle
        const filterBtns = document.querySelectorAll('.filter-btn');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const dropdown = btn.nextElementSibling;
                btn.classList.toggle('active');
                dropdown.classList.toggle('show');
            });
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', (e) => {
            if (!e.target.matches('.filter-btn')) {
                filterBtns.forEach(btn => {
                    btn.classList.remove('active');
                    btn.nextElementSibling.classList.remove('show');
                });
            }
        });

        // Tag Filter Functionality
        const tagFilters = document.querySelectorAll('.tag-filter');

        tagFilters.forEach(tag => {
            tag.addEventListener('click', () => {
                tagFilters.forEach(t => t.classList.remove('active'));
                tag.classList.add('active');
                // In a real implementation, this would filter the articles
                console.log(`Filtering by: ${tag.textContent}`);
            });
        });

        // Dark Mode Toggle
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            body.setAttribute('data-theme',
                body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');

            // Save preference to localStorage
            localStorage.setItem('theme', body.getAttribute('data-theme'));

            // Update icon
            themeToggle.innerHTML = body.getAttribute('data-theme') === 'dark' ?
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        });

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.setAttribute('data-theme', savedTheme);
            themeToggle.innerHTML = savedTheme === 'dark' ?
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        }

        // Pagination
        const pageBtns = document.querySelectorAll('.page-btn:not(.disabled)');

        pageBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.querySelector('i')) return; // Skip arrow buttons

                document.querySelector('.page-btn.active').classList.remove('active');
                btn.classList.add('active');
                // In a real implementation, this would load the page
                console.log(`Loading page ${btn.textContent}`);
            });
        });

        // Article card hover effect
        const articleCards = document.querySelectorAll('.article-card');

        articleCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px)';
                card.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = 'var(--shadow)';
            });
        });

        // Featured article hover effect
        const featuredArticle = document.querySelector('.featured-article');
        if (featuredArticle) {
            featuredArticle.addEventListener('mouseenter', () => {
                featuredArticle.style.transform = 'translateY(-5px)';
                featuredArticle.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
            });

            featuredArticle.addEventListener('mouseleave', () => {
                featuredArticle.style.transform = 'translateY(0)';
                featuredArticle.style.boxShadow = 'var(--shadow)';
            });
        }

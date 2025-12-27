import './bootstrap';

// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                // Close menu
                mobileMenu.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                // Open menu
                mobileMenu.classList.remove('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'true');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        });

        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenuButton.getAttribute('aria-expanded') === 'true') {
                mobileMenuButton.click();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenuButton.getAttribute('aria-expanded') === 'true' && 
                !mobileMenu.contains(e.target) && 
                !mobileMenuButton.contains(e.target)) {
                mobileMenuButton.click();
            }
        });
    }

    // Category Tabs - Removed (site only shows marketing courses)

    // Accordion functionality
    const accordionButtons = document.querySelectorAll('.accordion-item button[aria-controls]');

    accordionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            const targetId = this.getAttribute('aria-controls');
            const target = document.getElementById(targetId);
            
            // Get icon - button ID format: section-button-0, icon ID format: section-icon-0
            const iconId = this.id ? this.id.replace('button', 'icon') : null;
            const icon = iconId ? document.getElementById(iconId) : null;

            if (!target) {
                console.warn('Accordion target not found:', targetId);
                return;
            }

            // Close all other accordion items
            accordionButtons.forEach(otherButton => {
                if (otherButton !== this && otherButton.getAttribute('aria-expanded') === 'true') {
                    const otherTargetId = otherButton.getAttribute('aria-controls');
                    const otherTarget = document.getElementById(otherTargetId);
                    const otherIconId = otherButton.id ? otherButton.id.replace('button', 'icon') : null;
                    const otherIcon = otherIconId ? document.getElementById(otherIconId) : null;
                    
                    if (otherTarget) {
                        otherTarget.classList.add('hidden');
                        otherTarget.style.maxHeight = '0';
                        otherTarget.style.opacity = '0';
                        otherButton.setAttribute('aria-expanded', 'false');
                        if (otherIcon) {
                            otherIcon.classList.remove('rotate-180');
                        }
                    }
                }
            });

            // Toggle current item
            if (isExpanded) {
                // Close
                target.style.maxHeight = '0';
                target.style.opacity = '0';
                setTimeout(() => {
                    target.classList.add('hidden');
                }, 300);
                this.setAttribute('aria-expanded', 'false');
                if (icon) {
                    icon.classList.remove('rotate-180');
                }
            } else {
                // Open
                target.classList.remove('hidden');
                // Force reflow to ensure transition works
                const height = target.scrollHeight;
                target.style.maxHeight = height + 'px';
                target.style.opacity = '1';
                this.setAttribute('aria-expanded', 'true');
                if (icon) {
                    icon.classList.add('rotate-180');
                }
            }
        });

        // Keyboard navigation for accordion
        button.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Reviews Carousel (RTL Support)
    const reviewsContainer = document.getElementById('reviews-container');
    const reviewsPrev = document.getElementById('reviews-prev');
    const reviewsNext = document.getElementById('reviews-next');
    const reviewDots = document.querySelectorAll('.review-dot');
    
    if (reviewsContainer && reviewsPrev && reviewsNext) {
        let currentIndex = 0;
        const reviews = reviewsContainer.querySelectorAll('div > div');
        const totalReviews = reviews.length;

        function updateCarousel() {
            // In RTL, we use positive translateX to move right (which is next)
            const translateX = currentIndex * 100;
            reviewsContainer.style.transform = `translateX(${translateX}%)`;
            
            // Update dots
            reviewDots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.remove('opacity-30');
                    dot.classList.add('opacity-100');
                    dot.style.backgroundColor = '#04c2eb';
                    dot.style.width = '10px';
                    dot.style.height = '10px';
                } else {
                    dot.classList.remove('opacity-100');
                    dot.classList.add('opacity-30');
                    dot.style.backgroundColor = '#6B6F73';
                    dot.style.width = '8px';
                    dot.style.height = '8px';
                }
            });
        }

        function goToNext() {
            currentIndex = (currentIndex + 1) % totalReviews;
            updateCarousel();
        }

        function goToPrev() {
            currentIndex = (currentIndex - 1 + totalReviews) % totalReviews;
            updateCarousel();
        }

        function goToSlide(index) {
            currentIndex = index;
            updateCarousel();
        }

        // In RTL: right arrow (prev) goes to next, left arrow (next) goes to prev
        reviewsPrev.addEventListener('click', goToNext);
        reviewsNext.addEventListener('click', goToPrev);

        // Dot navigation
        reviewDots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToSlide(index));
        });

        // Keyboard navigation (RTL: ArrowRight goes to prev, ArrowLeft goes to next)
        reviewsContainer.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight') {
                goToPrev();
            } else if (e.key === 'ArrowLeft') {
                goToNext();
            }
        });

        // Auto-play (optional - can be removed if not needed)
        // let autoPlayInterval = setInterval(goToNext, 5000);
        // reviewsContainer.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
        // reviewsContainer.addEventListener('mouseleave', () => {
        //     autoPlayInterval = setInterval(goToNext, 5000);
        // });
    }
});

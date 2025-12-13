document.addEventListener('DOMContentLoaded', function() {
  // Slideshow functionality
  const slides = document.querySelectorAll('.slide');
  const indicators = document.querySelectorAll('.indicator');
  let currentSlide = 0;
  const slideInterval = 5000; // 5 másodperces váltás
  let slideTimer;
  
  // Kezdeti beállítás
  showSlide(currentSlide);
  startSlideShow();
  
  // Indikátor kattintás
  indicators.forEach(indicator => {
    indicator.addEventListener('click', function() {
      const index = parseInt(this.getAttribute('data-index'));
      showSlide(index);
      resetSlideShow();
    });
  });
  
  // Slide megjelenítése
  function showSlide(index) {
    // Elrejtjük az összes slide-ot
    slides.forEach(slide => {
      slide.classList.remove('active');
    });
    
    // Elrejtjük az összes indikátort
    indicators.forEach(indicator => {
      indicator.classList.remove('active');
    });
    
    // Megjelenítjük a kiválasztott slide-ot
    slides[index].classList.add('active');
    indicators[index].classList.add('active');
    currentSlide = index;
  }
  
  // Következő slide
  function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }
  
  // Slideshow indítása
  function startSlideShow() {
    slideTimer = setInterval(nextSlide, slideInterval);
  }
  
  // Slideshow újraindítása
  function resetSlideShow() {
    clearInterval(slideTimer);
    startSlideShow();
  }

  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 100,
          behavior: 'smooth'
        });
      }
    });
  });

  // Reviews section interaction
  // Add animation to review cards when they come into view
  const reviewCards = document.querySelectorAll('.review-card');
  
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };
  
  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);
  
  // Set initial state for animation
  reviewCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(card);
  });
  
  // Add click effect to review cards
  reviewCards.forEach(card => {
    card.addEventListener('click', function() {
      this.style.transform = 'scale(0.98)';
      setTimeout(() => {
        this.style.transform = '';
      }, 150);
    });
  });
});
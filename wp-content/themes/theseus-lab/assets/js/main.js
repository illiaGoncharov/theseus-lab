document.addEventListener('DOMContentLoaded', () => {
  // === Reveal-анимации при скролле (IntersectionObserver) ===
  const revealItems = document.querySelectorAll('.reveal-item');
  if (revealItems.length) {
    const revealObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
          }
        });
      },
      { threshold: 0.1 }
    );
    revealItems.forEach((item) => revealObserver.observe(item));
  }

  // === Hero: canvas dots + glow за курсором ===
  const heroSection = document.getElementById('hero');
  const heroCanvas = document.getElementById('hero-canvas');
  const heroGlow = document.getElementById('hero-glow');

  if (heroSection && heroCanvas && heroGlow) {
    const SPACING = 40;
    const BASE_R = 1.5;
    const MAX_R = 8;
    const INFLUENCE = 150;

    const mouse = { x: -9999, y: -9999 };
    let dots = [];

    const buildDots = () => {
      const cols = Math.ceil(heroCanvas.offsetWidth / SPACING) + 1;
      const rows = Math.ceil(heroCanvas.offsetHeight / SPACING) + 1;
      dots = [];
      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
          dots.push({ x: c * SPACING, y: r * SPACING, baseR: BASE_R, r: BASE_R });
        }
      }
    };

    const draw = () => {
      const ctx = heroCanvas.getContext('2d');
      if (!ctx) return;
      ctx.clearRect(0, 0, heroCanvas.width, heroCanvas.height);

      for (const dot of dots) {
        const dx = dot.x - mouse.x;
        const dy = dot.y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        const factor = Math.max(0, 1 - dist / INFLUENCE);
        const targetR = dot.baseR + (MAX_R - dot.baseR) * factor * factor;
        dot.r += (targetR - dot.r) * 0.15;

        ctx.beginPath();
        ctx.arc(dot.x, dot.y, dot.r, 0, Math.PI * 2);
        const alpha = 0.12 + 0.38 * factor * factor;
        ctx.fillStyle = `rgba(255,255,255,${alpha})`;
        ctx.fill();
      }

      requestAnimationFrame(draw);
    };

    const resize = () => {
      heroCanvas.width = heroCanvas.offsetWidth;
      heroCanvas.height = heroCanvas.offsetHeight;
      buildDots();
    };

    const onMove = (e) => {
      const rect = heroCanvas.getBoundingClientRect();
      mouse.x = e.clientX - rect.left;
      mouse.y = e.clientY - rect.top;
      heroGlow.style.transition = 'none';
      heroGlow.style.left = `${mouse.x}px`;
      heroGlow.style.top = `${mouse.y}px`;
      heroGlow.style.opacity = '1';
    };

    const onLeave = () => {
      mouse.x = -9999;
      mouse.y = -9999;
      heroGlow.style.transition = 'left 1.2s ease, top 1.2s ease, opacity 1.2s ease';
      const rect = heroSection.getBoundingClientRect();
      heroGlow.style.left = `${rect.width * 0.75}px`;
      heroGlow.style.top = `${rect.height * 0.35}px`;
      heroGlow.style.opacity = '0.5';
    };

    resize();
    draw();

    heroGlow.style.left = `${heroSection.offsetWidth * 0.75}px`;
    heroGlow.style.top = `${heroSection.offsetHeight * 0.35}px`;
    heroGlow.style.opacity = '0.5';

    const ro = new ResizeObserver(resize);
    ro.observe(heroCanvas);

    heroSection.addEventListener('mousemove', onMove);
    heroSection.addEventListener('mouseleave', onLeave);
  }

  // === Header shrink при скролле ===
  const header = document.querySelector('.site-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('scrolled', window.scrollY > 40);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // === Попап ===
  const overlay = document.getElementById('popup-contact');
  if (!overlay) return;

  const closeBtn = overlay.querySelector('.popup-close');

  document.querySelectorAll('[data-popup="contact"]').forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });

  function closePopup() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  if (closeBtn) closeBtn.addEventListener('click', closePopup);
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closePopup();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closePopup();
  });

  // === Бургер-меню ===
  const burger = document.querySelector('.nav-burger');
  const mobileMenu = document.querySelector('.nav-mobile-menu');

  if (burger && mobileMenu) {
    burger.addEventListener('click', () => {
      const expanded = burger.getAttribute('aria-expanded') === 'true';
      burger.setAttribute('aria-expanded', !expanded);
      burger.classList.toggle('active');
      mobileMenu.classList.toggle('active');
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        burger.classList.remove('active');
        burger.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.remove('active');
      });
    });
  }

  // === Process: hover раскрывает описание, progress-line ===
  const processStages = document.querySelectorAll('.process-stage');
  const progressFill = document.getElementById('process-progress-fill');
  if (processStages.length && progressFill) {
    const total = processStages.length - 1;
    processStages.forEach((el, i) => {
      el.addEventListener('mouseenter', () => {
        processStages.forEach((s) => s.classList.remove('active'));
        el.classList.add('active');
        progressFill.style.width = `${(i / total) * 100}%`;
      });
      el.addEventListener('mouseleave', () => {
        processStages.forEach((s) => s.classList.remove('active'));
        progressFill.style.width = '0%';
      });
    });
  }

  // === Плавный скролл к якорям ===
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const targetId = anchor.getAttribute('href');
      if (targetId === '#' || anchor.hasAttribute('data-popup')) return;
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  // === Reveal-анимации при скролле (IntersectionObserver) ===
  const revealItems = document.querySelectorAll('.reveal-item');
  if (revealItems.length) {
    const revealObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.06, rootMargin: '0px 0px -40px 0px' }
    );
    revealItems.forEach((item) => revealObserver.observe(item));
    setTimeout(() => {
      revealItems.forEach((item) => {
        item.classList.add('revealed');
        item.classList.add('is-visible');
      });
    }, 800);
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

  // === Expertise Hero: canvas dots + glow (страница услуги) ===
  const expHeroSection = document.getElementById('expertise-hero');
  const expHeroCanvas = document.getElementById('exp-hero-canvas');
  const expHeroGlow = document.getElementById('exp-hero-glow');

  if (expHeroSection && expHeroCanvas && expHeroGlow) {
    const EXP_SPACING = 40;
    const EXP_BASE_R = 1.5;
    const EXP_MAX_R = 7;
    const EXP_INFLUENCE = 140;

    const expMouse = { x: -9999, y: -9999 };
    let expDots = [];

    const expBuildDots = () => {
      const cols = Math.ceil(expHeroCanvas.offsetWidth / EXP_SPACING) + 1;
      const rows = Math.ceil(expHeroCanvas.offsetHeight / EXP_SPACING) + 1;
      expDots = [];
      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
          expDots.push({ x: c * EXP_SPACING, y: r * EXP_SPACING, baseR: EXP_BASE_R, r: EXP_BASE_R });
        }
      }
    };

    const expDraw = () => {
      const ctx = expHeroCanvas.getContext('2d');
      if (!ctx) return;
      ctx.clearRect(0, 0, expHeroCanvas.width, expHeroCanvas.height);

      for (const dot of expDots) {
        const dx = dot.x - expMouse.x;
        const dy = dot.y - expMouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        const factor = Math.max(0, 1 - dist / EXP_INFLUENCE);
        const targetR = dot.baseR + (EXP_MAX_R - dot.baseR) * factor * factor;
        dot.r += (targetR - dot.r) * 0.15;

        ctx.beginPath();
        ctx.arc(dot.x, dot.y, dot.r, 0, Math.PI * 2);
        const alpha = 0.1 + 0.35 * factor * factor;
        ctx.fillStyle = `rgba(255,255,255,${alpha})`;
        ctx.fill();
      }

      requestAnimationFrame(expDraw);
    };

    const expResize = () => {
      expHeroCanvas.width = expHeroCanvas.offsetWidth;
      expHeroCanvas.height = expHeroCanvas.offsetHeight;
      expBuildDots();
    };

    const expOnMove = (e) => {
      const rect = expHeroCanvas.getBoundingClientRect();
      expMouse.x = e.clientX - rect.left;
      expMouse.y = e.clientY - rect.top;
      expHeroGlow.style.transition = 'none';
      expHeroGlow.style.left = `${expMouse.x}px`;
      expHeroGlow.style.top = `${expMouse.y}px`;
      expHeroGlow.style.opacity = '1';
    };

    const expOnLeave = () => {
      expMouse.x = -9999;
      expMouse.y = -9999;
      expHeroGlow.style.transition = 'left 1.2s ease, top 1.2s ease, opacity 1.2s ease';
      const rect = expHeroSection.getBoundingClientRect();
      expHeroGlow.style.left = `${rect.width * 0.75}px`;
      expHeroGlow.style.top = `${rect.height * 0.4}px`;
      expHeroGlow.style.opacity = '0.5';
    };

    expResize();
    expDraw();

    expHeroGlow.style.left = `${expHeroSection.offsetWidth * 0.75}px`;
    expHeroGlow.style.top = `${expHeroSection.offsetHeight * 0.4}px`;
    expHeroGlow.style.opacity = '0.5';

    const expRo = new ResizeObserver(expResize);
    expRo.observe(expHeroCanvas);

    expHeroSection.addEventListener('mousemove', expOnMove);
    expHeroSection.addEventListener('mouseleave', expOnLeave);
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
  if (overlay) {
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
      if (e.key === 'Escape' && overlay.classList.contains('active')) closePopup();
    });
  }

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

  // === Process: линия прогресса по центрам кружков (описание под h3 — в разметке, CSS opacity) ===
  const processDesktop = document.querySelector('.process-desktop');
  const processStages = document.querySelectorAll('.process-desktop .process-stage');
  const progressWrap = document.querySelector('.process-progress-wrap');
  const progressBg = document.querySelector('.process-progress-bg');
  const progressFill = document.getElementById('process-progress-fill');

  if (processDesktop && processStages.length && progressWrap && progressBg && progressFill) {
    /** Центры кружков относительно левого края .process-progress-wrap (для линии top: 52px) */
    function getCircleCenterXs() {
      return Array.from(processStages).map((stage) => {
        const circle = stage.querySelector('.process-stage-circle');
        if (!circle) return 0;
        const wrapRect = progressWrap.getBoundingClientRect();
        const c = circle.getBoundingClientRect();
        return c.left + c.width / 2 - wrapRect.left;
      });
    }

    function layoutProcessLines() {
      const centers = getCircleCenterXs();
      if (!centers.length) return;
      const left = centers[0];
      const right = centers[centers.length - 1];
      const fullW = Math.max(0, right - left);
      progressBg.style.left = `${left}px`;
      progressBg.style.width = `${fullW}px`;
      const active = processDesktop.querySelector('.process-stage.active');
      const idx = active ? parseInt(active.getAttribute('data-stage'), 10) : -1;
      updateProgressFill(idx);
    }

    function updateProgressFill(stageIndex) {
      const centers = getCircleCenterXs();
      if (!centers.length) return;
      const start = centers[0];
      if (stageIndex < 0 || Number.isNaN(stageIndex)) {
        progressFill.style.left = `${start}px`;
        progressFill.style.width = '0px';
        return;
      }
      const end = centers[stageIndex];
      progressFill.style.left = `${start}px`;
      progressFill.style.width = `${Math.max(0, end - start)}px`;
    }

    function clearProcessHover() {
      processStages.forEach((s) => s.classList.remove('active'));
      updateProgressFill(-1);
    }

    processStages.forEach((el, i) => {
      el.addEventListener('mouseenter', () => {
        processStages.forEach((s) => s.classList.remove('active'));
        el.classList.add('active');
        updateProgressFill(i);
      });
    });

    processDesktop.addEventListener('mouseleave', () => {
      clearProcessHover();
    });

    window.addEventListener('resize', layoutProcessLines);
    const ro = new ResizeObserver(() => layoutProcessLines());
    ro.observe(processDesktop);
    layoutProcessLines();
  }

  // === Industries: переключение табов ===
  const industryTabs = document.querySelectorAll('.exp-industries-tab');
  const industryContents = document.querySelectorAll('.exp-industries-content');

  if (industryTabs.length && industryContents.length) {
    industryTabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        const targetIdx = tab.getAttribute('data-tab');

        industryTabs.forEach((t) => {
          t.classList.remove('active');
          const bar = t.querySelector('.exp-industries-tab-bar');
          if (bar) bar.remove();
        });

        tab.classList.add('active');
        const bar = document.createElement('span');
        bar.className = 'exp-industries-tab-bar';
        tab.appendChild(bar);

        industryContents.forEach((c) => {
          c.classList.toggle('active', c.getAttribute('data-tab-content') === targetIdx);
        });
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

  // ============================================
  // BLOG / CASES: фильтрация + «Показать больше»
  // ============================================
  function initGridFilter(rubricatorId, gridId, showMoreId, loadMoreId, counterId, wordForms) {
    const rubricator = document.getElementById(rubricatorId);
    const grid = document.getElementById(gridId);
    const showMore = document.getElementById(showMoreId);
    const loadMoreBtn = document.getElementById(loadMoreId);
    const counter = document.getElementById(counterId);
    if (!rubricator || !grid) return;

    const INITIAL = 4;
    const STEP = 4;
    let visibleCount = INITIAL;
    let activeFilter = 'all';

    const allCards = Array.from(grid.querySelectorAll('.blog-card'));
    const filterBtns = rubricator.querySelectorAll('.blog-rubricator__btn');

    function pluralize(n, forms) {
      const mod10 = n % 10;
      const mod100 = n % 100;
      if (mod10 === 1 && mod100 !== 11) return forms[0];
      if (mod10 >= 2 && mod10 <= 4 && (mod100 < 12 || mod100 > 14)) return forms[1];
      return forms[2];
    }

    function update() {
      const filtered = allCards.filter(card => {
        if (activeFilter === 'all') return true;
        const cats = card.getAttribute('data-category') || '';
        return cats.split(' ').includes(activeFilter);
      });

      allCards.forEach(card => card.classList.add('is-hidden'));
      filtered.slice(0, visibleCount).forEach(card => card.classList.remove('is-hidden'));

      if (counter) {
        counter.textContent = filtered.length + ' ' + pluralize(filtered.length, wordForms);
      }
      if (showMore) {
        showMore.style.display = visibleCount < filtered.length ? 'flex' : 'none';
      }
    }

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('is-active'));
        btn.classList.add('is-active');
        activeFilter = btn.getAttribute('data-filter');
        visibleCount = INITIAL;
        update();
      });
    });

    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', () => {
        visibleCount += STEP;
        update();
      });
    }

    update();
  }

  initGridFilter('blog-rubricator', 'blog-grid', 'blog-show-more', 'blog-load-more', 'blog-count',
    ['статья', 'статьи', 'статей']);
  initGridFilter('cases-rubricator', 'cases-grid', 'cases-show-more', 'cases-load-more', 'cases-count',
    ['кейс', 'кейса', 'кейсов']);

  // ============================================
  // ARTICLE TOC (IntersectionObserver по h2)
  // ============================================
  const articleBody = document.getElementById('article-body');
  const tocNav = document.getElementById('article-toc-nav');

  if (articleBody && tocNav) {
    const h2s = articleBody.querySelectorAll('h2');
    if (h2s.length) {
      h2s.forEach((h2, i) => {
        if (!h2.id) h2.id = 'heading-' + i;
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'article-toc__item';
        btn.textContent = h2.textContent;
        btn.setAttribute('data-toc-index', i);
        btn.addEventListener('click', () => {
          h2.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
        tocNav.appendChild(btn);
      });

      let activeIdx = 0;
      const tocItems = tocNav.querySelectorAll('.article-toc__item');

      const tocObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const idx = Array.from(h2s).indexOf(entry.target);
            if (idx !== -1) {
              activeIdx = idx;
              tocItems.forEach((item, j) => {
                item.classList.toggle('is-active', j === activeIdx);
              });
            }
          }
        });
      }, { rootMargin: '-20% 0px -70% 0px' });

      h2s.forEach(h2 => tocObserver.observe(h2));
      if (tocItems.length) tocItems[0].classList.add('is-active');
    }
  }

  // ============================================
  // COPY URL
  // ============================================
  document.querySelectorAll('[data-copy-url]').forEach(btn => {
    btn.addEventListener('click', () => {
      navigator.clipboard.writeText(window.location.href).then(() => {
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="ri-check-line"></i> Скопировано';
        setTimeout(() => { btn.innerHTML = orig; }, 2000);
      });
    });
  });

  // ============================================
  // CONTACT: счётчик символов
  // ============================================
  const msgField = document.getElementById('contact-message-field');
  const charCounter = document.getElementById('contact-char-counter');

  if (msgField && charCounter) {
    msgField.addEventListener('input', () => {
      const len = msgField.value.length;
      charCounter.textContent = len + '/500';
      charCounter.classList.toggle('is-warning', len > 450);
    });
  }

  // ============================================
  // LIGHTBOX (для галереи кейса)
  // ============================================
  const galleryGrid = document.getElementById('case-gallery-grid');
  const lightbox = document.getElementById('lightbox');

  if (galleryGrid && lightbox) {
    const lbImg = document.getElementById('lightbox-img');
    const lbCaption = document.getElementById('lightbox-caption');
    const lbCounter = document.getElementById('lightbox-counter');
    const lbDots = document.getElementById('lightbox-dots');
    const lbPrev = document.getElementById('lightbox-prev');
    const lbNext = document.getElementById('lightbox-next');
    const lbClose = document.getElementById('lightbox-close');

    const items = Array.from(galleryGrid.querySelectorAll('[data-gallery-index]'));
    let currentIdx = 0;

    function showSlide(idx) {
      const item = items[idx];
      if (!item) return;
      currentIdx = idx;
      lbImg.src = item.getAttribute('data-gallery-url');
      lbImg.alt = item.getAttribute('data-gallery-caption') || '';
      lbCaption.textContent = item.getAttribute('data-gallery-caption') || '';
      lbCaption.style.display = lbCaption.textContent ? 'block' : 'none';
      lbCounter.textContent = (idx + 1) + ' / ' + items.length;
      lbPrev.style.display = idx > 0 ? 'flex' : 'none';
      lbNext.style.display = idx < items.length - 1 ? 'flex' : 'none';

      lbDots.innerHTML = '';
      items.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'lightbox__dot' + (i === idx ? ' is-active' : '');
        dot.addEventListener('click', (e) => { e.stopPropagation(); showSlide(i); });
        lbDots.appendChild(dot);
      });
    }

    function openLightbox(idx) {
      showSlide(idx);
      lightbox.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      lightbox.style.display = 'none';
      document.body.style.overflow = '';
    }

    items.forEach(item => {
      item.addEventListener('click', () => {
        openLightbox(parseInt(item.getAttribute('data-gallery-index'), 10));
      });
    });

    lbClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) closeLightbox();
    });
    lbPrev.addEventListener('click', (e) => { e.stopPropagation(); if (currentIdx > 0) showSlide(currentIdx - 1); });
    lbNext.addEventListener('click', (e) => { e.stopPropagation(); if (currentIdx < items.length - 1) showSlide(currentIdx + 1); });

    document.addEventListener('keydown', (e) => {
      if (lightbox.style.display !== 'flex') return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowLeft' && currentIdx > 0) showSlide(currentIdx - 1);
      if (e.key === 'ArrowRight' && currentIdx < items.length - 1) showSlide(currentIdx + 1);
    });
  }

  // ============================================
  // FAQ ACCORDION
  // ============================================
  const faqQuestions = document.querySelectorAll('.faq-question');

  if (faqQuestions.length) {
    faqQuestions.forEach(btn => {
      btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        const answer = item.querySelector('.faq-answer');
        const isOpen = item.classList.contains('open');

        // Закрыть все остальные
        document.querySelectorAll('.faq-item.open').forEach(openItem => {
          if (openItem !== item) {
            openItem.classList.remove('open');
            openItem.querySelector('.faq-answer').style.maxHeight = null;
          }
        });

        if (isOpen) {
          item.classList.remove('open');
          answer.style.maxHeight = null;
        } else {
          item.classList.add('open');
          answer.style.maxHeight = answer.scrollHeight + 'px';
        }
      });
    });
  }

  // ============================================
  // COOKIE BANNER
  // ============================================
  const cookieBanner = document.getElementById('cookie-banner');
  const cookieAccept = document.getElementById('cookie-accept');

  if (cookieBanner && cookieAccept) {
    if (!localStorage.getItem('theseus_cookies_accepted')) {
      setTimeout(() => cookieBanner.classList.add('is-visible'), 800);
    }

    cookieAccept.addEventListener('click', () => {
      localStorage.setItem('theseus_cookies_accepted', '1');
      cookieBanner.classList.remove('is-visible');
    });
  }

  // ============================================
  // SCROLL TO TOP
  // ============================================
  const scrollTopBtn = document.getElementById('scroll-top');

  if (scrollTopBtn) {
    const SCROLL_THRESHOLD = 600;

    window.addEventListener('scroll', () => {
      scrollTopBtn.classList.toggle('is-visible', window.scrollY > SCROLL_THRESHOLD);
    }, { passive: true });

    scrollTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
});

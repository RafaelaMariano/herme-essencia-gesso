(() => {
  const header = document.getElementById('site-header');
  const toggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');

  const updateHeader = () => header?.classList.toggle('is-scrolled', window.scrollY > 20);
  updateHeader();
  window.addEventListener('scroll', updateHeader, { passive: true });

  if (toggle && menu) {
    const closeMenu = () => {
      menu.hidden = true;
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Abrir menu');
      header.classList.remove('is-open');
    };
    toggle.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') !== 'true';
      menu.hidden = !open;
      toggle.setAttribute('aria-expanded', String(open));
      toggle.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
      header.classList.toggle('is-open', open);
      if (open) menu.querySelector('a')?.focus();
    });
    menu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
    document.addEventListener('keydown', event => {
      if (event.key === 'Escape' && !menu.hidden) { closeMenu(); toggle.focus(); }
    });
    document.addEventListener('click', event => {
      if (!menu.hidden && !header.contains(event.target)) closeMenu();
    });
    window.addEventListener('resize', () => { if (window.innerWidth >= 1024) closeMenu(); });
  }

  const mainImage = document.querySelector('#product-main-image img');
  document.querySelectorAll('[data-gallery-image]').forEach(button => {
    button.addEventListener('click', () => {
      if (!mainImage) return;
      mainImage.src = button.dataset.galleryImage;
      mainImage.alt = button.dataset.galleryAlt || '';
      if (button.dataset.gallerySrcset) mainImage.srcset = button.dataset.gallerySrcset;
      else mainImage.removeAttribute('srcset');
      mainImage.sizes = '(max-width: 1024px) 100vw, 58vw';
      document.querySelectorAll('[data-gallery-image]').forEach(item => { item.classList.remove('is-active'); item.setAttribute('aria-pressed', 'false'); });
      button.classList.add('is-active');
      button.setAttribute('aria-pressed', 'true');
    });
  });
})();

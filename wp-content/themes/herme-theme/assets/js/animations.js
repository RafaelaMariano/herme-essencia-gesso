(() => {
  if (!window.gsap || !window.ScrollTrigger || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  gsap.registerPlugin(ScrollTrigger);

  document.querySelectorAll('[data-reveal]').forEach((element) => {
    gsap.from(element, {
      opacity: 0, y: 35, duration: 1, ease: 'power3.out',
      scrollTrigger: { trigger: element, start: 'top 88%', once: true }
    });
  });

  if (window.matchMedia('(min-width: 768px)').matches) {
    document.querySelectorAll('[data-reveal-image]').forEach((element) => {
      gsap.from(element, {
        clipPath: 'inset(0 0 100% 0)', opacity: .75, duration: 1.3, ease: 'power2.out',
        scrollTrigger: { trigger: element, start: 'top 85%', once: true }
      });
    });
    document.querySelectorAll('[data-stagger]').forEach((element) => {
      gsap.from(element.children, {
        opacity: 0, y: 28, stagger: .12, duration: .85, ease: 'power2.out',
        scrollTrigger: { trigger: element, start: 'top 85%', once: true }
      });
    });
    document.querySelectorAll('[data-parallax]').forEach((image) => {
      gsap.fromTo(image, { yPercent: -3, scale: 1.07 }, {
        yPercent: 3, scale: 1.07, ease: 'none',
        scrollTrigger: { trigger: image.parentElement, start: 'top bottom', end: 'bottom top', scrub: 1 }
      });
    });
  }
})();

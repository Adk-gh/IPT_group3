// loading.js
document.addEventListener('DOMContentLoaded', () => {
  // Create loading overlay element and append it to body
  const loadingOverlay = document.createElement('div');
  loadingOverlay.id = 'loading-overlay';
  loadingOverlay.style.cssText = `
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    justify-content: center;
    align-items: center;
  `;

  const spinner = document.createElement('div');
  spinner.className = 'spinner';
  loadingOverlay.appendChild(spinner);
  document.body.appendChild(loadingOverlay);

  // Show loading on link clicks (except blank targets & anchors)
  document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
    link.addEventListener('click', (e) => {
      const href = link.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;
      loadingOverlay.style.display = 'flex';
    });
  });

  // Show loading on form submits
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', () => {
      loadingOverlay.style.display = 'flex';
    });
  });
});

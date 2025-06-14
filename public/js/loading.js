// loading.js
document.addEventListener('DOMContentLoaded', () => {
  // Create and style the loading overlay
  const loadingOverlay = document.createElement('div');
  loadingOverlay.id = 'loading-overlay';
  loadingOverlay.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  `;

  // Create spinner element
  const spinner = document.createElement('div');
  spinner.className = 'spinner';
  spinner.style.cssText = `
    border: 8px solid #f3f3f3;
    border-top: 8px solid #FF5E5B;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 1s linear infinite;
  `;

  // Add spinner to overlay and overlay to body
  loadingOverlay.appendChild(spinner);
  document.body.appendChild(loadingOverlay);

  // Add spin animation keyframes dynamically
  const style = document.createElement('style');
  style.textContent = `
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  `;
  document.head.appendChild(style);

  // Show/hide functions
  window.showLoading = () => {
    loadingOverlay.style.display = 'flex';
  };

  window.hideLoading = () => {
    loadingOverlay.style.display = 'none';
  };

  // Auto-attach to links and forms
  document.addEventListener('click', (e) => {
    const link = e.target.closest('a:not([target="_blank"]):not([href^="#"]):not([href^="javascript:"])');
    if (link) {
      showLoading();
      // Fallback in case navigation fails
      setTimeout(hideLoading, 5000);
    }
  });

  document.addEventListener('submit', (e) => {
    showLoading();
    // Fallback in case submission fails
    setTimeout(hideLoading, 5000);
  });

  // Hide when page fully loads
  window.addEventListener('load', hideLoading);

  // Handle back/forward navigation
  window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      hideLoading();
    }
  });
});
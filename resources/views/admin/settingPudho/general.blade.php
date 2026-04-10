@extends('admin.layout')

@section('content')

<style>
  /* White & Red Theme + Arial Font */
  .settings-container {
    font-family: 'Arial', sans-serif;
    max-width: 900px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
  }

  .settings-section {
    padding: 28px 32px;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.2s ease;
  }

  .settings-section:last-child {
    border-bottom: none;
  }

  .settings-section h2,
  .settings-section h3 {
    color: #1a1a1a;
    margin-bottom: 8px;
    font-weight: 600;
    letter-spacing: -0.2px;
  }

  .settings-section h2 {
    font-size: 24px;
    border-left: 4px solid #e53e3e;
    padding-left: 16px;
  }

  .settings-section h3 {
    font-size: 18px;
    margin-top: 8px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .settings-section p {
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 24px;
    border-left: 2px solid #e53e3e30;
    padding-left: 12px;
  }

  .form-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  label {
    font-weight: 600;
    color: #2d3748;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  label i,
  label svg {
    color: #e53e3e;
    font-size: 16px;
  }

  input,
  select,
  textarea {
    padding: 10px 14px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-family: 'Arial', sans-serif;
    font-size: 14px;
    transition: all 0.2s;
    background: #fff;
  }

  input:focus,
  select:focus,
  textarea:focus {
    outline: none;
    border-color: #e53e3e;
    box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
  }

  input[type="color"] {
    width: 60px;
    height: 40px;
    padding: 4px;
    cursor: pointer;
  }

  .save-btn {
    background: white;
    border: 1.5px solid #e53e3e;
    color: #e53e3e;
    padding: 10px 24px;
    border-radius: 40px;
    font-weight: 600;
    font-family: 'Arial', sans-serif;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-top: 12px;
  }

  .save-btn:hover {
    background: #e53e3e;
    color: white;
    box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
    transform: translateY(-1px);
  }

  .save-btn:active {
    transform: translateY(1px);
  }

  .checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 20px;
    padding-top: 12px;
    border-top: 1px dashed #edf2f7;
  }

  .checkbox-wrapper label {
    margin-bottom: 0;
    cursor: pointer;
  }

  input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #e53e3e;
  }

  hr {
    margin: 16px 0;
    border: none;
    border-top: 1px solid #f0f0f0;
  }

  /* Modal Overlay */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    visibility: hidden;
    opacity: 0;
    transition: all 0.2s ease;
  }

  .modal-overlay.active {
    visibility: visible;
    opacity: 1;
  }

  .modal-content {
    background: white;
    border-radius: 28px;
    padding: 28px 32px;
    width: 320px;
    text-align: center;
    box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
    font-family: 'Arial', sans-serif;
    animation: fadeSlideUp 0.25s ease;
  }

  @keyframes fadeSlideUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .modal-icon {
    font-size: 48px;
    margin-bottom: 16px;
    color: #e53e3e;
  }

  .modal-content h4 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #1a202c;
  }

  .modal-content p {
    color: #4a5568;
    font-size: 14px;
    margin-bottom: 20px;
  }

  .spinner {
    display: inline-block;
    width: 40px;
    height: 40px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #e53e3e;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-bottom: 12px;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  /* Toast Notification */
  .toast-notification {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #1f2937;
    color: white;
    padding: 14px 24px;
    border-radius: 60px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-family: 'Arial', sans-serif;
    font-size: 14px;
    font-weight: 500;
    z-index: 1100;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    transform: translateX(400px);
    transition: transform 0.3s ease;
    border-left: 4px solid #e53e3e;
  }

  .toast-notification.show {
    transform: translateX(0);
  }

  .toast-success {
    background: #0f172a;
  }

  .toast-success i {
    color: #e53e3e;
    font-size: 18px;
  }

  /* responsive tweaks */
  @media (max-width: 640px) {
    .settings-section {
      padding: 20px;
    }

    .save-btn {
      width: 100%;
      justify-content: center;
    }

    .toast-notification {
      left: 20px;
      right: 20px;
      bottom: 20px;
      justify-content: center;
    }
  }
</style>

<div class="settings-container">
  <!-- General Settings -->
  <div class="settings-section">
    <h2><i class="fas fa-sliders-h" style="color: #e53e3e; font-size: 22px;"></i> General Settings</h2>
    <p>Configure basic website information, logo, and description.</p>

    <div class="form-group">
      <label><i class="fas fa-globe"></i> Website Name:</label>
      <input type="text" id="website-name" name="website-name" value="PUDHO Website">
    </div>

    <div class="form-group">
      <label><i class="fas fa-image"></i> Website Logo:</label>
      <input type="file" id="website-logo" name="website-logo" accept="image/*">
    </div>

    <div class="form-group">
      <label><i class="fas fa-align-left"></i> Website Description:</label>
      <textarea id="website-description" name="website-description" rows="3">This is the official website of the Provincial Urban Development & Housing Office (PUDHO) of Laguna.</textarea>
    </div>

    <button class="save-btn" id="saveGeneralBtn">
      <i class="fas fa-save"></i> Save Changes
    </button>
  </div>

  <!-- Theme Settings -->
  <div class="settings-section">
    <h3><i class="fas fa-palette"></i> Theme Settings</h3>
    <p>Customize color palette and typography.</p>

    <div class="form-group">
      <label><i class="fas fa-eyedropper"></i> Theme Color:</label>
      <input type="color" id="theme-color" name="theme-color" value="#e53e3e">
    </div>

    <div class="form-group">
      <label><i class="fas fa-font"></i> Font Style:</label>
      <select id="font-style" name="font-style">
        <option value="Arial, sans-serif">Default (Arial)</option>
        <option value="'Times New Roman', serif">Serif</option>
        <option value="'Courier New', monospace">Monospace</option>
      </select>
    </div>

    <button class="save-btn" id="saveThemeBtn">
      <i class="fas fa-paint-brush"></i> Save Theme Settings
    </button>
  </div>

  <!-- Account Theme Settings -->
  <div class="settings-section">
    <h3><i class="fas fa-user-circle"></i> Account Theme Settings</h3>
    <p>Personalize your account panel background and text colors.</p>

    <div class="form-group">
      <label><i class="fas fa-fill-drip"></i> Account Background Color:</label>
      <input type="color" id="account-bg-color" name="account-bg-color" value="#f8f9fa">
    </div>

    <div class="form-group">
      <label><i class="fas fa-pen-fancy"></i> Account Font Color:</label>
      <input type="color" id="account-font-color" name="account-font-color" value="#212529">
    </div>

    <div class="checkbox-wrapper">
      <input type="checkbox" id="dark-mode-toggle" name="dark-mode-toggle">
      <label for="dark-mode-toggle"><i class="fas fa-moon"></i> Enable Dark Mode (preview mode)</label>
    </div>

    <button class="save-btn" id="saveAccountBtn">
      <i class="fas fa-user-edit"></i> Save Account Theme Settings
    </button>
  </div>
</div>

<!-- Modal Structure (Loading / Success states) -->
<div id="loadingModal" class="modal-overlay">
  <div class="modal-content">
    <div class="spinner"></div>
    <h4>Saving Changes...</h4>
    <p>Please wait while we update your settings.</p>
  </div>
</div>

<!-- Hidden Toast Container (dynamic) -->
<div id="toastMessage" class="toast-notification toast-success">
  <i class="fas fa-check-circle"></i>
  <span id="toastText">Settings saved successfully!</span>
</div>

<script>
  // Helper functions for modal & toast
  const modal = document.getElementById('loadingModal');
  const toastEl = document.getElementById('toastMessage');
  const toastTextSpan = document.getElementById('toastText');

  function showLoadingModal() {
    modal.classList.add('active');
  }

  function hideLoadingModal() {
    modal.classList.remove('active');
  }

  function showToast(message, isError = false) {
    // Set message
    toastTextSpan.innerText = message;
    // Change icon based on success/error
    const iconEl = toastEl.querySelector('i');
    if (isError) {
      iconEl.className = 'fas fa-exclamation-triangle';
      toastEl.style.borderLeftColor = '#f97316';
      toastEl.classList.add('toast-success'); // keep same bg
    } else {
      iconEl.className = 'fas fa-check-circle';
      toastEl.style.borderLeftColor = '#e53e3e';
    }
    // Show toast
    toastEl.classList.add('show');
    // Auto hide after 3 seconds
    setTimeout(() => {
      toastEl.classList.remove('show');
    }, 3000);
  }

  // Simulate async saving (API call simulation)
  function simulateSave(actionName, callback) {
    showLoadingModal();
    // Simulate network delay (loading effect)
    setTimeout(() => {
      hideLoadingModal();
      // Simulate success (always success for demo, but you can extend)
      if (callback) callback(true);
      showToast(`${actionName} saved successfully! ✨`);
    }, 1200);
  }

  // ========== General Settings Save ==========
  document.getElementById('saveGeneralBtn').addEventListener('click', function(e) {
    e.preventDefault();

    const websiteName = document.getElementById('website-name').value.trim();
    const websiteDesc = document.getElementById('website-description').value.trim();
    const logoFile = document.getElementById('website-logo').files[0];

    // Basic validation: name required
    if (!websiteName) {
      showToast('Website name cannot be empty', true);
      return;
    }

    // Simulate saving general info (including optional logo preview logic)
    simulateSave('General Settings', (success) => {
      if (success) {
        // In real scenario you would send via AJAX, but we reflect UI feedback
        console.log(`General saved: Name=${websiteName}, Desc=${websiteDesc}, Logo=${logoFile ? logoFile.name : 'none'}`);
        // Optionally update preview anywhere (just for demo)
        document.querySelector('.settings-container').style.border = '1px solid #f0f0f0';
      }
    });
  });

  // ========== Theme Settings Save ==========
  document.getElementById('saveThemeBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const themeColor = document.getElementById('theme-color').value;
    const fontStyleSelect = document.getElementById('font-style');
    const selectedFont = fontStyleSelect.options[fontStyleSelect.selectedIndex].value;

    simulateSave('Theme Settings', (success) => {
      if (success) {
        // Apply dynamic theme preview (red-white concept but also updates color picker accent)
        // Update root variables to show red theme consistency
        document.documentElement.style.setProperty('--theme-accent', themeColor);
        // For demo: change save buttons border color on hover to reflect new theme? subtle
        const allBtns = document.querySelectorAll('.save-btn');
        allBtns.forEach(btn => {
          btn.style.borderColor = themeColor;
          btn.style.color = themeColor;
        });
        // Update font style globally for .settings-container
        const settingsContainer = document.querySelector('.settings-container');
        settingsContainer.style.fontFamily = selectedFont;
        showToast(`Theme updated: font & accent color applied.`, false);
      }
    });
  });

  // ========== Account Theme Settings Save ==========
  document.getElementById('saveAccountBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const accountBg = document.getElementById('account-bg-color').value;
    const accountFontColor = document.getElementById('account-font-color').value;
    const darkModeToggle = document.getElementById('dark-mode-toggle').checked;

    simulateSave('Account Theme Settings', (success) => {
      if (success) {
        // Visual preview inside a "account preview card" — but we'll simulate by changing a temporary style
        // We'll create or update a small preview box to reflect account theme changes (just for better UX)
        let previewCard = document.getElementById('dynamicAccountPreview');
        if (!previewCard) {
          const accountSection = document.querySelector('.settings-section:last-child');
          const previewDiv = document.createElement('div');
          previewDiv.id = 'dynamicAccountPreview';
          previewDiv.style.marginTop = '20px';
          previewDiv.style.padding = '16px';
          previewDiv.style.borderRadius = '16px';
          previewDiv.style.border = '1px solid #e2e8f0';
          previewDiv.innerHTML = '<strong><i class="fas fa-user"></i> Preview:</strong> <span>Admin User — Account panel style</span>';
          accountSection.insertBefore(previewDiv, accountSection.querySelector('.save-btn').nextSibling);
          previewCard = document.getElementById('dynamicAccountPreview');
        }
        previewCard.style.backgroundColor = accountBg;
        previewCard.style.color = accountFontColor;
        previewCard.style.transition = 'all 0.2s';

        // Dark mode toggle effect (simulate darker background for account area)
        if (darkModeToggle) {
          previewCard.style.backgroundColor = '#1e293b';
          previewCard.style.color = '#f1f5f9';
          previewCard.style.borderColor = '#e53e3e';
          showToast(`Dark mode enabled + custom colors applied (preview)`, false);
        } else {
          // keep custom bg & font
          previewCard.style.backgroundColor = accountBg;
          previewCard.style.color = accountFontColor;
          previewCard.style.borderColor = '#e2e8f0';
          showToast(`Account theme saved with custom colors`, false);
        }

        // Also persist dark mode checkbox effect globally (optional)
        if (darkModeToggle) {
          document.body.style.backgroundColor = '#121212';
          document.body.style.transition = '0.2s';
          // but we keep container white as per design - adjust container
          document.querySelector('.settings-container').style.backgroundColor = '#ffffff';
          document.querySelector('.settings-container').style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
        } else {
          document.body.style.backgroundColor = '';
          document.querySelector('.settings-container').style.backgroundColor = '#ffffff';
        }
      }
    });
  });

  // Additional: improve file input interaction: show loading on file change? but we keep modals on save only
  // Also ensure that any button loading does not double trigger, fine.

  // Optional: Live preview of red/white theme: apply initial red accent on load
  document.addEventListener('DOMContentLoaded', () => {
    // set initial theme color to red (#e53e3e) but the color picker value already shows red
    const defaultRed = '#e53e3e';
    const themeColorPicker = document.getElementById('theme-color');
    if (themeColorPicker && themeColorPicker.value !== defaultRed) {
      themeColorPicker.value = defaultRed;
    }
    // Ensure all save buttons have red accent consistent
    const btns = document.querySelectorAll('.save-btn');
    btns.forEach(btn => {
      btn.style.borderColor = '#e53e3e';
      btn.style.color = '#e53e3e';
    });
    // attach font default Arial already set via CSS
    // To satisfy SVG / i icons all over: using font awesome icons (fas) which are <i> tags and SVGs-like
    // Additionally add any inline SVG if needed: maybe a custom red logo inside title
    const h2Elem = document.querySelector('.settings-section h2');
    if (h2Elem && !h2Elem.querySelector('svg')) {
      // add an inline SVG next to title (demonstrate SVG usage as required)
      const svgSpan = document.createElement('span');
      svgSpan.style.marginRight = '8px';
      svgSpan.innerHTML = `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L15 8.5L22 9.5L17 14L18.5 21L12 17.5L5.5 21L7 14L2 9.5L9 8.5L12 2Z" fill="#e53e3e" stroke="#e53e3e" stroke-width="1.2"/>
            </svg>`;
      h2Elem.insertBefore(svgSpan, h2Elem.firstChild);
    }
  });

  // Additional helper: Show loading on all save actions (ensures consistent modal & toast)
  // Also handle error scenario if needed
  window.addEventListener('load', () => {
    // Preload toast hidden
    toastEl.classList.remove('show');
    // Make modal click outside not close (prevent accidental closure during load)
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        // optional: do nothing, loading important
        return;
      }
    });
  });

  // Provide a mini demo for dark mode toggle saving: when checkbox toggles, saving is manual via button.
  // However we also show a small info: dark mode integrated inside account save.
  document.getElementById('dark-mode-toggle').addEventListener('change', function() {
    // just visual hint but actual save requires clicking button.
    const hintMsg = document.createElement('div');
    let existingHint = document.getElementById('darkModeHint');
    if (!existingHint) {
      const hint = document.createElement('small');
      hint.id = 'darkModeHint';
      hint.style.display = 'block';
      hint.style.marginTop = '8px';
      hint.style.color = '#e53e3e';
      hint.innerHTML = '<i class="fas fa-info-circle"></i> Click "Save Account Theme Settings" to apply dark mode.';
      document.querySelector('.checkbox-wrapper').appendChild(hint);
      setTimeout(() => {
        if (document.getElementById('darkModeHint')) document.getElementById('darkModeHint').remove();
      }, 2500);
    }
  });
</script>

@endsection
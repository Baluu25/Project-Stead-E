// Login functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeLoginForm();
    initializePasswordToggle();
    initializeSocialButtons();
});

function initializeLoginForm() {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateLoginForm()) {
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Signing In...';
                submitBtn.disabled = true;
                
                // Simulate API call delay
                setTimeout(() => {
                    this.submit();
                }, 1000);
            }
        });
    }
}

function validateLoginForm() {
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    let isValid = true;
    
    // Reset previous errors
    resetValidationStyles();
    
    // Validate email/username
    if (!email.value.trim()) {
        showFieldError(email, 'Email or username is required');
        isValid = false;
    }
    
    // Validate password
    if (!password.value) {
        showFieldError(password, 'Password is required');
        isValid = false;
    } else if (password.value.length < 6) {
        showFieldError(password, 'Password must be at least 6 characters');
        isValid = false;
    }
    
    return isValid;
}

function showFieldError(field, message) {
    field.style.borderColor = '#dc3545';
    field.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
    
    // Remove existing error message
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Add error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.color = '#dc3545';
    errorDiv.style.fontSize = '0.8rem';
    errorDiv.style.marginTop = '0.5rem';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
    
    // Add shake animation
    field.classList.add('shake');
    setTimeout(() => {
        field.classList.remove('shake');
    }, 500);
}

function resetValidationStyles() {
    const fields = document.querySelectorAll('.form-control');
    const errorMessages = document.querySelectorAll('.field-error');
    
    fields.forEach(field => {
        field.style.borderColor = '';
        field.style.boxShadow = '';
    });
    
    errorMessages.forEach(error => error.remove());
}

function initializePasswordToggle() {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Update eye icon
            const eyeIcon = this.querySelector('.eye-icon');
            if (type === 'text') {
                eyeIcon.textContent = '🙈';
            } else {
                eyeIcon.textContent = '👁️';
            }
            
            // Add animation
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    }
}

function initializeSocialButtons() {
    const googleBtn = document.querySelector('.btn-google');
    const facebookBtn = document.querySelector('.btn-facebook');
    
    if (googleBtn) {
        googleBtn.addEventListener('click', function() {
            // Simulate Google login
            showLoadingState(this, 'Connecting to Google...');
            setTimeout(() => {
                alert('Google login would be implemented here');
                resetButtonState(this, 'Continue with Google');
            }, 1500);
        });
    }
    
    if (facebookBtn) {
        facebookBtn.addEventListener('click', function() {
            // Simulate Facebook login
            showLoadingState(this, 'Connecting to Facebook...');
            setTimeout(() => {
                alert('Facebook login would be implemented here');
                resetButtonState(this, 'Continue with Facebook');
            }, 1500);
        });
    }
}

function showLoadingState(button, loadingText) {
    button.disabled = true;
    button.style.opacity = '0.7';
    const originalText = button.textContent;
    button.setAttribute('data-original-text', originalText);
    button.innerHTML = loadingText;
}

function resetButtonState(button, originalText) {
    button.disabled = false;
    button.style.opacity = '1';
    button.innerHTML = originalText;
}

// Enter key submission
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        const loginForm = document.getElementById('loginForm');
        if (loginForm && document.activeElement.closest('#loginForm')) {
            loginForm.dispatchEvent(new Event('submit'));
        }
    }
});

// Auto-focus on email field
window.addEventListener('load', function() {
    const emailField = document.getElementById('email');
    if (emailField) {
        emailField.focus();
    }
});

// Remember me functionality
function handleRememberMe() {
    const rememberMe = document.getElementById('rememberMe');
    const emailField = document.getElementById('email');
    
    if (rememberMe && emailField) {
        // Check if we have saved credentials
        const savedEmail = localStorage.getItem('rememberedEmail');
        if (savedEmail) {
            emailField.value = savedEmail;
            rememberMe.checked = true;
        }
        
        // Save credentials when form is submitted
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', function() {
                if (rememberMe.checked) {
                    localStorage.setItem('rememberedEmail', emailField.value);
                } else {
                    localStorage.removeItem('rememberedEmail');
                }
            });
        }
    }
}

// Initialize remember me functionality
handleRememberMe();
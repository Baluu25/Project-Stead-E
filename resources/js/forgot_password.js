let currentStep = 1;
const totalSteps = 4;

document.addEventListener('DOMContentLoaded', function() {
    initializePasswordToggles();
    initializeFormSubmissions();
    initializeResendCode();
});

function initializePasswordToggles() {
    const toggleButtons = document.querySelectorAll('.btn-toggle-password');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            
            if (passwordInput) {
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
            }
        });
    });
}

function initializeFormSubmissions() {
    // Email form submission
    const emailForm = document.getElementById('emailForm');
    if (emailForm) {
        emailForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateEmailForm()) {
                // Simulate API call
                showLoadingState(this.querySelector('button[type="submit"]'), 'Sending...');
                
                setTimeout(() => {
                    // In real app, this would be an API call
                    nextStep();
                }, 1500);
            }
        });
    }
    
    // Code verification form
    const codeForm = document.getElementById('codeForm');
    if (codeForm) {
        codeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateCodeForm()) {
                showLoadingState(this.querySelector('button[type="submit"]'), 'Verifying...');
                
                setTimeout(() => {
                    nextStep();
                }, 1500);
            }
        });
    }
    
    // Password reset form
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validatePasswordForm()) {
                showLoadingState(this.querySelector('button[type="submit"]'), 'Resetting...');
                
                setTimeout(() => {
                    nextStep();
                }, 1500);
            }
        });
    }
}

function initializeResendCode() {
    const resendLink = document.getElementById('resendCode');
    if (resendLink) {
        resendLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Disable link and show countdown
            this.style.pointerEvents = 'none';
            this.style.opacity = '0.6';
            
            let countdown = 30;
            const originalText = this.textContent;
            
            const countdownInterval = setInterval(() => {
                this.textContent = `Resend code (${countdown}s)`;
                countdown--;
                
                if (countdown < 0) {
                    clearInterval(countdownInterval);
                    this.textContent = originalText;
                    this.style.pointerEvents = 'auto';
                    this.style.opacity = '1';
                }
            }, 1000);
            
            // Simulate resend
            showToast('Verification code sent to your email!');
        });
    }
}

function validateEmailForm() {
    const email = document.getElementById('email');
    let isValid = true;
    
    resetValidationStyles();
    
    if (!email.value.trim()) {
        showFieldError(email, 'Email is required');
        isValid = false;
    } else if (!isValidEmail(email.value)) {
        showFieldError(email, 'Please enter a valid email address');
        isValid = false;
    }
    
    return isValid;
}

function validateCodeForm() {
    const code = document.getElementById('resetCode');
    let isValid = true;
    
    resetValidationStyles();
    
    if (!code.value.trim()) {
        showFieldError(code, 'Verification code is required');
        isValid = false;
    } else if (code.value.length !== 6) {
        showFieldError(code, 'Code must be 6 digits');
        isValid = false;
    }
    
    return isValid;
}

function validatePasswordForm() {
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    let isValid = true;
    
    resetValidationStyles();
    
    if (!newPassword.value) {
        showFieldError(newPassword, 'New password is required');
        isValid = false;
    } else if (newPassword.value.length < 6) {
        showFieldError(newPassword, 'Password must be at least 6 characters');
        isValid = false;
    }
    
    if (!confirmPassword.value) {
        showFieldError(confirmPassword, 'Please confirm your password');
        isValid = false;
    } else if (newPassword.value !== confirmPassword.value) {
        showFieldError(confirmPassword, 'Passwords do not match');
        isValid = false;
    }
    
    return isValid;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showFieldError(field, message) {
    field.style.borderColor = '#dc3545';
    field.style.boxShadow = '0 0 0 2px rgba(220, 53, 69, 0.1)';
    
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

function showLoadingState(button, loadingText) {
    const originalText = button.textContent;
    button.disabled = true;
    button.innerHTML = loadingText;
    button.setAttribute('data-original-text', originalText);
}

function resetButtonState(button) {
    const originalText = button.getAttribute('data-original-text');
    button.disabled = false;
    button.innerHTML = originalText;
}

function nextStep() {
    const currentStepElement = document.getElementById(`step${currentStep}`);
    currentStepElement.style.animation = 'slideOutLeft 0.4s ease forwards';
    
    setTimeout(() => {
        currentStepElement.classList.remove('active');
        
        currentStep++;
        const nextStepElement = document.getElementById(`step${currentStep}`);
        nextStepElement.classList.add('active');
        nextStepElement.style.animation = 'slideInRight 0.4s ease forwards';
    }, 400);
}

function previousStep() {
    const currentStepElement = document.getElementById(`step${currentStep}`);
    currentStepElement.style.animation = 'slideOutRight 0.4s ease forwards';
    
    setTimeout(() => {
        currentStepElement.classList.remove('active');
        
        currentStep--;
        const prevStepElement = document.getElementById(`step${currentStep}`);
        prevStepElement.classList.add('active');
        prevStepElement.style.animation = 'slideInLeft 0.4s ease forwards';
    }, 400);
}

function showToast(message) {
    // Create toast element
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #25408f;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        animation: slideInRight 0.3s ease;
    `;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Remove toast after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOutRight 0.3s ease forwards';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

// Auto-focus on code input when it appears
function observeStepChanges() {
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                if (currentStep === 2) {
                    const codeInput = document.getElementById('resetCode');
                    if (codeInput) {
                        codeInput.focus();
                    }
                }
            }
        });
    });
    
    const step2 = document.getElementById('step2');
    if (step2) {
        observer.observe(step2, { attributes: true });
    }
}

// Initialize step observer
observeStepChanges();
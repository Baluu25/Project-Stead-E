let currentStep = 1;
const totalSteps = 6;

// Debounce function for performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function nextStep() {
    if (!validateStep(currentStep)) {
        return;
    }
    
    storeStepData(currentStep);
    navigateStep(currentStep + 1);
}

function prevStep() {
    navigateStep(currentStep - 1);
}

function navigateStep(newStep) {
    const currentCard = document.getElementById(`step${currentStep}`);
    const direction = newStep > currentStep ? 'next' : 'prev';
    
    // Animation classes based on direction
    const exitAnimation = direction === 'next' ? 'slideOutLeft' : 'slideOutRight';
    const enterAnimation = direction === 'next' ? 'slideInRight' : 'slideInLeft';
    
    currentCard.style.animation = `${exitAnimation} 0.4s ease forwards`;
    
    setTimeout(() => {
        currentCard.classList.remove('active');
        
        currentStep = newStep;
        const nextCard = document.getElementById(`step${currentStep}`);
        nextCard.classList.add('active');
        nextCard.style.animation = `${enterAnimation} 0.4s ease forwards`;
        
        updateProgress();
    }, 400);
}

function validateStep(step) {
    switch(step) {
        case 1:
            const basicForm = document.getElementById('basicInfoForm');
            if (!basicForm.checkValidity()) {
                basicForm.reportValidity();
                return false;
            }
            return true;
            
        case 2:
            const genderSelected = document.querySelector('input[name="gender"]:checked');
            if (!genderSelected) {
                showAlert('Please select your gender');
                return false;
            }
            return true;
            
        case 3:
            const weightInput = document.getElementById('weight');
            if (!weightInput.value || weightInput.value < 30 || weightInput.value > 300) {
                showAlert('Please enter a valid weight between 30 and 300 kg');
                return false;
            }
            return true;
            
        case 4:
            const heightInput = document.getElementById('height');
            if (!heightInput.value || heightInput.value < 100 || heightInput.value > 250) {
                showAlert('Please enter a valid height between 100 and 250 cm');
                return false;
            }
            return true;
            
        case 5:
            const goalSelected = document.querySelector('input[name="user_goal"]:checked');
            if (!goalSelected) {
                showAlert('Please select your main goal');
                return false;
            }
            return true;
            
        case 6:
            const activitySelected = document.querySelector('input[name="activity_level"]:checked');
            if (!activitySelected) {
                showAlert('Please select your activity level');
                return false;
            }
            return true;
            
        default:
            return true;
    }
}

function showAlert(message) {
    // Use a more user-friendly notification system in production
    alert(message);
}

function storeStepData(step) {
    // In a real application, you would store this data
    // For now, we'll just log it for demonstration
    const stepData = {
        1: () => {
            const formData = new FormData(document.getElementById('basicInfoForm'));
            return {
                name: formData.get('name'),
                username: formData.get('username'),
                email: formData.get('email')
            };
        },
        2: () => {
            const gender = document.querySelector('input[name="gender"]:checked');
            return { gender: gender?.value };
        },
        3: () => {
            const weight = document.getElementById('weight');
            return { weight: weight?.value };
        },
        4: () => {
            const height = document.getElementById('height');
            return { height: height?.value };
        },
        5: () => {
            const userGoal = document.querySelector('input[name="user_goal"]:checked');
            return { userGoal: userGoal?.value };
        },
        6: () => {
            const activityLevel = document.querySelector('input[name="activity_level"]:checked');
            return { activityLevel: activityLevel?.value };
        }
    };
    
    if (stepData[step]) {
        console.log(`Step ${step} data:`, stepData[step]());
    }
}

function updateProgress() {
    const progressBar = document.getElementById('progressBar');
    const steps = document.querySelectorAll('.step');
    
    const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
    progressBar.style.width = `${progress}%`;
    
    steps.forEach((step, index) => {
        if (index + 1 <= currentStep) {
            step.classList.add('active');
        } else {
            step.classList.remove('active');
        }
    });
}

// Password toggle functionality
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

// Optimized event listeners
document.addEventListener('DOMContentLoaded', function() {
    initializeOptionCards();
    initializeNumberInputs();
    initializePasswordToggle();
});

function initializeOptionCards() {
    const optionCards = document.querySelectorAll('.option-card');
    
    optionCards.forEach(card => {
        card.addEventListener('click', debounce(function(event) {
            handleOptionCardClick(this, event);
        }, 50)); // 50ms debounce
    });
}

function initializeNumberInputs() {
    // Add input validation for number fields
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.validity.rangeOverflow) {
                this.setCustomValidity('Value is too high');
            } else if (this.validity.rangeUnderflow) {
                this.setCustomValidity('Value is too low');
            } else {
                this.setCustomValidity('');
            }
        });
    });
}

function handleOptionCardClick(card, event) {
    const input = card.querySelector('input');
    
    if (!input) return;
    
    if (input.type === 'radio') {
        // Uncheck others in the same group
        const groupName = input.name;
        document.querySelectorAll(`input[name="${groupName}"]`).forEach(otherInput => {
            if (otherInput !== input) {
                otherInput.checked = false;
                otherInput.closest('.option-card').classList.remove('checked');
            }
        });
    }
    
    // Toggle checked state
    if (input.type === 'checkbox') {
        input.checked = !input.checked;
    } else {
        input.checked = true;
    }
    
    // Update visual state
    if (input.checked) {
        card.classList.add('checked');
    } else {
        card.classList.remove('checked');
    }
    
    createRippleEffect(card, event);
}

function createRippleEffect(card, event) {
    const ripple = document.createElement('span');
    const rect = card.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
        position: absolute;
        border-radius: 50%;
        background: rgba(37, 64, 143, 0.3);
        transform: scale(0);
        animation: ripple 0.6s linear;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        pointer-events: none;
        z-index: 1;
    `;
    
    const optionContent = card.querySelector('.option-content');
    if (optionContent) {
        optionContent.appendChild(ripple);
        
        setTimeout(() => {
            if (ripple.parentNode === optionContent) {
                optionContent.removeChild(ripple);
            }
        }, 600);
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(event) {
    if (event.key === 'ArrowRight') {
        nextStep();
    } else if (event.key === 'ArrowLeft') {
        prevStep();
    }
});
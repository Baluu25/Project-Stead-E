<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
  <title>Stead-E - Create Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  @vite(['resources/js/app.js', 'resources/css/style.css', 'resources/js/register.js'])
</head>
<body>
  <div class="background-gradient"></div>
  
  <div class="back-to-home-container">
    <a href="{{ url('/') }}" class="back-to-home">
      <span class="back-arrow">←</span> Back to Home
    </a>
  </div>

  <div class="progress-container">
    <div class="progress">
      <div class="progress-bar" id="progressBar"></div>
    </div>
    <div class="progress-steps">
      <span class="step active" data-step="1">1</span>
      <span class="step" data-step="2">2</span>
      <span class="step" data-step="3">3</span>
      <span class="step" data-step="4">4</span>
      <span class="step" data-step="5">5</span>
      <span class="step" data-step="6">6</span>
    </div>
  </div>

  <div class="registration-container">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
          
          <div class="registration-card active" id="step1">
            <div class="text-center mb-2">
              <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('images/logo.png') }}" alt="Stead-E" class="registration-logo">
              </a>
            </div>
            <h1 class="registration-title">Create Account</h1>
            <p class="registration-subtitle">Start creating habits today</p>
            
            <form id="basicInfoForm">       
              <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
              </div>
              
              <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Choose a username" required>
              </div>
              
              <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
              </div>
              
              <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="password-container">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                  <button type="button" class="btn-toggle-password" id="togglePassword">
                    <span class="eye-icon">👁️</span>
                  </button>
                </div>
              </div>
              
              <button type="button" class="btn btn-primary mt-2" onclick="nextStep()">Continue</button>
            </form>
            
            <div class="login-redirect mt-2">
              <p>Already have an account? <a href="{{ url('/login') }}">sign in</a></p>
            </div>
          </div>

          <div class="registration-card" id="step2">
            <div class="text-center mb-2">
              <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('images/logo.png') }}" alt="Stead-E" class="registration-logo">
              </a>
            </div>
            <h1 class="registration-title">Tell Us About Yourself</h1>
            <p class="registration-subtitle">Help us personalize your experience</p>
            <form>
              <div class="form-group">
                <label class="form-label">I am</label>
                <div class="options-grid">
                  <label class="option-card">
                    <input type="radio" name="gender" value="male" required>
                    <div class="option-content">
                      <span class="option-icon">👨</span>
                      <span class="option-text">Male</span>
                    </div>
                  </label>
                  <label class="option-card">
                    <input type="radio" name="gender" value="female" required>
                    <div class="option-content">
                      <span class="option-icon">👩</span>
                      <span class="option-text">Female</span>
                    </div>
                  </label>
                  <label class="option-card">
                    <input type="radio" name="gender" value="other" required>
                    <div class="option-content">
                      <span class="option-icon">😊</span>
                      <span class="option-text">Other</span>
                    </div>
                  </label>
                </div>
              </div>
              <div class="form-buttons">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Continue</button>
              </div>
            </form>
          </div>

          <div class="registration-card" id="step3">
            <div class="text-center mb-2">
              <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('images/logo.png') }}" alt="Stead-E" class="registration-logo">
              </a>
            </div>
            <h1 class="registration-title">Your Weight</h1>
            <p class="registration-subtitle">How much do you weigh?</p>
            <form>
              <div class="form-group">
                <label for="weight" class="form-label">Weight (kg)</label>
                <input type="number" id="weight" name="weight" class="form-control" placeholder="Enter your weight in kg" min="30" max="300" step="0.1" required>
                <div class="form-text">Please enter your current weight in kilograms</div>
              </div>
              <div class="form-buttons">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Continue</button>
              </div>
            </form>
          </div>

          <div class="registration-card" id="step4">
            <div class="text-center mb-2">
              <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('images/logo.png') }}" alt="Stead-E" class="registration-logo">
              </a>
            </div>
            <h1 class="registration-title">Your Height</h1>
            <p class="registration-subtitle">How tall are you?</p>
            <form>
              <div class="form-group">
                <label for="height" class="form-label">Height (cm)</label>
                <input type="number" id="height" name="height" class="form-control" placeholder="Enter your height in cm" min="100" max="250" step="1" required>
                <div class="form-text">Please enter your height in centimeters</div>
              </div>
              <div class="form-buttons">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Continue</button>
              </div>
            </form>
          </div>

          <div class="registration-card" id="step5">
            <div class="text-center mb-2">
              <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('images/logo.png') }}" alt="Stead-E" class="registration-logo">
              </a>
            </div>
            <h1 class="registration-title">Your Goals</h1>
            <p class="registration-subtitle">What do you want to achieve?</p>
            <form>
              <div class="form-group">
                <label class="form-label">My main goal is</label>
                <div class="options-grid">
                  <label class="option-card">
                    <input type="radio" name="user_goal" value="weight_loss" required>
                    <div class="option-content">
                      <span class="option-icon">⚖️</span>
                      <span class="option-text">Weight Loss</span>
                      <small>Shed extra pounds</small>
                    </div>
                  </label>
                  <label class="option-card">
                    <input type="radio" name="user_goal" value="consistency" required>
                    <div class="option-content">
                      <span class="option-icon">📅</span>
                      <span class="option-text">Build Consistency</span>
                      <small>Establish routines</small>
                    </div>
                  </label>
                  <label class="option-card">
                    <input type="radio" name="user_goal" value="quit_habit" required>
                    <div class="option-content">
                      <span class="option-icon">🚫</span>
                      <span class="option-text">Quit a Bad Habit</span>
                      <small>Break unwanted patterns</small>
                    </div>
                  </label>
                  <label class="option-card">
                    <input type="radio" name="user_goal" value="explore" required>
                    <div class="option-content">
                      <span class="option-icon">🔍</span>
                      <span class="option-text">Just Exploring</span>
                      <small>See what the app offers</small>
                    </div>
                  </label>
                </div>
              </div>
              <div class="form-buttons">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Continue</button>
              </div>
            </form>
          </div>

          <div class="registration-card" id="step6">
            <div class="text-center mb-2">
              <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('images/logo.png') }}" alt="Stead-E" class="registration-logo">
              </a>
            </div>
            <h1 class="registration-title">Your Fitness Level</h1>
            <p class="registration-subtitle">Help us create the perfect plan for you</p>
            
            <form action="{{ route('register') }}" method="POST" id="finalForm">
              @csrf
              
              <input type="hidden" id="final_name" name="name">
              <input type="hidden" id="final_username" name="username">
              <input type="hidden" id="final_email" name="email">
              <input type="hidden" id="final_password" name="password">
              <input type="hidden" id="final_gender" name="gender">
              <input type="hidden" id="final_weight" name="weight">
              <input type="hidden" id="final_height" name="height">
              <input type="hidden" id="final_user_goal" name="user_goal">
              <input type="hidden" id="final_activity_level" name="activity_level">
              
              <div class="form-group">
                <label class="form-label">My current activity level</label>
                <div class="options-grid">
                  <label class="option-card">
                    <input type="radio" name="activity_level" value="beginner" required>
                    <div class="option-content">
                      <span class="option-icon">🌱</span>
                      <span class="option-text">Beginner</span>
                      <small>Just starting out</small>
                    </div>
                  </label>
                  <label class="option-card">
                    <input type="radio" name="activity_level" value="intermediate" required>
                    <div class="option-content">
                      <span class="option-icon">🌿</span>
                      <span class="option-text">Intermediate</span>
                      <small>Some experience</small>
                    </div>
                  </label>
                  <label class="option-card">
                    <input type="radio" name="activity_level" value="advanced" required>
                    <div class="option-content">
                      <span class="option-icon">🎯</span>
                      <span class="option-text">Advanced</span>
                      <small>Regularly active</small>
                    </div>
                  </label>
                </div>
              </div>
              <div class="form-buttons">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
                <button type="button" class="btn btn-primary" onclick="submitFinalForm()">Complete Registration</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

<script>
function submitFinalForm() {
    document.getElementById('final_name').value = document.getElementById('name').value;
    document.getElementById('final_username').value = document.getElementById('username').value;
    document.getElementById('final_email').value = document.getElementById('email').value;
    document.getElementById('final_password').value = document.getElementById('password').value;
    
    const genderRadio = document.querySelector('input[name="gender"]:checked');
    if (genderRadio) {
        document.getElementById('final_gender').value = genderRadio.value;
    }
    
    document.getElementById('final_weight').value = document.getElementById('weight').value;
    document.getElementById('final_height').value = document.getElementById('height').value;
    
    const goalRadio = document.querySelector('input[name="user_goal"]:checked');
    if (goalRadio) {
        document.getElementById('final_user_goal').value = goalRadio.value;
    }
    
    const activityRadio = document.querySelector('input[name="activity_level"]:checked');
    if (activityRadio) {
        document.getElementById('final_activity_level').value = activityRadio.value;
    }
    
    document.getElementById('finalForm').submit();
}
</script>

</body>
</html>
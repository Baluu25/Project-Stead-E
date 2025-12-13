<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="images/logo.png">
  <title>Stead-E - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/login.js?v=1.0" defer></script>
</head>
<body>
  <div class="background-gradient"></div>
  
  <div class="back-to-home-container">
    <a href="index.html" class="back-to-home">
      <span class="back-arrow">←</span> Back to Home
    </a>
  </div>

  <div class="login-container">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
          <div class="login-card">
            <div class="text-center mb-4">
              <a href="index.php" class="logo-link">
                <img src="images/logo.png" alt="Stead-E" class="login-logo" loading="lazy">
              </a>
            </div>
            
            <h1 class="login-title">Welcome Back</h1>
            <p class="login-subtitle">Sign in to continue your journey</p>
            <?php if (isset($_GET['error'])): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
            
            <form id="loginForm" action="controllers/process_login.php" method="POST">
              <div class="form-group">
                <label for="email" class="form-label">E-mail or Username</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email or username" required>
              </div>
              
              <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                <div class="password-toggle">
                  <button type="button" class="btn-toggle-password" id="togglePassword">
                    <span class="eye-icon">👁️</span>
                  </button>
                </div>
              </div>

              <div class="form-options">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
              </div>
              
              <button type="submit" class="btn btn-primary mt-3">Sign In</button>
            </form>
            
            <div class="login-divider">
              <span>or</span>
            </div>

            <div class="social-login">
              <button type="button" class="btn btn-google">
                <span class="social-icon">🔍</span>
                Continue with Google
              </button>
              <button type="button" class="btn btn-facebook">
                <span class="social-icon">f</span>
                Continue with Facebook
              </button>
            </div>
            
            <div class="register-redirect mt-4">
              <p>Don't have an account? <a href="register.php">Create account</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
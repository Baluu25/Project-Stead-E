<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="images/logo.png">
  <title>Stead-E - Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/forgot_password.js?v=1.0" defer></script>
</head>
<body>
  <div class="background-gradient"></div>

  <div class="back-to-home-container">
    <a href="index.html" class="back-to-home">
      <span class="back-arrow">←</span> Back to Home
    </a>
  </div>

  <div class="forgot-password-container">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
          <div class="forgot-password-card">
            <div class="text-center mb-3">
              <a href="index.php" class="logo-link">
                <img src="images/logo.png" alt="Stead-E" class="forgot-password-logo" loading="lazy">
              </a>
            </div>
            <h1 class="forgot-password-title">Reset Password</h1>
            <p class="forgot-password-subtitle">Enter your email to receive reset instructions</p>

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
            
            <div class="forgot-password-step active" id="step1">
              <form id="emailForm" action="process_forgot_password.php" method="POST">
                <div class="form-group">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                </div>
                
                <button type="submit" class="btn btn-primary mt-3">Send Reset Instructions</button>
              </form>
            </div>

            <div class="forgot-password-step" id="step2">
              <form id="codeForm" action="process_reset_code.php" method="POST">
                <div class="form-group">
                  <label for="resetCode" class="form-label">Verification Code</label>
                  <input type="text" id="resetCode" name="reset_code" class="form-control" placeholder="Enter the 6-digit code" required maxlength="6">
                  <div class="form-text">We sent a 6-digit code to your email</div>
                </div>
                
                <div class="form-buttons">
                  <button type="button" class="btn btn-secondary" onclick="previousStep()">Back</button>
                  <button type="submit" class="btn btn-primary">Verify Code</button>
                </div>
              </form>

              <div class="resend-code mt-3">
                <p>Didn't receive the code? <a href="#" id="resendCode">Resend code</a></p>
              </div>
            </div>

            <div class="forgot-password-step" id="step3">
              <form id="passwordForm" action="process_new_password.php" method="POST">
                <div class="form-group">
                  <label for="newPassword" class="form-label">New Password</label>
                  <input type="password" id="newPassword" name="new_password" class="form-control" placeholder="Enter your new password" required>
                  <div class="password-toggle">
                    <button type="button" class="btn-toggle-password" data-target="newPassword">
                      <span class="eye-icon">👁️</span>
                    </button>
                  </div>
                </div>

                <div class="form-group">
                  <label for="confirmPassword" class="form-label">Confirm New Password</label>
                  <input type="password" id="confirmPassword" name="confirm_password" class="form-control" placeholder="Confirm your new password" required>
                  <div class="password-toggle">
                    <button type="button" class="btn-toggle-password" data-target="confirmPassword">
                      <span class="eye-icon">👁️</span>
                    </button>
                  </div>
                </div>
                
                <div class="form-buttons">
                  <button type="button" class="btn btn-secondary" onclick="previousStep()">Back</button>
                  <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
              </form>
            </div>

            <div class="forgot-password-step" id="step4">
              <div class="success-message text-center">
                <div class="success-icon">✅</div>
                <h3>Password Reset Successful!</h3>
                <p>Your password has been successfully reset. You can now sign in with your new password.</p>
                <a href="login.php" class="btn btn-primary mt-3">Back to Login</a>
              </div>
            </div>
            
            <div class="back-to-login mt-4">
              <a href="login.php" class="back-to-login-link">← Back to Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
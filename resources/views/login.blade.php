<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="images/logo.png">
  <title>Stead-E - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
          crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
            crossorigin="anonymous" defer></script>
  @vite(['resources/js/script.js'])
  @vite(['resources/js/login.js'])          
  @vite(['resources/css/style.css'])
</head>
<body>
    <div class="background-gradient"></div>
    
    <div class="back-to-home-container">
        <a href="{{ url('/') }}" class="back-to-home">
            <span class="back-arrow">←</span> Back to Home
        </a>
    </div>

    <div class="login-container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="login-card">
                        <div class="text-center mb-4">
                            <a href="{{ url('/') }}" class="logo-link">
                                <img src="{{ asset('images/logo.png') }}" alt="Stead-E" class="login-logo">
                            </a>
                        </div>
                        
                        <h1 class="login-title">Welcome Back</h1>
                        <p class="login-subtitle">Sign in to continue your journey</p>
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" id="email" name="email" class="form-control" 
                                       value="{{ old('email') }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-options">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-3">Sign In</button>
                        </form>
                        
                        <div class="register-redirect mt-4">
                            <p>Don't have an account? <a href="{{ url('/register') }}">Create account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
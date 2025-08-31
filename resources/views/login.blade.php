<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/logreg.css') }}">
</head>
<body>
  <div class="auth-container">
    <div class="auth-box">
      <h2>Login</h2>

      <!-- Display Error Message -->
      @if(session('error'))
        <p class="error-msg">{{ session('error') }}</p>
      @endif

      <!-- Display Validation Errors -->
      @if($errors->any())
        <div class="error-msg">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form action="{{ url('/login') }}" method="post">
        @csrf
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password">
        </div>
        <button type="submit" class="btn">Login</button>
        <p class="switch-link">
          Don’t have an account? <a href="{{ url('/register') }}">Register</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>

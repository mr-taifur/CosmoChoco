<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('css/logreg.css') }}">
</head>
<body>
  <div class="auth-container">
    <div class="auth-box">
      <h2>Register</h2>

      <!-- Display Success Message -->
      @if(session('success'))
        <p class="success-msg">{{ session('success') }}</p>
      @endif

      <!-- Display Validation Errors -->
      @if($errors->any())
        <div class="error-msg">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form action="{{ url('/register') }}" method="post">
        @csrf
        <div class="input-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="input-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
        </div>
        <button type="submit" class="btn">Register</button>
        <p class="switch-link">
          Already have an account? <a href="{{ url('/login') }}">Login</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>

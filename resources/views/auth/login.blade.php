@extends('base')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card mt-5">
      <div class="card-header">Connexion</div>
      <div class="card-body">
        <form method="POST" action="{{ route('auth.login') }}">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember"
                   {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Se souvenir de moi</label>
          </div>

          <button type="submit" class="btn btn-primary w-100">Se connecter</button>

          <div class="mt-3 text-center">
            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
